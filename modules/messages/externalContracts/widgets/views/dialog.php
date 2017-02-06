<?php
/**
 * @var yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var int $userId
 */
?>
<div class="messages-default-index" style="padding-bottom: 10px;">
    <h2><?= \app\modules\messages\Module::t("module", "DIALOG") ?></h2>
    <?= \app\modules\messages\externalContracts\widgets\SmallMessageFormWidget::widget(['userId' => $userId]) ?>
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_message',
    ]); ?>
</div>