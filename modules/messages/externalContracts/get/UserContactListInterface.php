<?php

namespace app\modules\messages\externalContracts\get;

interface UserContactListInterface
{
    /**
     * @param int $userId
     * @return UserInterface[]
     */
    public function getUserContactList($userId);
}