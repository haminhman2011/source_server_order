<?php
/* @var $this yii\web\View */
/* @var $syslog backend\models\Syslog */
?>
<form id="form_syslog_search" class="search-form">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="select_level"><?= $syslog->getAttributeLabel('level') ?></label>
                <select name="level" id="select_level" class="select">
                    <option></option>
                    <option value="1">Error</option>
                    <option value="2">Warning</option>
                    <option value="3">Info</option>
                    <option value="4">Trace</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="txt_log_time"><?= $syslog->getAttributeLabel('log_time') ?></label>
                <input type="text" class="form-control datepicker" name="log_time" id="txt_log_time">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group pull-left" style="margin-top: 22px">
                <a type="button" class="btn btn-default" id="btn_reset_filter"><?= Yii::t('yii', 'Reset') ?></a>
                <button class="btn blue-steel" id="btn_filter"><?= Yii::t('yii', 'Search') ?></button>
            </div>
        </div>
    </div>
</form>
