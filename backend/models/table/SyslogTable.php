<?php

namespace backend\models\table;

use backend\models\Syslog;
use common\utils\table\DataTable;
use Yii;

class SyslogTable extends DataTable
{
    /*public function __construct() {
		parent::__construct();
        $arguments = Yii::$app->request->post();
	}*/

    /**
     * Tạo danh sách Syslog
     * .
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\base\InvalidParamException
     */
    public function getData()
    {
        $models    = $this->getModels();
        $dataArray = [];
        foreach ($models as $model) {
            $htmlAction  = "<a class='btn yellow-gold link-view-syslog' title='Xem' data-id='$model->id'><i class='fa fa-eye'></i> </a>";
            $dataArray[] = [
                $model->category,
                $model->prefix,
                $model->getLevel(),
                Yii::$app->formatter->asDatetime($model->log_time),
                $htmlAction
            ];
        }

        return $dataArray;
    }

    /**
     * Tìm Syslog.
     * @return Syslog[].
     */
    public function getModels()
    {
        $column = $this->getColumn();
        $models = Syslog::find()->filterWhere([
            'and',
            ['level' => $this->filterDatas['level']]
        ])->distinct();
        if ($this->filterDatas['log_time'] != '') {
            $startDate = strtotime($this->filterDatas['log_time'] . ' 00:00:00');
            $endDate   = strtotime($this->filterDatas['log_time'] . ' 23:59:59');
            $models    = $models->filterWhere(['between', 'log_time', $startDate, $endDate]);
        }
        $this->totalRecords = $models->count();
        $models             = $models->limit($this->length)
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
            case '1':
                $field = 'category';
                break;
            case '2':
                $field = 'message';
                break;
            case '3':
                $field = 'prefix';
                break;
            case '4':
                $field = 'level';
                break;
            case '5':
                $field = 'log_time';
                break;
            default:
                $field = 'id';
                break;
        }

        return $field;
    }
}

?>