<?php

namespace backend\models\table;

use backend\models\User;
use common\utils\helpers\TimeHelper;
use common\utils\table\DataTable;
use Yii;
use yii\helpers\Url;

class UserTable extends DataTable
{
    /*public function __construct()
    {
        parent::__construct();
        $arguments = Yii::$app->request->post();
    }*/

    /**
     * Tạo danh sách User
     * @return array
     * @throws \yii\base\InvalidParamException
     */
    public function getData()
    {
        $models    = $this->getModels();
        $dataArray = [];
        foreach ($models as $model) {
            $htmlAction  = "<a class='btn yellow-gold link-view-user' data-id='$model->id' href=" . Url::to(['view', 'id' => $model->id]) . " title='" . Yii::t('yii', 'View') . "'><i class='fa fa-eye'></i> </a>";
            $htmlAction  .= "<a class='btn green-steel link-update-user' data-id='$model->id' href=" . Url::to(['update', 'id' => $model->id]) . " title='" . Yii::t('yii', 'Update') . "'><i class='fa fa-pencil'></i> </a>";
            $htmlAction  .= "<a class='btn purple-sharp btn-toggle-status-user' data-id='$model->id' data-url='" . Url::to(['toggle-status']) . "' title='" . Yii::t('yii', 'Change Status') . "'><i class='fa fa-refresh'></i> </a>";
            $htmlAction  .= "<button class='btn red-mint btn-delete-user' data-id='$model->id' data-url='" . Url::to(['delete']) . "' title='" . Yii::t('yii', 'Delete') . "'><i class='fa fa-trash'></i> </button>";
            $dataArray[] = [
                "<label class=\"mt-checkbox mt-checkbox-single mt-checkbox-outline\"><input class='cb-single' type='checkbox' data-id='$model->id'><span></span></label>",
                $model->username,
                $model->fullname,
                $model->email,
                $model->phone,
                $model->getStatus(),
                $model->last_login != null ? TimeHelper::getTimeInterval(time() - $model->last_login) : '<em style="color: rgba(0,0,0,0.5);">never</em>',
                $htmlAction
            ];
        }

        return $dataArray;
    }

    /**
     * Tìm User theo dữ liệu đầu vào
     * @return User[]
     */
    public function getModels()
    {
        $column             = $this->getColumn();
        $models             = User::find()->visible()->andWhere(['!=', 'type', 100])->andFilterWhere([
            'and',
            ['like', 'username', $this->filterDatas['username']],
            ['like', 'fullname', $this->filterDatas['fullname']],
            ['like', 'email', $this->filterDatas['email']],
            ['like', 'phone', $this->filterDatas['phone']],
            ['user.status' => $this->filterDatas['status']]
        ]);
        $this->totalRecords = $models->count();
        $models             = $models->limit($this->length)->offset($this->start)->orderBy([$column => $this->direction])
                                     ->select(['user.id', 'username', 'fullname', 'email', 'phone', 'user.status', 'last_login'])->all();

        return $models;
    }

    /**
     * Lấy cột muốn sắp xếp
     * @return string
     */
    public function getColumn()
    {
        switch ($this->column) {
            case '1':
                $field = 'username';
                break;
            case '2':
                $field = 'fullname';
                break;
            case '3':
                $field = 'email';
                break;
            case '4':
                $field = 'phone';
                break;
            case '5':
                $field = 'status';
                break;
            case '6':
                $field = 'last_login';
                break;
            default:
                $field = 'id';
                break;
        }

        return $field;
    }
}