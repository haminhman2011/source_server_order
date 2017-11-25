<?php
/* @var $this yii\web\View */
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$excludesAttribute = [ 'status', 'created_by', 'created_date', 'updated_date', 'updated_by' ];
if($generator->hasSubDetail) {
	$subDetailModel            = Inflector::camelize($generator->subDetailTableName);
	$subDetailModelString      = 'backend\\models\\' . $subDetailModel;
	$subModelDetailIdName      = Inflector::camel2id( StringHelper::basename( $generator->subDetailTableName ), '_' );
	$subDetailClassName        = Inflector::camel2id(Inflector::camelize($subModelDetailIdName));
	$subDetailModelClass       = new $subDetailModelString;
	$subDetailModelForeignKeys = $subDetailModelClass->getTableSchema()->foreignKeys;
	$detailForeignKey          = '';
	foreach ( $subDetailModelForeignKeys as $subDetailModelForeignKey ) {
		if (in_array($generator->subTableName, array_values($subDetailModelForeignKey), true)) {
			$detailForeignKey = array_search('id', $subDetailModelForeignKey, true);
			break;
		}
	}
}
?>
<?= '<?php /** @var backend\models\\'.$subDetailModel.' $'.Inflector::variablize($generator->subDetailTableName).' */ ?>' . "\n" ?>
<div class="modal-header">
    <label for="">Danh sách chi tiết</label>
    <input type="hidden" value="<?= '<?= $index ?>' ?>" id="txt_index">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
	<div class="row">
<?php foreach ($generator->subDetailColumns as $key => $subDetailColumn): $label = "'<?= $'. Inflector::variablize($generator->subDetailTableName) . \"->getAttributeLabel('{$subDetailColumn->name}')\" . ' ?>'";?>
<?php if ($detailForeignKey !== $subDetailColumn->name && $subDetailColumn->name !== 'id' && !\common\utils\helpers\Inflector::inArray($subDetailColumn->name, $excludesAttribute)): ?>
<?php if ( substr( $subDetailColumn->name, - 3 ) === '_id' ): ?>
		<div class="col-md-4 form-group">
			<label><?= $label ?></label>
			<select title="" id="select_<?= $subModelDetailIdName . '_' . $subDetailColumn->name ?>" class="form-control select" data-placeholder="Chọn <?= $label ?>">
				<option></option>
			</select>
		</div>
<?php else: ?>
		<div class="col-md-4 form-group">
			<label><?= '<?= $'. Inflector::variablize($generator->subDetailTableName) . "->getAttributeLabel('{$subDetailColumn->name}')" . ' ?>' ?></label>
			<input title="" type="text" class="form-control" id="txt_<?= $subModelDetailIdName . '_' . $subDetailColumn->name ?>">
		</div>
<?php endif ?>
<?php endif ?>
<?php endforeach ?>
		<div class="col-md-3 form-group">
			<a type="button" class="btn btn-primary" id="btn_add_<?= $subModelDetailIdName ?>" style="margin-top: 22px"><?= $generator->enableI18N ? '<?= Yii::t(\'yii\', \'' . 'Add' . '\') ?>' : $generator->defaultLanguage == 'vi' ? 'Thêm' : 'Add' ?></a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 form-group">
			<table id="table_<?= $generator->subDetailTableName ?>" class="table table-striped table-bordered nowrap" style="width: 100%">
				<thead>
				<tr>
<?php foreach ($generator->subDetailColumns as $key => $subDetailColumn): ?>
<?php if ($detailForeignKey !== $subDetailColumn->name && $subDetailColumn->name !== 'id' && !\common\utils\helpers\Inflector::inArray($subDetailColumn->name, $excludesAttribute)): ?>
                    <th><?= '<?= $'. Inflector::variablize($generator->subDetailTableName) . "->getAttributeLabel('{$subDetailColumn->name}')" . ' ?>' ?></th>
<?php endif ?>
<?php endforeach ?>
					<th style="min-width: 5%">Hành động</th>
				</tr>
				</thead>
				<tbody>
<?php $details = Inflector::pluralize(Inflector::variablize($generator->subDetailTableName));
$detail = Inflector::singularize($details); ?>
				<?= '<?php if ( isset($' . $details . ') && is_array($' . $details . ') ): ?>' . "\n" ?>
					<?= '<?php /** @var backend\models\\'.$subDetailModel.'[] $'.$details.' */ ?>' . "\n" ?>
					<?= '<?php foreach ( $' . $details . ' as $key => $' . $detail . ' ): ?>' . "\n" ?>
						<tr>
<?php foreach ($generator->subDetailColumns as $key => $subDetailColumn):?>
<?php if ($detailForeignKey !== $subDetailColumn->name && $subDetailColumn->name !== 'id' &&  !\common\utils\helpers\Inflector::inArray($subDetailColumn->name, $excludesAttribute)): ?>
<?php if (substr( $subDetailColumn->name, - 3 ) === '_id'): ?>
							<td>
								<?= '<?= $' . $detail . '->' . Inflector::variablize($subDetailColumn->name) . '->name ?>' . "\n" ?>
								<input type="hidden" value="<?= '<?= $' . $detail . '->' . $subDetailColumn->name . '?>' ?>"">
							</td>
<?php else: ?>
							<td>
<?php if ($key == 'name'): ?>
								<input type="hidden" value="<?= '<?= $' . $detail . '->id ?>' ?>" class="form-control txt-<?= $subDetailClassName . '-id' ?>">
<?php endif ?>
								<input title="" type="text" value="<?= '<?= $' . $detail . '->' . $subDetailColumn->name . '?>' ?>" class="form-control txt-<?= $subDetailClassName . '-' . $subDetailColumn->name ?>">
							</td>
<?php endif ?>
<?php endif ?>
<?php endforeach ?>
							<td>
								<a class="btn btn-danger btn-remove-<?= $subDetailClassName ?>"> <i class="glyphicon glyphicon-trash"></i> </a>
							</td>
						</tr>
					<?= '<?php endforeach ?>' . "\n" ?>
				<?= '<?php endif ?>' . "\n" ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button class="btn btn-default" type="button" data-dismiss="modal" data-bb-handler="cancel">Hủy</button>
	<button class="btn btn-primary" type="button" data-bb-handler="confirm" id="btn_save_<?= $subModelDetailIdName ?>">Lưu</button>
</div>
<div class="clear"></div>