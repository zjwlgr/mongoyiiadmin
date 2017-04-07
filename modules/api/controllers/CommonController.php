<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;
use yii\web\HttpException;

class CommonController extends ActiveController {

    public function init() {
        $Token = \Yii::$app->request->get('token');
        //echo sha1(md5(date("YmdHi").'*q&2$d@6!b'));exit;

        $params = urldecode(file_get_contents("php://input"));
        $postToken = json_decode($params , true);
        if(!empty($postToken)){$Token = $postToken['token'];}

        $result = $this->checkToken($Token);
        if($result === false){
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;//json格式输出
            throw new HttpException(403, 'token Validation failed');
        }
    }

    public function checkToken($sign){
        $str = '*q&2$d@6!b';
        $new_sign = sha1(md5(date("YmdHi").$str));
        $new_sign2 = sha1(md5(date('YmdHi',strtotime('-1 minute')).$str));
        $new_sign3 = sha1(md5(date('YmdHi',strtotime('+1 minute')).$str));
        if($new_sign == $sign || $new_sign2 == $sign || $new_sign3 == $sign){
            return true;
        }else{
            return false;
        }
    }

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = \yii\web\Response::FORMAT_JSON;
        return $behaviors;
    }

    public function ren($data = [],$message = 'success',$code = 200){
        $response = [
            'message' => $message,
            'status' => $code,
            'data' => $data,
        ];
        \Yii::$app->response->statusCode = 200;
        return $response;
    }

}
