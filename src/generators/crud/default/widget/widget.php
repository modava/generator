<?php
/* @var $generator yii\gii\generators\crud\Generator */
$ns = explode('\\', $generator->modelClass)[0];
echo "<?php";
?>

namespace <?= $ns ?>\<?= $generator->messageCategory ?>\widgets;

class NavbarWidgets extends \yii\base\Widget
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        if(CONSOLE_HOST == 1)
            return $this->render('navbarWidgets', []);
        else
            return '';
    }
}