<?php

namespace app\modules\admin\models;

use Yii;
use yii\mongodb\Query;
use yii\mongodb\ActiveRecord;
use yii\data\Pagination;

class ManagerRecordInfo extends ActiveRecord{

    public static function collectionName()
    {
        return 'managerRecord';
    }

    /*添加管理员登录信息，ip，时间，浏览器，系统*/
    public static function add($array){
        $collection = \Yii::$app->mongodb->getCollection(ManagerRecordInfo::collectionName());
        $res = $collection->insert([
            'user_id' => Yii::getMongoId($array['_id']),
            'username' => $array['username'],
            'uname' => $array['uname'],
            'ip' => \Yii::$app->request->userIP,
            'time' => time(),
            'browser' => \Yii::$app->myhelper->determinebrowser(),
            'system' => \Yii::$app->myhelper->determineplatform(),
        ]);
        return $res;
    }

    /*管理员登录日志-列表*/
    public static function record_list($pageSize, $page, $search){
        $query = new Query ();
        $query->select(['id', 'user_id', 'username', 'uname', 'ip', 'time', 'browser', 'system'])->from(ManagerRecordInfo::collectionName());
        if(!empty($search)){
            $query->where(['like', 'username', $search])
                ->orWhere(['like', 'uname', $search]);
        }
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize, 'page' => $page-1]);
        $query->offset($pagination->offset)->limit($pagination->limit);
        $list = $query->orderBy('_id DESC')->all();
        foreach ($list as $key => $val){
            $list[$key]['id'] = Yii::getMongoId($val['_id']);
            $list[$key]['number'] = ManagerRecordInfo::find()->where(['user_id' => $val['user_id']])->count();
        }
        return ['list' => $list, 'page' => $pagination, 'count' => $count];
    }

    /*根据ID删除*/
    public static function deletes($id){
        $res = ManagerRecordInfo::deleteAll([
            '_id' => $id
        ]);
        return $res;
    }

    /*根据user_id删除*/
    /*public static function deletes_user($user_id){
        $res = ManagerRecordInfo::deleteAll([
            'user_id' => $user_id
        ]);
        return $res;
    }*/


}