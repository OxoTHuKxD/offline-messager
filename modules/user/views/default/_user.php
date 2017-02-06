<?php
use yii\helpers\Html;

/** @var $model \app\modules\user\models\User */
?>
<div class="user">
    <h3>
        <?= Html::a($model->username, ['default/profile', 'id' => $model->id]) ?>
        <?php if ($model->isOnline()) { ?>
            <span class="label label-success"><?= \app\modules\user\Module::t("module", "STATUS_ONLINE") ?></span>
        <?php } else { ?>
            <span class="label label-danger"><?= \app\modules\user\Module::t("module", "STATUS_OFFLINE") ?></span>
        <?php } ?>
        <?= \app\modules\contactList\externalContracts\widgets\ChangeContactWidget::widget(['userId' => $model->id]) ?>
    </h3>
</div>