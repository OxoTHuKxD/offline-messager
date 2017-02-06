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

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @return Module
     * @throws InvalidConfigException
     */
    public static function getThisModule()
    {
        if (!\Yii::$app->hasModule('messages') || !(($module = \Yii::$app->getModule('messages')) instanceof Module)) {
            throw new InvalidConfigException("Модуль messages не определен!");
        }
        return $module;
    }
}
