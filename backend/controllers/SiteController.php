<?php

namespace backend\controllers;

use backend\models\User;
use common\models\LoginForm;
use common\models\PasswordResetRequestForm;
use common\models\ResetPasswordForm;
use common\utils\controller\Controller;
use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Cookie;
use yii\web\ErrorAction;

class SiteController extends Controller
{
    public $layout = 'login';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'request-password-reset', 'reset-password'],
                        'allow'   => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'change-lang'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public function actionIndex()
    {
        $this->layout = 'main';

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public function actionLogin()
    {
        if ( ! Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model      = new LoginForm();
        $forgetForm = new PasswordResetRequestForm();
        /** @noinspection NotOptimalIfConditionsInspection */
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                User::updateLoginTime(Yii::$app->user->id);

                return $this->goBack();
            }
            Yii::warning("Đăng nhập vào tài khoản {$model->username} thất bại.", 'system');
        }

        return $this->render('login', [
            'model'      => $model,
            'forgetForm' => $forgetForm,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return 'success';
    }

    /**
     * Chức năng gửi mail reset mật khẩu
     * Nếu có email hợp lệ => Gửi mail co kèm link reset mật khẩu
     * Nếu có email không hợp lệ => Hiện thông báo không thể gửi reset mật khẩu
     * Nếu không co email => Render ra form quên mật khẩu
     *
     * @return null|\yii\web\Response
     * @throws Exception
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('yii', 'Check your email for further instructions.'));

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', Yii::t('yii', 'Sorry, we are unable to reset password for email provided.'));
        }

        return null;
    }

    /**
     * Chức năng reset mật khẩu
     * Nếu có token hợp lệ => Render form reset mật khẩu
     * Nếu có token hợp lệ và mật khẩu mới => Thay dổi mật khẩu theo mật khẩu mới
     *
     * @param $token
     *
     * @return string
     * @throws \yii\base\InvalidParamException
     * @throws BadRequestHttpException
     * @throws \yii\base\Exception
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::info("Mật khẩu của tài khoản {$model->getUser()->username} đã được thay đổi.", 'system');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Chức năng chuyển đổi ngôn ngữ
     *
     * @throws \yii\base\InvalidCallException
     */
    public function actionChangeLang()
    {
        try {
            $lang   = Yii::$app->request->get('lang', 'en');
            $cookie = new Cookie([
                'name'  => 'language',
                'value' => $lang
            ]);
            \Yii::$app->getResponse()->getCookies()->add($cookie);

            return 'success';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
