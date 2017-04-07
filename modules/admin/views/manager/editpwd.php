<?php
use yii\helpers\Url;
$this->params['title'] = '修改密码';
?>

<div class="bs-example">

    <div class="bs-hander">

        <a href="<?= Url::to(['manager/editpwd'])?>" type="button" class="btn btn-default active"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp; 修改密码</a>

    </div>

    <div class="bs-center">

        <form id="form1_editpwd" name="form1_editpwd" method="post" action="" class="form-horizontal">
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
            <input name="ManagerInfo[id]" id="id" type="hidden"  value="<?= $id ?>">

            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">旧密码</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" name="ManagerInfo[oldpassword]" id="oldpassword" placeholder="旧密码">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">新密码</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" name="ManagerInfo[password]" id="password" placeholder="新密码">
                </div>
            </div>
            <div class="form-group">
                <label for="repassword" class="col-sm-2 control-label">确认新密码</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" name="ManagerInfo[repassword]" id="repassword" placeholder="确认新密码">
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
