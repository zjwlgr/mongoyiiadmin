<?php
use yii\helpers\Url;
use app\assets\AdminbaseAsset;
use app\assets\ArtdialogAsset;
AdminbaseAsset::register($this);
ArtdialogAsset::register($this);
$this->title = \Yii::$app->params['backtitle'].'入口 - Login';
$this->params['keywords'] = '';
$this->params['description'] = '';
?>
<style type="text/css">
    body{background: #5E87B0;}
</style>
<div class="container">

    <div class="login">
        <h3 class="form-title"><?=\Yii::$app->params['backtitle']?>入口<small>&nbsp;Login</small></h3>
        <form id="form1_login" name="form1_login" method="post" action="">
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <div class="form-group">
            <label for="username">用户名</label>
            <input type="text" class="form-control" name="ManagerInfo[username]" id="username" placeholder="username">
        </div>
        <div class="form-group">
            <label for="password">密码</label>
            <input type="password" class="form-control" name="ManagerInfo[password]" id="password" placeholder="password">
        </div>
        <div class="form-group">
            <label for="validate">验证码</label>
            <div class="row show-grid">
                <div class="col-md-5">
                        <input type="text" class="form-control validate" name="ManagerInfo[validates]" id="validates" placeholder="validate">
                </div>
                <div class="col-md-7">
                    <img class="image" src="<?= Url::to(['captcha']);?>" onclick="this.src='<?= Url::to(['captcha']);?>?r='+Math.random();">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id="loading">
            提&nbsp;交 <i class="glyphicon glyphicon-circle-arrow-right glyphicon_top_left"></i>
        </button>
        </form>
        <div class="create-account">
            <p>Copyright © 2016-<?=date('Y')?> by <?=\Yii::$app->params['webname']?> <a href="http://<?=\Yii::$app->params['weburl']?>" target="_blank"><?=\Yii::$app->params['weburl']?></a><br /> All Rights Reserved. version <?=\Yii::$app->version?></p>
        </div>
    </div>

</div>