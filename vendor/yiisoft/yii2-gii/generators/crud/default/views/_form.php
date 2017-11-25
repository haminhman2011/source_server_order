<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
/* @var $model \yii\db\ActiveRecord */
$model             = new $generator->modelClass();
$path = pathinfo($generator->modelClass);
$modelName         = Inflector::camel2id( StringHelper::basename( $generator->modelClass ) );
$mainModelIdName   = Inflector::camel2id( StringHelper::basename( $generator->modelClass ), '_' );
$modelNameUpper    = StringHelper::basename( $generator->modelClass );
$excludesAttribute = array_map('trim', explode(',', $generator->skippedColumns));
$validAttributes   = array_diff( $generator->getColumnNames(), $excludesAttribute);
$modelVariableName = Inflector::variablize(StringHelper::basename( $generator->modelClass ));
$requireColumns = explode(',', $generator->requireColumns);
if ($generator->hasDetail) {
	$subModelVar = Inflector::variablize($generator->subTableName);
	$subModel            = Inflector::camelize($generator->subTableName);
	$subClassName        = Inflector::camel2id($subModel);
	$subModelString      = 'backend\\models\\' . $subModel;
	$subModelClass       = new $subModelString;
	$subModelForeignKeys = $subModelClass->getTableSchema()->foreignKeys;
	$foreignKey          = '';
	$subModelIdName   = Inflector::camel2id( StringHelper::basename( $generator->subTableName ), '_' );
	$subModelClassName   = Inflector::camel2id( StringHelper::basename( $generator->subTableName ), '-' );
	foreach ( $subModelForeignKeys as $subModelForeignKey ) {
		if (in_array($mainModelIdName, array_values($subModelForeignKey), true)) {
			$foreignKey = array_search('id', $subModelForeignKey, true);
			break;
		}
	}
	if($generator->hasSubDetail) {
		$subDetailModel            = Inflector::camelize($generator->subDetailTableName);
		$subDetailClassName        = Inflector::camel2id($subDetailModel);
		$subDetailModelString      = 'backend\\models\\' . $subDetailModel;
		$subDetailModelClass       = new $subDetailModelString;
		$subDetailModelForeignKeys = $subDetailModelClass->getTableSchema()->foreignKeys;
		$detailForeignKey          = '';
		$subDetailModelVar = Inflector::pluralize(Inflector::variablize($subDetailModel));
		foreach ( $subDetailModelForeignKeys as $subDetailModelForeignKey ) {
			if (in_array($generator->subTableName, array_values($subDetailModelForeignKey), true)) {
				$detailForeignKey = array_search('id', $subDetailModelForeignKey, true);
				break;
			}
		}
	}
}
$column = 3;
echo "<?php\n";
?>
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $<?= $modelVariableName ?> <?= ltrim( $generator->modelClass, '\\' ) ?> */
<?php if ($generator->hasDetail): ?>
/* @var $<?= Inflector::pluralize(Inflector::variablize($generator->subTableName)) ?>[] <?= $path['dirname'] . '\\' . Inflector::camelize($generator->subTableName) ?> */
/* @var $<?= $subModelVar ?> <?= $path['dirname'] . '\\' . Inflector::camelize($generator->subTableName) ?> */
<?php endif ?>
?>
<?php if ($generator->isModal): ?>
<div class="modal-header">
    <button class="bootbox-close-button close" data-dismiss="modal" type="button" style="margin-top: -10px;">×</button>
    <h1><?= '<?= ' ?>yii\helpers\Html::encode($this->title) ?></h1>
</div>
<?php endif ?>
<form id="form_<?= $mainModelIdName ?>"<?= $generator->isModal ? ' class="modal-body"' : '' ?>>
	<div id="error_summary"></div>
	<div class="row">
		<input type="hidden" name="<?= $modelNameUpper . '[id]' ?>" value="<?= '<?= $' .$modelVariableName . '->id' . ' ?>' ?>">
<?php foreach ( $validAttributes as $key => $attribute ): $inputClass = ' alphanum'; $inputValue = '<?= $' . $modelVariableName . '->' . $attribute . ' ?>';
if (strpos($attribute, 'email') !== false) {
    $inputClass = ' email';
} elseif (strpos($attribute, 'quantity') !== false) {
    $inputClass = ' number';
	$inputValue = '<?= number_format($' . $modelVariableName . '->' . $attribute . ') ?>';
} elseif (strpos($attribute, 'date') !== false) {
	$inputClass = ' datepicker';
	$inputValue = '<?= Yii::$app->formatter->asDate($' . $modelVariableName . '->' . $attribute . ') ?>';
}
$label = '<?= $'. $modelVariableName . "->getAttributeLabel('{$attribute}')" . ' ?>';
if (in_array($attribute, $requireColumns, false)) {
	$inputClass .= ' require';
    $label = '<?= $'. $modelVariableName . "->getAttributeLabel('{$attribute}')" . ' ?>' . "\n" . '<span class="font-red-mint">*</span>';
}
?>
		<div class="col-md-<?= $attribute == 'note' || $attribute == 'description' ? '12  col-xs-12' : $column . ' col-xs-6' ?>">
			<div class="form-group">
<?php
if ( substr( $attribute, - 3 ) === '_id' ): $relation = substr( $attribute, 0, -3);?>
				<label for="select_<?= $attribute ?>" class="control-label"><?= $label ?></label>
				<select name="<?= $modelNameUpper . '[' . $attribute . ']' ?>" id="select_<?= $attribute ?>" class="form-control select require"<?= $key == 1 ? ' autofocus' : '' ?>>
					<option></option>
                    <?php echo '<?php if ( $' . $modelVariableName . '->' . $attribute . ' != null ): ?>' . "\n"; ?>
                        <option value="<?= '<?= $' . $modelVariableName . '->' . $attribute . ' ?>' ?>" selected><?= '<?= $' . $modelVariableName . '->' . Inflector::variablize( $relation ) . '->name ?>' ?></option>
                    <?php echo '<?php endif ?>' . "\n"?>
				</select>
<?php else: ?>
<?php if (strpos($attribute, 'note') !== false || strpos($attribute, 'description') !== false): ?>
                <label for="textarea_<?= $attribute ?>" class="control-label"><?= $label ?></label>
                <textarea class="form-control" name="<?= $modelNameUpper . '[' . $attribute . ']' ?>" id="textarea_<?= $attribute ?>" cols="30" rows="5"><?= $inputValue ?></textarea>
<?php else: ?>
                <label for="txt_<?= $attribute ?>" class="control-label"><?= $label ?></label>
<?php if (strpos($attribute, 'date') !== false): ?>
                <div class="input-group date">
                    <input class="form-control<?= $inputClass ?>" name="<?= $modelNameUpper . '[' . $attribute . ']' ?>" value="<?= $inputValue ?>" id="txt_<?= $attribute ?>"<?= $key == 1 ? ' autofocus' : '' ?>><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
<?php else: ?>
                <input class="form-control<?= $inputClass ?>" name="<?= $modelNameUpper . '[' . $attribute . ']' ?>" value="<?= $inputValue ?>" id="txt_<?= $attribute ?>"<?= $key == 1 ? ' autofocus' : '' ?>>
<?php endif ?>
<?php endif ?>
<?php endif; ?>
			</div>
		</div>
<?php endforeach ?>
	</div>
<?php if ($generator->hasDetail): $inputIdHidden = 0; ?>
<?php $details = Inflector::pluralize($subModelVar); ?>
    <div class="detail-title">
        <label for="">Danh sách</label>
    </div>
    <div class="row" id="<?= $subModelIdName ?>_section">
<?php foreach ( $generator->detailColumns as $key => $attribute ): $attributeName = $attribute->name; ?>
<?php if ($foreignKey !== $attributeName && $attributeName !== 'id' && !\common\utils\helpers\Inflector::inArray($attributeName, $excludesAttribute)): ?>
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
<?php
$label = $generator->getSubColumn( $attributeName, 'backend\\models\\' . $subModel )->comment;
if ( substr( $attributeName, - 3 ) === '_id' ):
?>
				<label for="select_<?= $subModelIdName . '_' . $attributeName ?>" class="control-label"><?= '<?= $'. $subModelVar . "->getAttributeLabel('{$attributeName}')" . ' ?>' ?>:</label>
				<select id="select_<?= $subModelIdName . '_' . $attributeName ?>" class="form-control select">
					<option></option>
				</select>
<?php else: ?>
				<label for="txt_<?= $subModelIdName . '_' . $attributeName ?>" class="control-label"><?= '<?= $'. $subModelVar . "->getAttributeLabel('{$attributeName}')" . ' ?>' ?>:</label>
				<input class="form-control<?= strpos($label, 'date') !== false ? ' datepicker' : ' alphanum' ?>" id="txt_<?= $subModelIdName . '_' . $attributeName ?>">
<?php endif; ?>
			</div>
		</div>
<?php endif; ?>
<?php endforeach; ?>
		<div class="col-md-3 col-xs-6">
            <div class="form-group">
<?php if ($generator->enableI18N == '1'): ?>
                <button type="button" class="btn btn-primary" id="btn_add_<?= $subModelIdName ?>" style="margin-top: 24px"><?= '<?= Yii::t(\'yii\', \'' . 'Add' . '\') ?>' ?></button>
<?php else: ?>
                <button type="button" class="btn btn-primary" id="btn_add_<?= $subModelIdName ?>" style="margin-top: 24px"><?= $generator->defaultLanguage == 'vi' ? 'Thêm' : 'Add' ?></button>
<?php endif ?>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 form-group">
			<table id="table_<?= $subModelIdName ?>" class="table table-striped table-bordered nowrap">
				<thead>
				<tr>
<?php foreach ( $generator->detailColumns as $key => $attribute ): ?>
<?php if ($foreignKey !== $attribute->name && $attribute->name !== 'id' && !\common\utils\helpers\Inflector::inArray($attribute->name, $excludesAttribute)): ?>
					<th><?= '<?= $'. $subModelVar . "->getAttributeLabel('{$attribute->name}')" . ' ?>' ?></th>
<?php endif; ?>
<?php endforeach; ?>
<?php if ($generator->enableI18N == '1'): ?>
                    <th width="10%"><?= '<?= Yii::t(\'yii\', \'Actions\') ?>' ?></th>
<?php else: ?>
                    <th width="10%"><?= $generator->defaultLanguage == 'vi' ? 'Hành động' : 'Actions' ?></th>
<?php endif ?>
				</tr>
				</thead>
				<tbody>
				<?= '<?php if ( isset($' . $details . ') && is_array($' . $details . ') ): ?>' . "\n" ?>
					<?= '<?php foreach ( $' . $details . ' as $key => $' . $subModelVar . ' ): ?>' . "\n" ?>
						<tr>
<?php foreach ( $generator->detailColumns as $key => $attribute ): ?>
<?php if ($foreignKey !== $attribute->name && $attribute->name !== 'id'  && !\common\utils\helpers\Inflector::inArray($attribute->name, $excludesAttribute)): ?>
<?php if (substr( $attribute->name, - 3 ) === '_id'): $name = substr( $attribute->name, 0, - 3 ); ?>
							<td>
                                <?= '<?= $' . $subModelVar . '->' . $attribute->name . ' != null ? $'.$subModelVar.'->'.Inflector::variablize( $name ).'->name : \'\' ?>' . "\n" ?>
								<input type="hidden" class="txt-<?= Inflector::camel2id(Inflector::camelize($attribute->name)) ?>" name="<?= $subModel ?>[<?= '<?= $key ?>' ?>][<?= $attribute->name ?>]" value="<?= '<?= $' . $subModelVar . '->' . $attribute->name . '?>' ?>">
							</td>
<?php else: ?>
							<td>
<?php if ($inputIdHidden == 0): ?>
								<input type="hidden" name="<?= $subModel ?>[<?= '<?= $key ?>' ?>][id]" value="<?= '<?= $' . $subModelVar . '->id ?>' ?>">
<?php endif ?>
								<input title="" class="form-control txt-<?= Inflector::camel2id(Inflector::camelize($attribute->name)) ?>" name="<?= $subModel ?>[<?= '<?= $key ?>' ?>][<?= $attribute->name ?>]" value="<?= '<?= $' . $subModelVar . '->' . $attribute->name . ' ?>' ?>">
							</td>
<?php endif ?>
<?php endif ?>
<?php $inputIdHidden++; endforeach; ?>
							<td>
<?php if ($generator->hasSubDetail): ?>
									<button type="button" class="btn btn-primary btn-modal-<?= $subDetailClassName ?>" data-<?= $subClassName ?>-id="<?= '<?= $' . $subModelVar . '->id ?>' ?>"> <i class="glyphicon glyphicon-eye-open"></i> </button>
<?php endif ?>
								<button type="button" class="btn btn-danger btn-remove-<?= $subModelClassName ?>"> <i class="glyphicon glyphicon-trash"></i> </button>
							</td>
						</tr>
					<?= '<?php endforeach ?>' . "\n" ?>
				<?= '<?php endif ?>' . "\n" ?>
				</tbody>
			</table>
		</div>
	</div>
<?php endif; ?>
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
    'use strict';
    $(function () {
		$("#form_<?= $mainModelIdName ?>").on('submit', function () {
            if (Team.validate('form_<?= $mainModelIdName ?>')) {
				let formData = new FormData(document.getElementById("form_<?= $mainModelIdName ?>"));
<?php if ($generator->hasSubDetail): ?>
				formData.append('<?= $subDetailModel ?>', JSON.stringify(<?= $subDetailModelVar ?>));
<?php endif; ?>
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
		});
<?php if ($generator->hasDetail):$detailDatas = [];?>
//		MODEL DETAIL
		let table<?= Inflector::camelize($generator->subTableName) ?> = $("#table_<?= $subModelIdName ?>").DataTable({
            paging: false,
            scrollY: '276px',
            scrollCollapse: true,
            scrollX: true,
            sort: false
		});
		let body = $("body");
		$("#btn_add_<?= $subModelIdName ?>").on('click', function() {
            let index = table<?= Inflector::camelize($subModelIdName) ?>.rows().count();
            let valid = false;
            while (!valid) {
                if ($(`input[name="<?= $subModel ?>[${index}][id]"]`).length > 0) {
                    index++;
                } else {
                    valid = true;
                }
            }
<?php foreach ( $generator->detailColumns as $key => $attribute ): ?>
<?php if ($foreignKey !== $attribute->name && !\common\utils\helpers\Inflector::inArray($attribute->name, $excludesAttribute)): ?>
<?php if (substr( $attribute->name, - 3 ) === '_id'): $name = substr( $attribute->name, 0, - 3 ); ?>
            let <?= Inflector::variablize($name . 'Text'); ?> = $("#select_<?= $subModelIdName . '_' . $attribute->name ?>").select2('data')[0]['name'];
            let <?= Inflector::variablize($attribute->name); ?> = $("#select_<?= $subModelIdName . '_' . $attribute->name ?>").val();
<?php $detailDatas[] = Inflector::variablize($name . 'Text') . ' + `<input type="hidden" name="'.$subModel.'[${index}]['.$attribute->name.']" value="${'.Inflector::variablize($attribute->name).'}" class="txt-'.Inflector::camel2id
			(Inflector::camelize($attribute->name)) .'">`' . "\n"  ?>
<?php else: ?>
            let <?= Inflector::variablize($attribute->name); ?> = $("#txt_<?= $subModelIdName . '_' . $attribute->name ?>").val();
<?php $detailDatas[] = '`<input type="text" name="'.$subModel.'[${index}]['.$attribute->name.']" value="${'.Inflector::variablize($attribute->name).'}" class="form-control txt-'.Inflector::camel2id(Inflector::camelize
		($attribute->name)) .'">`' . "\n" ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
			table<?= Inflector::camelize($generator->subTableName) ?>.row
                .add([`<input type="hidden" name="<?= $subModel ?>[${index}][id]">` + <?= "\n" . implode(',', $detailDatas) ?><?php if ($generator->hasSubDetail): ?>,'<button type="button" class="btn btn-primary btn-modal-<?= $subDetailClassName?>" data-attr-id=""> <i class="glyphicon glyphicon-eye-open"></i> </button> ' + '<?php else: echo ',\''; endif; ?><button type="button" class="btn btn-danger btn-remove-<?= $subClassName ?>"> <i class="glyphicon glyphicon-trash"></i> </button>'])
                .draw(false);
            $("#<?= $subModelIdName ?>_section").find('input, select').val('').trigger('change').first().focus();
            let offSet = (parseInt(index) + 1) * 51;
            $(".dataTables_scrollBody").scrollTop(offSet);
//            $('.DTFC_LeftBodyLiner').scrollTop(offSet);
//            $('.DTFC_RightBodyLiner').scrollTop(offSet);
		});
		body.on('click', '.btn-remove-<?= $subClassName ?>', function () {
			table<?= Inflector::camelize($generator->subTableName) ?>.row($(this).parents('tr')).remove().draw();
		});
<?php if($generator->hasSubDetail): $subDetailDatas = [];
		$subDetailArr = $subDetailModelVar;
		$subDetailTable = 'table'. Inflector::camelize($generator->subDetailTableName);?>
//		SUB MODEL DETAIL
		let <?= $subDetailArr ?> = [];
		let <?= $subDetailTable ?> = '';
		body.on('click', '.btn-modal-<?= $subDetailClassName ?>', function () {
			let <?= Inflector::variablize($generator->subTableName) ?>Id = $(this).data('<?= $subClassName ?>-id');
			let index = $(this).parents('tr').index();
			let isLoad = 1;
			if (typeof <?= $subDetailArr ?>[index] !== 'undefined') {
				isLoad = 0;
			}
            Team.showModal({<?= Inflector::variablize($generator->subTableName) ?>Id: <?= Inflector::variablize($generator->subTableName) ?>Id, index: index, isLoad: isLoad},
                '<?= '<?= Url::to( [ \'modal-' . Inflector::camel2id(Inflector::camelize($generator->subDetailTableName)) . '\' ] ) ?>' ?>', $('#modal-lg'));
		});
		body.on('shown.bs.modal', '#modal-lg', function () {
			<?= $subDetailTable ?> = $("#table_<?= $generator->subDetailTableName ?>").DataTable({
                paging: false,
                scrollY: '276px',
                scrollCollapse: true,
                scrollX: true,
                sort: false
            });
			let index = parseInt($("#txt_index").val());
			if (typeof <?= $subDetailArr ?>[index] !== 'undefined') {
				<?= $subDetailArr ?>[index].forEach(function(item) {
<?php foreach ( $generator->subDetailColumns as $key => $attribute ): ?>
<?php if ($detailForeignKey !== $attribute->name && $attribute->name !== 'id' && !\common\utils\helpers\Inflector::inArray($attribute->name, $excludesAttribute)): ?>
<?php if (substr( $attribute->name, - 3 ) === '_id'): $name = substr( $attribute->name, 0, - 3 ); ?>
<?php $subDetailDatas[] = Inflector::variablize($name . 'Text') . ' + `<input type="hidden" value="${item.'.Inflector::variablize($attribute->name).'}" class="txt-'.$subDetailClassName.'-'.Inflector::camel2id
(Inflector::camelize($attribute->name)) .'">`' . "\n"  ?>
<?php else: ?>
<?php $subDetailDatas[] = $attribute->name == 'name' ?
'`<input type="hidden" value="${item.id}" class="txt-'.$subDetailClassName.'-id">`' . ' + `<input type="text" value="${item.'.Inflector::variablize($attribute->name).'}" class="form-control txt-'.$subDetailClassName.'-'.Inflector::camel2id(Inflector::camelize
($attribute->name)) .'">`' . "\n" :
'`<input type="text" value="${item.'.Inflector::variablize($attribute->name).'}" class="form-control txt-'.$subDetailClassName.'-'.Inflector::camel2id(Inflector::camelize($attribute->name)) .'">`' ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
					<?= $subDetailTable ?>.row
						.add([<?= implode(',', $subDetailDatas) ?>, '<a class="btn btn-danger btn-remove-<?= $subDetailClassName ?>"> <i class="glyphicon glyphicon-trash"></i> </a>'])
						.draw(false);
				});
			}
		});
		body.on('click', '#btn_add_<?= $generator->subDetailTableName ?>', function () {
<?php $subDetailDatas =[]; foreach ( $generator->subDetailColumns as $key => $attribute ): ?>
<?php if ($detailForeignKey !== $attribute->name && $attribute->name !== 'id' && !\common\utils\helpers\Inflector::inArray($attribute->name, $excludesAttribute)): ?>
<?php if (substr( $attribute->name, - 3 ) === '_id'): $name = substr( $attribute->name, 0, - 3 ); ?>
			let <?= Inflector::variablize($name . 'Text'); ?> = $("#select_<?= $generator->subDetailTableName . '_' . $attribute->name ?>").select2('data')[0]['text'];
			let <?= Inflector::variablize($attribute->name); ?> =  $("#select_<?= $generator->subDetailTableName . '_' . $attribute->name ?>").val();
<?php $subDetailDatas[] = Inflector::variablize($name . 'Text') . ' + `<input type="hidden" value="${'.Inflector::variablize($attribute->name).'}" class="txt-'.$subDetailClassName.'-'.Inflector::camel2id
			(Inflector::camelize($attribute->name)) .'">`' . "\n"  ?>
<?php else: ?>
			let <?= Inflector::variablize($attribute->name); ?> = $("#txt_<?= $generator->subDetailTableName . '_' . $attribute->name ?>").val();
<?php $subDetailDatas[] = $attribute->name == 'name' ?
			'`<input type="hidden" class="txt-'.$subDetailClassName.'-id">`' . ' + `<input type="text" value="${'.Inflector::variablize($attribute->name).'}" class="form-control txt-'.$subDetailClassName.'-'.Inflector::camel2id(Inflector::camelize
			($attribute->name)) .'">`' . "\n" :
			'`<input type="text" value="${'.Inflector::variablize($attribute->name).'}" class="form-control txt-'.$subDetailClassName.'-'.Inflector::camel2id(Inflector::camelize($attribute->name)) .'">`' ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
			<?= $subDetailTable ?>.row
				.add([<?= implode(',', $subDetailDatas) ?>, '<button type="button" class="btn btn-danger btn-remove-<?= $subDetailClassName ?>"> <i class="glyphicon glyphicon-trash"></i> </a>'])
				.draw(false);
		});
		body.on('click', '.btn-remove-<?= Inflector::camel2id(Inflector::camelize($generator->subDetailTableName)) ?>', function () {
			<?= $subDetailTable ?>.row($(this).parents('tr')).remove().draw();
		});
		body.on('click', '#btn_save_<?= $generator->subDetailTableName ?>', function () {
			$.blockUI();
			let tempArray = [];
			if (<?= $subDetailTable ?>.rows().data().count() > 0) {
                $("#table_<?= $generator->subDetailTableName ?>").find("tbody").find('tr').each(function () {
<?php $objectString = ''; foreach ( $generator->subDetailColumns as $key => $attribute ):?>
<?php if ($detailForeignKey !== $attribute->name && !\common\utils\helpers\Inflector::inArray($attribute->name, $excludesAttribute)): ?>
<?php if (substr( $attribute->name, - 3 ) === '_id'): ?>
                    let <?= Inflector::variablize($attribute->name); ?> = $(this).find(".select_<?= $subDetailClassName . '-' . $attribute->name ?>").val();
<?php $objectString .= $attribute->name . ': ' . Inflector::variablize($attribute->name). ', '; ?>
<?php else: ?>
                    let <?= Inflector::variablize($attribute->name); ?> = $(this).find(".txt-<?= $subDetailClassName . '-' . $attribute->name ?>").val();
<?php $objectString .= $attribute->name . ': ' . Inflector::variablize($attribute->name). ', '; ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; $objectString = substr($objectString, 0, -2);?>
                    tempArray.push({<?= $objectString ?>});
                });
                let index = parseInt($("#txt_index").val());
                <?= $subDetailArr ?>[index] = tempArray;
            }
			$.unblockUI();
			$("#modal-lg").modal('hide');
		});
<?php endif; ?>
<?php endif; ?>
	});
</script>