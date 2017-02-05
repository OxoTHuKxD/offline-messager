<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\forms\ChangePasswordForm */
/* @var $form ActiveForm */
?>
<div class="default-change-password-form">

    <h2><?= \app\modules\user\Module::t("module", "CHANGE_PASSWORD_FORM") ?></h2>

    <?php if (Yii::$app->session->hasFlash('statusChangePasswordOk')) { ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= \app\modules\user\Module::t("module", "PASSWORD_CHANGED_OK") ?>
        </div>
    <?php } ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oldPassword')->passwordInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton(\app\modules\user\Module::t('module', 'SUBMIT'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- default-change-password-form -->
