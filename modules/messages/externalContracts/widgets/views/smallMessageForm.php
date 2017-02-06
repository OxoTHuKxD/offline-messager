<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\messages\forms\MessageForm */
/* @var $form ActiveForm */
?>
<div class="message-form">

    <?php $form = ActiveForm::begin(['action' => ['/messages/send/index']]); ?>
    <?= $form->field($model, 'userId')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'message')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton(\app\modules\messages\Module::t('module', 'SUBMIT'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
