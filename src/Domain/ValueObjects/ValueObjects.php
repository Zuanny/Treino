<?php

namespace Source\Domain\ValueObjects;

abstract class ValueObjects
{
    public string $ID;
    public function __construct()
    {
        $this->ID = strtoupper(uniqid());
    }

}