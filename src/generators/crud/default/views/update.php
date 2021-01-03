<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$modelClass = StringHelper::basename($generator->modelClass);
$columns = $generator->tableSchema->columns;
$ns = explode('\\', $generator->modelClass)[0];
$alias = $generator->getYiiAlias();

echo "<?php\n";
?>

use <?= $alias ?>widgets\NavbarWidgets;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = Yii::t('<?= $generator->messageCategory ?>', 'Update : {name}', [
    'name' => $model-><?= $generator->getNameAttribute() ?>,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('<?= $generator->messageCategory ?>', '<?= Inflector::pluralize(Inflector::camel2words($modelClass)) ?>'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model-><?= $generator->getNameAttribute() ?>, 'url' => ['view', <?= $urlParams ?>]];
$this->params['breadcrumbs'][] = Yii::t('<?= $generator->messageCategory ?>', 'Update');
?>
<div class="container-fluid px-xxl-25 px-xl-10">
    <?= "<?=" ?> NavbarWidgets::widget(); ?>

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                        class="ion ion-md-apps"></span></span><?= "<?=" ?> Html::encode($this->title) <?= "?>\n" ?>
        </h4>
        <a class="btn btn-outline-light" href="<?= "<?=" ?> Url::to(['create']); <?= "?>" ?>"
           title="<?= "<?=" ?> Yii::t('<?= $generator->messageCategory ?>', 'Create'); <?= "?>" ?>">
            <i class="fa fa-plus"></i> <?= "<?=" ?> Yii::t('<?= $generator->messageCategory ?>', 'Create'); <?= "?>" ?></a>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <?= "<?=" ?> $this->render('_form', [
                    'model' => $model,
                ]) <?= "?>\n" ?>

            </section>
        </div>
    </div>
</div>
