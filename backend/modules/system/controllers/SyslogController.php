<?php

namespace backend\modules\system\controllers;

use backend\models\Syslog;
use backend\models\table\SyslogTable;
use common\utils\controller\Controller;
use common\utils\table\TableFacade;
use Yii;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;

class SyslogController extends Controller
{
    public function actionIndex()
    {
        $syslog = new Syslog();

        return $this->render('index', ['syslog' => $syslog]);
    }

    public function actionIndexTable()
    {
        $tableFacade = new TableFacade(new SyslogTable);

        return $tableFacade->getDataTable();
    }

    /**
     * Select2 ajax Syslog.
     * @return \yii\web\Response
     * @throws MethodNotAllowedHttpException
     */
    public function actionSelectSyslog()
    {
        if (Yii::$app->request->isAjax) {
            $query   = Yii::$app->request->get('query', '');
            $page    = Yii::$app->request->get('page', 1);
            $offset  = ($page - 1) * 10;
            $syslogs = Syslog::find()->where(['status' => 1])->andFilterWhere(['like', 'id', $query])->select(['id', 'id']);

            return $this->asJson([
                'total_count' => $syslogs->count(),
                'items'       => $syslogs->offset($offset)->limit(10)->all()
            ]);
        }

        throw new MethodNotAllowedHttpException(Yii::t('yii', 'Method Not Allowed'));
    }

    /**
     * Finds the Syslog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * If $syslogId == '', return new Syslog.
     *
     * @param $syslogId
     *
     * @return Syslog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($syslogId)
    {
        if (($model = Syslog::findOne(['id' => $syslogId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
    }

    /**
     * Render view log
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionViewLog()
    {
        $id     = Yii::$app->request->get('id');
        $syslog = $this->findModel($id);

        return $this->renderAjax('view', ['syslog' => $syslog]);
    }
}
