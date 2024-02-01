<?php

namespace Source\Domain\Entities;

use Source\Domain\ValueObjects\ValueObjects;
use Source\Tests\WorkoutLine;

class Workout extends ValueObjects {
    public string $Name;
    private array $Lines = [];
    public string $UserID;

    public function __construct(string $Name, string $UserID)
    {
        parent::__construct();
        $this->Name = $Name;
        $this->UserID = $UserID;
    }

    public function addLine(WorkoutLine $Workout): void
    {
        $this->Lines[] = $Workout;
    }
    public function addLines(array $WorkoutList): void
    {
        foreach ($WorkoutList as $Workout)
            $this->Lines[] = $Workout;
    }
    public function show(){
        return $this->Lines;
    }

}