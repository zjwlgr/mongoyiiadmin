<?php
namespace app\assets;

use yii\web\AssetBundle;

class JqueryCookieAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'public/js/jquery.cookie.js',
    ];
    public $depends = [
        'app\assets\JqueryAsset'
    ];
}
