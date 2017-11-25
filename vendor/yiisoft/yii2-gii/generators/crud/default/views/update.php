<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
$modelVariableName   = Inflector::variablize(StringHelper::basename( $generator->modelClass ));
$urlParams = $generator->generateUrlParams();
$modelDetails = $generator->hasDetail ? '\'' . Inflector::pluralize(Inflector::variablize($generator->subTableName)) . '\' => $' . Inflector::pluralize(Inflector::variablize($generator->subTableName)) . ",\n" : '';
$modelDetail = $generator->hasDetail ? '\'' . Inflector::variablize($generator->subTableName) . '\' => $' . Inflector::variablize($generator->subTableName) . ",\n" : '';
$path = pathinfo($generator->modelClass);
$updateText = $generator->defaultLanguage == 'vi' ? 'Cập nhật ' : 'Update ';
echo "<?php\n";
?>

/* @var $this yii\web\View */
/* @var $<?= $modelVariableName ?> <?= ltrim($generator->modelClass, '\\') ?> */
<?php if ($generator->hasDetail): ?>
/* @var $<?= Inflector::pluralize(Inflector::variablize($generator->subTableName)) ?>[] <?= $path['dirname'] . '\\' . Inflector::camelize($generator->subTableName) ?> */
/* @var $<?= Inflector::variablize($generator->subTableName) ?> <?= $path['dirname'] . '\\' . Inflector::camelize($generator->subTableName) ?> */
<?php endif ?>
<?php if ($generator->enableI18N): ?>
$this->title = Yii::t('yii', 'Update {model}', ['model' => mb_convert_case(Yii::t('yii', '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>'), MB_CASE_LOWER, 'UTF-8')]) . ': ' . $<?= $modelVariableName ?>-><?= $generator->getNameAttribute() ?>;
<?php else: ?>
$this->title = <?= $generator->generateString($updateText . '{modelClass}: ', ['modelClass' => Inflector::camel2words(StringHelper::basename($generator->modelClass))]) ?> . $<?= $modelVariableName ?>-><?= $generator->getNameAttribute() ?>;
<?php endif ?>
<?php if ($generator->enableI18N): ?>
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>'), 'url' => ['index']];
<?php else: ?>
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, 'url' => ['index']];
<?php endif ?>
$this->params['breadcrumbs'][] = <?= $generator->generateString('Update') ?>;
?>
<?php if (! $generator->isModal): ?>
<h1 class="page-title margin-bottom-10"><?= '<?= ' ?>yii\helpers\Html::encode($this->title) ?></h1>
<?php endif ?>
<?= '<?= ' ?>$this->render('_form', [
    <?= "\t" ?>'<?= $modelVariableName ?>' => $<?= $modelVariableName ?>,
    <?= $modelDetails ?>
    <?= $modelDetail ?>
]) ?>
