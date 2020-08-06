<?php
/* @var $generator yii\gii\generators\model\Generator */
$ns = explode('\\', $generator->moduleClass)[0];
?>
<?= "<?php" ?>

namespace <?= $ns ?>\<?= $generator->moduleID ?>\components;

use <?= $ns ?>\imagick\Imagick;
use yii\base\Component;

class MyUpload extends Component
{
    public static function upload($width, $height, $pathImage, $pathSave)
    {
        $imagick = new Imagick($pathImage, true);
        return $imagick->resizeImage($width, $height)->saveTo($pathSave);
    }
}
