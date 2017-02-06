<?php

namespace app\modules\messages\externalContracts\get;

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