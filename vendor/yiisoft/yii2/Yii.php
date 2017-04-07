<?php
/**
 * Yii bootstrap file.
 *
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

require(__DIR__ . '/BaseYii.php');

/**
 * Yii is a helper class serving common framework functionalities.
 *
 * It extends from [[\yii\BaseYii]] which provides the actual implementation.
 * By writing your own Yii class, you can customize some functionalities of [[\yii\BaseYii]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Yii extends \yii\BaseYii
{
    /**
     * 测试方法
     * @param type $msg 输出信息
     */
    static function echotext($msg=""){
        echo $msg;
    }
    /**
     * 成功提示
     * @param type $msg 提示信息
     * @param type $jumpurl 跳转url
     * @param type $wait 等待时间
     */
    static function mysuccess($msg="",$jumpurl="",$wait=3){
        self::_jump($msg, $jumpurl, $wait, 1);
    }
    /**
     * 错误提示
     * @param type $msg 提示信息
     * @param type $jumpurl 跳转url
     * @param type $wait 等待时间
     */
    static function myerror($msg="",$jumpurl="",$wait=3){
        self::_jump($msg, $jumpurl, $wait, 0);
    }
    /**
     * 最终跳转处理
     * @param type $msg 提示信息
     * @param type $jumpurl 跳转url
     * @param type $wait 等待时间
     * @param int $type 消息类型 0或1
     */
    static private function _jump($msg="",$jumpurl="",$wait=3,$type=0){
        $data = array(
            'msg' => $msg,
            'jumpurl' => $jumpurl,
            'wait' => $wait,
            'type' => $type
        );
        $data['title'] = $type == 1 ? "提示信息" : "错误信息";
        if(empty($jumpurl)){
            if($type==1){
                $data['jumpurl']=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:"javascript:window.close();";
            }else{
                $data['jumpurl'] = "javascript:history.back(-1);";
            }
        }
        $cc = new \yii\base\Controller('show_message','none_model');
        echo $cc->renderPartial("//site/show_message",$data);
        exit;
    }

    /**
     * 获取MongoDb _id 方法
     * @param type $_objectId
     */
    public static function getMongoId($_objectId){
        foreach ($_objectId as $key => $val){
            $mongoID = $val;
        }
        return $mongoID;
    }
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = require(__DIR__ . '/classes.php');
Yii::$container = new yii\di\Container();
