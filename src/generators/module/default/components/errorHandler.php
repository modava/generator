<?php
/* @var $generator yii\gii\generators\model\Generator */
$ns = explode('\\', $generator->moduleClass)[0];
?>
<?= "<?php" ?>

namespace <?= $ns ?>\<?= $generator->moduleID ?>\components;

class MyErrorHandler extends \yii\web\ErrorHandler
{
    public $errorView = '@<?= $ns ?>/<?= $generator->moduleID ?>/views/error/error.php';

}
