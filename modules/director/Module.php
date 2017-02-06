<?php

namespace app\modules\director;

use yii\base\InvalidConfigException;

/**
 * director module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @return Module
     * @throws InvalidConfigException
     */
    public static function getThisModule()
    {
        if (!\Yii::$app->hasModule('director') || !(($module = \Yii::$app->getModule('director')) instanceof Module)) {
            throw new InvalidConfigException(\Yii::t('app', 'MODULE_NOT_DEFINED ({0})', 'director'));
        }
        return $module;
    }
}
