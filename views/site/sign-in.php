<?php

/* @var $this yii\web\View */

$this->title = '签到';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-faq mt-2">

    <div class="card mx-1 float-right" style="width: 12rem;">
        <?php if ($adImg = params('adImage')): ?>
            <img src="<?= $adImg ?> " class="card-img-top"
                 alt="<?= params('adTitle') ?>" title="<?= params('adTitle') ?>">
        <?php endif ?>

        <?php if ($adTitle = params('adTitle')): ?>
            <div class="card-body">
                <p class="card-text txt-info"><?= $adTitle ?></p>
            </div>
        <?php endif ?>
    </div>

    <h3>签到步骤：</h3>

    <p>
        1. 先关注公众号（首次需要先绑定用户）：
    </p>
    <div class="row">
        <div class="col">
            <img src="https://i.loli.net/2020/02/27/GRlBvSMqpK98DeW.png" alt="公众号" class="img-fluid">
        </div>
        <div class="col-md-5"></div>
    </div>

    <p>
        2. 发送 <code>签到</code> 两个字。
    </p>

    <h3>签到说明：</h3>

    <ul>
        <li>中国时区，每天只能签到一次。</li>
        <li>每次签到送<b><?= params('signInRewardPoints') ?></b>分。</li>
    </ul>
</div>
