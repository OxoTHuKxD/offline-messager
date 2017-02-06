<?php
/**
 * @var yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 */
?>
<div class="messages-default-index" style="padding-bottom: 10px;">
    <h2><?= \app\modules\messages\Module::t("module", "NEW_MESSAGES") ?></h2>
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_message',
    ]); ?>
</div>