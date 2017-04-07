<?php

namespace app\modules\index;

/**
 * index module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\index\controllers';

    public $layout = 'main';

    public $defaultRoute = 'index';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $ismobile = \Yii::$app->myhelper->ismobile();
        if($ismobile){
            header('Location: http://m.form1.cn');
            exit;
        }
        // custom initialization code goes here
    }
}
