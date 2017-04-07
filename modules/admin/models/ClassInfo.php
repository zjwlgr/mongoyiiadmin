<?php

namespace app\modules\admin\models;

use Yii;
use yii\mongodb\ActiveRecord;

class ClassInfo extends ActiveRecord{

    public static function collectionName()
    {
        return 'class';
    }

    public static function add($post){
        $one = ClassInfo::one($post['fid']);
        $collection = \Yii::$app->mongodb->getCollection(ClassInfo::collectionName());
        $result = $collection->insert([
            'fid' => $post['fid'],
            'nexus' =>  $one['nexus'].$post['nexus'],
            'depth' => $post['depth'],
            'name' => $post['name'],
            'sort' => 0,
            'ctime' => time()
        ]);
        $post['id'] = Yii::getMongoId($result);
        return $post;
    }

    /*通过ID 查询某一条数据*/
    public static function one($id){
        $ClassInfo = ClassInfo::find()
            ->where(['_id' => $id])
            ->asArray()->one();
        if(!empty($ClassInfo)){
            $ClassInfo['id'] = Yii::getMongoId($ClassInfo['_id']);
        }
        return $ClassInfo;
    }

    /*通过NAME 查询某一条数据 id,fid,name 前台导航选中*/
    public static function name_one($name){
        $ClassInfo = ClassInfo::find()
            ->select(['_id','fid','name'])
            ->where(['name' => $name])
            ->asArray()->one();
        if(!empty($ClassInfo)){
            $ClassInfo['id'] = Yii::getMongoId($ClassInfo['_id']);
        }
        return $ClassInfo;
    }
    
    /*通过ID 查出 分类 名称 name*/
    public static function classnames($id){
        $result = ClassInfo::one($id);
        return $result['name'];
    }

    /*通过 FID 查询一个父下面子分类的集合*/
    public static function lists($fid,$count = false){
        $ClassInfo = ClassInfo::find()
            ->where(['fid' => $fid])
            ->orderBy('sort DESC,_id ASC')
            ->asArray()->all();
        foreach ($ClassInfo as $key => $val){
            $ClassInfo[$key]['id'] = Yii::getMongoId($val['_id']);
        }
        if($count){//是否需要子类 的子类总数
            foreach($ClassInfo as $key => $val){
                $ClassInfo[$key]['count'] = ClassInfo::total($val['id']);
            }
        }
        return $ClassInfo;
    }

    /*通过ID 删除分类与所有级的子分类*/
    public static function deletes($id){
        $ClassInfo = ClassInfo::find()->select(['_id'])
            ->where(['like', 'nexus', $id])->asArray()->all();
        foreach ($ClassInfo as $key => $val){
            ClassInfo::deleteAll(['_id' => Yii::getMongoId($val['_id'])]);
        }
        ClassInfo::deleteAll(['_id' => $id]);
    }

    /*编辑分类信息*/
    public static function updates($post){
        if(!empty($post['name'])) {
            $update['name'] = $post['name'];
        }
        if(!empty($post['sort'])) {
            $update['sort'] = $post['sort'];
        }
        $res = ClassInfo::updateAll(
            $update,
            ['_id' => $post['id']]
        );
        return $res;
    }

    /*通过 FID 查询子分类总数*/
    public static function total($fid){
        $ClassInfo = ClassInfo::find()
            ->where(['fid' => $fid])
            ->count();
        return $ClassInfo;
    }


}