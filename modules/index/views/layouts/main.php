<?php
use yii\helpers\Url;
use app\assets\IndexbaseAsset;
IndexbaseAsset::register($this);

$this->title = $this->params['title'].' - '.\Yii::$app->params['weburl'];
$this->params['keywords'] = empty($this->params['keywords']) ? '' : $this->params['keywords'];
$this->params['description'] = empty($this->params['description']) ? '' : $this->params['description'];


$this->beginContent('@app/views/layouts/base.php');
?>

    <header class="headers">

    </header>

    <section class="section">
        <?= $content ?>
    </section>

    <footer class="footers">

    </footer>

<?php $this->endContent(); ?>