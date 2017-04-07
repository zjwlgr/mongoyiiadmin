<?php
namespace app\assets;

use yii\web\AssetBundle;

class FocusimgAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'public/js/forimage.js',
    ];
    public $depends = [
        'app\assets\JqueryAsset'
    ];
}
