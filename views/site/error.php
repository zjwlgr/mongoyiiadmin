<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

//$this->title = $name;
$this->title = '系统提示';
?>
<div class="site-error">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->
    <h5 style="font-weight: bold;">系统提示：</h5>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>&nbsp; &nbsp;<a href="javascript:window.history.back(-1);">返回上一页</a>
    </div>

    <p class="text-muted">
        当前Web服务器处理您的请求时发生上述错误。<!--<br />
        The above error occurred while the Web server was processing your request.-->
    </p>
    <!--<p>
        如果你认为这是一个服务器错误，请与我们联系。谢谢您！<br />
        Please contact us if you think this is a server error. Thank you.
    </p>-->

</div>
