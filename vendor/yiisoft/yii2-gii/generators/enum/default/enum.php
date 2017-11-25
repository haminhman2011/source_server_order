<?php

use common\utils\helpers\Inflector;
use common\utils\helpers\StringHelper;

echo "<?php\n";
/* @var $generator yii\gii\generators\model\Generator */
$index = $generator->index;
$properties = StringHelper::explode($generator->properties);
?>

namespace <?= $generator->ns ?>;
use common\utils\enum\BaseEnum;

class <?= $generator->enumName ?> extends BaseEnum
{
<?php foreach ($properties as $key => $property): ?>
    const <?= strtoupper(Inflector::underscore(Inflector::camelize($property))) ?> = <?= (int) $index ?>;
<?php $index++; endforeach; ?>

    public static $list = [
<?php $index = $generator->index;
foreach ($properties as $key => $property): ?>
        <?= $index ?> => <?= '\'' . Inflector::humanize($property) . '\',' . "\n" ?>
<?php $index++; endforeach; ?>
    ];
}
