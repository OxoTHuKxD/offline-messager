<?php
/**
 * @var yii\web\View $this
 * @var int $userId
 */
?>
<?= \yii\helpers\Html::a(\app\modules\messages\Module::t("module", "SEND_MESSAGE"), ['/messages/send/index', 'userId' => $userId], ['class' => 'btn btn-primary']) ?>
