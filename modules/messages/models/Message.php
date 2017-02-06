<?php

namespace app\modules\messages\models;

use app\modules\messages\externalContracts\get\UserFinderInterface;
use app\modules\messages\models\query\MessageQuery;
use app\modules\messages\Module;
use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $user_sent_id
 * @property integer $user_inbox_id
 * @property string $message
 * @property integer $status
 * @property integer $created_at
 */
class Message extends ActiveRecord
{
    const STATUS_UNREAD = 0;
    const STATUS_READ = 1;

    /** @var UserFinderInterface */
    private $userFinder;

    public function init()
    {
        $this->userFinder = \Yii::createObject('app\modules\messages\externalContracts\get\UserFinderInterface');
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Module::getThisModule()->messagesTableName;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_sent_id', 'user_inbox_id', 'message'], 'required'],
            [['user_sent_id', 'user_inbox_id', 'status', 'created_at'], 'integer'],
            [['message'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'MESSAGE_ID'),
            'user_sent_id' => Module::t('module', 'MESSAGE_USER_SENT'),
            'user_inbox_id' => Module::t('module', 'MESSAGE_USER_INBOX'),
            'message' => Module::t('module', 'MESSAGE'),
            'status' => Module::t('module', 'MESSAGE_STATUS'),
            'created_at' => Module::t('module', 'MESSAGE_CREATED_AT')
        ];
    }

    /**
     * @inheritdoc
     * @return MessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessageQuery(get_called_class());
    }

    /**
     * @return \app\modules\messages\externalContracts\get\UserInterface|null
     */
    public function getInboxUser()
    {
        return $this->userFinder->getUserById($this->user_inbox_id);
    }

    /**
     * @return \app\modules\messages\externalContracts\get\UserInterface|null
     */
    public function getSentUser()
    {
        return $this->userFinder->getUserById($this->user_sent_id);
    }

    /**
     * @inheritDoc
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->created_at = time();
        }
        return parent::beforeSave($insert);
    }
}
