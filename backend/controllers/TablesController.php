<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\MethodNotAllowedHttpException;
use backend\models\Tables;
use common\utils\controller\Controller;
use common\utils\table\TableFacade;
use backend\models\table\TablesTable;
use yii\helpers\Url;

class TablesController extends Controller
{
    /**
    * Hiện danh sách Tables.
    *
    * @return string
    */
    public function actionIndex()
    {
		$tables = new Tables();
        return $this->render('index', ['tables' => $tables]);
    }

    /**
    * Load ajax table trang index
    *
    * @return string
    */
    public function actionIndexTable() {
        $tableFacade = new TableFacade( new TablesTable );
        return $tableFacade->getDataTable();
    }

    /**
    * Hiện trang view chi tiết Tables.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionView()
	{
        $tablesId = Yii::$app->request->get('id', '');
        $tables = $this->findModel($tablesId);
		return $this->render('view', [
			'tables' => $tables
		]);
	}

    /**
    * Hiện trang create Tables.
    *
    * @return string
    */
    public function actionCreate()
    {
		$tables = new Tables();
		return $this->render('create', [
			'tables' => $tables,
		]);
    }

    /**
    * Hiện trang update Tables.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionUpdate()
	{
        $tablesId = Yii::$app->request->get('id', '');
		$tables = $this->findModel($tablesId);
		return $this->render('update', [
			'tables' => $tables
		]);
	}

    /**
    * Lưu Tables model.
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
		$tablesId = Yii::$app->request->post('Tables')['id'];
		$tables   = $tablesId != '' ? $this->findModel($tablesId) : new Tables();

		if ( $tables->load( Yii::$app->request->post() ) ) {
			if ( $tables->save() ) {
				return Url::to( [ 'index' ], true );
			}

			return $this->asJson($tables->errors);
		}

		throw new ServerErrorHttpException( Yii::t('yii', 'An internal server error occurred.') );
	}


    /**
    * Cập nhật status Tables.
    *
    * @return string
    * @throws NotFoundHttpException
    */
    public function actionDelete() {
        $tablesId = Yii::$app->request->post( 'id', '');
        $tables = Tables::findOne(['id' => $tablesId, 'status' => 1]);
        return $tables != null && $tables->updateAttributes( [ 'status' => -1 ] ) > 0 ? 'success' : 'fail';
    }

    /**
     * Select2 ajax Tables.
     *
     * @return \yii\web\Response
     * @throws MethodNotAllowedHttpException
     */
	public function actionSelectTables() {
        if (Yii::$app->request->isAjax) {
            $query  = Yii::$app->request->get( 'query', '' );
            $page   = Yii::$app->request->get( 'page', 1 );
            $excludeIds = Yii::$app->request->get( 'excludeIds', [] );
            $offset = ($page - 1) * 10;
            $tabless = Tables::find()->where( [ 'status' => 1 ] )
                                                                    ->andFilterWhere( [ 'not in', 'id', $excludeIds ] )
                                                                    ->andFilterWhere( [ 'like', 'name', $query ] )->select( [ 'id', 'name' ] );

            return $this->asJson( [
                'total_count' => $tabless->count(),
                'items'       => $tabless->offset($offset)->limit( 10 )->all()
            ] );
        }

        throw new MethodNotAllowedHttpException(Yii::t('yii', 'Method Not Allowed'));
	}


	/**
	* Tìm Tables model theo khóa chính.
	* Nếu không tìm thấy, trả về trang 404.
    *
	* @param $tablesId
	* @return Tables the loaded model
	* @throws NotFoundHttpException if the model cannot be found
	*/
    protected function findModel($tablesId) {
        if (($model = Tables::findOne(['id' => $tablesId, 'status' => 1])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t( 'yii', 'Page not found.'));
    }
}
