<?php
/**
 * This is the template for generating the model class of a specified table.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\model\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $queryClassName string query class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */

echo "<?php\n";
?>

namespace <?= $generator->ns ?>\base;
use Yii;
use yii\db\ActiveRecord;
<?php
$hasQuery = false;
if ( $queryClassName ) {
$hasQuery = true;
$queryClassFullName = ( $generator->ns === $generator->queryNs ) ? $queryClassName : '\\' . $generator->queryNs . '\\' . $queryClassName;
echo 'use ' . ltrim($queryClassFullName, '\\') . ';';
}
if ($generator->enableI18N) {
echo 'use Yii;';
}
?>

<?php
$hasDone = [ ];
foreach ( $relations as $name => $relation ) {
    if ( ! in_array( $relation[1], $hasDone ) ) {
        echo "use $generator->ns\\$relation[1];\n";
    }
    $hasDone[] = $relation[1];
}
?>


/**
* This is the model class for table "<?= $generator->generateTableName($tableName) ?>".
*
<?php foreach ($tableSchema->columns as $column): ?>
* @property <?= "{$column->phpType} \${$column->name}\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
*
<?php foreach ($relations as $name => $relation): ?>
* @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
<?php endforeach; ?>
<?php endif; ?>
*/
class <?= $className ?>Base extends ActiveRecord {
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return '<?= $generator->generateTableName( $tableName ) ?>';
    }
<?php if ( $generator->db !== 'db' ): ?>

    /**
    * @return \yii\db\Connection the database connection used by this AR class.
    */
    public static function getDb()
    {
        return Yii::$app->get('<?= $generator->db ?>');
    }
<?php endif; ?>

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [<?= "\n            " . implode(",\n            ", $rules) . "\n        " ?>];
    }

<?php foreach ( $relations as $name => $relation ): ?>

    /**
    * @return \yii\db\ActiveQuery
    */
    public function get<?= $name ?>()
    {
        <?= $relation[0] . "\n" ?>
    }
<?php endforeach; ?>
<?php if ( $hasQuery ): ?>
    /**
    * @inheritdoc
    * @return <?= $queryClassName ?> the active query used by this AR class.
    */
    public static function find()
    {
        return new <?= $queryClassName ?>(get_called_class());
    }
<?php endif; ?>
}
