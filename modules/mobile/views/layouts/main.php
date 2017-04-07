<?php
use yii\helpers\Url;
use app\assets\IndexbaseAsset;
IndexbaseAsset::register($this);

$this->title = $this->params['title'].' - '.\Yii::$app->params['weburl'];
$this->params['keywords'] = '';
$this->params['description'] = '';
$this->beginContent('@app/views/layouts/base.php');

?>

    <header class="headers-m">

    </header>

    <section class="section-m">
        <?= $content ?>
    </section>


    <footer class="footers-m">

    </footer>

<?php $this->endContent(); ?>