<?php
use yii\helpers\Html;

/** @var $model \app\modules\contactList\models\UserContactList */
?>
<div class="user">
    <h3>
        <?= Html::a(Html::encode($model->getContactUser()->getName()), ['/user/default/profile', 'id' => $model->contact_user_id]) ?>
        <?php if ($model->getContactUser()->isOnline()) { ?>
            <span class="label label-success"><?= \app\modules\user\Module::t("module", "STATUS_ONLINE") ?></span>
        <?php } else { ?>
            <span class="label label-danger"><?= \app\modules\user\Module::t("module", "STATUS_OFFLINE") ?></span>
        <?php } ?>
        <?= \app\modules\contactList\externalContracts\widgets\ChangeContactWidget::widget(['userId' => $model->contact_user_id]) ?>
    </h3>
</div>