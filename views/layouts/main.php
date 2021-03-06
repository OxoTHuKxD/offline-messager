<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginContent('@app/views/layouts/layout.php'); ?>

<?php
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);

$countNewMessages = 0;
if (!Yii::$app->user->isGuest) {
    /** @var app\modules\messages\externalContracts\give\UserNewMessagesInterface $userMessageCounter */
    $userMessageCounter = Yii::createObject('app\modules\messages\externalContracts\give\UserNewMessagesInterface');
    $countNewMessages = $userMessageCounter->getNewMessagesCount(Yii::$app->user->id);
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'activateParents' => true,
    'items' => array_filter([
        ['label' => Yii::t('app', 'NAV_HOME'), 'url' => ['/user/default/index']],
        Yii::$app->user->isGuest ?
            ['label' => Yii::t('app', 'NAV_REGISTER'), 'url' => ['/user/security/register']] :
            false,
        Yii::$app->user->isGuest ?
            ['label' => Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/security/login']] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => Yii::t('app', 'NAV_CONTACT_LIST'), 'url' => ['/contact-list/default/index']] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => Yii::t('app', 'NAV_NEW_MESSAGES') . " <span class=\"badge\">$countNewMessages</span>", 'url' => ['/messages/default/new-messages'], 'encode' => false] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => Yii::t('app', 'NAV_SEND_MESSAGE'), 'url' => ['/messages/send/index']] :
            false,
        !Yii::$app->user->isGuest ?
            ['label' => Yii::t('app', 'NAV_PROFILE'), 'items' => [
                ['label' => Yii::t('app', 'NAV_PROFILE'), 'url' => ['/user/default/profile', 'id' => Yii::$app->user->id]],
                ['label' => Yii::t('app', 'NAV_CHANGE_PASSWORD'), 'url' => ['/user/settings/change-password']],
                ['label' => Yii::t('app', 'NAV_LOGOUT'),
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']]
            ]] :
            false,
    ]),
]);
NavBar::end();
?>

<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= $content ?>
</div>

<?php $this->endContent(); ?>
