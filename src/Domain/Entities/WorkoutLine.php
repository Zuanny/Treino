<?php

namespace Source\Domain\Entities;

use Source\Domain\ValueObjects\ValueObjects;

class WorkoutLine extends ValueObjects {

    public Exercise $Exercise;
    public int $Series;
    public int $Reps;
    public float | null $RPE;
    public string | null $Technique;
    public int | null $Rest;

    public function __construct(
        Exercise $Exercise,
        int $Series,
        int $Reps,
        int $RPE = null,
        int $Rest = null,
        string $Technique = null
    )
    {
        parent::__construct();
        $this->Exercise = $Exercise;
        $this->Series = $Series;
        $this->Reps = $Reps;
        $this->RPE = $RPE;
        $this->Technique = $Technique;
        $this->Rest = $Rest;
    }

}