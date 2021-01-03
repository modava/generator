<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$modelClass = StringHelper::basename($generator->modelClass);
$ns = explode('\\', $generator->modelClass)[0];
$alias = $generator->getYiiAlias();

echo "<?php\n";
?>

use <?= $alias ?>widgets\NavbarWidgets;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = Yii::t('<?= $generator->messageCategory ?>', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('<?= $generator->messageCategory ?>', '<?= Inflector::pluralize(Inflector::camel2words($modelClass)) ?>'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid px-xxl-25 px-xl-10">
    <?= "<?=" ?> NavbarWidgets::widget(); ?>

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span
                        class="ion ion-md-apps"></span></span><?= "<?=" ?> Html::encode($this->title) <?= "?>\n" ?>
        </h4>
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
