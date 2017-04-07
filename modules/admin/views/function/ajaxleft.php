<?php
use yii\helpers\Url;

if(!empty($group_list)) {
    foreach ($group_list as $val) {?>
        <li class="has-sub open">
            <a href="javascript:void(0);" class="offsite" id="has_<?= $val['id'] ?>">
                <i class="glyphicon glyphicon-th-large"></i>
                <span class="menu-text"><?= $val['fname'] ?></span>
                <span class="glyphicon glyphicon-triangle-bottom arrow"></span>
            </a>
            <ul class="sub" style="display: block">
                <?php foreach ($val['funt_list'] as $vo) { ?>
                    <li>
                        <a href="<?= Url::to([$vo['furi']]) ?>"><?= str_replace($search, '<span class="text-primary" style="font-weight: bold;">' . $search . '</span>', $vo['fname']) ?></a>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php }
}else{?>

    <p class="text-warning" style="padding-left: 13px; font-size: 13px; padding-top: 10px;">Sorry nothing was found.</p>

<?php }?>