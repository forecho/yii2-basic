<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2016/8/31 15:24
 * description:
 */

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->params['title'] = '欢迎加入' . Yii::$app->name;
$this->params['subject'] = '在开始使用之前，请确认你的邮箱账号，你可以在 24 小时内点击下面的「确认账号」按钮来进行确认。';
$this->params['tips'] = '对此电子邮件有疑问，可不必理会。';
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm-email', 'token' => $user->password_reset_token]);
?>

<?= $resetLink ?>

