<?php

use common\utils\helpers\StringHelper;
use yii\helpers\Inflector;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $role backend\models\Role */
/* @var $modules backend\models\Module[] */
/* @var $moduleChildren backend\models\ModuleChild[] */
/* @var $roles array */
/** @var int $colSpan */
?>
<form id="form_role">
    <div id="error_summary"></div>
    <div class="row">
        <input type="hidden" name="Role[id]" value="<?= $role->id ?>">
        <div class="col-md-3">
            <div class="form-group">
                <label for="txt_name"><?= $role->getAttributeLabel('name') ?></label>
                <input class="form-control alphanum require" name="Role[name]" value="<?= $role->name ?>" id="txt_name" autofocus>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="select_status"><?= $role->getAttributeLabel('status') ?></label>
                <select name="Role[status]" id="select_status" class="select">
                    <option></option>
                    <option value="1" <?= $role->status === 1 || $role->isNewRecord ? 'selected' : '' ?>><?= Yii::t('yii', 'Activate'); ?></option>
                    <option value="0" <?= $role->status === 0 ? 'selected' : '' ?>><?= Yii::t('yii', 'Disable'); ?></option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="textarea_note"><?= $role->getAttributeLabel('note') ?></label>
                <textarea name="Role[note]" id="textarea_note" cols="30" rows="5" class="form-control"><?= $role->note ?></textarea>
            </div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-md-12">
            <table class="table table-bordered table-bordered">
                <tbody>
                <?php foreach ($modules as $moduleKey => $module): ?>
                    <tr style="background-color: #f5f5f5">
                        <td colspan="<?= $colSpan ?>">
                            <h4 class="uppercase"><b><?= Yii::t('yii', $module->name); ?></b></h4>
                        </td>
                    </tr>
                    <?php foreach ($moduleChildren as $moduleChildKey => $moduleChild):
                        $permissions = StringHelper::explode($moduleChild->role, ',');
                        $moduleName = $moduleChild->controller; ?>
                        <?php if ($module->id == $moduleChild->module_id): /** @noinspection UnSafeIsSetOverArrayInspection */
                        $checkAll = isset($roles) && array_key_exists('all_' . $moduleName, $roles) ? $roles['all_' . $moduleName] : ''; ?>
                        <tr class="">
                            <td style="width: 10%"><?= Inflector::camel2words(Inflector::id2camel($moduleChild->name)) ?></td>
                            <td width="10%">
                                <label class="mt-checkbox mt-checkbox-outline"><?= Yii::t('yii', 'All'); ?>
                                    <input title="" type="checkbox" class="chk_all_permission permission" data-module="<?= $moduleName ?>" data-role="all" <?= $checkAll == 1 ? 'checked' : '' ?>>
                                    <span></span>
                                </label>
                            </td>
                            <?php /** @var string[] $permissions */
                            $colCount = 2;
                            foreach ($permissions as $permissionKey => $permission): $colCount++;
                                /** @noinspection UnSafeIsSetOverArrayInspection */
                                $checked = isset($roles) && array_key_exists(trim($permission) . '_' . $moduleName, $roles) ? $roles[trim($permission) . '_' . $moduleName] : '';
                                ?>
                                <td width="10%">
                                    <label class="mt-checkbox mt-checkbox-outline"><?= Yii::t('yii', Inflector::humanize($permission)); ?>
                                        <input title="" type="checkbox" class="chk_permission permission" data-module="<?= $moduleName ?>" data-role="<?= $permission ?>" <?= $checked == 1 ? 'checked' : '' ?>>
                                        <span></span>
                                    </label>
                                </td>
                            <?php endforeach ?>
                            <?php $leftSpan = $colSpan - $colCount; ?>
                            <?php if ($leftSpan > 0): ?>
                                <td colspan="<?= $leftSpan ?>">
                                </td
                            <?php endif ?>
                        </tr>
                    <?php endif ?>
                    <?php endforeach ?>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-footer">
        <a type="button" class="btn btn-default" href="<?= Url::to(['role/']) ?>"><?= Yii::t('yii', 'Cancel') ?></a>
        <button class="btn <?= $role->isNewRecord ? 'blue-steel' : 'green-haze' ?>" id="btn_save"><?= Yii::t('yii', 'Save') ?></button>
    </div>
</form>
<script>
    $(function() {
        $('.chk_all_permission').on('click', function() {
            if ($(this).is(':checked')) {
                $(this).parents('tr').find('.chk_permission').prop('checked', true);
            } else {
                $(this).parents('tr').find('.chk_permission').prop('checked', false);
            }
        });
        $('.chk_permission').on('click', function() {
            let tr = $(this).parents('tr');
            if (tr.find('.chk_permission:checked').length >= tr.find('.chk_permission').length) {
                $(this).parents('tr').find('.chk_all_permission').prop('checked', true);
            } else {
                $(this).parents('tr').find('.chk_all_permission').prop('checked', false);
            }
        });
        $('#form_role').on('submit', function() {
            if (Team.validate('form_role')) {
                let roles = {};
                $('.permission').each(function() {
                    let module = $(this).data('module');
                    let role = $(this).data('role');
                    let check = 0;
                    if ($(this).is(':checked')) {
                        check = 1;
                    }
                    roles[$.trim(role) + '_' + $.trim(module.toLowerCase())] = check;
                });
                let formData = new FormData(document.getElementById('form_role'));
                formData.append('roles', JSON.stringify(roles));
                Team.submitForm('<?= Url::to(['save']) ?>', formData).then(function(result) {
                    if (typeof result !== 'object' && result.includes('http')) {
                        location.href = result;
                    } else {
                        Team.showErrorSummary(result, '#form_user');
                    }
                });
            } else {
                $('.error').first().focus();
            }
            return false;
        });
    });
</script>