<?php
use common\utils\helpers\ArrayHelper;
use common\utils\helpers\StringHelper;
use yii\helpers\Inflector;

$excludesAttribute = ArrayHelper::compact(array_map('trim', explode(',', $generator->skippedColumns)));
//$validAttributes   = array_diff( $labels, $excludesAttribute);
$cssClassName         = Inflector::camel2id( StringHelper::basename( $tableName ), '-' );
$joinWith = [];
echo '<?php'
?>


namespace <?= $tableNs ?>;

use <?= '\\'.$generator->ns.'\\'.$className?>;
use common\utils\table\DataTable;
use yii\helpers\Url;
use Yii;

class <?= $tableClassName ?> extends DataTable
{
    /*public function __construct() {
		parent::__construct();
        $arguments = Yii::$app->request->post();
	}*/

	/**
	* Tạo danh sách <?= $className . "\n" ?>.
	* @return array
    * @throws \yii\base\InvalidParamException
	*/
	public function getData()
	{
		$models = $this->getModels();
		$dataArray = [];
		foreach ($models as $model) {
<?php $viewUrl = '".Url::to([\'view\', \'id\' => $model->id])."'; ?>
<?php if ($generator->enableI18N): ?>
            $htmlAction  = "<a class='btn yellow-gold link-view-<?= $cssClassName ?>' title='".<?= 'Yii::t(\'yii\', \'View\')' ?>."' data-id='<?= '$model->id'?>' href='<?= $viewUrl ?>'><i class='fa fa-eye' aria-hidden='true'></i> </a>";
            <?php echo 'if ( Yii::$app->permission->can( Yii::$app->controller->id , \'update\' )) {' . "\n"; $updateUrl = '".Url::to([\'update\', \'id\' => $model->id])."';?>
                $htmlAction .= " <a class='btn green-steel btn-update-<?= $cssClassName ?>' title='".<?= 'Yii::t(\'yii\', \'Update\')' ?>."' data-id='<?= '$model->id'?>' href='<?= $updateUrl ?>'><i class='fa fa-pencil' aria-hidden='true'></i> </a>";
            <?php echo '}' . "\n"; ?>
            <?php echo 'if ( Yii::$app->permission->can( Yii::$app->controller->id , \'delete\' )) {' . "\n"; $deleteUrl = '".Url::to([\'delete\'])."';?>
                $htmlAction .= " <button class='btn red-mint btn-delete-<?= $cssClassName ?>' title='".<?= 'Yii::t(\'yii\', \'Delete\')' ?>."' data-id='<?= '$model->id'?>' data-url='<?= $deleteUrl ?>'><i class='fa fa-trash' aria-hidden='true'></i>
    </button>";
            <?php echo '}' . "\n"; ?>
<?php else: ?>
            $htmlAction  = "<a class='btn yellow-gold link-view-<?= $cssClassName ?>' title='<?= $generator->defaultLanguage == 'vi' ? 'Xem' : 'View' ?>' data-id='<?= '$model->id'?>' href='<?= $viewUrl ?>'><i class='fa fa-eye' aria-hidden='true'></i> </a>";
            <?php echo 'if ( Yii::$app->permission->can( Yii::$app->controller->id , \'update\' )) {' . "\n"; $updateUrl = '".Url::to([\'update\', \'id\' => $model->id])."';?>
                $htmlAction .= " <a class='btn green-steel btn-update-<?= $cssClassName ?>' title='<?= $generator->defaultLanguage == 'vi' ? 'Sửa' : 'Update' ?>' data-id='<?= '$model->id'?>' href='<?= $updateUrl ?>'><i class='fa fa-pencil' aria-hidden='true'></i> </a>";
            <?php echo '}' . "\n"; ?>
            <?php echo 'if ( Yii::$app->permission->can( Yii::$app->controller->id , \'delete\' )) {' . "\n"; $deleteUrl = '".Url::to([\'delete\'])."';?>
                $htmlAction .= " <button class='btn red-mint btn-delete-<?= $cssClassName ?>' title='<?= $generator->defaultLanguage == 'vi' ? 'Xóa' : 'Delete' ?>' data-id='<?= '$model->id'?>' data-url='<?= $deleteUrl ?>'><i class='fa fa-trash' aria-hidden='true'></i> </button>";
            <?php echo '}' . "\n"; ?>
<?php endif ?>
			$dataArray[] = [
                "<label class='mt-checkbox mt-checkbox-single mt-checkbox-outline'><input class='cb-single' type='checkbox' data-id='$model->id'><span></span></label>",
<?php
$space = "\t\t\t\t";
foreach ( $labels as $key => $label ) {
	$data  = '';
	if (empty($excludesAttribute) || !in_array($key, $excludesAttribute, true)) {
		$data = '$model->' . $key . ',' . "\n";
		if (substr( $key, -3) === '_id') {
			$relation           = substr( $key, 0, -3);
			$foreignDisplayText = '$model->' . Inflector::variablize( $relation ) . '->displayText()';
			$data               = '$model->' . $key . ' !== null ? ' . $foreignDisplayText . ' : \'\',' . "\n";
            $joinWith[]         = '\'' . Inflector::variablize( $relation ) . '\'';
		}
		if (strpos($key, 'date') !== false) {
		    $data = '\Yii::$app->formatter->asDate(' . '$model->' . $key . '),' . "\n";
        }
        if (strpos($key, 'quantity') !== false || strpos($key, 'total') !== false) {
		    $data = 'number_format( $model->' . $key . ' ),' . "\n";
        }
        if (strpos($key, 'price') !== false || strpos($key, 'amount') !== false) {
		    $data = 'number_format( $model->' . $key . ', 2 ),' . "\n";
        }
		echo $space . $data;
	}
}
?>
				$htmlAction
			];
		}
		return $dataArray;
	}

	/**
	* Tìm <?= $className ?>.
	* @return <?= $className ?>[].
	*/
	public function getModels()
	{
		$column = $this->getColumn();
<?php if (count($joinWith) > 0): ?>
        $models = <?= $className ?>::find()->joinWith([<?= implode(',', $joinWith) ?>])
                                            ->where(['<?= StringHelper::basename( $tableName ) ?>.status' => 1])
                                            ->andFilterWhere([])->distinct();
<?php else: ?>
        $models = <?= $className ?>::find()->where(['<?= StringHelper::basename( $tableName ) ?>.status' => 1])
                                            ->andFilterWhere([])->distinct();
<?php endif ?>

		$this->totalRecords = $models->count();
        return $models->limit($this->length)
						 ->offset($this->start)
						 ->orderBy([$column => $this->direction])
						 ->all();
	}

	/**
	 * Lấy cột muốn sắp xếp
	 * @return string
	 */
	public function getColumn()
	{
		switch ($this->column) {
			<?php
				$i = 0;
				foreach ( $labels as $key => $label ) {
					if (!in_array($key, $excludesAttribute, true)) {
						if ($i === 0) {
							echo 'case ' . '\'' . ($i + 1) . '\'' . ":\n";
						} else {
							echo "\t\t\t" . 'case ' . '\'' . ($i + 1) . '\'' . ":\n";
						}
						echo "\t\t\t\t" . '$field = ' . '\'' . $key . '\'' . ';' . "\n";
						echo "\t\t\t\t" . 'break;' . "\n";
						$i++;
					}
				}
			?>
			default:
				$field = 'id';
				break;
		}
		return $field;
	}
}

?>