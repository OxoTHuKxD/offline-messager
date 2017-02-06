<?php

namespace app\modules\director\implementation\messages;

use app\modules\contactList\externalContracts\give\UserGetContactsInterface;
use app\modules\messages\externalContracts\get\UserContactListInterface;
use app\modules\user\externalContracts\give\UserFinderInterface;

class UserContactList implements UserContactListInterface
{
    /** @var UserGetContactsInterface */
    private $userGetContacts;
    /** @var UserFinderInterface */
    private $userFinder;

    /**
     * UserContactList constructor.
     * @param UserGetContactsInterface $userGetContacts
     * @param UserFinderInterface $userFinder
     */
    public function __construct(UserGetContactsInterface $userGetContacts, UserFinderInterface $userFinder)
    {
        $this->userGetContacts = $userGetContacts;
        $this->userFinder = $userFinder;
    }

    /**
     * @inheritDoc
     */
    public function getUserContactList($userId)
    {
        return array_map(
            function($el) {
                return $this->userFinder->getUserById($el);
            }, $this->userGetContacts->getUserContactsIdList($userId)
        );
    }
}