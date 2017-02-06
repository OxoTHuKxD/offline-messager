<?php

namespace app\modules\messages\forms;

use app\modules\messages\externalContracts\get\UserContactListInterface;
use app\modules\messages\Module;
use yii\base\Model;

class MessageForm extends Model
{
    /** @var UserContactListInterface */
    private $userContactList;

    /** @var int */
    public $userId;

    /** @var string */
    public $message;

    /**
     * @inheritDoc
     */
    public function __construct(UserContactListInterface $userContactList, $config = [])
    {
        $this->userContactList = $userContactList;
        parent::__construct($config);
    }

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['message'], 'filter', 'filter' => 'trim'],
            [['userId', 'message'], 'required'],
            ['userId', 'integer'],
            ['message', 'string'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => Module::t('module', 'MESSAGE_FORM_USER'),
            'message' => Module::t('module', 'MESSAGE_FORM_MESSAGE')
        ];
    }

    public function getUserContacts()
    {
        $userContacts = $this->userContactList->getUserContactList(\Yii::$app->user->id);
        $result = [];
        foreach($userContacts as $val){
            $result[$val->getId()] = $val->getName();
        }
        return $result;
    }
}