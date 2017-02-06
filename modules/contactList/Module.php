<?php

namespace app\modules\contactList;

use yii\base\InvalidConfigException;

/**
 * contactList module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\contactList\controllers';

    public $userContactListTableName = '{{%user_contact_list}}';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t('modules/contactList/' . $category, $message, $params, $language);
    }

    /**
     * @return Module
     * @throws InvalidConfigException
     */
    public static function getThisModule()
    {
        if (!\Yii::$app->hasModule('contact-list') || !(($module = \Yii::$app->getModule('contact-list')) instanceof Module)) {
            throw new InvalidConfigException(\Yii::t('app', 'MODULE_NOT_DEFINED ({0})', 'contact-list'));
        }
        return $module;
    }
}
