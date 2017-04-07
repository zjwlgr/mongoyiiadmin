<?php

namespace yii\helpers;

/*主要用于 模板中所需 函数*/
class MyHelper
{
    /*测试方法  \yii\helpers\MyHelper::merge(1,2); */
    public static function merge($a, $b)
    {
        echo $a.$b;
    }

    /*字符串截取*/
    public static function truncate_utf8_string($string, $length, $etc = '...') {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++) {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0')) {
                if ($length < 1.0) {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            } else {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen) {
            $result .= $etc;
        }
        return $result;
    }

    /*去掉所有空格*/
    public static function trimall($str){
        $qian=array("&nbsp;"," ","　","\t","\n","\r");$hou=array("","","","","","");
        return str_replace($qian,$hou,$str);
    }

    /*后台按分类查看设置选中状态*/
    public static function v_v($is1,$is2){
        if($is2 === 0){
            if(isset($is1) && $is2 == $is1){
                return 'text-info';
            }else {
                return 'text-muted';
            }
        }else {
            if ($is1 == $is2) {
                return 'text-info';
            } else {
                return 'text-muted';
            }
        }
    }

}