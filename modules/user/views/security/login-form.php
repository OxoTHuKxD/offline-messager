<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\forms\LoginForm */
/* @var $form ActiveForm */
?>
<div class="default-login-form">

    <h2><?= \app\modules\user\Module::t("module", "LOGIN_FORM") ?></h2>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(\app\modules\user\Module::t('module', 'SUBMIT'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- default-login-form -->
