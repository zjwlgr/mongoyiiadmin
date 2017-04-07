<?php
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="format-detection" content="telephone=no"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta content="<?= Html::encode($this->params['keywords']) ?>" name="keywords"/>
        <meta content="<?= Html::encode($this->params['description']) ?>" name="description"/>
        <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <?= $content ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>