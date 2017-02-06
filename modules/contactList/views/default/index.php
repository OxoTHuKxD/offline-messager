<?php
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
?>

<div class="contactList-default-index">
    <h2><?= \app\modules\contactList\Module::t("module", "CONTACT_LIST") ?></h2>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_contact',
    ]); ?>
</div>
