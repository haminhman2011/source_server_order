<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model             = new $generator->modelClass();
$modelName         = Inflector::camel2id( StringHelper::basename( $generator->modelClass ) );
$mainModelIdName   = Inflector::camel2id( StringHelper::basename( $generator->modelClass ), '_' );
$modelNameUpper    = StringHelper::basename( $generator->modelClass );
$excludesAttribute = [ 'status', 'created_by', 'created_date', 'modified_date', 'modified_by' ];
$validAttributes   = array_diff( $generator->getColumnNames(), $excludesAttribute);
$modelVariableName = Inflector::variablize(StringHelper::basename( $generator->modelClass ));
$column = 3;
echo "<?php\n";
?>
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $<?= $modelVariableName ?> <?= ltrim( $generator->modelClass, '\\' ) ?> */
?>
<form id="form_<?= $mainModelIdName ?>">
	<div id="error_summary"></div>
	<div class="row">
<?php foreach ( $validAttributes as $key => $attribute ): $inputClass = ' alphanum'; $inputValue = '<?= $' . $modelVariableName . '->' . $attribute . '?>';
if (strpos($attribute, 'email') !== false) {
    $inputClass = ' email';
} elseif (strpos($attribute, 'quantity') !== false) {
    $inputClass = ' number';
	$inputValue = '<?= number_format($' . $modelVariableName . '->' . $attribute . ') ?>';
} elseif (strpos($attribute, 'date') !== false) {
    $inputClass = ' datepicker';
	$inputValue = '<?= Yii::$app->formatter->asDate($' . $modelVariableName . '->' . $attribute . ') ?>';
}
if ($attribute == 'name' || $attribute == 'code') {
    $inputClass .= ' require';
}
?>
<?php if ( $attribute === 'id' ): ?>
		<input type="hidden" name="<?= $modelNameUpper . '[id]' ?>" value="<?= '<?= $' . $modelVariableName . '->id' . '?>' ?>">
<?php else: ?>
		<div class="col-md-<?= $attribute == 'note' || $attribute == 'description' ? '12  col-xs-12' : $column . '  col-xs-6' ?>">
			<div class="form-group">
<?php
if ( substr( $attribute, - 3 ) === '_id' ): $relation = substr( $attribute, 0, -3); ?>
				<label for="select_<?= $attribute ?>"><?= '<?= $'. $modelVariableName . "->getAttributeLabel('{$attribute}')" . ' ?>' ?></label>
				<select name="<?= $modelNameUpper . '[' . $attribute . ']' ?>" id="select_<?= $attribute ?>" class="form-control select require"<?= $key == 1 ? ' autofocus' : '' ?>>
					<option></option>
					<?php echo '<?php if ( $' . $modelVariableName . '->' . $attribute . ' != null ): ?>' . "\n"; ?>
                        <option value="<?= '<?= $' . $modelVariableName . '->' . $attribute . ' ?>' ?>" selected><?= '<?= $' . $modelVariableName . '->' . Inflector::variablize( $relation ) . '->name ?>' ?></option>
					<?php echo '<?php endif ?>' . "\n"?>
				</select>
<?php else: ?>
<?php if ($attribute == 'note' || $attribute == 'description'): ?>
                <label for="textarea_<?= $attribute ?>"><?= '<?= $'. $modelVariableName . "->getAttributeLabel('{$attribute}')" . ' ?>' ?></label>
                <textarea class="form-control" name="<?= $modelNameUpper . '[' . $attribute . ']' ?>" id="textarea_<?= $attribute ?>" cols="30" rows="5"><?= $inputValue ?></textarea>
<?php else: ?>
                <label for="txt_<?= $attribute ?>"><?= '<?= $'. $modelVariableName . "->getAttributeLabel('{$attribute}')" . ' ?>' ?></label>
                <input class="form-control<?= $inputClass ?>" name="<?= $modelNameUpper . '[' . $attribute . ']' ?>" value="<?= $inputValue ?>" id="txt_<?= $attribute ?>"<?= $key == 1 ? ' autofocus' : '' ?>>
<?php endif ?>
<?php endif; ?>
			</div>
		</div>
<?php endif; ?>
<?php endforeach ?>
	</div>
    <div class="form-footer">
<?php if ($generator->enableI18N == '1'): ?>
        <a class="btn btn-default" href="<?= '<?= ' . "Url::to( [ 'index' ] )" . ' ?>' ?>"><?= '<?= Yii::t(\'yii\', \'Cancel\') ?>' ?></a>
        <button class="btn <?= '<?= $' . $modelVariableName . '->isNewRecord ? \'blue-steel\' : \'green-haze\' ?>' ?>" id="btn_save_<?= $mainModelIdName ?>"><?= '<?= Yii::t(\'yii\', \'Save\') ?>' ?></button>
<?php else: ?>
        <a class="btn btn-default" href="<?= '<?= ' . "Url::to( [ 'index' ] )" . ' ?>' ?>"><?= $generator->defaultLanguage == 'vi' ? 'Hủy' : 'Cancel' ?></a>
        <button class="btn <?= '<?= $' . $modelVariableName . '->isNewRecord ? \'blue-steel\' : \'green-haze\' ?>' ?>" id="btn_save_<?= $mainModelIdName ?>"><?= $generator->defaultLanguage == 'vi' ? 'Lưu' : 'Save' ?></button>
<?php endif ?>
    </div>
</form>
<script>
	$(function () {
		$("#form_<?= $mainModelIdName ?>").on('submit', function () {
            if (!Team.validate('form_<?= $mainModelIdName ?>')) {
				let formData = new FormData(document.getElementById("form_<?= $mainModelIdName ?>"));
                Team.submitForm('<?= '<?= ' . "Url::to( [ 'save' ] )" . ' ?>' ?>', formData).then(function(result) {
					if (typeof result !== 'object' && result.includes('http')) {
						location.href = result;
					} else {
                        Team.showErrorSummary(result, '#form_<?= $mainModelIdName ?>');
					}
				});
			} else {
                $('.error').first().focus();
            }
			return false;
		})
	});
</script>