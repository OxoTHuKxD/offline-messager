<?php

/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\User */
?>
<div class="default-profile">
    <?php if (Yii::$app->session->hasFlash('statusChangeResultOk')) { ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= \app\modules\user\Module::t("module", "STATUS_CHANGED_OK") ?>
        </div>
    <?php } ?>
    <?php if (Yii::$app->session->hasFlash('statusChangeResultError')) { ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= \app\modules\user\Module::t("module", "STATUS_CHANGED_ERROR") ?>
        </div>
    <?php } ?>
    <h2>
        <?= $model->username ?>
        <?php if ($model->isOnline()) { ?>
            <span class="label label-success">Online</span>
        <?php } else { ?>
            <span class="label label-danger">Offline</span>
        <?php } ?>
    </h2>
    <?= \yii\widgets\DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email',
            'status_count'
        ],
    ]); ?>
    <?php if (!Yii::$app->user->isGuest) { ?>
        <?php if (!$model->hasLike(Yii::$app->user->id)) { ?>
            <?= \yii\helpers\Html::a(\app\modules\user\Module::t("module", "LIKE"), ['default/change-status-user', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php } else { ?>
            <?= \yii\helpers\Html::a(\app\modules\user\Module::t("module", "DISLIKE"), ['default/change-status-user', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?php } ?>
    <?php } ?>
</div>
