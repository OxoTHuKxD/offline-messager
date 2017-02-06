<?php

namespace app\modules\contactList\implementationContracts\give;

use app\modules\contactList\externalContracts\give\UserHasContactInterface;
use app\modules\contactList\services\MainService;

class UserHasContact implements UserHasContactInterface
{
    /** @var MainService */
    private $service;

    /**
     * UserHasContact constructor.
     * @param MainService $service
     */
    public function __construct(MainService $service)
    {
        $this->service = $service;
    }

    /**
     * @inheritDoc
     */
    public function hasUserContact($userId, $contactUserId)
    {
        return $this->service->hasUserContact($userId, $contactUserId);
    }

}