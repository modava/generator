<?php
/* @var $generator yii\gii\generators\model\Generator */
$ns = explode('\\', $generator->moduleClass)[0];
?>
<?= "<?php" ?>

use <?= $ns ?>\<?= $generator->moduleID ?>\<?= ucfirst($generator->moduleID) ?>Module;

return [
    'availableLocales' => [
        'vi' => 'Tiếng Việt',
        'en' => 'English',
        'jp' => 'Japan',
    ],
    '<?= $generator->moduleID ?>Name' => '<?= ucfirst($generator->moduleID) ?>',
    '<?= $generator->moduleID ?>Version' => '1.0',
    'status' => [
        '0' => <?= ucfirst($generator->moduleID) ?>Module::t('<?= $generator->moduleID ?>', 'Tạm ngưng'),
        '1' => <?= ucfirst($generator->moduleID) ?>Module::t('<?= $generator->moduleID ?>', 'Hiển thị'),
    ]
];
