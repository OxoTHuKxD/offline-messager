<?php

namespace app\modules\messages\externalContracts\widgets;

use app\modules\messages\externalContracts\get\UserCanSendMessageInterface;
use app\modules\messages\forms\MessageForm;
use yii\bootstrap\Widget;

class SmallMessageFormWidget extends Widget
{
    /** @var UserCanSendMessageInterface */
    private $userCanSendMessageService;

    /** @var MessageForm */
    private $messageForm;

    /** @var int */
    public $userId;

    /**
     * SmallMessageFormWidget constructor.
     * @param UserCanSendMessageInterface $userCanSendMessageService
     * @param MessageForm $messageForm
     * @param array $config
     */
    public function __construct(UserCanSendMessageInterface $userCanSendMessageService, MessageForm $messageForm, $config = [])
    {
        $this->userCanSendMessageService = $userCanSendMessageService;
        $this->messageForm = $messageForm;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
        $this->messageForm->userId = $this->userId;
    }

    public function run()
    {
        if (\Yii::$app->user->id && \Yii::$app->user->id !== $this->userId && $this->userCanSendMessageService->canSend(\Yii::$app->user->id, $this->userId)) {
            \Yii::$app->user->setReturnUrl(\Yii::$app->request->url);
            return $this->render('smallMessageForm', [
                'userId' => $this->userId,
                'model' => $this->messageForm,
            ]);
        } else {
            return '';
        }
    }
}