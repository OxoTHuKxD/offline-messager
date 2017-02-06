<?php

return [
    'id' => 'app-console',
    'controllerNamespace' => 'app\commands',
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app',
            'migrationNamespaces' => [
                'app\modules\user\migrations',
                'app\modules\contactList\migrations'
            ],
        ],
    ]
];
