<?php
use yii\helpers\Url;
$this->params['title'] = '管理员分组管理--编辑';
?>

<div class="bs-example">

    <div class="bs-hander">

        <a href="<?= Url::to(['manager-group/list'])?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp; 列 表 (<?= $count ?>)</a>
        <a href="<?= Url::to(['manager-group/add'])?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp; 新 增 </a>

    </div>

    <div class="bs-center">

        <form id="form1_group" name="form1_group" method="post" action="" class="form-horizontal">
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
            <input name="ManagerGroupInfo[id]" type="hidden" id="id" value="<?= Yii::getMongoId($group_one['_id']) ?>">

            <div class="form-group">
                <label for="fname" class="col-sm-2 control-label">管理组名称</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="ManagerGroupInfo[gname]" id="gname" placeholder="管理组名称" value="<?= $group_one['gname'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="furi" class="col-sm-2 control-label">选择权限</label>
                <div class="col-sm-9">
                    <?php foreach($func_list as $key => $val){?>
                    <div class="checkbox"<?php if($key != 0){echo ' style="margin-top: 15px;"';}?>><strong><?= $val['fname'] ?></strong></div>
                    <div class="checkbox" style="padding-top: 0px;">
                        <?php foreach($val['f_list'] as $vo){?>
                        <label class="checkbox-inline checkboxclick<?php if($newar[$vo['id']] == $vo['id']){echo ' ceboxse';}?>" style="margin-left: 0px; margin-right: 10px;">
                            <span></span>
                            <input type="checkbox" class="jquery_click" name="ManagerGroupInfo[function][]" id="function_<?= $vo['id'] ?>" value="<?= $val['id'] ?>_<?= $vo['id'] ?>"<?php if($newar[$vo['id']] == $vo['id']){echo ' checked';}?>><?= $vo['fname'] ?>
                        </label>
                        <?php }?>
                    </div>
                    <?php }?>
                </div>
            </div>

            <div class="form-group" style="padding-top: 6px;">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary"> 提 交 &nbsp;<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></button>
                </div>
            </div>
        </form>

    </div>

</div>
