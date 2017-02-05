<?php

namespace app\modules\user;

use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\web\Application as WebApplication;
use yii\web\User;
use yii\web\UserEvent;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/user/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/user/messages',
            'fileMap' => [
                'modules/user/module' => 'module.php',
            ],
        ];

        \Yii::$container->set('app\modules\user\externalContracts\give\UserFinderInterface', [
            'class' => 'app\modules\user\implementationContracts\give\UserFinder'
        ]);

        if ($app instanceof WebApplication) {
            \Yii::$container->set('yii\web\User', [
                'enableAutoLogin' => true,
                'loginUrl' => ['/user/security/login'],
                'identityClass' => 'app\modules\user\adapters\IdentityInterfaceAdapter'
            ]);

            Event::on(WebApplication::className(), WebApplication::EVENT_BEFORE_REQUEST, function () {
                if (\Yii::$app->user->id) {
                    $userOnlineService = \Yii::createObject('app\modules\user\services\UserOnlineService');
                    $userOnlineService->setWebUserOnline(\Yii::$app->user->id);
                }
            });

            Event::on(User::className(), User::EVENT_AFTER_LOGOUT, function ($event) {
                /** @var UserEvent $event */
                $userOnlineService = \Yii::createObject('app\modules\user\services\UserOnlineService');
                $userOnlineService->setWebUserOffline($event->identity->getId());
            });
        }
    }
}