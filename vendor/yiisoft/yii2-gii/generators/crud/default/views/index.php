<?php

use common\utils\helpers\StringHelper;
use yii\helpers\Inflector;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams         = $generator->generateUrlParams();
$nameAttribute     = $generator->getNameAttribute();
$excludesAttribute = array_map('trim', explode(',', $generator->skippedIndexColumns));
$validAttributes   = array_diff( $generator->getColumnNames(), $excludesAttribute);
$className         = Inflector::camel2id( StringHelper::basename( $generator->modelClass ), '-' );
$idName            = Inflector::camel2id( StringHelper::basename( $generator->modelClass ), '_' );
$modelVariableName = Inflector::variablize(StringHelper::basename( $generator->modelClass ));
echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\Url;
<?php if ($generator->enableI18N): ?>
$this->title = Yii::t('yii', '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>');
<?php else: ?>
$this->title = <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
<?php endif ?>
$this->params['breadcrumbs'][] = $this->title;
/* @var $<?= $modelVariableName ?> <?= ltrim( $generator->modelClass, '\\' ) ?> */
/* @var $this yii\web\View */
?>
<div class="<?= $className ?>-index">
	<h1 class="page-title margin-bottom-10"><?= '<?= ' ?>Html::encode($this->title) ?></h1>
<?php
if ( $generator->isFilter ) {
echo "\t" . '<?= $this->render( \'_search\', [\'table\' => \'table_'.$idName.'\', \''.$modelVariableName.'\' => $'.$modelVariableName.'] ); ?>' . "\n";
}
?>
<?php if ($generator->moreOption): ?>
	<?= '<?=  $this->render( \'/template/_more_options\', [ \'table\' => \'table_'.$idName.'\', \'url\' => Url::to( [ \'change-rows-status\' ] ), \'params\' => [Yii::t( \'yii\', \'Delete\' ) => - 1] ] ); ?>' . "\n" ?>
<?php else: ?>
    <div class="action-create form-group">
    <?php echo '<?php if ( Yii::$app->permission->can( Yii::$app->controller->id, \'create\' ) ) : ?>' . "\n" ?>
        <a class="btn blue-steel" href="<?= "<?= Url::to( [ 'create' ] ) ?>" ?>" title="<?= "<?= Yii::t( 'yii', 'Create' ) ?>" ?>"><?= "<?= Yii::t( 'yii', 'Create' ) ?>" ?></a>
    <?php echo "<?php endif; ?>" . "\n" ?>
    </div>
<?php endif ?>
<?php if ($generator->exportAll): ?>
    <div class="form-group">
        <a href="<?= '<?= ' . "Url::to( [ 'export-$className' ] )" . ' ?>' ?>" class="btn blue-steel"><i class="fa fa-download"></i> Export</a>
    </div>
<?php endif ?>
	<table id="table_<?= $idName ?>" class="table table-striped table-bordered table-hover table-checkable nowrap">
		<thead>
		<tr>
            <th class="table-checkbox" width="5%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input class="cb-all group-checkable" type="checkbox" title=""/>
                    <span></span>
                </label>
            </th>
<?php foreach ( $validAttributes as $key => $attribute ): ?>
<?php if ($generator->isIndexFixed): ?>
			<th><?= '<?= $'. $modelVariableName . "->getAttributeLabel('{$attribute}')" . ' ?>' ?></th>
<?php else: ?>
			<th><?= '<?= $'. $modelVariableName . "->getAttributeLabel('{$attribute}')" . ' ?>' ?></th>
<?php endif; ?>
<?php endforeach; ?>
<?php if ($generator->actionCol): ?>
<?php if ($generator->enableI18N == '1'): ?>
            <th width="10%"><?= '<?= Yii::t(\'yii\', \'Actions\') ?>' ?></th>
<?php else: ?>
            <th width="10%"><?= $generator->defaultLanguage == 'vi' ? 'Hành động' : 'Actions' ?></th>
<?php endif ?>
<?php endif ?>
		</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script>
    'use strict';
	$(function () {
		Team.blockUI();
		let body = $('body');
        let table<?= Inflector::camelize($idName) ?> = $("#table_<?= $idName ?>").DataTable({
			serverSide: true,
			ajax: $.fn.dataTable.pipeline({
				url: "<?= '<?= ' . "Url::to(['index-table'])" . ' ?>' ?>",
<?php if ($generator->isFilter): ?>
				data: function(q) {
					q.filterDatas = $("#form_<?= $idName ?>_search").serialize();
				}
<?php endif; ?>
			}),
			conditionalPaging: true,
            info: true,
            columnDefs: [
                {
                    'targets': [0, -1],
                    'searchable': false,
                    'orderable': false,
                }
            ],
<?php if ($generator->isIndexFixed): ?>
			fixedColumns: {
				leftColumns: 2,
				rightColumns: 1
			}
<?php endif; ?>
		});
		body.on('click', '.btn-delete-<?= $className ?>', function () {
            Team.action($(this), <?= '"<?= Yii::t(\'yii\', \'Are you sure you want to delete this item?\') ?>"' ?>, table<?= Inflector::camelize($idName) ?>);
		});
	});
</script>