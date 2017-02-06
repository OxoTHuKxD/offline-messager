<?php

namespace app\modules\mediator;

use yii\base\InvalidConfigException;

/**
 * mediator module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @return Module
     * @throws InvalidConfigException
     */
    public static function getThisModule()
    {
        if (!\Yii::$app->hasModule('mediator') || !(($module = \Yii::$app->getModule('mediator')) instanceof Module)) {
            throw new InvalidConfigException(\Yii::t('app', 'MODULE_NOT_DEFINED ({0})', 'mediator'));
        }
        return $module;
    }
}
