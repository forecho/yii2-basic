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
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->renderMetaTags(); ?>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-png"/>
    <?php if ($this->context->action->id == 'view'): ?>
        <link rel="canonical" href="<?= Url::current([], true) ?>"/>
    <?php endif ?>
    <?php if (params('googleAnalyticsAU')): ?>
        <script data-ad-client="<?= params('googleAnalyticsAU') ?>" async
                src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <?php endif ?>
    <title><?= Url::home() == Yii::$app->request->url ? Yii::$app->name . ' - ' . params('seoDescription') : Html::encode($this->title) . ' - ' . Yii::$app->name ?></title>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $targetLang = \app\core\types\Lang::getTarget();
    NavBar::begin([
        'brandLabel' => Yii::$app->name . Html::a(
                Html::tag('span', current($targetLang), ['class' => 'badge badge-secondary']),
                Url::current(['lang' => key($targetLang)])
            ),
        'options' => ['class' => 'navbar navbar-expand-lg navbar-light bg-light']
    ]);
    $items = [];
    if ($nodeId = request('alias')) {
        $items = [
            ['label' => '话题', 'url' => ['/topic/default/index', 'alias' => $nodeId]],
        ];
    }
    echo Nav::widget([
        'items' => $items,
        'options' => ['class' => 'navbar-nav mr-auto mt-2 mt-lg-0'],
    ]);

    ?>
    <form class="form-inline d-none my-2 my-lg-0" action="<?= Url::to(['/site/search']) ?>">
        <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="关键词"
               value="<?= request()->get('keyword') ?>">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
    </form>
    <?php
    $menuItemsRight = [];
    if (Yii::$app->user->isGuest) {
        $menuItemsRight[] = [
            'label' => '注册',
            'url' => ['/site/signup']
        ];
        $menuItemsRight[] = [
            'label' => '登录',
            'url' => ['/site/login']
        ];
    } else {
        if ($nodeId) {
            $menuItemsRight[] = ['label' => '发帖', 'url' => ['/topic/default/create', 'alias' => $nodeId]];
        }
        // 个人中心
        $menuItemsRight[] = [
            // 'label' => Yii::$app->user->identity->username,
            'label' => '<img class="avatar img-circle" src="' . Yii::$app->user->identity->avatar . '">',
            'items' => [
                ['label' => '我的主页', 'url' => ['/user/show', 'username' => user('username')]],
                ['label' => '设置中心', 'url' => ['/user/profile']],
                ['label' => '退出', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]
            ]
        ];
    }
    echo Nav::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'my-2 my-lg-0 pr'],
        'items' => $menuItemsRight,
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
<?= $this->render('analytics') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
