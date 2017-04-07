<?php

namespace app\modules\admin\models;

use Yii;
use yii\mongodb\ActiveRecord;

class FunctionInfo extends ActiveRecord{

    public static function collectionName()
    {
        return 'function';
    }

    /*添加功能组 或 功能*/
    public static function add($post){
        $collection = \Yii::$app->mongodb->getCollection(FunctionInfo::collectionName());
        if($post['fid'] == '0'){//新增功能组
            $res = $collection->insert([
                'fid' => $post['fid'],
                'fname' => $post['fidname'],
                'furi' => 'none',
                'sort' => '0',
                'candel' => '0',
                'state' => '0',
                'ctime' => time()
            ]);
            $post['fid'] = Yii::getMongoId($res);
        }
        $res = $collection->insert([
            'fid' => $post['fid'],
            'fname' => $post['fname'],
            'furi' => $post['furi'],
            'sort' => '0',
            'candel' => '0',
            'state' => '0',
            'ctime' => time()
        ]);
        return $res;
    }

    /*查询功能组列表 添加 页面中用到*/
    public static function group_list($state = false,$idin = false){
        $query = FunctionInfo::find()
            ->select(['_id','fname','sort','candel','state','ctime'])
            ->where(['fid' => '0']);
            if($state){
                $query->andWhere(['state' => '0']);
            }
            if(!empty($idin)){
                $query->andWhere(['in', '_id', $idin]);
            }
            $list = $query->orderBy('sort ASC')->asArray()->all();
        foreach ($list as $key => $val){
            $list[$key]['id'] = Yii::getMongoId($val['_id']);
        }
        return $list;
    }

    /*管理页面列表*/
    public static function funt_list($fid,$state = false,$idin = false){
        $query = FunctionInfo::find()
            ->select(['_id','fid','fname','furi','sort','candel','state','ctime'])
            ->where(['fid' => $fid]);
            if($state){
                $query->andWhere(['state' => '0']);
            }
            if(!empty($idin)){
                $query->andWhere(['in', '_id', $idin]);
            }
            $list = $query->orderBy('sort ASC')->asArray()->all();
        foreach ($list as $key => $val){
            $list[$key]['id'] = Yii::getMongoId($val['_id']);
        }
        return $list;
    }

    /*根据ID查询一条数据*/
    public static function funt_one($id){
        $function = FunctionInfo::find()
            ->where(['_id' => $id])
            ->asArray()->one();
        return $function;
    }

    /*根据FURI查询一条数据*/
    public static function furi($url){
        $function = FunctionInfo::find()
            ->select(['_id','furi'])
            ->where(['furi' => $url])
            ->asArray()->one();
        if(!empty($function)) {
            $function['id'] = Yii::getMongoId($function['_id']);
        }
        return $function;
    }

    /*编辑功能或功能组*/
    public static function up($post){
        $res = FunctionInfo::updateAll(
            [
                'fid' => isset($post['fid']) ? $post['fid'] : '0',
                'fname' => $post['fname'],
                'furi' => $post['furi'],
                'sort' => $post['sort'],
                'state' => $post['state']
            ],
            ['_id' => $post['id']]
        );
        return $res;
    }

    /*删除功能组或功能*/
    public static function deletes($id){
        $funt_one = FunctionInfo::funt_one($id);
        if($funt_one['candel'] == '0') {
            FunctionInfo::deleteAll([
                '_id' => $id
            ]);
        }
    }

    /*搜索子功能（fid<>0 为子功能） 根据关键字*/
    public static function search($keyword){
        $function = FunctionInfo::find()
            ->select(['_id'])
            ->where(['<>', 'fid', '0'])
            ->andWhere(['like', 'fname', $keyword])
            ->asArray()->all();
        foreach ($function as $key => $val){
            $function[$key]['id'] = Yii::getMongoId($val['_id']);
        }
        return $function;
    }

    /*通过子功能ID，查询父功能ID，ID*/
    public static function parentid($childid){
        $function = FunctionInfo::find()
            ->select(['fid'])
            ->where(['in', '_id', $childid])
            ->asArray()->all();
        return $function;
    }


}