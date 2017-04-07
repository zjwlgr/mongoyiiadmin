<?php

namespace app\modules\mobile;

/**
 * index module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\mobile\controllers';

    public $layout = 'main';

    public $defaultRoute = 'index';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
