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
    public static function uploadFromOnline($width, $height, $pathImage, $pathSave, $fileName = null)
    {
        $imagick = new Imagick($pathImage, true);
        if ($fileName != null) {
            $imagick->filename = $fileName;
        }
        return $imagick->resizeImage($width, $height)->saveTo($pathSave);
    }

    public static function uploadFromLocal($width, $height, $pathImage, $pathSave, $fileName = null)
    {
        $imagick = new Imagick($pathImage);
        if ($fileName != null) {
            $imagick->filename = $fileName;
        }
        return $imagick->resizeImage($width, $height)->saveTo($pathSave);
    }
}
