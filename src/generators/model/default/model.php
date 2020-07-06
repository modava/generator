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

use yii\helpers\StringHelper;
use yii\helpers\Inflector;

$modelClass = StringHelper::basename($generator->modelClass);

echo "<?php\n"; ?>

namespace <?= $generator->ns ?>;

use common\helpers\MyHelper;
use common\models\User;
use <?= str_replace('\models', '', $generator->ns) ?>\<?= ucfirst($generator->messageCategory) ?>Module;
use <?= $generator->ns ?>\table\<?= $modelClass ?>Table;
<?php if (isset($tableSchema->columns['created_by']) && isset($tableSchema->columns['updated_by'])) { ?>
use yii\behaviors\BlameableBehavior;
<?php } ?>
<?php if (isset($tableSchema->columns['slug'])) { ?>
use yii\behaviors\SluggableBehavior;
<?php } ?>
<?php if (isset($tableSchema->columns['title']) && isset($tableSchema->columns['slug'])) { ?>
use common\helpers\MyHelper;
<?php } ?>
use yii\db\ActiveRecord;
use Yii;

/**
* This is the model class for table "<?= $generator->generateTableName($tableName) ?>".
*
<?php foreach ($properties as $property => $data): ?>
    * @property <?= "{$data['type']} \${$property}" . ($data['comment'] ? ' ' . strtr($data['comment'], ["\n" => ' ']) : '') . "\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
    *
    <?php foreach ($relations as $name => $relation): ?>
        * @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
    <?php endforeach; ?>
<?php endif; ?>
*/
class <?= $className ?> extends <?= $className ?>Table
{
    public $toastr_key = '<?= Inflector::camel2id($className, '-', true) ?>';
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
<?php if (isset($tableSchema->columns['slug'])) { ?>
                'slug' => [
                    'class' => SluggableBehavior::class,
                    'immutable' => false,
                    'ensureUnique' => true,
                    'value' => function () {
                        return MyHelper::createAlias($this-><?= isset($tableSchema->columns['title']) ? 'title' : (isset($tableSchema->columns['name']) ? 'name': 'id') ?>);
                    }
                ],
<?php } ?>
<?php if (isset($tableSchema->columns['created_by']) && isset($tableSchema->columns['updated_by'])) { ?>
                [
                    'class' => BlameableBehavior::class,
                    'createdByAttribute' => 'created_by',
                    'updatedByAttribute' => 'updated_by',
                ],
<?php } ?>
<?php if (isset($tableSchema->columns['created_at']) && isset($tableSchema->columns['updated_at'])) { ?>
                'timestamp' => [
                    'class' => 'yii\behaviors\TimestampBehavior',
                    'preserveNonEmptyValues' => true,
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    ],
                ],
<?php } ?>
            ]
        );
    }

    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [<?= empty($rules) ? '' : ("\n\t\t\t" . implode(",\n\t\t\t", $rules) . ",\n\t\t") ?>];
    }

    /**
    * {@inheritdoc}
    */
    public function attributeLabels()
    {
        return [
<?php foreach ($labels as $name => $label): ?>
            <?= "'$name' => " . $generator->generateString($label) . ",\n" ?>
<?php endforeach; ?>
        ];
    }

<?php if(isset($tableSchema->columns['created_by'])){ ?>
    /**
    * Gets query for [[User]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getUserCreated()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }
<?php } ?>

<?php if(isset($tableSchema->columns['updated_by'])){ ?>
    /**
    * Gets query for [[User]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getUserUpdated()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
<?php } ?>
}
