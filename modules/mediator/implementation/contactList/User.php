<?php

namespace app\modules\mediator\implementation\contactList;

use app\modules\contactList\externalContracts\get\UserInterface;

class User implements UserInterface
{
    /** @var \app\modules\user\externalContracts\give\UserInterface */
    private $user;

    /**
     * User constructor.
     * @param \app\modules\user\externalContracts\give\UserInterface $user
     */
    public function __construct(\app\modules\user\externalContracts\give\UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->user->getId();
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->user->getName();
    }

    /**
     * @inheritDoc
     */
    public function isOnline()
    {
        return $this->user->isOnline();
    }
}