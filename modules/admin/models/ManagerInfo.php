<?php

namespace app\modules\admin\models;

use yii;
use yii\mongodb\Query;
use yii\mongodb\ActiveRecord;
use yii\data\Pagination;

class ManagerInfo extends ActiveRecord{

    public static function collectionName()
    {
        return 'manager';
    }

    public function login($username){
        $query = new Query ();
        $row = $query->select(['_id', 'username', 'password', 'uname', 'number', 'group_id', 'locking'])
            ->from(ManagerInfo::collectionName())
            ->where(['username' => $username])
            ->one();
        return $row;
    }

    /*更新manager表管理员的，登录次数，登录IP，登录时间*/
    public function number($id,$number){
        $res = ManagerInfo::updateAll(
            ['number' => $number + 1, 'login_ip' => \Yii::$app->request->userIP, 'login_time' => time()],
            ['_id' => $id]
        );
        return $res;
    }

    /*查询当前模块表数据总数*/
    public static function count(){
        $count = ManagerInfo::find()->count();
        return $count;
    }

    public static function manager_list($pageSize, $page, $search, $group_id){
        $query = ManagerInfo::find()
            ->select(['id','username','uname','group_id','locking','number','login_ip','login_time','ctime']);
        if(!empty($group_id)) {
            $query->where(['group_id' => $group_id]);
        }
        if(!empty($search)){
            $query->andWhere(['or', ['like', 'username', $search], ['like', 'uname', $search]]);
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

    public static function check_username($username){
        $ManagerInfo = ManagerInfo::find()
            ->where(['username' => $username]);
        $query = $ManagerInfo->count();
        return $query;
    }

    public static function add($post){
        $check_user = ManagerInfo::check_username($post['username']);
        if($check_user <= 0) {
            $collection = \Yii::$app->mongodb->getCollection(ManagerInfo::collectionName());
            $result = $collection->insert([
                'username' => $post['username'],
                'password' =>  md5($post['password']),
                'uname'    => $post['uname'],
                'group_id' => $post['group_id'],
                'locking'  => $post['locking'],
                'number'   => 0,
                'login_ip' => '0.0.0.0',
                'login_time' => '',
                'ctime'    => time()
            ]);
        }else{
            $result = false;
        }
        return $result;
    }

    public static function up($post){
        $check_user = ManagerInfo::check_username($post['username']);
        if($check_user <= 1) {
            $updatearray = [
                'username' => $post['username'],
                'password' => md5($post['password']),
                'uname'    => $post['uname'],
                'group_id' => $post['group_id'],
                'locking'  => $post['locking']
            ];
            if (empty($post['password'])) {
                unset($updatearray['password']);
            }
            $result = ManagerInfo::updateAll(
                $updatearray,
                ['_id' => $post['id']]
            );
        }else{
            $result = false;
        }
        return $result;
    }

    public static function editpwd($post){
        $ManagerInfo = ManagerInfo::find()
            ->where(['_id' => $post['id'], 'password' => md5($post['oldpassword'])])
            ->asArray()->one();
        if(!empty($ManagerInfo)) {
            $result = ManagerInfo::updateAll(
                ['password' => md5($post['password'])],
                ['_id' => $post['id']]
            );
        }else{
            $result = false;
        }
        return $result;
    }

    public static function manager_one($id){
        $ManagerInfo = ManagerInfo::find()
            ->where(['_id' => $id])
            ->asArray()->one();
        return $ManagerInfo;
    }

    public static function deletes($id){
        $res = ManagerInfo::deleteAll([
            '_id' => $id
        ]);
        //ManagerRecordInfo::deletes_user($id);
        return $res;
    }

}