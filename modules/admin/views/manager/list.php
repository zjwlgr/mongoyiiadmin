<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
$this->params['title'] = '管理员管理--列表';
?>

<div class="bs-example">

    <div class="bs-hander">

        <a href="<?= Url::to(['manager/list'])?>" type="button" class="btn btn-default active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp; 列 表 (<?= $count ?>)</a>
        <a href="<?= Url::to(['manager/add'])?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp; 新 增 </a>

        <div class="col-lg-3" style="float: right; padding-right: 0px; padding-left: 8px;">
            <form id="form1_search" name="form1_search" method="get" action="">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control" placeholder="用户名/姓名" value="<?= Yii::$app->request->get('search') ?>">
                  <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">Go!</button>
                  </span>
            </div>
            </form>
        </div>

        <div class="dropdown" style="float: right;">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                <?php
                $sgstr = '选择分组查看';
                foreach($select_list as $val){
                    if(Yii::getMongoId($val['_id']) == Yii::$app->request->get('groupid')){
                        $sgstr = $val['gname'];
                        break;
                    }
                }
                echo $sgstr;
                ?>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <?php foreach($select_list as $val){?>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= Url::to(['manager/list', 'groupid' => Yii::getMongoId($val['_id'])]) ?>"><?= $val['gname'] ?></a></li>
                <?php }?>
            </ul>
        </div>

    </div>

    <div class="bs-center">

        <table class="table table-bordered table-hover">
            <thead>
            <tr class="active">
                <th width="5%">#</th>
                <th width="10%">用户名</th>
                <th width="9%">姓名</th>
                <th width="11%">用户组</th>
                <th width="6%">状态</th>
                <th width="7%">登录次数</th>
                <th width="10%">最后登录IP</th>
                <th width="15%">最后登录时间</th>
                <th width="8%">操作</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($list as $key => $val){?>
            <tr>
                <th scope="row" title="<?= $val['id'] ?>"><?= substr($val['id'],-5) ?></th>
                <td><?= $val['username'] ?></td>
                <td><?= $val['uname'] ?></td>
                <td>
                    <?php if($val['group_id'] == '58e24718db76ac85090041a7'){echo '<strong>'.$val['groupname'].'</strong>';}else{?>
                    <a href="<?= Url::to(['manager-group/up', 'id' => $val['group_id']]) ?>"><?= $val['groupname'] ?></a>
                    <?php }?>
                </td>
                <td><?php
                    if($val['locking'] == 0){
                        echo '<span class="text-success">正常</span>';
                    }else{
                        echo '<span class="text-danger">锁定</span>';
                    }
                    ?></td>
                <td><?= $val['number'] ?></td>
                <td><?= $val['login_ip'] ?></td>
                <td>
                    <?php if($val['login_time'] == 0){
                        echo '0000-00-00 00:00:00';
                    }else{
                        echo date('Y-m-d H:i:s',$val['login_time']);
                    } ?>
                    <span style="cursor: pointer;" class="glyphicon glyphicon-circle-arrow-right" data-toggle="tooltip" data-placement="bottom" title="录入时间：<?= date('Y-m-d H:i:s',$val['ctime']) ?>"></span>
                </td>
                <td>
                    <a href="<?= Url::to(['manager/up', 'id' => $val['id']]) ?>">编辑</a> |
                    <?php if($val['id'] != '58e248e9db76ac86090041a7'){?>
                        <a href="<?= Url::to(['manager/delete', 'id' => $val['id']]) ?>" class="delete" >删除</a>
                    <?php }else{echo ' <span class="text-muted">删除</span>';}?>
                </td>
            </tr>
            <?php }?>

            </tbody>
        </table>

        <?php if($count == 0){?>
            <div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-info-sign glyphicon-pos-2"></span> 暂无信息！</div>
        <?php }?>

        <?php
        echo LinkPager::widget([
            'pagination' => $page,
        ]);
        ?>
    </div>

</div>
