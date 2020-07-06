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
class <?= ucfirst($generator->moduleID) ?>Asset extends AssetBundle
{
    public $sourcePath = '@<?= $generator->moduleID ?>web';
    public $css = [
        'vendors/datatables.net-dt/css/jquery.dataTables.min.css',
        'vendors/bootstrap/dist/css/bootstrap.min.css',
        'vendors/jquery-toggles/css/toggles.css',
        'vendors/jquery-toggles/css/themes/toggles-light.css',
        'css/custom<?= ucfirst($generator->moduleID) ?>.css',
    ];
    public $js = [
        "vendors/popper.js/dist/umd/popper.min.js",
        "vendors/bootstrap/dist/js/bootstrap.min.js",
        "vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js",
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
