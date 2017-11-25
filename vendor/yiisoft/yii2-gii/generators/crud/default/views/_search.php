<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
$excludesAttribute = array_map('trim', explode(',', $generator->skippedColumns));
$validAttributes   = array_diff( $generator->getColumnNames(), $excludesAttribute);
$idName            = Inflector::camel2id( StringHelper::basename( $generator->modelClass ), '_' );
$modelVariableName = Inflector::variablize(StringHelper::basename( $generator->modelClass ));
echo "<?php\n";
?>
/* @var $this yii\web\View */
/* @var $<?= $modelVariableName ?> <?= ltrim( $generator->modelClass, '\\' ) ?> */
?>
<form id="form_<?= $idName ?>_search" class="search-form">
	<div class="row">
<?php foreach ( $validAttributes as $key => $attribute ): ?>
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
<?php if (strpos($attribute, 'type') !== false): ?>
				<label for="txt_<?= $attribute ?>"><?= '<?= $'. $modelVariableName . "->getAttributeLabel('{$attribute}')" . ' ?>' ?></label>
				<select name="<?= $attribute ?>" id="select_<?= $attribute ?>" class="form-control select" title="">
					<option></option>
				</select>
<?php else: ?>
				<label for="txt_<?= $attribute ?>"><?= '<?= $'. $modelVariableName . "->getAttributeLabel('{$attribute}')" . ' ?>' ?></label>
<?php if (strpos($attribute, 'date') !== false): ?>
                <div class="input-group date">
                    <input class="form-control datepicker" name="<?= $attribute ?>" id="txt_<?= $attribute ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
<?php else: ?>
                <input class="form-control" name="<?= $attribute ?>" id="txt_<?= $attribute ?>">
<?php endif ?>
<?php endif ?>
			</div>
		</div>
<?php endforeach ?>
        <div class="col-md-3 col-xs-12">
            <div class="form-group" style="margin-top: 22px">
<?php if ($generator->enableI18N == '1'): ?>
                <a type="button" class="btn btn-default" id="btn_reset_filter"><?= '<?= Yii::t(\'yii\', \'' . 'Reset' . '\') ?>' ?></a>
                <button class="btn blue-steel" id="btn_filter"><?= '<?= Yii::t(\'yii\', \'' . 'Search' . '\') ?>' ?></button>
<?php else: ?>
                <a type="button" class="btn btn-default" id="btn_reset_filter"><?= $generator->defaultLanguage == 'vi' ? 'Thiết lập lại' : 'Reset' ?></a>
                <button class="btn blue-steel" id="btn_filter"><?= $generator->defaultLanguage == 'vi' ? 'Tìm kiếm' : 'Seach' ?></button>
<?php endif ?>
            </div>
        </div>
	</div>
</form>
<script>
    $(function() {
        let body = $("body");
        // PHẦN TÌM KIẾM
        $("#form_<?= $idName ?>_search").on('submit', function () {
            $('#<?= '<?= $table ?>' ?>').DataTable().clearPipeline().draw();
            return false;
        });
        $(document).keyup(function(e) {
            if (e.keyCode === 27) { // escape key maps to keycode `27`
                $("#btn_reset_filter").trigger('click');
            }
        });
        body.on('click', '#btn_reset_filter', function () {
            $("#form_<?= $idName ?>_search").find('input, select').val('').trigger('change');
            $('#<?= '<?= $table ?>' ?>').DataTable().clearPipeline().order([]).draw();
        });
        //END PHẦN TÌM KIẾM
    });
</script>
