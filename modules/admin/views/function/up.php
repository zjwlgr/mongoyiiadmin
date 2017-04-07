<?php
use yii\helpers\Url;
$this->params['title'] = '系统功能管理--编辑';
?>

<div class="bs-example">

    <div class="bs-hander">
        <a href="<?= Url::to(['function/list'])?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp; 列 表 </a>
        <a href="<?= Url::to(['function/add'])?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp; 新 增 </a>
    </div>

    <div class="bs-center">
        <form id="form1_function" name="form1_function" method="post" action="" class="form-horizontal">
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
            <input name="FunctionInfo[id]" type="hidden"  value="<?= Yii::getMongoId($funt_one['_id']) ?>">
            <?php if($funt_one['fid'] == 0){?>
                <input type="hidden" name="FunctionInfo[furi]" id="furi" value="<?= $funt_one['furi'] ?>">
            <div class="form-group">
                <label for="fname" class="col-sm-2 control-label">功能组名称</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="FunctionInfo[fname]" id="fname" placeholder="功能名称" value="<?= $funt_one['fname'] ?>">
                </div>
            </div>

            <?php }else{?>

                <div class="form-group">
                    <label class="col-sm-2 control-label">功能组</label>
                    <div class="col-sm-5">

                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span id="text">
                                    <?php foreach($group_list as $val){
                                        if($val['id'] == $funt_one['fid']){
                                            echo $val['fname'];
                                            break;
                                        }
                                    }?>
                                </span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="dropdownMenuone" aria-labelledby="dropdownMenu1">
                                <?php foreach($group_list as $val){?>
                                    <li><a href="#" _i="<?= $val['id'] ?>"><?= $val['fname'] ?></a></li>
                                <?php }?>
                            </ul>
                            <input type="hidden" name="FunctionInfo[fid]" id="fid" value="<?= $funt_one['fid'] ?>" />
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label for="fname" class="col-sm-2 control-label">功能名称</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="FunctionInfo[fname]" id="fname" placeholder="功能名称" value="<?= $funt_one['fname'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="furi" class="col-sm-2 control-label">功能链接</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="FunctionInfo[furi]" id="furi" placeholder="功能链接" value="<?= $funt_one['furi'] ?>">
                    </div>
                </div>

            <?php }?>

            <div class="form-group">
                <label for="furi" class="col-sm-2 control-label">排序</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="FunctionInfo[sort]" id="sort" placeholder="排序" value="<?= $funt_one['sort'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="furi" class="col-sm-2 control-label">状态</label>
                <div class="col-sm-2">
                    <div class="radio">
                        <label>
                            <input type="radio" <?php echo $funt_one['state'] == 0 ? 'checked' : ''; ?> name="FunctionInfo[state]" value="0"> 显示 &nbsp;
                        </label>
                        <label>
                            <input type="radio" <?php echo $funt_one['state'] == 1 ? 'checked' : ''; ?> name="FunctionInfo[state]" value="1"> 隐藏
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
