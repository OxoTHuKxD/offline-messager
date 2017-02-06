<?php

namespace app\modules\contactList;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/contactList/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/contactList/messages',
            'fileMap' => [
                'modules/contactList/module' => 'module.php',
            ],
        ];

        \Yii::$container->set('app\modules\contactList\externalContracts\get\UserFinderInterface', [
            'class' => 'app\modules\director\implementation\contactList\UserFinder'
        ]);

        \Yii::$container->set('app\modules\contactList\externalContracts\give\UserHasContactInterface', [
            'class' => 'app\modules\contactList\implementationContracts\give\UserHasContact'
        ]);
    }
}