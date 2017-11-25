<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$excludesAttribute = array_map('trim', explode(',', $generator->skippedColumns));
$modelName         = Inflector::camel2id( StringHelper::basename( $generator->modelClass ) );
$mainModelIdName   = Inflector::camel2id( StringHelper::basename( $generator->modelClass ), '_' );
$validAttributes   = array_diff( $generator->getColumnNames(), $excludesAttribute);
$modelVariableName   = Inflector::variablize(StringHelper::basename( $generator->modelClass ));
$path = pathinfo($generator->modelClass);
if ($generator->hasDetail) {
    $subModelVar = Inflector::variablize($generator->subTableName);
    $subModel            = Inflector::camelize($generator->subTableName);
    $subClassName        = Inflector::camel2id($subModel);
    $subModelString      = 'backend\\models\\' . $subModel;
    $subModelClass       = new $subModelString;
    $subModelForeignKeys = $subModelClass->getTableSchema()->foreignKeys;
    $foreignKey          = '';
    foreach ( $subModelForeignKeys as $subModelForeignKey ) {
        if (in_array($mainModelIdName, array_values($subModelForeignKey), true)) {
            $foreignKey = array_search('id', $subModelForeignKey, true);
            break;
        }
    }
    $subDetailModel            = Inflector::camelize($generator->subDetailTableName);
    $subDetailClassName        = Inflector::camel2id($subDetailModel);
}
$column = 6;
$totalAttrs = count( $validAttributes ) - 1;
if ($totalAttrs == 3 || $totalAttrs == 5) {
    $column = 4;
}elseif($totalAttrs == 4 || $totalAttrs > 5) {
    $column = 3;
}
echo "<?php\n";
?>

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $<?= $modelVariableName ?> <?= ltrim($generator->modelClass, '\\') ?> */
<?php if ($generator->hasDetail): ?>
/* @var $<?= Inflector::pluralize(Inflector::variablize($generator->subTableName)) ?>[] <?= $path['dirname'] . '\\' . Inflector::camelize($generator->subTableName) ?> */
/* @var $<?= $subModelVar ?> <?= $path['dirname'] . '\\' . Inflector::camelize($generator->subTableName) ?> */
<?php endif ?>
$this->title = $<?= $modelVariableName ?>-><?= $generator->getNameAttribute() ?>;
<?php if ($generator->enableI18N): ?>
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'List {model}', ['model' => mb_convert_case(Yii::t('yii', '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>'), MB_CASE_LOWER, 'UTF-8')]), 'url' => ['index']];
<?php else: ?>
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, 'url' => ['index']];
<?php endif ?>
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view <?= $generator->isModal ? 'modal-body' : '' ?>">
    <h1 class="page-title"><?= '<?= ' ?>Html::encode($this->title) ?></h1>
    <div class="row">
<?php foreach ( $validAttributes as $key => $attribute ): $inputValue = '<?= $' . $modelVariableName . '->' . $attribute . ' ?>';
if (strpos($attribute, 'quantity') !== false) {
    $inputValue = '<?= number_format($' . $modelVariableName . '->' . $attribute . ') ?>';
} elseif (strpos($attribute, 'date') !== false) {
    $inputValue = '<?= Yii::$app->formatter->asDate($' . $modelVariableName . '->' . $attribute . ') ?>';
} elseif (substr( $attribute, - 3) === '_id') {
    $inputValue = '<?= $'. $modelVariableName . '->'.$attribute.' != null ? $'. $modelVariableName . '->' . Inflector::variablize( substr( $attribute, 0, - 3) ) . '->name' . ' : \'\' ?>';
}
?>
        <div class="col-md-<?= $column ?>">
            <div class="form-group">
                <label for="txt_<?= $attribute ?>"><?= '<?= $'. $modelVariableName . "->getAttributeLabel('{$attribute}')" . ' ?>' ?></label>
                <input type="text" class="form-control" value="<?= $inputValue ?>" id="txt_<?= $attribute ?>" readonly>
            </div>
        </div>
<?php endforeach ?>
    </div>
<?php if ($generator->hasDetail): ?>
<?php $details = Inflector::pluralize($subModelVar); ?>
    <div class="detail-title">
        <label for="">Danh sách chi tiết</label>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <table id="table_<?= $generator->subTableName ?>" class="table table-striped table-bordered nowrap" style="width: 100%">
                    <thead>
                        <tr>
<?php foreach ( $generator->detailColumns as $key => $attribute ): ?>
<?php if ($foreignKey !== $attribute->name && $attribute->name !== 'id' && !\common\utils\helpers\Inflector::inArray($attribute->name, $excludesAttribute)): ?>
                            <th><?= '<?= $'. $subModelVar . "->getAttributeLabel('{$attribute->name}')" . ' ?>' ?></th>
<?php endif; ?>
<?php endforeach; ?>
<?php if ($generator->hasSubDetail): ?>
                            <th style="min-width: 5%"><?= $generator->enableI18N ? '<?= Yii::t(\'yii\', \'Actions\') ?>' : 'Actions' ?></th>
<?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?= '<?php if ( isset($' . $details . ') && is_array($' . $details . ') ): ?>' . "\n" ?>
                        <?= '<?php foreach ( $' . $details . ' as $key => $' . $subModelVar . ' ): ?>' . "\n" ?>
                            <tr>
<?php foreach ( $generator->detailColumns as $key => $attribute ): ?>
<?php if ($foreignKey !== $attribute->name && $attribute->name !== 'id'  && !\common\utils\helpers\Inflector::inArray($attribute->name, $excludesAttribute)): ?>
                                <td>
<?php if ( substr( $attribute->name, - 3 ) === '_id' ): $relation = substr( $attribute->name, 0, -3);?>
                                    <?= '<?= $' . $subModelVar . '->' . $attribute->name . ' != null ? $'.$subModelVar.'->'.Inflector::variablize( $relation ).'->name : \'\' ?>' . "\n" ?>
<?php else: ?>
                                    <?= '<?= $' . $subModelVar . '->' . $attribute->name . ' ?>' . "\n" ?>
<?php endif ?>

                                </td>
<?php endif ?>
<?php endforeach; ?>
<?php if ($generator->hasSubDetail): ?>
                                <td>
                                    <a class="btn btn-info btn-modal-<?= $subDetailClassName ?>" data-<?= $subClassName ?>-id="<?= '<?= $' . $subModelVar . '->id ?>' ?>"> <i class="glyphicon glyphicon-eye-open"></i> </a>
                                </td>
<?php endif ?>
                            </tr>
                        <?= '<?php endforeach ?>' . "\n" ?>
                    <?= '<?php endif ?>' . "\n" ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>
    <div class="form-footer">
<?php if ($generator->enableI18N): ?>
        <a class="btn btn-default" href="<?= '<?= ' . "Url::to( [ 'index' ] )" . ' ?>' ?>"><?= '<?= Yii::t(\'yii\', \'Cancel\') ?>' ?></a>
        <?php echo '<?php if ( Yii::$app->permission->can( Yii::$app->controller->id , \'update\' )) : ?>' . "\n"; ?>
            <a class="btn green-haze" href="<?= '<?= ' . 'Url::to( [ \'update\', \'id\' => $' . $modelVariableName . '->id ] )' . ' ?>' ?>"><?= '<?= Yii::t(\'yii\', \'Update\') ?>' ?></a>
        <?php echo '<?php endif; ?>' . "\n"; ?>
<?php if ($generator->exportDetail): ?>
        <a href="<?= '<?= ' . "Url::to( [ 'export-$modelName-detail' ] )" . ' ?>' ?>" class="btn blue-steel"><i class="glyphicon glyphicon-export"></i> Export</a>
<?php endif ?>
<?php else: ?>
        <a class="btn btn-default" href="<?= '<?= ' . "Url::to( [ 'index' ] )" . ' ?>' ?>"><?= $generator->defaultLanguage == 'vi' ? 'Hủy' : 'Cancel' ?></a>
        <?php echo '<?php if ( Yii::$app->permission->can( Yii::$app->controller->id , \'update\' )) : ?>' . "\n"; ?>
            <a class="btn green-haze" href="<?= '<?= ' . 'Url::to( [ \'update\', \'id\' => $' . $modelVariableName . '->id ] )' . ' ?>' ?>"><?= $generator->defaultLanguage == 'vi' ? 'Cập nhật' : 'Update' ?></a>
        <?php echo '<?php endif; ?>' . "\n"; ?>
<?php if ($generator->exportDetail): ?>
            <a href="<?= '<?= ' . "Url::to( [ 'export-$modelName-detail' ] )" . ' ?>' ?>" class="btn blue-steel"><i class="fa fa-download"></i> Export</a>
<?php endif ?>
<?php endif ?>
    </div>
</div>
<?php if ($generator->hasDetail): ?>
<script>
    'use strict';
    $(function(){
        $("#table_<?= $generator->subTableName ?>").DataTable({
            paging: false,
            scrollY: '276px',
            scrollCollapse: true,
            scrollX: true,
            sort: false
        });
<?php if ($generator->hasSubDetail): ?>
        $('body').on('click', '.btn-modal-<?= $subDetailClassName ?>', function() {
            let <?= Inflector::variablize($generator->subTableName) ?>Id = $(this).data('<?= $subClassName ?>-id');
            Team.showModal({<?= Inflector::variablize($generator->subTableName) ?>Id: <?= Inflector::variablize($generator->subTableName) ?>Id}, '<?= '<?= ' . "Url::to(['view-modal-$subDetailClassName'])" . ' ?>' ?>', $('#modal-lg')).
                then(function() {
                $("#table_<?= $generator->subDetailTableName ?>").DataTable({
                    paging: false,
                    scrollY: '276px',
                    scrollCollapse: true,
                    scrollX: true,
                    sort: false
                });
            });
        });
<?php endif ?>
    });
</script>
<?php endif ?>
