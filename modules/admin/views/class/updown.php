<?php
use app\commands\MyWidget;

foreach($list as $key => $val){
    echo MyWidget::widget(['type' => 'clalist', 'params' => $val]);
}?>

<div class="row show-grid">
    <div class="col-md-1"></div>
    <div class="col-md-4" style="margin-left: <?=45*$one['depth']?>px;">
        <div class="input-group input-group-sm">
            <span class="input-group-addon iga-img">新增</span>
            <input type="text" _i="<?= $one['id'] ?>" _d="<?= $one['depth'] ?>" class="form-control add-new-cla">
        </div>
    </div>
</div>
