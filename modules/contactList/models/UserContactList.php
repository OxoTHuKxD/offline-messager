<?php

namespace app\modules\contactList\models;

use app\modules\contactList\externalContracts\get\UserFinderInterface;
use app\modules\contactList\Module;
use yii\db\ActiveRecord;

/**
 *
 * @property integer $user_id
 * @property integer $contact_user_id
 */
class UserContactList extends ActiveRecord
{
    /** @var UserFinderInterface */
    private $userFinder;

    public function init()
    {
        $this->userFinder = \Yii::createObject('app\modules\contactList\externalContracts\get\UserFinderInterface');
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Module::getThisModule()->userContactListTableName;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'contact_user_id'], 'required'],
            [['user_id', 'contact_user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => \Yii::t('modules/user/module', 'User ID'),
            'contact_user_id' => \Yii::t('modules/user/module', 'Contact User ID'),
        ];
    }

    /**
     * @return \app\modules\contactList\externalContracts\get\UserInterface|null
     */
    public function getContactUser()
    {
        return $this->userFinder->getUserById($this->contact_user_id);
    }
}
