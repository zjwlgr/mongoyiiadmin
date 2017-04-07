<?php
namespace app\assets;

use yii\web\AssetBundle;

class JqueryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'public/js/jquery-1.9.1.min.js',
    ];
}
