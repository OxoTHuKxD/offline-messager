<?php

namespace app\modules\mediator\implementation\contactList;

use app\modules\contactList\externalContracts\get\UserFinderInterface;

class UserFinder implements UserFinderInterface
{
    /** @var \app\modules\user\externalContracts\give\UserFinderInterface */
    private $userFinder;

    private $userCache = [];

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
        $user = isset($this->userCache[$id]) ? $this->userCache[$id] : $this->userFinder->getUserById($id);
        $this->userCache[$id] = $user;
        return is_null($user) ? null : new User($user);
    }

    /**
     * @inheritDoc
     */
    public function hasUserById($id)
    {
        if(isset($this->userCache[$id]) && $this->userCache[$id])
            return true;
        return $this->userFinder->hasUserById($id);
    }
}