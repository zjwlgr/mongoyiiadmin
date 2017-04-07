<?php

namespace app\modules\admin\models;

use Yii;
use yii\mongodb\ActiveRecord;
use yii\data\Pagination;

class ManagerGroupInfo extends ActiveRecord{

    public static function collectionName()
    {
        return 'managerGroup';
    }

    public static function add($post){
        foreach($post['function'] as $val){
            $newar = explode('_',$val);
            $func_ar[$newar[0]][] = $newar[1];
        }
        $function_json = json_encode($func_ar);

        $collection = \Yii::$app->mongodb->getCollection(ManagerGroupInfo::collectionName());
        $res = $collection->insert([
            'gname' => $post['gname'],
            'function' => $function_json,
            'ctime' => time()
        ]);
        return $res;
    }

    public static function up($post){
        foreach($post['function'] as $val){
            $newar = explode('_',$val);
            $func_ar[$newar[0]][] = $newar[1];
        }
        $function_json = json_encode($func_ar);

        $res = ManagerGroupInfo::updateAll(
            ['gname' => $post['gname'], 'function' => $function_json, 'ctime' => time()],
            ['_id' => $post['id']]
        );
        return $res;
    }

    public static function count(){
        $count = ManagerGroupInfo::find()->count();
        return $count;
    }

    public static function lists($pageSize, $page, $search){
        $query = ManagerGroupInfo::find()
            ->select(['id','gname','function','ctime']);
        if(!empty($search)){
            $query->where(['like', 'gname', $search]);
        }
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize, 'page' => $page-1]);
        $list = $query->orderBy('id ASC')->offset($pagination->offset)
            ->limit($pagination->limit)->asArray()->all();
        foreach ($list as $key => $val){
            $list[$key]['id'] = Yii::getMongoId($val['_id']);
        }
        return ['list' => $list, 'page' => $pagination, 'count' => $count];
    }

    public static function deletes($id){
        $res = ManagerGroupInfo::deleteAll([
            '_id' => $id
        ]);
        return $res;
    }

    public static function group_one($id){
        $ManagerGroupInfo = ManagerGroupInfo::find()
            ->where(['_id' => $id])
            ->asArray()->one();
        return $ManagerGroupInfo;
    }

    public static function select_list(){
        $query = ManagerGroupInfo::find()->select(['_id','gname'])->asArray()->all();
        return $query;
    }







}