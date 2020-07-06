<?php
/**
 * This is the template for generating the ActiveQuery class.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\model\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */
/* @var $className string class name */
/* @var $modelClassName string related model class name */

$modelFullClassName = $modelClassName;
if ($generator->ns !== $generator->queryNs) {
    $modelFullClassName = '\\' . $generator->ns . '\\' . $modelFullClassName;
}

echo "<?php\n";
?>

namespace <?= $generator->queryNs . '\\query' ?>;

use <?= $generator->queryNs . '\\' . $modelFullClassName ?>;

/**
 * This is the ActiveQuery class for [[<?= $modelFullClassName ?>]].
 *
 * @see <?= $modelFullClassName . "\n" ?>
 */
class <?= $className ?>Query extends <?= '\\' . ltrim($generator->queryBaseClass, '\\') . "\n" ?>
{
<?php if (isset($tableSchema->columns['status'])) { ?>
    public function published()
    {
        return $this->andWhere([<?= $modelFullClassName ?>::tableName() . '.status' => <?= $modelFullClassName ?>::STATUS_PUBLISHED]);
    }

    public function disabled()
    {
        return $this->andWhere([<?= $modelFullClassName ?>::tableName() . '.status' => <?= $modelFullClassName ?>::STATUS_DISABLED]);
    }
<?php } ?>

    public function sortDescById()
    {
        return $this->orderBy([<?= $modelFullClassName ?>::tableName() . '.id' => SORT_DESC]);
    }
}
