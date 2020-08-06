<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace modava\generators\module;

use yii\gii\CodeFile;
use yii\helpers\Html;
use Yii;
use yii\helpers\StringHelper;

/**
 * This generator will generate the skeleton code needed by a module.
 *
 * @property string $controllerNamespace The controller namespace of the module. This property is read-only.
 * @property bool $modulePath The directory that contains the module class. This property is read-only.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Generator extends \yii\gii\Generator
{
    public $moduleClass;
    public $moduleID;


    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Module Generator';
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return 'This generator helps you to generate the skeleton code needed by a Yii module.';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['moduleID', 'moduleClass'], 'filter', 'filter' => 'trim'],
            [['moduleID', 'moduleClass'], 'required'],
            [['moduleID'], 'match', 'pattern' => '/^[\w\\-]+$/', 'message' => 'Only word characters and dashes are allowed.'],
            [['moduleClass'], 'match', 'pattern' => '/^[\w\\\\]*$/', 'message' => 'Only word characters and backslashes are allowed.'],
            [['moduleClass'], 'validateModuleClass'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'moduleID' => 'Module ID',
            'moduleClass' => 'Module Class',
        ];
    }

    /**
     * @inheritdoc
     */
    public function hints()
    {
        return [
            'moduleID' => 'This refers to the ID of the module, e.g., <code>admin</code>.',
            'moduleClass' => 'This is the fully qualified class name of the module, e.g., <code>app\modules\admin\Module</code>.',
        ];
    }

    /**
     * @inheritdoc
     */
    public function successMessage()
    {
        if (Yii::$app->hasModule($this->moduleID)) {
            $link = Html::a('try it now', Yii::$app->getUrlManager()->createUrl($this->moduleID), ['target' => '_blank']);

            return "The module has been generated successfully. You may $link.";
        }

        $output = <<<EOD
<p>The module has been generated successfully.</p>
<p>To access the module, you need to add this to your application configuration:</p>
EOD;
        $code = <<<EOD
<?php
    ......
    'modules' => [
        '{$this->moduleID}' => [
            'class' => '{$this->moduleClass}',
        ],
    ],
    ......
EOD;

        return $output . '<pre>' . highlight_string($code, true) . '</pre>';
    }

    /**
     * @inheritdoc
     */
    public function requiredTemplates()
    {
        return [
            'assets/assets.php',
            'assets/custom_assets.php',
            'components/controller.php',
            'components/errorHandler.php',
            'components/upload.php',
            'config/.htaccess',
            'config/_urlManager.php',
            'config/option.php',
            'config/params.php',
            'controllers/index.html',
            'messages/en/en.php',
            'messages/vi/vi.php',
            'migration/index.html',
            'views/error/error.php',
            'views/layouts/layouts.php',
            'web/css/style.css',
            'web/js/script.js',
            'widgets/views/index.html',
            'module.php',
        ];
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        $files = [];
        $modulePath = $this->getModulePath();
        $params = [
            'moduleClass' => StringHelper::basename($this->moduleClass),
            'moduleID' => $this->moduleID
        ];
        $files[] = new CodeFile(
            $modulePath . '/assets/' . ucfirst($this->moduleID) . 'Asset.php',
            $this->render("assets/assets.php", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/assets/' . ucfirst($this->moduleID) . 'CustomAsset.php',
            $this->render("assets/custom_assets.php", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/components/My' . ucfirst($this->moduleID) . 'Controller.php',
            $this->render("components/controller.php", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/components/MyErrorHandler.php',
            $this->render("components/errorHandler.php", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/components/MyUpload.php',
            $this->render("components/upload.php", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/config/.htaccess',
            $this->render("config/.htaccess", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/config/_urlManager.php',
            $this->render("config/_urlManager.php", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/config/' . $this->moduleID . '.php',
            $this->render("config/option.php", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/config/params.php',
            $this->render("config/params.php", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/controllers/index.html',
            $this->render("controllers/index.html", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/messages/en/' . $this->moduleID . '.php',
            $this->render("messages/en/en.php", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/messages/vi/' . $this->moduleID . '.php',
            $this->render("messages/vi/vi.php", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/migration/index.html',
            $this->render("migration/index.html", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/views/error/error.php',
            $this->render("views/error/error.php", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/views/layouts/' . $this->moduleID . '.php',
            $this->render("views/layouts/layouts.php", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/web/css/custom' . ucfirst($this->moduleID) . '.css',
            $this->render("web/css/style.css", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/web/js/custom' . ucfirst($this->moduleID) . '.js',
            $this->render("web/js/script.js", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/widgets/views/index.html',
            $this->render("widgets/views/index.html", $params)
        );
        $files[] = new CodeFile(
            $modulePath . '/' . StringHelper::basename($this->moduleClass) . '.php',
            $this->render("module.php", $params)
        );

        return $files;
    }

    /**
     * Validates [[moduleClass]] to make sure it is a fully qualified class name.
     */
    public function validateModuleClass()
    {
        if (strpos($this->moduleClass, '\\') === false || Yii::getAlias('@' . str_replace('\\', '/', $this->moduleClass), false) === false) {
            $this->addError('moduleClass', 'Module class must be properly namespaced.');
        }
        if(ucfirst(strtolower(substr($this->moduleClass, strlen($this->moduleClass) - 6, strlen($this->moduleClass)))) !== 'Module'){
            $this->addError('moduleClass', 'Module class must end with string "Module".');
        }
        if (empty($this->moduleClass) || substr_compare($this->moduleClass, '\\', -1, 1) === 0) {
            $this->addError('moduleClass', 'Module class name must not be empty. Please enter a fully qualified class name. e.g. "app\\modules\\admin\\Module".');
        }
    }

    /**
     * @return bool the directory that contains the module class
     */
    public function getModulePath()
    {
        return Yii::getAlias('@' . str_replace('\\', '/', substr($this->moduleClass, 0, strrpos($this->moduleClass, '\\'))));
    }

    /**
     * @return string the controller namespace of the module.
     */
    public function getControllerNamespace()
    {
        return substr($this->moduleClass, 0, strrpos($this->moduleClass, '\\')) . '\controllers';
    }
}
