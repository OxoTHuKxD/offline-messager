<?php

namespace app\modules\messages\externalContracts\get;

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