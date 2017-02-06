<?php
/**
 * @var yii\web\View $this
 * @var int $userId
 * @var bool $hasContact
 */

if($hasContact){
    echo \yii\helpers\Html::a(\app\modules\contactList\Module::t("module", "DELETE_CONTACT"), ['/contact-list/default/remove-contact', 'id' => $userId], ['class' => 'btn btn-danger']);
}else{
    echo \yii\helpers\Html::a(\app\modules\contactList\Module::t("module", "ADD_CONTACT"), ['/contact-list/default/add-contact', 'id' => $userId], ['class' => 'btn btn-primary']);
}
