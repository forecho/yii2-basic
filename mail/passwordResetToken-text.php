<?php

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->params['title'] = '您好 ' . $user->username . '，';
$this->params['subject'] = '你可以在 24 小时内点击下面的「重置密码」按钮来重置密码。如果这不是您本人发起的动作，请忽略此操作。';
$this->params['tips'] = '如果这不是您本人发起的动作，请忽略此操作。';
$resetLink = \yii\helpers\Url::to(['/site/reset-password', 'token' => $user->password_reset_token], true);
?>

<?= $resetLink ?>
