<?php

namespace app\modules\api;

use yii\web\Response;
/**
 * index module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    public $layout = false;
    /*该属性指定渲染 视图 默认使用的布局名字， 默认值为 'main' 对应布局路径下的 main.php 文件， 如果 布局路径 和 视图路径 都是默认值， 默认布局文件可以使用路径别名@app/views/layouts/main.php*/

    public $defaultRoute = 'index';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        \yii\base\Component::on(Response::className(), Response::EVENT_BEFORE_SEND, [$this, 'formatDataBeforeSend']);

        /*$this->components = [
            'response' => [
                'class' => 'yii\web\Response',
                'on beforeSend' => function ($event) {
                    $response = $event->sender;
                    //if ($response->data !== null) {
                        $response->data = [
                            'success' => $response->isSuccessful,
                            'data' => $response->data,
                        ];
                        $response->statusCode = 200;
                    //}
                },
            ],
        ];*/

        // custom initialization code goes here
    }

    public function formatDataBeforeSend($event)
    {
        $response = $event->sender;
        $response->data = [
            'success' => $response->isSuccessful,
            'data' => $response->data,
        ];
        $response->statusCode = 200;
        echo 'ddd';
        return $response;
        // do something
    }
}
