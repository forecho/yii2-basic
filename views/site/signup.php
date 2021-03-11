<?php

/* @var $this yii\web\View */
/* @var $form ActiveForm */

/* @var $model app\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login my-4">
    <div class="card ">
        <div class="card-header">
            <strong>
                <?= $this->title ?>
            </strong>
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'id' => 'signup-form',
                'layout' => 'horizontal',
                'enableAjaxValidation' => true,
                'enableClientValidation' => false,
                'fieldConfig' => [
                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                    'horizontalCssClasses' => [
                        'label' => 'col-lg-1',
                        'wrapper' => 'col-lg-4',
                        'error' => '',
                        'hint' => '',
                    ],
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput()->hint('用户名只能为小写字母') ?>

            <?= $form->field($model, 'email')->textInput()->hint('邮箱为方便您找回密码和接收重要通知，请如实填写。') ?>

            <?= $form->field($model, 'password')->passwordInput()->hint('密码至少6位') ?>

            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    <?= Html::a('登录', ['/site/login'], ['class' => 'mx-4', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
