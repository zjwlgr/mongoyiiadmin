<?php
namespace app\assets;

use yii\web\AssetBundle;

class ArtdialogAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'public/artDialog/artDialog.js?skin=opera',
    ];
    public $depends = [
        'app\assets\JqueryAsset'
    ];
}
