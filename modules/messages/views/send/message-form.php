<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\messages\forms\MessageForm */
/* @var $form ActiveForm */
?>
<div class="message-form">

    <h2><?= \app\modules\messages\Module::t("module", "MESSAGE_FORM") ?></h2>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'userId')->dropDownList($model->getUserContacts()) ?>
        <?= $form->field($model, 'message')->textarea() ?>
    
        <div class="form-group">
            <?= Html::submitButton(\app\modules\messages\Module::t('module', 'SUBMIT'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
