<?php
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
?>
<div class="messages-default-index">
    <h2><?= \app\modules\messages\Module::t("module", "SENT_MESSAGE_LIST") ?></h2>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_message',
    ]); ?>
</div>
