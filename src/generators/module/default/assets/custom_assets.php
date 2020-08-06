<?php
/* @var $generator yii\gii\generators\model\Generator */
$ns = explode('\\', $generator->moduleClass)[0];
?>
<?= "<?php\n" ?>

namespace <?= $ns ?>\<?= $generator->moduleID ?>\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class <?= ucfirst($generator->moduleID) ?>CustomAsset extends AssetBundle
{
    public $sourcePath = '@<?= $generator->moduleID ?>web';
    public $css = [
        'css/custom<?= ucfirst($generator->moduleID) ?>.css',
    ];
    public $js = [
        'js/custom<?= ucfirst($generator->moduleID) ?>.js'
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_END
    );
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
