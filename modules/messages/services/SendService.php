<?php

namespace app\modules\messages\services;

use app\modules\messages\externalContracts\get\UserCanSendMessageInterface;
use app\modules\messages\models\Message;
use app\modules\messages\Module;
use yii\base\ErrorException;

class SendService
{
    /** @var UserCanSendMessageInterface */
    private $userCanSendMessageService;

    /**
     * SendService constructor.
     * @param UserCanSendMessageInterface $userCanSendMessageService
     */
    public function __construct(UserCanSendMessageInterface $userCanSendMessageService)
    {
        $this->userCanSendMessageService = $userCanSendMessageService;
    }

    /**
     * @param $userSentId
     * @param $userInboxId
     * @param $text
     * @throws ErrorException
     */
    public function sendMessage($userSentId, $userInboxId, $text)
    {
        if(!$this->userCanSendMessageService->canSend($userSentId, $userInboxId)){
            throw new ErrorException(Module::t('module', 'CAN_NOT_SEND_MESSAGE_THIS_USER'));
        }

        $message = new Message();
        $message->user_sent_id = $userSentId;
        $message->user_inbox_id = $userInboxId;
        $message->message = $text;
        $message->save();
        \Yii::trace($message->errors);
    }
}