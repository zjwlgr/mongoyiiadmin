<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
$this->params['title'] = '管理员分组管理--列表';
?>

<div class="bs-example">

    <div class="bs-hander">

        <a href="<?= Url::to(['manager-group/list'])?>" type="button" class="btn btn-default active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp; 列 表 (<?= $count ?>)</a>
        <a href="<?= Url::to(['manager-group/add'])?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp; 新 增 </a>

        <div class="col-lg-3" style="float: right; padding-right: 0px; padding-left: 8px;">
            <form id="form1_search" name="form1_search" method="get" action="">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control" placeholder="管理组名称" value="<?= Yii::$app->request->get('search') ?>">
                  <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">Go!</button>
                  </span>
            </div>
            </form>
        </div>

    </div>

    <div class="bs-center">

        <table class="table table-bordered table-hover">
            <thead>
            <tr class="active">
                <th width="4%">#</th>
                <th width="40%">管理组名称</th>
                <th width="12%">录入时间</th>
                <th width="8%">操作</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($list as $key => $val){?>
            <tr>
                <th scope="row" title="<?= $val['id'] ?>"><?= substr($val['id'],-5) ?></th>
                <td><?= $val['gname'] ?></td>
                <td>
                    <?= date('Y-m-d H:i:s',$val['ctime']) ?>
                </td>
                <td>
                    <?php if($val['function'] == 'CJ'){
                        echo '<span class="text-muted">编辑 | 删除</span>';
                    }else{?>
                        <a href="<?= Url::to(['manager-group/up', 'id' => $val['id']]) ?>">编辑</a> |
                        <a href="<?= Url::to(['manager-group/delete', 'id' => $val['id']]) ?>" class="delete" >删除</a>
                    <?php }?>
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
