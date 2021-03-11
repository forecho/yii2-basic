<?php

if ($au = params('googleAnalyticsAU')): ?>
    <div style="display:none">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $au ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());


            <?php if (!Yii::$app->user->isGuest): ?>
            gtag('config', '<?= $au ?>', {
                'user_id': '<?= Yii::$app->user->id?>'
            });
            gtag('event', 'user_view_page', {
                'event_category': '<?= yii\helpers\Url::current()?>',
                'user_id': '<?= Yii::$app->user->id?>',
            });
            <?php else: ?>
            gtag('config', '<?= $au ?>');
            <?php endif ?>

        </script>
    </div>

<?php endif ?>
