<?php
/** @var \backend\models\Syslog $syslog */
?>
<div class="modal-header">
    <h3 class="modal-title">Chi tiết log</h3>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="textarea_message">Message</label>
                <textarea id="textarea_message" cols="30" rows="10" class="form-control" readonly><?= $syslog->message ?></textarea>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-default" type="button" data-dismiss="modal" data-bb-handler="cancel">Hủy</button>
        </div>
    </div>
</div>
