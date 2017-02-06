<?php

namespace app\modules\messages;

use yii\base\InvalidConfigException;

/**
 * messages module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\messages\controllers';

    public $messagesTableName = '{{%messages}}';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t('modules/messages/' . $category, $message, $params, $language);
    }

    /**
     * @return Module
     * @throws InvalidConfigException
     */
    public static function getThisModule()
    {
        if (!\Yii::$app->hasModule('messages') || !(($module = \Yii::$app->getModule('messages')) instanceof Module)) {
            throw new InvalidConfigException(\Yii::t('app', 'MODULE_NOT_DEFINED ({0})', 'messages'));
        }
        return $module;
    }
}
