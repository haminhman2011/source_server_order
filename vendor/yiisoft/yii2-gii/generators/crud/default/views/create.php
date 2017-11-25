<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
$modelVariableName   = Inflector::variablize(StringHelper::basename( $generator->modelClass ));
$modelDetail = $generator->hasDetail ? '\'' . Inflector::variablize($generator->subTableName) . '\' => $' . Inflector::variablize($generator->subTableName) . "\n" : '';
$path = pathinfo($generator->modelClass);
$createText = $generator->defaultLanguage == 'vi' ? 'Tạo ' : 'Create ';
echo "<?php\n";
?>

/* @var $this yii\web\View */
/* @var $<?= $modelVariableName ?> <?= ltrim($generator->modelClass, '\\') ?> */
<?php if ($generator->hasDetail): ?>
/* @var $<?= Inflector::variablize($generator->subTableName) ?>[] <?= $path['dirname'] . '\\' . Inflector::camelize($generator->subTableName) ?> */
<?php endif ?>
<?php if ($generator->enableI18N): ?>
$this->title = Yii::t('yii', 'Create {model}', ['model' => mb_convert_case(Yii::t('yii', '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>'), MB_CASE_LOWER, 'UTF-8')]);
<?php else: ?>
$this->title = <?= $generator->generateString($createText . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
<?php endif ?>
<?php if ($generator->enableI18N): ?>
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>'), 'url' => ['index']];
<?php else: ?>
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, 'url' => ['index']];
<?php endif ?>
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (! $generator->isModal): ?>
<h1 class="page-title margin-bottom-10"><?= '<?= ' ?>yii\helpers\Html::encode($this->title) ?></h1>
<?php endif ?>
<?= '<?= ' ?>$this->render('_form', [
<?= "\t" ?>'<?= $modelVariableName ?>' => $<?= $modelVariableName ?>,
<?= $modelDetail ?>
]) ?>
