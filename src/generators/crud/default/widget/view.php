<?php
/* @var $generator yii\gii\generators\crud\Generator */

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

$modelClass = StringHelper::basename($generator->modelClass);
$contollerClass = str_replace('Controller', '', StringHelper::basename($generator->controllerClass));
$ns = explode('\\', $generator->modelClass)[0];
$alias = $generator->getYiiAlias();

echo "<?php";
?>

use Yii;
use yii\helpers\Url;

?>
<ul class="nav nav-tabs nav-sm nav-light mb-10">
    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left<?="<?php" ?> if (Yii::$app->controller->id == '<?= Inflector::camel2id($modelClass, '-', true) ?>') echo ' active' ?>"
           href="<?= "<?=" ?> Url::toRoute(['/<?= strtolower(StringHelper::basename($alias)) ?>/<?= Inflector::camel2id($contollerClass, '-', true) ?>']); ?>">
            <i class="ion ion-ios-locate"></i><?= "<?=" ?> Yii::t('<?= $generator->messageCategory ?>', '<?= ucwords(Inflector::camel2id($modelClass, ' ', true)) ?>'); ?>
        </a>
    </li>
</ul>
