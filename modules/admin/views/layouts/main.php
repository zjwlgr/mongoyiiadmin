<?php
use yii\helpers\Url;
use app\assets\AdminbaseAsset;
use app\assets\JqueryCookieAsset;
use app\assets\ArtdialogAsset;
JqueryCookieAsset::register($this);
ArtdialogAsset::register($this);
AdminbaseAsset::register($this);

$maintitle = \Yii::$app->params['backtitle'].'--'.$this->params['title'];
$this->title = $maintitle;
$maintitle_ar = explode("--",$maintitle);
$this->params['keywords'] = '';
$this->params['description'] = '';

$this->beginContent('@app/views/layouts/base.php');
?>

<header id="header" class="navbar">
    <div class="container-fluid">
        <div class="navbar-brand">
            <span class="glyphicon glyphicon-menu-left glyphicon-pos"></span>
            <?=\Yii::$app->params['backtitle']?>
            <span class="glyphicon glyphicon-menu-right glyphicon-pos"></span>
        </div>
        <ul id="navbar-left" class="nav navbar-nav pull-left">
            <li class="dropdown">
                <a class="dropdown-toggle" href="<?= Url::to(['index/default'])?>">
                    <span class="glyphicon glyphicon-list-alt glyphicon-pos-2"></span>
                    <span class="name">系统信息查看</span>
                </a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="/" target="_blank">
                    <span class="glyphicon glyphicon-home glyphicon-pos-2"></span>
                    <span class="name">网站首页</span>
                </a>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-right">
            <li id="header-user" class="dropdown">
                <a class="dropdown-toggle" href="">
                    <span class="glyphicon glyphicon-user glyphicon-pos-2"></span>
                    <?= $this->params['header']['group_name'] ?> [ <span class="username"><?= $this->params['header']['uname'] ?></span> ]
                </a>
            </li>
            <li id="header-message" class="dropdown">
                <a class="dropdown-toggle" href="<?= Url::to(['manager/editpwd'])?>">
                    <span class="glyphicon glyphicon-ok-circle glyphicon-pos-2"></span>
                    修改密码
                </a>
            </li>
            <li id="header-tasks" class="dropdown">
                <a class="dropdown-toggle" href="<?= Url::to(['login/loginout']) ?>">
                    <span class="glyphicon glyphicon-remove-circle glyphicon-pos-2"></span>
                    安全退出
                </a>
            </li>
        </ul>
    </div>
</header>

<section id="page">

    <div class="sidebar" id="sidebar">
        <div class="sidebar-menu">
            <div class="divide-10"></div>
            <div id="search-bar">
                <input class="search" id="left_search" type="text" placeholder="搜索">
                <input type="hidden" id="left_hidden_url" value="<?= Url::to(['common/ajaxleft'])?>">
                <input type="hidden" id="left_hidden_search" value="">
                <input type="hidden" id="left_hidden" value="">
                <span id="search_loader" class="glyphicon glyphicon-search search-icon"><img src="/public/image/loaders/16.gif" style="display: none;" /> </span>
            </div>

            <ul id="left_ajax">

                <?php $group_list = $this->params['group_list'];
                foreach($group_list as $val){?>
                <li class="has-sub">
                    <a href="javascript:void(0);" class="offsite" id="has_<?= $val['id'] ?>">
                        <i class="glyphicon glyphicon-th-large"></i>
                        <span class="menu-text"><?= $val['fname'] ?></span>
                        <span class="glyphicon glyphicon-triangle-left arrow"></span>
                    </a>
                    <ul class="sub">
                        <?php foreach($val['funt_list'] as $vo){?>
                        <li><a href="<?= Url::to([$vo['furi']])?>"><?= $vo['fname'] ?></a></li>
                        <?php }?>
                    </ul>
                </li>
                <?php }?>

            </ul>

            <div class="divide-20"></div>
        </div>
    </div>

    <div id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div id="content" class="col-lg-12">

                    <div class="row_hander">
                        <ol class="breadcrumb backbread">
                            <span class="glyphicon glyphicon-log-out myglyphicon"></span>
                            <?php foreach($maintitle_ar as $val){?>
                            <li class="active"><?= $val ?></li>
                            <?php }?>
                        </ol>
                    </div>

                    <div class="row_main-content">

                        <?= $content ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

</section>

<footer class="bs-footer">
    Copyright © 2016-<?=date('Y')?> by <?=\Yii::$app->params['webname']?> <a href="http://<?=\Yii::$app->params['weburl']?>" target="_blank"><?=\Yii::$app->params['weburl']?></a>  All Rights Reserved. version <?=\Yii::$app->version?>
</footer>

<?php $this->endContent(); ?>