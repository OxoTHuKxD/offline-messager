<?php

namespace app\modules\contactList\externalContracts\get;

interface UserInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return bool
     */
    public function isOnline();
}