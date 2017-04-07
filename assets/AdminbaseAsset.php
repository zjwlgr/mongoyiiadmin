<?php
namespace app\assets;

use yii\web\AssetBundle;

class AdminbaseAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/css/admin_style.css',
    ];
    public $js = [
        'public/js/admin_script.js'
    ];
    public $depends = [
        'app\assets\BootstrapAsset',
    ];
}
