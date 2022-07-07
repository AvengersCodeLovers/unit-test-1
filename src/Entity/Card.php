<?php

namespace StdGroup\App\Entity;

class Card
{
    private $id;
    private $isVip;

    public function __construct($id, $isVip)
    {
        $this->id = $id;
        $this->isVip = $isVip;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIsVip()
    {
        return $this->isVip;
    }
}
