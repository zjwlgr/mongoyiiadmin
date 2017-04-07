<?php

namespace app\commands;

use yii\base\Widget;
use yii\helpers\Html;

class MyWidget extends Widget
{
    public $type;
    public $params;

    /*初始化属性*/
    public function init(){
        parent::init();
        if ($this->type === null) {
            $this->type = 'none';
        }
    }

    /*返回渲染结果*/
    public function run(){
        if($this->type == 'clalist'){
            return $this->clalist();
        }

        elseif($this->type == 'none'){
            return false;
        }
    }

    /*后台无限级分类列表可重用部分*/
    public function clalist(){
        return $this->render('@app/views/widget/clalist', [
            'params' => $this->params,
        ]);
    }




}