<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);

/* @var $class ActiveRecordInterface */
$class               = $generator->modelClass;
$pks                 = $class::primaryKey();
$urlParams           = $generator->generateUrlParams();
$actionParams        = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();
$ajax                = $generator->isModal ? 'Ajax' : '';
$action              = $generator->isModal ? ', \'create\', \'update\'' : '';
$mainModelIdName     = Inflector::camel2id( StringHelper::basename( $generator->modelClass ), '_' );
$foreignKey          = '';
$detailForeignKey    = '';
$modelVariableName   = Inflector::variablize(StringHelper::basename( $generator->modelClass ));
$modelClassName      = Inflector::camel2id( StringHelper::basename( $generator->modelClass ), '-' );

if ($generator->hasDetail) {
	$subModel            = Inflector::camelize($generator->subTableName);
	$subModelString      = 'backend\\models\\' . $subModel;
	$subModelIdName      = Inflector::camel2id( StringHelper::basename( $generator->subTableName ), '_' );
	$subModelClass       = new $subModelString;
	$subModelForeignKeys = $subModelClass->getTableSchema()->foreignKeys;
	$mainModelRelation   = Inflector::pluralize(Inflector::variablize($generator->subTableName));
	foreach ( $subModelForeignKeys as $subModelForeignKey ) {
		if (in_array($mainModelIdName, array_values($subModelForeignKey), true)) {
			$foreignKey = array_search('id', $subModelForeignKey, true);
			break;
		}
	}
	if($generator->hasSubDetail) {
		$subDetailModel            = Inflector::camelize($generator->subDetailTableName);
		$subDetailModelString      = 'backend\\models\\' . $subDetailModel;
		$subDetailModelClass       = new $subDetailModelString;
		$subDetailModelForeignKeys = $subDetailModelClass->getTableSchema()->foreignKeys;
		$subModelRelation          = Inflector::pluralize(Inflector::variablize($generator->subDetailTableName));
		foreach ( $subDetailModelForeignKeys as $subDetailModelForeignKey ) {
			if (in_array($subModelIdName, array_values($subDetailModelForeignKey), true)) {
				$detailForeignKey = array_search('id', $subDetailModelForeignKey, true);
				break;
			}
		}
	}
}
echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\MethodNotAllowedHttpException;
use <?= ltrim($generator->modelClass, '\\') ?>;
use common\utils\controller\Controller;
use common\utils\table\TableFacade;
use backend\models\table\<?= $modelClass ?>Table;
use yii\helpers\Url;
<?php if($generator->hasDetail): ?>
use backend\models\<?= Inflector::camelize(StringHelper::basename( $generator->subTableName )) ?>;
use common\utils\model\ModelBuilder;
<?php if ($generator->hasSubDetail): ?>
use backend\models\<?= Inflector::camelize(StringHelper::basename( $generator->subDetailTableName )) ?>;
<?php endif; ?>
use common\utils\model\Model;
use yii\base\Exception;
<?php endif; ?>

class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
{
    /**
    * Hiện danh sách <?= $modelClass ?>.
    *
    * @return string
    */
    public function actionIndex()
    {
		$<?= $modelVariableName ?> = new <?= $modelClass ?>();
        return $this->render('index', ['<?= $modelVariableName ?>' => $<?= $modelVariableName ?>]);
    }

    /**
    * Load ajax table trang index
    *
    * @return string
    */
    public function actionIndexTable() {
        $tableFacade = new TableFacade( new <?= $modelClass ?>Table );
        return $tableFacade->getDataTable();
    }

    /**
    * Hiện trang view chi tiết <?= $modelClass ?>.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionView()
	{
<?php if ($generator->isModal): ?>
        $<?= $modelVariableName ?>Id = Yii::$app->request->post('id', '');
<?php else: ?>
        $<?= $modelVariableName ?>Id = Yii::$app->request->get('id', '');
<?php endif; ?>
        $<?= $modelVariableName ?> = $this->findModel($<?= $modelVariableName ?>Id);
<?php if($generator->hasDetail): ?>
		$<?= Inflector::pluralize(Inflector::variablize($generator->subTableName)) ?> = <?= $subModel ?>::find()->where( [ '<?= $generator->getDeleteAttribute() ?>' => 1, <?= '\'' . $foreignKey . '\'' ?> => $<?= $modelVariableName ?>Id ] )->all();
		$<?= Inflector::variablize($generator->subTableName) ?> = new <?= $subModel ?>();
		return $this->render<?= $ajax ?>('view', [
			'<?= $modelVariableName ?>' => $<?= $modelVariableName ?>,
			'<?= Inflector::pluralize(Inflector::variablize($generator->subTableName)) ?>' => $<?= Inflector::pluralize(Inflector::variablize($generator->subTableName)) ?>,
			'<?= Inflector::variablize($generator->subTableName) ?>' => $<?= Inflector::variablize($generator->subTableName) . "\n" ?>
		]);
<?php else: ?>
		return $this->render<?= $ajax ?>('view', [
			'<?= $modelVariableName ?>' => $<?= $modelVariableName . "\n" ?>
		]);
<?php endif ?>
	}

    /**
    * Hiện trang create <?= $modelClass ?>.
    *
    * @return string
    */
    public function actionCreate()
    {
		$<?= $modelVariableName ?> = new <?= $modelClass ?>();
<?php if($generator->hasDetail): ?>
		$<?= Inflector::variablize($generator->subTableName) ?> = new <?= $subModel ?>();
		return $this->render<?= $ajax ?>('create', [
			'<?= $modelVariableName ?>' => $<?= $modelVariableName ?>,
			'<?= Inflector::variablize($generator->subTableName) ?>' => $<?= Inflector::variablize($generator->subTableName) . "\n" ?>
		]);
<?php else: ?>
		return $this->render<?= $ajax ?>('create', [
			'<?= $modelVariableName ?>' => $<?= $modelVariableName ?>,
		]);
<?php endif ?>
    }

    /**
    * Hiện trang update <?= $modelClass ?>.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionUpdate()
	{
<?php if ($generator->isModal): ?>
        $<?= $modelVariableName ?>Id = Yii::$app->request->post('id', '');
<?php else: ?>
        $<?= $modelVariableName ?>Id = Yii::$app->request->get('id', '');
<?php endif; ?>
		$<?= $modelVariableName ?> = $this->findModel($<?= $modelVariableName ?>Id);
<?php if($generator->hasDetail): ?>
		$<?= Inflector::pluralize(Inflector::variablize($generator->subTableName)) ?> = <?= $subModel ?>::find()->where( [ '<?= $generator->getDeleteAttribute() ?>' => 1, <?= '\'' . $foreignKey . '\'' ?> => $<?= $modelVariableName ?>Id ] )->all();
		$<?= Inflector::variablize($generator->subTableName) ?> = new <?= $subModel ?>();
		return $this->render<?= $ajax ?>('update', [
			'<?= $modelVariableName ?>' => $<?= $modelVariableName ?>,
			'<?= Inflector::pluralize(Inflector::variablize($generator->subTableName)) ?>' => $<?= Inflector::pluralize(Inflector::variablize($generator->subTableName)) ?>,
			'<?= Inflector::variablize($generator->subTableName) ?>' => $<?= Inflector::variablize($generator->subTableName) . "\n" ?>
		]);
<?php else: ?>
		return $this->render<?= $ajax ?>('update', [
			'<?= $modelVariableName ?>' => $<?= $modelVariableName . "\n" ?>
		]);
<?php endif ?>
	}

<?php if(!$generator->hasDetail): ?>
    /**
    * Lưu <?= $modelClass ?> model.
    *
    * @return string:
    * - url: lưu thành công
    * - json: lưu thất bại, trả vể object lỗi
    * - An internal server error occurred: không load được model
    * @throws \yii\base\InvalidParamException
    * @throws NotFoundHttpException
    * @throws ServerErrorHttpException
    * @throws \yii\base\Exception
    * @throws \yii\db\Exception
    * @throws \yii\base\InvalidCallException
    */
	public function actionSave() {
		$<?= $modelVariableName ?>Id = Yii::$app->request->post('<?= $modelClass ?>')['id'];
		$<?= $modelVariableName ?>   = $<?= $modelVariableName ?>Id != '' ? $this->findModel($<?= $modelVariableName ?>Id) : new <?= $modelClass ?>();

		if ( $<?= $modelVariableName ?>->load( Yii::$app->request->post() ) ) {
<?php if(!$generator->isModal): ?>
			if ( $<?= $modelVariableName ?>->save() ) {
				return Url::to( [ 'index' ], true );
			}

			return $this->asJson($<?= $modelVariableName ?>->errors);
<?php else: ?>
			return $<?= $modelVariableName ?>->save() ? 'success' : $this->asJson($<?= $modelVariableName ?>->errors);
<?php endif ?>
		}

		throw new ServerErrorHttpException( Yii::t('yii', 'An internal server error occurred.') );
	}
<?php else: ?>
    /**
    * Lưu <?= $modelClass ?> model.
    *
    * @return string:
    * - url: lưu model <?= $modelClass ?> thành công
    * - json: lưu thất bại, trả vể object lỗi
    * - An internal server error occurred: không load được model
    * @throws \yii\base\InvalidParamException
    * @throws NotFoundHttpException
    * @throws ServerErrorHttpException
    * @throws \yii\base\Exception
    * @throws \yii\db\Exception
    * @throws \yii\base\InvalidCallException
    */
	public function actionSave() {
		$<?= $modelVariableName ?>Id = Yii::$app->request->post( '<?= $modelClass ?>' )['id'];
<?php if ($generator->hasSubDetail): ?>
		$subModelDetailDatas = json_decode( Yii::$app->request->post( '<?= $subDetailModel ?>' ), true );
<?php endif ?>
        $<?= $modelVariableName ?>   = $<?= $modelVariableName ?>Id != '' ? $this->findModel($<?= $modelVariableName ?>Id) : new <?= $modelClass ?>();
		if ( $<?= $modelVariableName ?>->load( Yii::$app->request->post() ) ) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
                $result = $<?= $modelVariableName ?>->save();
				if ( $result && (! $<?= $modelVariableName ?>->isNewRecord || array_key_exists( '<?= $subModel ?>', Yii::$app->request->post()))) {
                    $builder = new ModelBuilder($<?= $modelVariableName ?>->id);
<?php if ($generator->hasSubDetail): ?>
                    $builder->setSubModel(<?= $subModel ?>::className())
                            ->setRelation(<?= '\'' . $mainModelRelation . '\'' ?>)
                            ->setForeignKey(<?= '\'' . $foreignKey . '\'' ?>)
                            ->setSubDetailModel(<?= $subDetailModel ?>::className())
                            ->setSubForeignKey(<?= '\'' . $detailForeignKey . '\'' ?>)
                            ->setSubRelation(<?= '\'' . $subModelRelation . '\'' ?>);
<?php else: ?>
                    $builder->setSubModel(<?= $subModel ?>::className())->setRelation(<?= '\'' . $mainModelRelation . '\'' ?>)->setForeignKey(<?= '\'' . $foreignKey . '\'' ?>);
<?php endif ?>
					$result    = Model::saveMultiple( $<?= $modelVariableName ?>, $builder<?= $generator->hasSubDetail ? ', $subModelDetailDatas' : '' ?> );
				}
				if ( is_bool($result) && $result ) {
					$transaction->commit();
                    return Url::to( ['index'], true );
				}
                if (is_array($result) && ! empty($result)) {
                    return $this->asJson( $result );
                }
                return $this->asJson($<?= $modelVariableName ?>->errors);
			} catch ( Exception $e ) {
				$transaction->rollBack();
                Yii::error($e->getMessage() . "\n" . __FUNCTION__ . ' ----- ' . __CLASS__, 'system');

				return $e->getMessage();
			}
		}

		throw new ServerErrorHttpException( Yii::t( 'yii', 'An internal server error occurred.' ) );
	}
<?php endif; ?>

<?php if ($generator->hasSubDetail): ?>
	public function actionModal<?= $subDetailModel ?>() {
		$index          = Yii::$app->request->get( 'index', '' );
		$isLoad         = Yii::$app->request->get( 'isLoad', '' );
        $<?= Inflector::variablize($generator->subDetailTableName) ?> = new <?= $subDetailModel ?>();
		if ($isLoad == 1) {
			$<?= Inflector::variablize($generator->subTableName). 'Id' ?> = Yii::$app->request->get( '<?= Inflector::variablize($generator->subTableName) ?>Id', '' );
			$<?= Inflector::pluralize(Inflector::variablize($generator->subDetailTableName)) ?> = <?= $subDetailModel ?>::findAll(['<?= $generator->getDeleteAttribute() ?>' => 1, <?= '\'' . $detailForeignKey . '\'' ?> => $<?= Inflector::variablize(StringHelper::basename($generator->subTableName )). 'Id' ?>]);
		}

		return $this->renderAjax( '_modal_sub_detail', compact( 'index', <?= '\'' . Inflector::pluralize(Inflector::variablize($generator->subDetailTableName)) . '\'' ?>, '<?= Inflector::variablize($generator->subDetailTableName) ?>' ) );
	}

	public function actionViewModal<?= $subDetailModel ?>() {
		$<?= Inflector::variablize($generator->subTableName). 'Id' ?> = Yii::$app->request->get( '<?= Inflector::variablize($generator->subTableName) ?>Id', '' );
		$<?= Inflector::pluralize(Inflector::variablize($generator->subDetailTableName)) ?> = <?= $subDetailModel ?>::findAll(['<?= $generator->getDeleteAttribute() ?>' => 1, <?= '\'' . $detailForeignKey . '\'' ?> => $<?= Inflector::variablize(StringHelper::basename($generator->subTableName )). 'Id' ?>]);
        $<?= Inflector::variablize($generator->subDetailTableName) ?> = new <?= $subDetailModel ?>();
		return $this->renderAjax( '_modal_view_sub_detail', compact( <?= '\'' . Inflector::pluralize(Inflector::variablize($generator->subDetailTableName)) . '\'' ?>, '<?= Inflector::variablize($generator->subDetailTableName) ?>' ) );
	}
<?php endif ?>

    /**
    * Cập nhật status <?= $modelClass ?>.
    *
    * @return string
    * @throws NotFoundHttpException
    */
    public function actionDelete() {
        $<?= $modelVariableName ?>Id = Yii::$app->request->post( 'id', '');
        $<?= $modelVariableName ?> = <?= $modelClass ?>::findOne(<?= '[\'id\' => $'.$modelVariableName.'Id, \''.$generator->getDeleteAttribute().'\' => 1]' ?>);
<?php if(! $generator->hasDetail): ?>
        return $<?= $modelVariableName ?> != null && $<?= $modelVariableName ?>->updateAttributes( [ '<?= $generator->getDeleteAttribute() ?>' => -1 ] ) > 0 ? 'success' : 'fail';
<?php else: ?>
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($<?= $modelVariableName ?>->updateAttributes( [ '<?= $generator->getDeleteAttribute() ?>' => -1 ] ) > 0) {
                <?= $subModel ?>::updateAll( [ 'status' => -1 ], [ '<?= Inflector::camel2id($modelVariableName, '_') . '_id' ?>' => $<?= $modelVariableName ?>Id ] );
<?php if($generator->hasSubDetail): ?>
                <?= $subDetailModel ?>::updateAll( [ 'status' => -1 ], [ '<?= Inflector::camel2id($subModel, '_') . '_id' ?>' => $<?= $modelVariableName ?>Id ] );
<?php endif; ?>
                $transaction->commit();
                return 'success';
            }
            return 'fail';
        } catch ( Exception $e ) {
            $transaction->rollBack();
            Yii::error($e->getMessage() . "\n" . __FUNCTION__ . ' ----- ' . __CLASS__, 'system');

            return $e->getMessage();
        }
<?php endif; ?>
    }

    /**
     * Select2 ajax <?= $modelClass ?>.
     *
     * @return \yii\web\Response
     * @throws MethodNotAllowedHttpException
     */
	public function actionSelect<?= $modelClass ?>() {
        if (Yii::$app->request->isAjax) {
            $query  = Yii::$app->request->get( 'query', '' );
            $page   = Yii::$app->request->get( 'page', 1 );
            $excludeIds = Yii::$app->request->get( 'excludeIds', [] );
            $offset = ($page - 1) * 10;
            $<?= $modelVariableName ?>s = <?= $modelClass ?>::find()->where( [ '<?= $generator->getDeleteAttribute() ?>' => 1 ] )
                                                                    ->andFilterWhere( [ 'not in', 'id', $excludeIds ] )
                                                                    ->andFilterWhere( [ 'like', '<?= $generator->getNameAttribute() ?>', $query ] )->select( [ 'id', '<?= $generator->getNameAttribute() ?>' ] );

            return $this->asJson( [
                'total_count' => $<?= $modelVariableName ?>s->count(),
                'items'       => $<?= $modelVariableName ?>s->offset($offset)->limit( 10 )->all()
            ] );
        }

        throw new MethodNotAllowedHttpException(Yii::t('yii', 'Method Not Allowed'));
	}

<?php if ($generator->exportAll): ?>
    /**
    * @return mixed
    * @throws \PHPExcel_Exception
    * @throws \PHPExcel_Reader_Exception
    * @throws \PHPExcel_Writer_Exception
    */
    public function actionExport<?= $modelClass ?>() {
        $objPHPExcel = new \PHPExcel();

        //PAGE SETUP
        //$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
<?php
$titles = '';
$excludesAttribute = array_map('trim', explode(',', $generator->skippedIndexColumns));
$columnNames   = array_diff( $generator->getColumnNames(), $excludesAttribute);
foreach ($columnNames as $columnName):
    $titles .= '\'' . str_replace(' Id', '', Inflector::camel2words($columnName)) . '\', ';
endforeach;
$alphas = array_filter(array_merge(array(0), range('A', 'Z')));
$lastColumn = $alphas[count($columnNames)];
$modelPlural = Inflector::pluralize($modelVariableName);
$colsText = "range('A', '$lastColumn')";
$columns = range('A', $lastColumn);
?>
        $titles = [<?= substr($titles, 0, -2) ?>];
        $colums = <?= $colsText ?>;
        foreach ($colums as $key => $column) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValue($column . '2', $titles[$key]);
        }

        $row = 3;
        $<?= $modelPlural ?> = <?= $modelClass ?>::find()->status()->all();
        foreach ($<?= $modelPlural ?> as $<?= $modelVariableName ?>) {
<?php foreach ($columns as $key => $column): $columnName = $columnNames[$key + 1];?>
<?php if (substr( $columnName, - 3 ) === '_id'): ?>
            $objPHPExcel->getActiveSheet()->setCellValue(<?= '\'' . $column . '\'' ?> . $row, $<?= $modelVariableName ?>-><?= $columnName ?> != null ? $<?= $modelVariableName ?>-><?= Inflector::variablize( substr( $columnName, 0, -3) ) ?>->name : '');
<?php else: ?>
            $objPHPExcel->getActiveSheet()->setCellValue(<?= '\'' . $column . '\'' ?> . $row, $<?= $modelVariableName ?>-><?= $columnName ?>);
<?php endif ?>
<?php endforeach; ?>
            $row++;
        }

        //ACTIVE SHEET STYLE FORMAT
        $objPHPExcel->getActiveSheet()->getStyle('A2:<?= $lastColumn ?>2')->getFont()->setBold(true)->setSize(11);
        $objPHPExcel->getActiveSheet()->getStyle('A2:<?= $lastColumn ?>2')->getAlignment()->applyFromArray(array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER))->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A2:<?= $lastColumn ?>$row")->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=<?= Inflector::pluralize($modelClass) . '_' . date('d.m.Y H:i:s') ?>.xlsx ');
        header('Content-Transfer-Encoding: binary ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        return $objWriter->save('php://output');
    }
<?php endif ?>

<?php if ($generator->exportDetail): ?>
    /**
    * @return mixed
    * @throws NotFoundHttpException
    * @throws \PHPExcel_Exception
    * @throws \PHPExcel_Reader_Exception
    * @throws \PHPExcel_Writer_Exception
    */
    public function actionExport<?= $modelClass ?>Detail() {
        $<?= $modelVariableName ?>Id = Yii::$app->request->get('id', '');
<?php $modelDetails = Inflector::pluralize($subModelIdName);
    $modelDetailsVar = Inflector::variablize($modelDetails);
?>
        $<?= $modelVariableName ?> = $this->findModel($<?= $modelVariableName ?>Id);
        $<?= $modelDetailsVar ?> = $<?= $modelVariableName ?>-><?= $modelDetails ?>;

        $objPHPExcel = new \PHPExcel();

        //PAGE SETUP
        //$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

<?php
$titles = '';
$excludesAttribute = array_map('trim', explode(',', $generator->skippedIndexColumns));
$columnNames   = array_diff( $generator->getColumnNames(), $excludesAttribute);
foreach ($columnNames as $columnName):
    $titles .= '\'' . Inflector::camel2words($columnName) . '\', ';
endforeach;
$alphas = array_filter(array_merge(array(0), range('A', 'Z')));
$lastColumn = $alphas[count($columnNames)];
$modelPlural = Inflector::pluralize($modelVariableName);
$colsText = "range('A', '$lastColumn')";
$columns = range('A', $lastColumn);
?>
        $titles = [<?= substr($titles, 0, -2) ?>];
        $colums = <?= $colsText ?>;
        foreach ($colums as $key => $column) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setCellValue($column . '2', $titles[$key]);
        }

        $row = 3;
<?php foreach ($columns as $key => $column): $columnName = $columnNames[$key + 1];?>
<?php if (substr( $columnName, - 3 ) === '_id'): ?>
        $objPHPExcel->getActiveSheet()->setCellValue(<?= '\'' . $column . '\'' ?> . $row, $<?= $modelVariableName ?>-><?= $columnName ?> != null ? $<?= $modelVariableName ?>-><?= Inflector::variablize( substr( $columnName, 0, -3) ) ?>->name : '');
<?php else: ?>
        $objPHPExcel->getActiveSheet()->setCellValue(<?= '\'' . $column . '\'' ?> . $row, $<?= $modelVariableName ?>-><?= $columnName ?>);
<?php endif ?>
<?php endforeach; ?>

        $objPHPExcel->getActiveSheet()->getStyle('A2:<?= $lastColumn ?>2')->getFont()->setBold(true)->setSize(11);
        $objPHPExcel->getActiveSheet()->getStyle('A2:<?= $lastColumn ?>2')->getAlignment()->applyFromArray(array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER))->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle("A2:<?= $lastColumn ?>$row")->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        $row += 3;
<?php
$titles = '';
$excludesAttribute = array_map('trim', explode(',', $generator->skippedIndexColumns));
$excludesAttribute[] = $foreignKey;
$columnNames   = array_diff( \yii\helpers\ArrayHelper::getColumn($generator->detailColumns, 'name'), $excludesAttribute);
$columnNames = array_filter(array_merge(array(0), array_values($columnNames)));
foreach ($columnNames as $columnName):
    $titles .= '\'' . str_replace(' Id', '', Inflector::camel2words($columnName)) . '\', ';
endforeach;
$alphas = array_filter(array_merge(array(0), range('A', 'Z')));
$lastColumn = $alphas[count($columnNames)];
$modelPlural = Inflector::pluralize($modelVariableName);
$colsText = "range('A', '$lastColumn')";
$columns = range('A', $lastColumn);
?>

        $datailTitles = [<?= substr($titles, 0, -2) ?>];
        $colums = <?= $colsText ?>;

        foreach ($colums as $key => $column) {
            $objPHPExcel->getActiveSheet()->setCellValue($column . $row, $datailTitles[$key]);
        }

        $objPHPExcel->getActiveSheet()->getStyle("A$row:<?= $lastColumn ?>$row")->getFont()->setBold(true)->setSize(11);
        $objPHPExcel->getActiveSheet()->getStyle("A$row:<?= $lastColumn ?>$row")->getAlignment()->applyFromArray(array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER))->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $row++;

        foreach ($<?= $modelDetailsVar ?> as $<?= Inflector::singularize($modelDetailsVar) ?>) {
<?php foreach ($columns as $key => $column): $columnName = $columnNames[$key + 1];?>
<?php if (substr( $columnName, - 3 ) === '_id'): ?>
            $objPHPExcel->getActiveSheet()->setCellValue(<?= '\'' . $column . '\'' ?> . $row, $<?= Inflector::singularize($modelDetailsVar) ?>-><?= $columnName ?> != null ? $<?= Inflector::singularize($modelDetailsVar) ?>-><?= Inflector::variablize( substr( $columnName, 0, -3) ) ?>->name : '');
<?php else: ?>
            $objPHPExcel->getActiveSheet()->setCellValue(<?= '\'' . $column . '\'' ?> . $row, $<?= Inflector::singularize($modelDetailsVar) ?>-><?= $columnName ?>);
<?php endif ?>
<?php endforeach; ?>
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getStyle("A$row:G$row")->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=<?= Inflector::singularize($modelClass) . '_' . date('d.m.Y H:i:s') ?>.xlsx ');
        header('Content-Transfer-Encoding: binary ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        return $objWriter->save('php://output');
    }

<?php endif ?>
	/**
	* Tìm <?= $modelClass ?> model theo khóa chính.
	* Nếu không tìm thấy, trả về trang 404.
    *
	* @param $<?= $modelVariableName ?>Id
	* @return <?= $modelClass ?> the loaded model
	* @throws NotFoundHttpException if the model cannot be found
	*/
    protected function findModel($<?= $modelVariableName ?>Id) {
<?php
if (count($pks) === 1) {
	$condition = '[\'id\' => $'.$modelVariableName.'Id, \''.$generator->getDeleteAttribute().'\' => 1]';
} else {
    $condition = [];
    foreach ($pks as $pk) {
        $condition[] = "'$pk' => \$$pk";
    }
    $condition = '[' . implode(', ', $condition) . ']';
}
?>
        if (($model = <?= $modelClass ?>::findOne(<?= $condition ?>)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t( 'yii', 'Page not found.'));
    }
}
