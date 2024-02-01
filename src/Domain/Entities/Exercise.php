<?php

namespace Source\Domain\Entities;

use Source\Domain\ValueObjects\ValueObjects;

class Exercise extends ValueObjects {
    private string $Name;
    private string $PrincipalMuscle;
    private array $SecondaryMuscles;

    public function __construct(string $Name, string $PrincipalMuscle)
    {
        parent::__construct();
        $this->Name = $Name;
        $this->PrincipalMuscle = $PrincipalMuscle;
    }

    public function addSecondaryMuscles(string | array $Muscles): void
    {
        if(is_string($Muscles))
            $this->SecondaryMuscles[] = $Muscles;

        foreach ($Muscles as $muscle)
            $this->SecondaryMuscles[] = $muscle;
    }


}