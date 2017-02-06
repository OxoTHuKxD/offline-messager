<?php

namespace app\modules\contactList\externalContracts\give;

interface UserHasContactInterface
{
    /**
     * @param int $userId
     * @param int $contactUserId
     * @return bool
     */
    public function hasUserContact($userId, $contactUserId);
}