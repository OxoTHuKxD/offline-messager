<?php

namespace app\modules\messages\externalContracts\give;

interface UserNewMessagesInterface
{
    /**
     * @param int $userId
     * @return int
     */
    public function getNewMessagesCount($userId);
}