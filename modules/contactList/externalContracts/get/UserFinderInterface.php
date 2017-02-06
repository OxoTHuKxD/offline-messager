<?php

namespace app\modules\contactList\externalContracts\get;

interface UserFinderInterface
{
    /**
     * @param int $id
     * @return UserInterface|null
     */
    public function getUserById($id);

    /**
     * @param int $id
     * @return bool
     */
    public function hasUserById($id);
}