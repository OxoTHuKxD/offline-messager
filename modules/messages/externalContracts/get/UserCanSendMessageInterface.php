<?php

namespace app\modules\messages\externalContracts\get;

interface UserCanSendMessageInterface
{
    /**
     * @param int $userSentId
     * @param int $userInboxId
     * @return bool
     */
    public function canSend($userSentId, $userInboxId);
}