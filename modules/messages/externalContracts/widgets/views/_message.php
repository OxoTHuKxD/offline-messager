<?php

use yii\helpers\Html;

/** @var $model \app\modules\messages\models\Message */
?>
<div class="message" style="border-bottom: 1px solid #000;">
    <h4>
        <?= Html::encode($model->getSentUser()->getName()) ?>
        <?php if ($model->isNew() && $model->user_inbox_id === Yii::$app->user->id) { ?> <span
            class="label label-success"><?= \app\modules\messages\Module::t("module", "NEW") ?></span><?php } ?>
    </h4>
    <p class="small"><?= date("H:i:s d.m.Y", $model->created_at) ?></p>
    <div style="padding-bottom: 5px;"><?= Html::encode($model->message) ?></div>
</div>