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
/* @var $properties array list of properties (property => [type, name. comment]) */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */

$columns = $tableSchema->columns;

echo "<?php\n";
?>

namespace <?= $generator->ns ?>\table;

use backend\components\MyModel;
use cheatsheet\Time;
<?php if(isset($columns['status'])) { ?>
use <?= $generator->ns ?>\query\<?= $className ?>Query;
<?php } ?>
use Yii;
use yii\db\ActiveRecord;

class <?= $className ?>Table extends MyModel
{
<?php if(isset($columns['status'])) { ?>
    const STATUS_DISABLED = 0;
    const STATUS_PUBLISHED = 1;

<?php } ?>
    public static function tableName()
    {
        return '<?= $generator->generateTableName($tableName) ?>';
    }

<?php if(isset($columns['status'])) { ?>
    public static function find()
    {
        return new <?= $className ?>Query(get_called_class());
    }
<?php } ?>

    public function afterDelete()
    {
        $cache = Yii::$app->cache;
        $keys = [];
        foreach ($keys as $key) {
            $cache->delete($key);
        }
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        $cache = Yii::$app->cache;
        $keys = [];
        foreach ($keys as $key) {
            $cache->delete($key);
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}
