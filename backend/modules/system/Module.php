<?php

namespace backend\modules\system;

use Yii;
use yii\web\ForbiddenHttpException;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\system\controllers';

    public $defaultRoute = '/user/index';

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\ForbiddenHttpException
     */
    public function beforeAction($action)
    {
        if ( ! parent::beforeAction($action)) {
            return false;
        }
        // Kiểm tra user đã đang nhập chưa, nếu chưa đang nhập thì return về trang login
        if (empty(Yii::$app->user->identity)) {
            return true;
        }

        if ( ! $this->checkAccess()) {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to access this page.'));
        }

        return true;
    }

    /**
     * @return boolean whether the module can be accessed by the current user
     */
    protected function checkAccess()
    {
        if (Yii::$app->permission->isAdmin()) {
            return true;
        }
        Yii::warning(Yii::t('yii', 'Access to System module is denied due to permission') . '-' . 'IP: ' . Yii::$app->request->getUserIP(), __METHOD__);

        return false;
    }
}
