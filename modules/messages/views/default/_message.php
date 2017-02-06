<?php
use yii\helpers\Html;

/** @var $model \app\modules\messages\models\Message */
?>
<div class="message" style="padding-bottom: 15px;">
    <p class="small"><?= date("H:i:s d.m.Y", $model->created_at) ?></p>
    <h4>Сообщение от <?= $model->getSentUser()->getName() ?> пользователю <?= $model->getInboxUser()->getName() ?></h4>
    <div><?=\yii\helpers\StringHelper::truncate($model->message, 100, Html::a('... Читать полностью', ['default/view-message', 'id' => $model->id]))?></div>
</div>