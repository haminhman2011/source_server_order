<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
$modelVariableName   = Inflector::variablize(StringHelper::basename( $generator->modelClass ));
$urlParams = $generator->generateUrlParams();
$updateText = $generator->defaultLanguage == 'vi' ? 'Cập nhật ' : 'Update ';

echo "<?php\n";
?>

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $<?= $modelVariableName ?> <?= ltrim($generator->modelClass, '\\') ?> */
<?php if ($generator->enableI18N): ?>
$this->title = Yii::t('yii', 'Update {model}', ['model' => mb_convert_case(Yii::t('yii', '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>'), MB_CASE_LOWER, 'UTF-8')]) . ': ' . $<?= $modelVariableName ?>-><?= $generator->getNameAttribute() ?>;
<?php else: ?>
$this->title = <?= $generator->generateString($updateText . '{modelClass}: ', ['modelClass' => Inflector::camel2words(StringHelper::basename($generator->modelClass))]) ?> . $<?= $modelVariableName ?>-><?= $generator->getNameAttribute() ?>;
<?php endif ?>
<?php if ($generator->enableI18N): ?>
$this->params['breadcrumbs'][] = ['label' => '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>']), 'url' => ['<?= $modelVariableName ?>/']];
<?php else: ?>
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, 'url' => ['<?= $modelVariableName ?>/']];
<?php endif ?>
$this->params['breadcrumbs'][] = ['label' => $<?= $modelVariableName ?>-><?= $generator->getNameAttribute() ?>, 'url' => ['view', <?= $urlParams ?>]];
$this->params['breadcrumbs'][] = <?= $generator->generateString('Update') ?>;
?>
<?php if ($generator->isModal): ?>
<div class="modal-header">
    <button class="bootbox-close-button close" aria-hidden="true" data-dismiss="modal" type="button" style="margin-top: -10px;">×</button>
    <h1><?= '<?= ' ?>Html::encode($this->title) ?></h1>
</div>
<div class="modal-body">
    <?= '<?= ' ?>$this->render('_form', [
        '<?= $modelVariableName ?>' => $<?= $modelVariableName ?>
    ]) ?>
</div>
<?php else: ?>
<h1><?= '<?= ' ?>Html::encode($this->title) ?></h1>

<?= '<?= ' ?>$this->render('_form', [
    '<?= $modelVariableName ?>' => $<?= $modelVariableName ?>
]) ?>
<?php endif ?>
