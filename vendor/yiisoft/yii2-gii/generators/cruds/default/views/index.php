<?php

use common\utils\helpers\StringHelper;
use yii\helpers\Inflector;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams         = $generator->generateUrlParams();
$nameAttribute     = $generator->getNameAttribute();
$excludesAttribute = [ 'status', 'created_by', 'created_date', 'modified_date', 'id', 'modified_by' ];
$validAttributes   = array_diff( $generator->getColumnNames(), $excludesAttribute);
$className         = Inflector::camel2id( StringHelper::basename( $generator->modelClass ), '-' );
$idName            = Inflector::camel2id( StringHelper::basename( $generator->modelClass ), '_' );
$modelVariableName = Inflector::variablize(StringHelper::basename( $generator->modelClass ));
echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\Url;
<?php if ($generator->enableI18N): ?>
$this->title = '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>';
<?php else: ?>
$this->title = <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
<?php endif ?>
$this->params['breadcrumbs'][] = $this->title;
/* @var $<?= $modelVariableName ?> <?= ltrim( $generator->modelClass, '\\' ) ?> */
?>
<div class="<?= $className ?>-index">
	<h1 class="page-title"><?= '<?= ' ?>Html::encode($this->title) ?></h1>
<?php
if ( $generator->isFilter ) {
echo "\t" . '<?= $this->render( \'_search\', [\''.$modelVariableName.'\' => $'.$modelVariableName.'] ); ?>' . "\n";
}
?>
<?php echo '<?php if ( Yii::$app->permission->can( Yii::$app->controller->id , \'create\' )) : ?>' . "\n"; ?>
        <div class="form-group">
<?php if ($generator->enableI18N == '1'): ?>
            <a class="btn blue-steel" href="<?= '<?= ' . "Url::to(['create'])" . ' ?>' ?>" title="<?= '<?= Yii::t(\'yii\', \'Create\') ?>' ?>"><?= '<?= Yii::t(\'yii\', \'Create\') ?>' ?></a>
<?php else: ?>
            <a class="btn blue-steel" href="<?= '<?= ' . "Url::to(['create'])" . ' ?>' ?>" title="<?= $generator->defaultLanguage == 'vi' ? 'Tạo mới' : 'Create' ?>"><?= $generator->defaultLanguage == 'vi' ? 'Tạo mới' : 'Create' ?></a>
<?php endif ?>
<?php if ($generator->exportAll): ?>
            <a href="<?= '<?= ' . "Url::to( [ 'export-$className' ] )" . ' ?>' ?>" class="btn blue-steel"><i class="glyphicon glyphicon-export"></i> Export</a><?php endif ?>
        </div>
<?php echo '<?php endif; ?>' . "\n"; ?>
	<table id="table_<?= $idName ?>" class="table table-striped table-hover table-bordered table-checkable nowrap">
		<thead>
		<tr>
            <th class="table-checkbox">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input class="cb-all group-checkable" type="checkbox" title=""/>
                    <span></span>
                </label>
            </th>
<?php foreach ( $validAttributes as $key => $attribute ): ?>
			<th><?= '<?= $'. $modelVariableName . "->getAttributeLabel('{$attribute}')" . ' ?>' ?></th>
<?php endforeach; ?>
<?php if ($generator->enableI18N == '1'): ?>
            <th width="10%"><?= '<?= Yii::t(\'yii\', \'Actions\') ?>' ?></th>
<?php else: ?>
            <th width="10%"><?= $generator->defaultLanguage == 'vi' ? 'Hành động' : 'Actions' ?></th>
<?php endif ?>
		</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script>
	$(function () {
		Team.blockUI();
		let body = $('body');
		let table<?= Inflector::camelize($idName) ?> = $("#table_<?= $idName ?>").DataTable({
			serverSide: true,
			ajax: $.fn.dataTable.pipeline({
				url: "<?= '<?= ' . "Url::to(['index-table'])" . ' ?>' ?>",
<?php if ($generator->isFilter): ?>
					data: function(q) {
						q.filter = $("#form_<?= $idName ?>_search").serialize();
					}
<?php endif; ?>
			}),
			conditionalPaging: true,
            info: true,
//            scrollX: true,
            'columnDefs': [
                {
                    'targets': [0, -1],
                    'searchable': false,
                    'orderable': false,
                }
            ],
		});
<?php if ( $generator->isModal ):?>
		body.on('click', '#btn_create_<?= $idName ?>', function () {
            Team.showModal('', '<?= '<?= ' . "Url::to(['create'])" . ' ?>' ?>', $('#modal-lg'));
		});
		body.on('click', '.btn-update-<?= $className ?>', function () {
			let id = $(this).data('id');
            Team.showModal({id: id}, '<?= '<?= ' . "Url::to(['update'])" . ' ?>' ?>', $('#modal-lg'));
		});
		body.on('click', '.btn-view-<?= $className ?>', function () {
			let id = $(this).data('id');
            Team.showModal({id: id}, '<?= '<?= ' . "Url::to(['view'])" . ' ?>' ?>', $('#modal-lg'));
		});
<?php endif; ?>
		body.on('click', '.btn-delete-<?= $className ?>', function () {
            Team.action($(this), <?= '"<?= Yii::t(\'yii\', \'Are you sure you want to delete this item?\') ?>"' ?>, table<?= Inflector::camelize($idName) ?>);
		});
<?php if ( $generator->isFilter ):?>
        $("#form_<?= $idName ?>_search").on('submit', function () {
			table<?= Inflector::camelize($idName) ?>.clearPipeline().draw();
			return false;
		});
		body.on('click', '#btn_reset_filter', function () {
			$("#form_<?= $idName ?>_search").find('input, select').val('').trigger('change');
			table<?= Inflector::camelize($idName) ?>.clearPipeline().order([]).draw();
		});
<?php endif ?>
	});
</script>