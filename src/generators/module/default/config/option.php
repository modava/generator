<?php
/* @var $generator yii\gii\generators\model\Generator */
$ns = explode('\\', $generator->moduleClass)[0];
?>
<?= "<?php" ?>

use <?= $ns ?>\<?= $generator->moduleID ?>\components\MyErrorHandler;

$config = [
    'defaultRoute' => '<?= $generator->moduleID ?>/index',
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'aliases' => [
        '@<?= $generator->moduleID ?>web' => '@<?= $ns ?>/<?= $generator->moduleID ?>/web',
    ],
    'components' => [
        'errorHandler' => [
            'class' => MyErrorHandler::class,
        ],
    ],
    'params' => require __DIR__ . '/params.php',
];

return $config;
