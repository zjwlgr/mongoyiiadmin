<?php
namespace app\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/bootstrap/css/bootstrap.css'
    ];
    public $js = [
        'public/bootstrap/js/bootstrap.js',
    ];
    public $depends = [
        'app\assets\JqueryAsset'
    ];
}
