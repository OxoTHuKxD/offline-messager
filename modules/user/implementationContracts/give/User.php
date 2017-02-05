<?php

namespace app\modules\user\implementationContracts\give;

use app\modules\user\externalContracts\give\UserInterface;

class User implements UserInterface
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /**
     * User constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->name;
    }
}