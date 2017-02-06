<?php

namespace app\modules\contactList\externalContracts\give;

interface UserGetContactsInterface
{
    /**
     * @param $userId
     * @return int[]
     */
    public function getUserContactsIdList($userId);
}