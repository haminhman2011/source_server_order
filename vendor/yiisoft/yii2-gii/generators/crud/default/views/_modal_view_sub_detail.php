<?php
/* @var $this yii\web\View */
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$excludesAttribute = [ 'status', 'created_by', 'created_date', 'updated_date', 'updated_by' ];
$subModelIdName      = Inflector::camel2id( StringHelper::basename( $generator->subTableName ), '_' );
if($generator->hasSubDetail) {
	$subDetailModel            = Inflector::camelize($generator->subDetailTableName);
	$subDetailModelString      = 'backend\\models\\' . $subDetailModel;
	$subModelDetailIdName      = Inflector::camel2id( StringHelper::basename( $generator->subDetailTableName ), '_' );
	$subDetailModelClass       = new $subDetailModelString;
	$subDetailModelForeignKeys = $subDetailModelClass->getTableSchema()->foreignKeys;
	$detailForeignKey          = '';
	foreach ( $subDetailModelForeignKeys as $subDetailModelForeignKey ) {
		if (in_array($subModelIdName, array_values($subDetailModelForeignKey), true)) {
			$detailForeignKey = array_search('id', $subDetailModelForeignKey, true);
			break;
		}
	}
}
?>
<?= '<?php /** @var backend\models\\'.$subDetailModel.' $'.Inflector::variablize($generator->subDetailTableName).' */ ?>' . "\n" ?>
<div class="modal-header">
    <label for="">Danh sách chi tiết</label>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
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
							<td>
								<?= '<?= $' . $detail . '->' . $subDetailColumn->name . ' ?>' . "\n" ?>
							</td>
<?php endif ?>
<?php endforeach ?>
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
</div>
<div class="clear"></div>