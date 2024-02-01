<?php

namespace Source\Domain\Entities;

use Source\Domain\ValueObjects\ValueObjects;

class User extends ValueObjects {
    private string $Name;

    public function __construct(string $Name)
    {
        parent::__construct();
        $this->Name = $Name;
    }
}