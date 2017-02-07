<?php

namespace app\modules\messages\implementationContracts\give;

use app\modules\messages\externalContracts\give\UserNewMessagesInterface;
use app\modules\messages\services\MainService;

class UserNewMessages implements UserNewMessagesInterface
{
    /** @var MainService */
    private $mainService;

    private $userNewMessageCountCache = [];

    /**
     * UserNewMessages constructor.
     * @param MainService $mainService
     */
    public function __construct(MainService $mainService)
    {
        $this->mainService = $mainService;
    }

    /**
     * @inheritDoc
     */
    public function getNewMessagesCount($userId)
    {
        $count = isset($this->userNewMessageCountCache[$userId]) ? $this->userNewMessageCountCache[$userId] : $this->mainService->getNewMessagesCount($userId);
        $this->userNewMessageCountCache[$userId] = $count;
        return $count;
    }

}