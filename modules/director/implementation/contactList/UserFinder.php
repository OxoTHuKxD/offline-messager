<?php

namespace app\modules\director\implementation\contactList;

use app\modules\contactList\externalContracts\get\UserFinderInterface;

class UserFinder implements UserFinderInterface
{
    /** @var \app\modules\user\externalContracts\give\UserFinderInterface */
    private $userFinder;

    /**
     * UserFinder constructor.
     * @param \app\modules\user\externalContracts\give\UserFinderInterface $userFinder
     */
    public function __construct(\app\modules\user\externalContracts\give\UserFinderInterface $userFinder)
    {
        $this->userFinder = $userFinder;
    }
    
    /**
     * @inheritDoc
     */
    public function getUserById($id)
    {
        $user = $this->userFinder->getUserById($id);
        return is_null($user) ? null : new User($user);
    }

    /**
     * @inheritDoc
     */
    public function hasUserById($id)
    {
        return $this->userFinder->hasUserById($id);
    }

}