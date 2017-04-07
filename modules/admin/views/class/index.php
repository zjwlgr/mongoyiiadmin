<?php
use app\commands\MyWidget;
use yii\helpers\Url;
$this->params['title'] = '系统分类管理';
?>

<div class="bs-example">

    <div class="bs-hander" style="position: relative;">

        <a href="<?= Url::to(['class/index'])?>" class="btn btn-default active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp; 列 表 (<?= $count ?>)</a>

        <div class="col-lg-8" style="position: absolute; top: 17px; left: 120px;">
            <p class="text-danger"><span class="text-muted">提示：删除分类后会同时删除该分类下所有子分类，</span>删除后将不能恢复！</p>
        </div>
    </div>

    <div class="bs-center">
        <span id="class_uri">
            <input type="hidden" id="addclass-u" value="<?= Url::to(['class/add']) ?>">
            <input type="hidden" id="delclass-u" value="<?= Url::to(['class/delete']) ?>">
            <input type="hidden" id="upclass-u" value="<?= Url::to(['class/upclass']) ?>">
            <input type="hidden" id="updclass-u" value="<?= Url::to(['class/updown']) ?>">
        </span>

        <div class="row show-grid top-table">
            <div class="col-md-1">ID</div>
            <div class="col-md-3">名称</div>
            <div class="col-md-1 text-align">排序</div>
            <div class="col-md-1 text-align">子数</div>
            <div class="col-md-1 text-align">操作&nbsp;&nbsp;&nbsp;</div>
        </div>

        <?php foreach($list as $key => $val){
            echo MyWidget::widget(['type' => 'clalist', 'params' => $val]);
        }?>

        <div class="row show-grid">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon iga-img">新增</span>
                    <input type="text" _i="0" _d="0" class="form-control add-new-cla">
                </div>
            </div>
        </div>

    </div>

</div>
