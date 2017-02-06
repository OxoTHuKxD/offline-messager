<?php

namespace app\modules\mediator\implementation\messages;

use app\modules\contactList\externalContracts\give\UserHasContactInterface;
use app\modules\messages\externalContracts\get\UserCanSendMessageInterface;

class UserCanSendMessage implements UserCanSendMessageInterface
{
    /** @var UserHasContactInterface */
    private $userHasContact;

    /**
     * UserCanSendMessage constructor.
     * @param UserHasContactInterface $userHasContact
     */
    public function __construct(UserHasContactInterface $userHasContact)
    {
        $this->userHasContact = $userHasContact;
    }

    /**
     * @inheritDoc
     */
    public function canSend($userSentId, $userInboxId)
    {
        return $this->userHasContact->hasUserContact($userSentId, $userInboxId);
    }

}