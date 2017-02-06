<?php

namespace app\modules\user\implementationContracts\give;

use app\modules\user\externalContracts\give\UserInterface;

class User implements UserInterface
{
    /** @var \app\modules\user\models\User */
    private $user;

    /**
     * User constructor.
     * @param \app\modules\user\models\User $user
     */
    public function __construct(\app\modules\user\models\User $user)
    {
        $this->user = $user;
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->user->id;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->user->username;
    }

    /**
     * @inheritDoc
     */
    public function isOnline()
    {
        return $this->user->isOnline();
    }


}