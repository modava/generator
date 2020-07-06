<?php
/* @var $generator yii\gii\generators\crud\Generator */

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

$modelClass = StringHelper::basename($generator->modelClass);
$ns = explode('\\', $generator->modelClass)[0];

echo "<?php";
?>

use yii\helpers\Url;
use <?= $ns ?>\<?= $generator->messageCategory ?>\<?= ucfirst($generator->messageCategory) ?>Module;

?>
<ul class="nav nav-tabs nav-sm nav-light mb-25">
    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left<?="<?php" ?> if (Yii::$app->controller->id == '<?= Inflector::camel2id($modelClass, '-', true) ?>') echo ' active' ?>"
           href="<?= "<?=" ?> Url::toRoute(['/<?= $generator->messageCategory ?>/<?= Inflector::camel2id($modelClass, '-', true) ?>']); ?>">
            <i class="ion ion-ios-locate"></i><?= "<?=" ?> <?= ucfirst($generator->messageCategory) ?>Module::t('<?= $generator->messageCategory ?>', '<?= ucwords(Inflector::camel2id($modelClass, ' ', true)) ?>'); ?>
        </a>
    </li>
</ul>
