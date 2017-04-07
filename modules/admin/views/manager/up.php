<?php
use yii\helpers\Url;
$this->params['title'] = '管理员管理--编辑';
?>

<div class="bs-example">

    <div class="bs-hander">

        <a href="<?= Url::to(['manager/list'])?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp; 列 表 (<?= $count ?>)</a>
        <a href="<?= Url::to(['manager/add'])?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp; 新 增 </a>


    </div>

    <div class="bs-center">

        <form id="form1_manager" name="form1_manager" method="post" action="" class="form-horizontal">
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
            <input name="ManagerInfo[id]" type="hidden" id="id" value="<?= Yii::getMongoId($one['_id']) ?>">

            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">用户组</label>
                <div class="col-sm-5">
                    <div class="dropdown" style="float: left;">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                            <span id="text">
                                <?php foreach($select_list as $val){
                                    if(Yii::getMongoId($val['_id']) == $one['group_id']){
                                        echo $val['gname'];
                                        break;
                                    }
                                }?>
                            </span>
                            <span class="caret"></span>
                        </button>
                        <?php if($one['id'] == 1){}else{?>
                        <ul class="dropdown-menu" id="dropdownMenuone" role="menu" aria-labelledby="dropdownMenu1">
                            <?php foreach($select_list as $val){?>
                                <li role="presentation"><a href="#" _i="<?= Yii::getMongoId($val['_id']) ?>"><?= $val['gname'] ?></a></li>
                            <?php }?>
                        </ul>
                        <?php }?>
                        <input type="hidden" name="ManagerInfo[group_id]" id="group_id" value="<?= $one['group_id'] ?>" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="ManagerInfo[username]" id="username" placeholder="用户名" value="<?= $one['username'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">密码</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" name="ManagerInfo[password]" id="password" placeholder="密码，不修改请保持为空">
                </div>
            </div>
            <div class="form-group">
                <label for="repassword" class="col-sm-2 control-label">确认密码</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" name="ManagerInfo[repassword]" id="repassword" placeholder="确认密码">
                </div>
            </div>
            <div class="form-group">
                <label for="uname" class="col-sm-2 control-label">姓名</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="ManagerInfo[uname]" id="uname" placeholder="姓名" value="<?= $one['uname'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="locking" class="col-sm-2 control-label">状态</label>
                <div class="col-sm-2">
                    <div class="radio">
                        <label>
                            <input type="radio" name="ManagerInfo[locking]" <?php echo $one['locking'] == 0 ? 'checked' : ''; ?> value="0"> 正常 &nbsp;
                        </label>
                        <label>
                            <input type="radio" name="ManagerInfo[locking]" <?php echo $one['locking'] == 1 ? 'checked' : ''; ?> value="1"> 锁定
                        </label>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary"> 提 交 &nbsp;<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></button>
                </div>
            </div>
        </form>

    </div>

</div>
