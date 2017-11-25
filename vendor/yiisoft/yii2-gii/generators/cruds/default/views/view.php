<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$excludesAttribute = ['is_delete', 'created_by', 'created_date', 'modified_date', 'modified_by', 'id'];
$mainModelIdName   = Inflector::camel2id( StringHelper::basename( $generator->modelClass ), '_' );
$validAttributes   = array_diff( $generator->getColumnNames(), $excludesAttribute);
$modelVariableName   = Inflector::variablize(StringHelper::basename( $generator->modelClass ));
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
<?php foreach ( $validAttributes as $key => $attribute ): $label = $generator->getColumn( $attribute )->comment; $inputValue = '<?= $' . $modelVariableName . '->' . $attribute . ' ?>';
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
    <div class="form-footer">
<?php if ($generator->enableI18N): ?>
        <a class="btn btn-default" href="<?= '<?= ' . "Url::to( [ 'index' ] )" . ' ?>' ?>"><?= '<?= Yii::t(\'yii\', \'Cancel\') ?>' ?></a>
        <?php echo '<?php if ( Yii::$app->permission->can( Yii::$app->controller->id , \'update\' )) : ?>' . "\n"; ?>
            <a class="btn btn-success" href="<?= '<?= ' . 'Url::to( [ \'update\', \'id\' => $' . $modelVariableName . '->id ] )' . ' ?>' ?>"><?= '<?= Yii::t(\'yii\', \'Update\') ?>' ?></a>
        <?php echo '<?php endif; ?>' . "\n"; ?>
<?php else: ?>
        <a class="btn btn-default" href="<?= '<?= ' . "Url::to( [ 'index' ] )" . ' ?>' ?>"><?= $generator->defaultLanguage == 'vi' ? 'Hủy' : 'Cancel' ?></a>
        <?php echo '<?php if ( Yii::$app->permission->can( Yii::$app->controller->id , \'update\' )) : ?>' . "\n"; ?>
            <a class="btn btn-success" href="<?= '<?= ' . 'Url::to( [ \'update\', \'id\' => $' . $modelVariableName . '->id ] )' . ' ?>' ?>"><?= $generator->defaultLanguage == 'vi' ? 'Cập nhật' : 'Update' ?></a>
        <?php echo '<?php endif; ?>' . "\n"; ?>
<?php endif ?>
    </div>
</div>
