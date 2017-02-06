<?php

use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
?>
<div class="user-default-index">
    <h2><?= \app\modules\user\Module::t("module", "USER_LIST") ?></h2>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_user',
    ]); ?>
</div>
