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
$ajax                = $isModal ? 'Ajax' : '';
$action              = $isModal ? ', \'create\', \'update\'' : '';
$modelVariableName   = Inflector::variablize(StringHelper::basename( $generator->modelClass ));
$modelClassName      = Inflector::camel2id( StringHelper::basename( $generator->modelClass ), '-' );
echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use <?= ltrim($generator->modelClass, '\\') ?>;
use common\utils\controller\Controller;
use common\utils\table\TableFacade;
use backend\models\table\<?= $modelClass ?>Table;
use yii\helpers\Url;

class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
{
	public function actionIndex()
	{
		$<?= $modelVariableName ?> = new <?= $modelClass ?>();
		return $this->render('index', ['<?= $modelVariableName ?>' => $<?= $modelVariableName ?>]);
	}

    public function actionIndexTable() {
        $tableFacade = new TableFacade( new <?= $modelClass ?>Table );
        return $tableFacade->getDataTable();
    }

	public function actionView()
	{
		$<?= $modelVariableName ?>Id = Yii::$app->request->get('id', '');
		return $this->render<?= $ajax ?>('view', [
			'<?= $modelVariableName ?>' => $this->findModel($<?= $modelVariableName ?>Id) <?= "\n" ?>,
		]);
	}

    public function actionCreate()
    {
        $<?= $modelVariableName ?> = new <?= $modelClass ?>();

		return $this->render<?= $ajax ?>('create', [
			'<?= $modelVariableName ?>' => $<?= $modelVariableName ?>,
		]);
    }

	public function actionUpdate()
	{
		$<?= $modelVariableName ?>Id = Yii::$app->request->get('id', '');
		$<?= $modelVariableName ?> = $this->findModel($<?= $modelVariableName ?>Id);

		return $this->render<?= $ajax ?>('update', [
			'<?= $modelVariableName ?>' => $<?= $modelVariableName . "\n" ?>,
		]);
	}

    /**
    * @return string:
    * - url: lưu thành công
    * - chuỗi: lưu thất bại, trả về lỗi
    * - An internal server error occurred: không load được model
    * @throws \yii\base\InvalidParamException
    * @throws NotFoundHttpException
    * @throws ServerErrorHttpException
    * @throws \yii\base\Exception
    */
	public function actionSave() {
		$<?= $modelVariableName ?>Id = Yii::$app->request->post('<?= $modelClass ?>')['id'];
        $<?= $modelVariableName ?>   = $<?= $modelVariableName ?>Id != '' ? $this->findModel($<?= $modelVariableName ?>Id) : new <?= $modelClass ?>();

		if ( $<?= $modelVariableName ?>->load( Yii::$app->request->post() ) ) {
			if ( $<?= $modelVariableName ?>->save() ) {
				return Url::to( [ '<?= $modelClassName ?>/' ], true );
			}

			return json_encode( $<?= $modelVariableName ?>->errors );
		}
		throw new ServerErrorHttpException( Yii::t('yii', 'An internal server error occurred.') );
	}

    public function actionDelete()
    {
		$<?= $modelVariableName ?>Id = Yii::$app->request->post( 'id', '');
		$<?= $modelVariableName ?> = <?= $modelClass ?>::findOne(<?= '[\'id\' => $'.$modelVariableName.'Id, \''.$generator->getDeleteAttribute().'\' => 1]' ?>);

        return $<?= $modelVariableName ?> != null && $<?= $modelVariableName ?>->updateAttributes( [ '<?= $generator->getDeleteAttribute() ?>' => -1 ] ) > 0 ? 'success' : 'fail';
    }

    /**
    * Select2 ajax <?= $modelClass ?>.
    * @return string
    * @throws \yii\base\InvalidParamException
    * @throws \yii\web\MethodNotAllowedHttpException
    */
	public function actionSelect<?= $modelClass ?>() {
        if (Yii::$app->request->isAjax) {
            $query  = Yii::$app->request->get( 'query', '' );
            $page   = Yii::$app->request->get( 'page', 1 );
            $offset = ($page - 1) * 10;
            $<?= $modelVariableName ?>s = <?= $modelClass ?>::find()->where( [ '<?= $generator->getDeleteAttribute() ?>' => 1 ] )->andFilterWhere( [ 'like', '<?= $generator->getNameAttribute() ?>', $query ] )->select( [ 'id', '<?= $generator->getNameAttribute() ?>' ] );

            return $this->asJson( [
                'total_count' => $<?= $modelVariableName ?>s->count(),
                'items'       => $<?= $modelVariableName ?>s->offset($offset)->limit( 10 )->all()
            ] );
        }

        throw new MethodNotAllowedHttpException(Yii::t('yii', 'Method Not Allowed'));
	}

	/**
	* Finds the <?= $modelClass ?> model based on its primary key value.
	* If the model is not found, a 404 HTTP exception will be thrown.
    * If $<?= $modelVariableName ?>Id == '', return new <?= $modelClass ?>.
    *
	* @param $<?= $modelVariableName ?>Id
	* @return <?= $modelClass ?> the loaded model
	* @throws NotFoundHttpException if the model cannot be found
	*/
    protected function findModel($<?= $modelVariableName ?>Id)
    {
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
