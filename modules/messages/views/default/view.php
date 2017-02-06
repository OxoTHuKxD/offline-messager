<?php
use yii\helpers\Html;

/** @var $message \app\modules\messages\models\Message */
?>
<div class="message">
    <h2>Сообщение от <?= Html::encode($message->getSentUser()->getName()) ?>
        пользователю <?= Html::encode($message->getInboxUser()->getName()) ?></h2>
    <p class="small"><?= date("H:i:s d.m.Y", $message->created_at) ?></p>
    <div><?= Html::encode($message->message) ?></div>
</div>