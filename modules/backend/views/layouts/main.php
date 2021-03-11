<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use app\core\helpers\Setup;
use app\widgets\Alert;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
/* @var $this \yii\web\View|\yiier\seo\SeoViewBehavior */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->renderMetaTags(); ?>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-png"/>
    <?php if ($this->context->action->id == 'view'): ?>
        <link rel="canonical" href="<?= Url::current([], true) ?>"/>
    <?php endif ?>
    <title><?= Setup::isHome() ? Yii::$app->name . ' - ' . params('seoDescription') : Html::encode($this->title) . ' - ' . Yii::$app->name ?></title>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name . '后台管理系统',
        'brandUrl' => ['/backend/default/index'],
        'options' => ['class' => 'navbar navbar-expand-lg navbar-dark bg-dark']
    ]);

    echo Nav::widget([
        'items' => [
            ['label' => '用户', 'url' => ['/backend/user/index']],
            ['label' => '图鉴', 'url' => ['/backend/ac-insects-fish/index']],
            ['label' => '节点', 'url' => ['/backend/node/index']],
            ['label' => '行为', 'url' => ['/backend/action-store/index']],
            ['label' => '话题', 'url' => ['/backend/topic/index']],
        ],
        'options' => ['class' => 'navbar-nav mr-auto mt-2 mt-lg-0'],
    ]);

    echo Nav::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'my-2 my-lg-0 pr'],
        'items' => [
            ['label' => '返回前台', 'url' => ['/']],
        ],
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name . ' ' . date('Y') ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
