<?php
use yii\helpers\Url;
$this->params['title'] = '系统功能管理--列表';
?>

<div class="bs-example">

    <div class="bs-hander">

        <a href="<?= Url::to(['function/list'])?>" type="button" class="btn btn-default active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp; 列 表 </a>
        <a href="<?= Url::to(['function/add'])?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp; 新 增 </a>

        <!--<div class="col-lg-3" style="float: right; padding-right: 0px; padding-left: 8px;">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="搜索">
                  <span class="input-group-btn">
                      <button class="btn btn-primary" type="button">Go!</button>
                  </span>
            </div>
        </div>-->

    </div>

    <div class="bs-center">

        <table class="table table-bordered table-hover">
            <thead>
            <tr class="active">
                <th width="6%">#</th>
                <th width="16%">所属功能组</th>
                <th width="16%">功能名称</th>
                <th width="16%">功能链接</th>
                <th width="6%">状态</th>
                <th width="5%">排序</th>
                <th width="16%">录入时间</th>
                <th width="10%">操作</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($group_list as $key => $val){?>
            <tr class="warning_my">
                <th scope="row" title="<?= $val['id'] ?>"><?= substr($val['id'],-5) ?></th>
                <td><?= $val['fname'] ?></td>
                <td></td>
                <td></td>
                <td>
                    <?php if($val['state'] == 0){
                        echo '<span class="text-success">显示</span>';
                    }else{
                        echo '<span class="text-danger">隐藏</span>';
                    }?>
                </td>
                <td><?= $val['sort'] ?></td>
                <td><?= date('Y-m-d H:i:s',$val['ctime'])?></td>
                <td>
                    <a href="<?= Url::to(['function/up', 'id' => $val['id']]) ?>">编辑</a>
                    <?php if($val['candel'] == 0){?>
                    | <a href="<?= Url::to(['function/delete', 'id' => $val['id']]) ?>" class="delete" _m="确定要删除该功能组？" _d="<?= count($val['funt_list']) ?>">删除</a>
                    <?php }else{echo ' | <span class="text-muted">删除</span>';}?>
                </td>
            </tr>
                <?php foreach($val['funt_list'] as $ke => $vo){?>
                    <tr>
                        <th scope="row" title="<?= $vo['id'] ?>"><?= substr($vo['id'],-5) ?></th>
                        <td></td>
                        <td><?= $vo['fname'] ?></td>
                        <td><a href="<?= Url::to([$vo['furi']]) ?>" target="_blank"><?= $vo['furi'] ?></a></td>
                        <td>
                            <?php if($vo['state'] == 0 && $val['state'] == 0){
                                echo '<span class="text-success">显示</span>';
                            }else{
                                echo '<span class="text-danger">隐藏</span>';
                            }?>
                        </td>
                        <td><?= $vo['sort'] ?></td>
                        <td><?= date('Y-m-d H:i:s',$vo['ctime'])?></td>
                        <td>
                            <a href="<?= Url::to(['function/up', 'id' => $vo['id']]) ?>">编辑</a>
                            <?php if($vo['candel'] == 0){?>
                            | <a href="<?= Url::to(['function/delete', 'id' => $vo['id']]) ?>" class="delete">删除</a>
                            <?php }else{echo ' | <span class="text-muted">删除</span>';}?>
                        </td>
                    </tr>
                <?php }?>
            <?php }?>

            </tbody>
        </table>
    </div>

</div>
