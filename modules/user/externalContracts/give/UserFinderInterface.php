<?php

namespace app\modules\user\externalContracts\give;

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