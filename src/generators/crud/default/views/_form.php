<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}
$columns = $generator->tableSchema->columns;
$ns = explode('\\', $generator->modelClass)[0];

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\widgets\ToastrWidget;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>
<?= "<?=" ?> ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-form']) ?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">
    <?= "<?php " ?>$form = ActiveForm::begin(); ?>
<?php foreach ($generator->getColumnNames() as $attribute) {
        if (in_array($attribute, $safeAttributes)) {
            echo "\t\t<?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
        }
    } ?>
<?php if(isset($columns['status'])){ ?>
<?= "\t\t<?php " ?>if (Yii::$app->controller->action->id == 'create') $model->status = 1; ?>
<?= "\t\t<?= " ?>$form->field($model, 'status')->checkbox() ?>
<?php } ?>
        <div class="form-group">
            <?= "<?=" ?> Html::submitButton(Yii::t('<?= $generator->messageCategory ?>', 'Save'), ['class' => 'btn btn-sm btn-success']) ?>
        </div>

    <?= "<?php" ?> ActiveForm::end(); ?>
</div>
