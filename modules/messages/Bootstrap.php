<?php

namespace app\modules\messages;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/messages/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/messages/messages',
            'fileMap' => [
                'modules/messages/module' => 'module.php',
            ],
        ];

        \Yii::$container->set('app\modules\messages\externalContracts\get\UserFinderInterface', [
            'class' => 'app\modules\director\implementation\messages\UserFinder'
        ]);

        \Yii::$container->set('app\modules\messages\externalContracts\get\UserCanSendMessageInterface', [
            'class' => 'app\modules\director\implementation\messages\UserCanSendMessage'
        ]);

        \Yii::$container->set('app\modules\messages\externalContracts\get\UserContactListInterface', [
            'class' => 'app\modules\director\implementation\messages\UserContactList'
        ]);

        \Yii::$container->set('app\modules\messages\externalContracts\get\UserInterface', [
            'class' => 'app\modules\director\implementation\messages\User'
        ]);
    }
}