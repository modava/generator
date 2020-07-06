<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$modelClass = StringHelper::basename($generator->modelClass);
$ns = explode('\\', $generator->modelClass)[0];

echo "<?php\n";
?>

use <?= $ns ?>\<?= $generator->messageCategory ?>\widgets\NavbarWidgets;
use yii\helpers\Html;
use <?= $ns ?>\<?= $generator->messageCategory ?>\<?= ucfirst($generator->messageCategory) ?>Module;


/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', 'Create');
$this->params['breadcrumbs'][] = ['label' => <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', '<?= Inflector::pluralize(Inflector::camel2words($modelClass)) ?>'), 'url' => ['index']];
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
