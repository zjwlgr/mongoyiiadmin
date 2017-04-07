<?php
use yii\helpers\Url;
$this->params['title'] = '系统功能管理--新增';
?>

<div class="bs-example">

    <div class="bs-hander">
        <a href="<?= Url::to(['function/list'])?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp; 列 表 </a>
        <a href="<?= Url::to(['function/add'])?>" type="button" class="btn btn-default active"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp; 新 增 </a>
    </div>

    <div class="bs-center">
        <form id="form1_function" name="form1_function" method="post" action="" class="form-horizontal">
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">功能组</label>
                <div class="col-sm-5">

                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="text">选择组</span> <span class="caret"></span></button>
                            <ul class="dropdown-menu" id="function_group">
                                <li><a href="#" _i="0">増加功能组</a></li>
                                <li role="separator" class="divider"></li>
                                <?php foreach($group_list as $val){?>
                                <li><a href="#" _i="<?= $val['id'] ?>"><?= $val['fname'] ?></a></li>
                                <?php }?>
                            </ul>
                        </div>
                        <input type="hidden" name="FunctionInfo[fid]" id="fid" value="0" />
                        <input type="text" class="form-control" name="FunctionInfo[fidname]" id="fidname" placeholder="功能组名称" disabled />
                    </div>

                </div>
            </div>
            <div class="form-group">
                <label for="fname" class="col-sm-2 control-label">功能名称</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="FunctionInfo[fname]" id="fname" placeholder="功能名称">
                </div>
            </div>
            <div class="form-group">
                <label for="furi" class="col-sm-2 control-label">功能链接</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="FunctionInfo[furi]" id="furi" placeholder="功能链接">
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
