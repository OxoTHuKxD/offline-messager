<?php

namespace app\modules\messages\implementationContracts\give;

use app\modules\messages\externalContracts\give\UserNewMessagesInterface;
use app\modules\messages\services\MainService;

class UserNewMessages implements UserNewMessagesInterface
{
    /** @var MainService */
    private $mainService;

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
        return $this->mainService->getNewMessagesCount($userId);
    }

}