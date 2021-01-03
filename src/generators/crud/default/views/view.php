<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$modelClass = StringHelper::basename($generator->modelClass);
$ns = explode('\\', $generator->modelClass)[0];
$alias = $generator->getYiiAlias();

echo "<?php\n";
?>

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\ToastrWidget;
use <?= $alias ?>widgets\NavbarWidgets;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => Yii::t('<?= $generator->messageCategory ?>', '<?= Inflector::pluralize(Inflector::camel2words($modelClass)) ?>'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= "<?=" ?> ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-view']) ?>
<div class="container-fluid px-xxl-25 px-xl-10">
    <?= "<?=" ?> NavbarWidgets::widget(); ?>

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                        class="ion ion-md-apps"></span></span><?= "<?=" ?>Yii::t('<?= $generator->messageCategory ?>', 'Chi tiết'); ?>: <?= "<?=" ?> Html::encode($this->title) ?>
        </h4>
        <p>
            <a class="btn btn-sm btn-outline-light" href="<?= "<?=" ?> Url::to(['create']); ?>"
                title="<?= "<?=" ?> Yii::t('<?= $generator->messageCategory ?>', 'Create'); <?= "?>" ?>">
                <i class="fa fa-plus"></i> <?= "<?=" ?> Yii::t('<?= $generator->messageCategory ?>', 'Create'); <?= "?>" ?></a>
            <?= "<?=" ?> Html::a(Yii::t('<?= $generator->messageCategory ?>', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) <?= "?>\n" ?>
            <?= "<?=" ?> Html::a(Yii::t('<?= $generator->messageCategory ?>', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-sm',
                'data' => [
                    'confirm' => Yii::t('<?= $generator->messageCategory ?>', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) <?= "?>\n" ?>
        </p>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <?= "<?= " ?>DetailView::widget([
                    'model' => $model,
                    'attributes' => [
<?php
                        if (($tableSchema = $generator->getTableSchema()) === false) {
                            foreach ($generator->getColumnNames() as $name) {
                                if(in_array($name, ['created_by', 'updated_by'])) {
                                    continue;
                                }
                                if($name == 'status'){
                                    echo '[
                                        \'attribute\' => \'status\',
                                        \'value\' => function ($model) {
                                            return Yii::$app->getModule(\''.$generator->messageCategory.'\')->params[\'status\'][$model->status];
                                        }
                                    ],';
                                }
                                echo "\t\t\t\t\t\t'" . $name . "',\n";
                            }
                        } else {
                            foreach ($generator->getTableSchema()->columns as $column) {
                                $name = $column->name;
                                if(in_array($name, ['created_by', 'updated_by'])) {
                                    continue;
                                }
                                switch ($name){
                                    case 'status':
                                        ?>
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                return Yii::$app->params['status'][$model->status];
                            }
                        ],
<?php
                                        break;
                                    case 'language':
                        ?>
                        [
                            'attribute' => 'language',
                            'value' => function ($model) {
                                if($model->language == null)
                                    return null;
                                return Yii::$app->params['availableLocales'][$model->language];
                            },
                        ],
<?php
                                        break;
                                    default:
                                        $format = $generator->generateColumnFormat($column);
                                        echo "\t\t\t\t\t\t'" . $name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                        ;
                                }
                            }
                        }
                        ?>
                        [
                            'attribute' => 'userCreated.userProfile.fullname',
                            'label' => Yii::t('<?= $generator->messageCategory ?>', 'Created By')
                        ],
                        [
                            'attribute' => 'userUpdated.userProfile.fullname',
                            'label' => Yii::t('<?= $generator->messageCategory ?>', 'Updated By')
                        ],
                    ],
                ]) ?>
            </section>
        </div>
    </div>
</div>
