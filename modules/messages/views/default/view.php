<?php
use yii\helpers\Html;

/** @var $message \app\modules\messages\models\Message */
?>
<div class="message">
    <h2>Сообщение от <?= $message->getSentUser()->getName() ?> пользователю <?= $message->getInboxUser()->getName() ?></h2>
    <p class="small"><?= date("H:i:s d.m.Y", $message->created_at) ?></p>
    <div><?=$message->message?></div>
</div>