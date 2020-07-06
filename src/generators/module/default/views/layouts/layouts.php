<?php
/* @var $generator yii\gii\generators\model\Generator */
$ns = explode('\\', $generator->moduleClass)[0];
?>
<?= "<?php" ?>

\<?= $ns ?>\<?= $generator->moduleID ?>\assets\<?= ucfirst($generator->moduleID) ?>Asset::register($this);
?>
<?= "<?php" ?> $this->beginContent('@backend/views/layouts/main.php'); ?>
<?= "<?php" ?> echo $content ?>
<?= "<?php" ?> $this->endContent(); ?>
