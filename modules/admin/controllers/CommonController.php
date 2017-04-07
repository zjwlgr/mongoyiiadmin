<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\modules\admin\models\FunctionInfo;
use app\modules\admin\models\ManagerInfo;
use app\modules\admin\models\ManagerGroupInfo;

class CommonController extends Controller {

    public $manager_session;
    
    public function init() {
        if (\Yii::$app->session->has('manager')){
            $this->manager_session = \Yii::$app->session->get('manager');
            $this->judge();//判断当前管理员对当前URL的权限
            $view = \Yii::$app->getView();//获取当前视图对像
            $view->params['header'] = $this->header();//session值传到布局
            $view->params['group_list'] = $this->left();//左侧功能列表
        }else{
            \Yii::$app->response->redirect(Url::to(['/admin/login/index']), 301)->send();
            exit;
        }
        //print_r($this->manager_session);
    }

    public function header(){
        $manager_session = $this->manager_session;
        $manager_session['group_id'] = empty($manager_session['group_id']) ? 0 : $manager_session['group_id'];
        $group = ManagerGroupInfo::group_one($manager_session['group_id']);
        $manager_session['group_name'] = $group['gname'];
        return $manager_session;
    }

    public function left(){
        $user = $this->manager_session;
        $manager = ManagerInfo::manager_one($user['id']);

        if($manager['group_id'] == '58e24718db76ac85090041a7'){//超级管理员功能列表

            $group_list = FunctionInfo::group_list(true);
            foreach($group_list as $key => $val){
                $funt_list = FunctionInfo::funt_list($val['id'],true);
                $group_list[$key]['funt_list'] = $funt_list;
            }

        }else{//权限管理员功能列表

            $group = ManagerGroupInfo::group_one($manager['group_id']);
            $function_ar = json_decode($group['function'],true);
            foreach($function_ar as $key => $val){
                $key_ar[] = $key;
                foreach($val as $ke => $va){
                    $val_ar[] = $va;
                }
            }
            //$key_str @ 父功能ID
            //$val_str @ 子功能ID
            $group_list = FunctionInfo::group_list(true,$key_ar);
            foreach($group_list as $key => $val){
                $funt_list = FunctionInfo::funt_list($val['id'],true,$val_ar);
                $group_list[$key]['funt_list'] = $funt_list;
            }

        }

        return $group_list;
    }

    /*判断非超级管理员是否有权限操作当前页面*/
    public function judge(){
        $user = $this->manager_session;
        $manager = ManagerInfo::manager_one($user['id']);
        if($manager['group_id'] == '58e24718db76ac85090041a7') {
            //超级管理员无需检查
        }else{
            $url = Yii::$app->request->url;
            if($url != '/admin/index/default.html') {//系统信息首页 所有用户默认可查看
                $url = str_replace('/admin/', '', $url);
                $url = str_replace('.html', '', $url);//得到功能uri 例：function/list
                $furi = FunctionInfo::furi($url);//查询功能列表中对应记录
                if (empty($furi)) {
                    //查询结果为空暂不处理
                } else {
                    $group = ManagerGroupInfo::group_one($manager['group_id']);
                    $function_ar = json_decode($group['function'], true);

                    foreach ($function_ar as $key => $val) {
                        foreach ($val as $ke => $va) {
                            $val_ar[] = $va;
                        }
                    }
                    if (in_array($furi['id'], $val_ar)) {//如果功能ID存在当前管理员用户组中 无操作
                    } else {
                        throw new \yii\web\NotFoundHttpException('您没有该页面的操作权限！');
                    }
                }
            }
        }
    }

    /*左侧功能列表 ajax 搜索功能*/
    public function actionAjaxleft(){
        $search = Yii::$app->request->post('search');
        $result = FunctionInfo::search($search);//搜索子功能
        foreach($result as $key => $val){
            $funtid[] = $val['id'];
        }
        if(!empty($funtid)){//如果搜索结果不为空
            //$funtid @ 得到子功能ID，ID
            $parendid = FunctionInfo::parentid($funtid);
            foreach($parendid as $key => $val){
                $parid[] = $val['fid'];
            }
            //$parid @ 得到父功能ID，ID
            $group_list = FunctionInfo::group_list(true,$parid);
            foreach($group_list as $key => $val){
                $funt_list = FunctionInfo::funt_list($val['id'],true,$funtid);
                $group_list[$key]['funt_list'] = $funt_list;
            }
        }else{
            $group_list = array();
        }
        return $this->renderPartial('/function/ajaxleft',['group_list' => $group_list, 'search'  => $search]);
    }

}
