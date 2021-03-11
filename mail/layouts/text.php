<?php
/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<?= $this->params['title'] ?>
<?= isset($this->params['subject']) ? $this->params['subject'] : null; ?>
<?= $content ?>
<?= isset($this->params['tips']) ? $this->params['tips'] : null; ?>
©<?= date('Y') ?> <?= Yii::$app->name ?>Inc.
<?php $this->endBody() ?>
<?php $this->endPage() ?>
