<?php

/* @var $this yii\web\View */

$this->title = '常见问题';
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

    <h2><?= $this->title ?></h2>

    <h3>积分说明：</h3>

    <ul>
        <li>本站所有资源为用户上传，用户上传时候可以选择下载资源时是否需要积分。</li>
        <li>
            获取积分的方式：目前只有以下几种方式：
            <ul>
                <li><a href="<?= \yii\helpers\Url::to('/site/sign-in') ?>">签到</a></li>
                <li>上传资源，本站审核通过之后奖励资源上传者<?= params('uploadRewardPoints') ?>积分。</li>
                <li>花钱购买积分，<a href="<?= \yii\helpers\Url::to('/points/index') ?>">点击购买</a>。</li>
            </ul>
        </li>
    </ul>

    <h3>资源说明：</h3>

    <ul>
        <li>目前上传的资源最大不能超过10M。</li>
        <li>花积分下载或者推送过的资源，一个小时内再次下载或者推送该资源将不再收取积分。（为了方便网络不太稳定的朋友）</li>
        <li>上传的资源目前只支持 <?= implode(', ', \app\models\Resource::getFormats()) ?>。</li>
        <li>支持推送到 Kindle 的格式只有 mobi 和 pdf。</li>
    </ul>

    <h3>免责声明:</h3>

    <ul>
        <li>
            本站只提供书籍的存储,索引服务,所有资源来源于网络用户分享，版权归原作者及其网站所有，本站不拥有此类资源的版权，不对任何资源负法律责任。
        </li>
        <li>
            本站资源为用户免费分享产生，如果你发现本站任何资源侵犯了你的版权,请立即告知，我们会在核实后第一时间删除并致以最深的歉意。
        </li>
        <li>
            本站仅为资源分享的平台，站内资源仅供会员参考和学习之用，不得用于其他非法用途，请下载后24小时内从您的电脑中彻底删除。否则，一切后果请用户自负。
        </li>
        <li>
            本站会员均可添加书籍，上传书籍版本。严禁在本站发布反动、色情、广告等不良信息及违法内容。
        </li>
        <li>
            本站作为网络服务提供者，由于网站信息量巨大，对非法转载、盗版行为的发生不具备充分的监控能力。在版权所有者出示材料联系后，本站负有移除非法转载和盗版内容以及停止继续传播的义务。
        </li>
        <li>
            凡登陆本网站或直接、间接使用本站资料者，一旦使用本站任何资源，即被视为您已接受本站的免责声明。
        </li>
    </ul>


    <hr>


</div>
