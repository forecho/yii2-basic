<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \app\models\ResetPasswordForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = '重置密码';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-reset-password my-4">
    <div class="card bg-dark text-ligh">
        <div class="card-header">
            <strong>
                <?= $this->title ?>
            </strong>
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
            ]); ?>

            <p class="txt-info text-muted">请输入您的新密码：</p>

            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
