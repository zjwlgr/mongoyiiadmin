<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
$this->params['title'] = '管理员登录日志--列表';
?>

<div class="bs-example">

    <div class="bs-hander">

        <a href="<?= Url::to(['manager-record/list'])?>" type="button" class="btn btn-default active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp; 列 表 (<?= $count ?>)</a>

        <div class="col-lg-3" style="float: right; padding-right: 0px; padding-left: 8px;">
            <form id="form1_search" name="form1_search" method="get" action="">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control" placeholder="管理员用户名/姓名" value="<?= Yii::$app->request->get('search') ?>">
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
                <th width="5%">#</th>
                <th width="10%">管理员用户名</th>
                <th width="9%">姓名</th>
                <th width="10%">登录IP</th>
                <th width="7%">登录次数</th>
                <th width="11%">使用系统</th>
                <th width="11%">使用浏览器</th>
                <th width="15%">登录时间</th>
                <th width="6%">操作</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($list as $key => $val){?>
            <tr>
                <th scope="row" title="<?= $val['id'] ?>"><?= substr($val['id'],-5) ?></th>
                <td><?= $val['username'] ?></td>
                <td><?= $val['uname'] ?></td>
                <td><?= $val['ip'] ?></td>
                <td><?= $val['number'] ?></td>
                <td><?= $val['system'] ?></td>
                <td><?= $val['browser'] ?></td>
                <td><?= date('Y-m-d H:i:s',$val['time']) ?></td>
                <td>
                    <a href="<?= Url::to(['manager-record/delete', 'id' => $val['id']]) ?>" class="delete" >删除</a>
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
