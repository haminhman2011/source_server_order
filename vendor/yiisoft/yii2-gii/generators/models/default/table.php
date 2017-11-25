<?php
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

$excludesAttribute = [ 'status', 'created_by', 'created_date', 'updated_date', 'id', 'modified_by' ];
$cssClassName         = Inflector::camel2id( StringHelper::basename( $tableName ), '-' );
echo '<?php'
?>


namespace <?= $tableNs ?>;

use backend\models\<?= $className ?>;
use common\utils\table\DataTable;
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
	*/
	public function getData()
	{
		$models = $this->getModels();
		$dataArray = [];
		foreach ($models as $model) {
<?php $viewUrl = '".Url::to([\'view\', \'id\' => $model->id])."'; ?>
            $htmlAction  = "<a class='btn yellow-gold link-view-<?= $cssClassName ?>' title='<?= $generator->enableI18N ? '<?= Yii::t(\'yii\', \'View\') ?>' : $generator->defaultLanguage == 'vi' ? 'Xem' : 'View' ?>' data-id='<?= '$model->id'?>' href='<?= $viewUrl ?>'><i class='glyphicon glyphicon-eye-open'></i> </a>";
            <?php echo 'if ( Yii::$app->permission->can( Yii::$app->controller->id , \'update\' )) {' . "\n"; $updateUrl = '".Url::to([\'update\', \'id\' => $model->id])."';?>
                $htmlAction .= " <a class='btn green-steel link-update-<?= $cssClassName ?>' title='<?= $generator->enableI18N ? '<?= Yii::t(\'yii\', \'Update\') ?>' : $generator->defaultLanguage == 'vi' ? 'Sửa' : 'Update' ?>' data-id='<?= '$model->id'?>' href='<?= $updateUrl ?>'><i class='glyphicon glyphicon-edit'></i> </a>";
            <?php echo '}' . "\n"; ?>
            <?php echo 'if ( Yii::$app->permission->can( Yii::$app->controller->id , \'delete\' )) {' . "\n"; $deleteUrl = '".Url::to([\'delete\'])."'; ?>
                $htmlAction .= " <button class='btn red-mint btn-delete-<?= $cssClassName ?>' title='<?= $generator->enableI18N ? '<?= Yii::t(\'yii\', \'Delete\') ?>' : $generator->defaultLanguage == 'vi' ? 'Xóa' : 'Delete' ?>' data-id='<?= '$model->id'?>' data-url='<?= $deleteUrl ?>'><i class='glyphicon glyphicon-trash'></i> </button>";
            <?php echo '}' . "\n"; ?>
			$dataArray[] = [
				"<label class='mt-checkbox mt-checkbox-single mt-checkbox-outline'><input class='cb-single' type='checkbox' data-id='$model->id'><span></span></label>",
<?php
$space = "\t\t\t\t";
foreach ( $labels as $key => $label ) {
    $data  = '';
    if (!in_array($key, $excludesAttribute, true)) {
        $data = '$model->' . $key . ',' . "\n";
        if (substr( $key, -3) === '_id') {
            $relation = substr( $key, 0, -3);
            $foreignName = '$model->' . Inflector::variablize( $relation ) . '->name';
            $data = '$model->' . $key . ' != null ? ' . $foreignName . ' : \'\',' . "\n" . "\n";
        }
        if (strpos($key, 'date') !== false) {
            $data = '\Yii::$app->formatter->asDate(' . '$model->' . $key . '),' . "\n";
        }
        if (strpos($key, 'quantity') !== false) {
            $data = 'number_format( $model->' . $key . ' ),' . "\n";
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
		$models = <?= $className ?>::find()->where(['<?= StringHelper::basename( $tableName ) ?>.status' => 1])->distinct();
		$this->totalRecords = $models->count();
		$models = $models->limit($this->length)
						 ->offset($this->start)
						 ->orderBy([$column => $this->direction])
						 ->all();

		return $models;
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