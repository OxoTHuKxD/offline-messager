<?php

namespace app\modules\user;

use yii\base\InvalidConfigException;

/**
 * user module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\user\controllers';

    public $userTableName = '{{%user}}';

    public $userStatusTableName = '{{%user_status}}';

    public $freeOnlineTime = 60 * 1;

    public $onlineCacheKey = 'user_online';

    public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t('modules/user/' . $category, $message, $params, $language);
    }

    /**
     * @return Module
     * @throws InvalidConfigException
     */
    public static function getThisModule()
    {
        if (!\Yii::$app->hasModule('user') || !(($module = \Yii::$app->getModule('user')) instanceof Module)) {
            throw new InvalidConfigException(\Yii::t('app', 'MODULE_NOT_DEFINED ({0})', 'user'));
        }
        return $module;
    }
}
