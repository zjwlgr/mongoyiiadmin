<?php
namespace app\assets;

use yii\web\AssetBundle;

class IndexbaseAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/css/index_style.css?v=1',
    ];
    public $js = [
        'public/js/index_script.js?v=1'
    ];
    public $depends = [
        'app\assets\BootstrapAsset',
    ];
}
