<?php

namespace app\modules\api\controllers;
use app\modules\api\models\Article;
use yii\web\HttpException;

class ArticleController extends CommonController {

    //提定对应的model，可以自动生成一系列常用动作: index, view, create, update, delete, options;
    public $modelClass = 'app\modules\api\models\Article';

    //返回错误：throw new HttpException(200, '缺少参数');

    public function actionReid() {
        $result = Article::lists();
        $datas = [
            'list' => $result,
        ];
        //throw new HttpException(200, '缺少参数');
        return $this->ren($datas);
    }

    public function actionAdds() {

        return $this->ren($_POST);
    }

}
