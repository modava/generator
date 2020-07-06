<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$modelClass = StringHelper::basename($generator->modelClass);
$ns = explode('\\', $generator->modelClass)[0];

echo "<?php\n";
?>

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\ToastrWidget;
use <?= $ns ?>\<?= $generator->messageCategory ?>\widgets\NavbarWidgets;
use <?= $ns ?>\<?= $generator->messageCategory ?>\<?= ucfirst($generator->messageCategory) ?>Module;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', '<?= Inflector::pluralize(Inflector::camel2words($modelClass)) ?>'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= "<?=" ?> ToastrWidget::widget(['key' => 'toastr-' . $model->toastr_key . '-view']) ?>
<div class="container-fluid px-xxl-25 px-xl-10">
    <?= "<?=" ?> NavbarWidgets::widget(); ?>

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                        class="ion ion-md-apps"></span></span><?= "<?=" ?> Html::encode($this->title) ?>
        </h4>
        <p>
            <a class="btn btn-outline-light" href="<?= "<?=" ?> Url::to(['create']); ?>"
                title="<?= "<?=" ?> <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Create'); <?= "?>" ?>">
                <i class="fa fa-plus"></i> <?= "<?=" ?> <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Create'); <?= "?>" ?></a>
            <?= "<?=" ?> Html::a(<?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) <?= "?>\n" ?>
            <?= "<?=" ?> Html::a(<?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Are you sure you want to delete this item?'),
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
                                return Yii::$app->getModule('<?= $generator->messageCategory ?>')->params['status'][$model->status];
                            }
                        ],
<?php
                                        break;
                                    case 'language':
                        ?>
                        [
                            'attribute' => 'language',
                            'value' => function ($model) {
                                return Yii::$app->getModule('<?= $generator->messageCategory ?>')->params['availableLocales'][$model->language];
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
                            'label' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Created By')
                        ],
                        [
                            'attribute' => 'userUpdated.userProfile.fullname',
                            'label' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Updated By')
                        ],
                    ],
                ]) ?>
            </section>
        </div>
    </div>
</div>
