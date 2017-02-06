<?php

namespace app\modules\contactList\implementationContracts\give;

use app\modules\contactList\externalContracts\give\UserGetContactsInterface;
use app\modules\contactList\services\MainService;

class UserGetContacts implements UserGetContactsInterface
{
    /** @var MainService */
    private $mainService;

    /**
     * UserGetContacts constructor.
     * @param MainService $mainService
     */
    public function __construct(MainService $mainService)
    {
        $this->mainService = $mainService;
    }

    /**
     * @inheritDoc
     */
    public function getUserContactsIdList($userId)
    {
        return $this->mainService->getUserContactsIdList($userId);
    }
}