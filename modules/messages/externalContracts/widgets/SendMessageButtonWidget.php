<?php

namespace app\modules\messages\externalContracts\widgets;

use app\modules\messages\externalContracts\get\UserCanSendMessageInterface;
use yii\bootstrap\Widget;

class SendMessageButtonWidget extends Widget
{
    /** @var UserCanSendMessageInterface */
    private $userCanSendMessageService;

    public $userId;

    public function __construct(UserCanSendMessageInterface $userCanSendMessageService, $config = [])
    {
        $this->userCanSendMessageService = $userCanSendMessageService;
        parent::__construct($config);
    }

    public function run()
    {
        if (\Yii::$app->user->id && \Yii::$app->user->id !== $this->userId && $this->userCanSendMessageService->canSend(\Yii::$app->user->id, $this->userId)) {
            return $this->render('sendMessageButton', [
                'userId' => $this->userId
            ]);
        } else {
            return '';
        }
    }
}