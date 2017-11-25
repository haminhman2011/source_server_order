<?php

namespace backend\modules\system\controllers;

use backend\models\table\UserTable;
use backend\models\User;
use common\utils\controller\Controller;
use common\utils\table\TableFacade;
use Yii;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class UserController extends Controller
{
    /**
     * Hiện danh sách User
     *
     * @return string
     */
    public function actionIndex()
    {
        $user = new User();

        return $this->render('index', ['user' => $user]);
    }

    /**
     * Load ajax table trang index
     *
     * @return string
     */
    public function actionIndexTable()
    {
        $tableFacade = new TableFacade(new UserTable);

        return $tableFacade->getDataTable();
    }

    /**
     * Hiện trang view chi tiết User
     * @return string
     * @throws NotFoundHttpException
     * @throws ForbiddenHttpException
     */
    public function actionView()
    {
        $userId = Yii::$app->request->get('id', '');
        if ($userId == 1 && Yii::$app->user->id !== 1) {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to access this page.'));
        }
        return $this->render('view', [
            'user' => $this->findModel($userId),
        ]);
    }

    /**
     * Hiện trang create User
     *
     * @return string
     */
    public function actionCreate()
    {
        $user = new User();

        return $this->render('create', [
            'user' => $user,
        ]);
    }

    /**
     * Hiện trang update User
     *
     * @return string
     * @throws NotFoundHttpException
     * @throws ForbiddenHttpException
     */
    public function actionUpdate()
    {
        $userId = Yii::$app->request->get('id', '');
        if ($userId == 1 && Yii::$app->user->id > 1) {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to access this page.'));
        }
        $user = $this->findModel($userId);

        return $this->render('update', [
            'user' => $user,
        ]);
    }

    /**
     * Lưu model User
     * Nếu $controller != 'user' => chức năng cập nhật thông tin profile, ngược lại là tạo & cập nhật model User
     *
     * @return string:
     * - url: lưu thành công
     * - chuỗi: success - lưu thay đổi thông tin cá nhân thành công
     * - json: lỗi lưu thất bại
     * - An internal server error occurred: không load được model
     * @throws \yii\base\InvalidParamException
     * @throws NotFoundHttpException
     * @throws ServerErrorHttpException
     * @throws \yii\base\Exception
     */
    public function actionSave()
    {
        $userId     = Yii::$app->request->post('User')['id'];
        $user       = $userId !== '' ? $this->findModel($userId) : new User();

        if ($user->load(Yii::$app->request->post())) {
            $user->generateAuthKey();
            if ( ! $user->isNewRecord) {
                $user->scenario = 'update';
            }
            if ($user->save()) {
                return Url::to(['index'], true);
            }

            return $this->asJson($user->errors);
        }

        throw new ServerErrorHttpException(Yii::t('yii', 'An internal server error occurred.'));
    }

    /**
     * Cập nhật status User
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionDelete()
    {
        $userId = Yii::$app->request->post('id', '');
        $user   = $this->findModel($userId);

        return $user != null && $user->updateAttributes(['status' => -1]) > 0 ? 'success' : 'fail';
    }

    /**
     * Select2 ajax User
     *
     * @return \yii\web\Response
     * @throws MethodNotAllowedHttpException
     */
    public function actionSelectUser()
    {
        if (Yii::$app->request->isAjax) {
            $query  = Yii::$app->request->get('query', '');
            $page   = Yii::$app->request->get('page', 1);
            $offset = ($page - 1) * 10;
            $users  = User::find()->where(['status' => 1])->andFilterWhere(['like', 'username', $query])->select(['id', 'username']);

            return $this->asJson([
                'total_count' => $users->count(),
                'items'       => $users->offset($offset)->limit(10)->all(),
            ]);
        }

        throw new MethodNotAllowedHttpException(Yii::t('yii', 'Method Not Allowed'));
    }

    /**
     * Thay đổi trạng thái user: active <=> inactive
     *
     * @return string thay đổi thành công hay không thành công
     * @throws NotFoundHttpException
     */
    public function actionToggleStatus()
    {
        $userId = Yii::$app->request->post('id', '');
        $user   = $this->findModel($userId);

        //Nếu đang inactive => active
        if ($user->status < 1) {
            return $user->updateAttributes(['status' => 1]) > 0 ? 'success' : 'fail';
        }

        //Nếu đang active => inactive
        return $user->updateAttributes(['status' => 0]) > 0 ? 'success' : 'fail';
    }

    /**
     * Thay đổi trạng thái user: active <=> inactive
     *
     * @return string thay đổi thành công hay không thành công
     */
    public function actionChangeRowsStatus()
    {
        $userIds = Yii::$app->request->post('userIds', '');
        if ($userIds !== '') {
            $userIds = json_decode($userIds);
            $action  = Yii::$app->request->post('action', '');

            return User::changeRowsStatus($action, $userIds);
        }

        return 'fail';
    }

    /**
     * Tìm <?= $modelClass ?> model theo khóa chính.
     * Nếu không tìm thấy, trả về trang 404.
     *
     * @param $userId
     *
     * @return User|\yii\db\ActiveRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($userId)
    {
        if (($model = User::find()->where(['id' => $userId])->visible()->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
    }
}
