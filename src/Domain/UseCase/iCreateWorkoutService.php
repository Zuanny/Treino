<?php

namespace Source\Domain\UseCase;

use Source\Domain\Entities\Workout;

interface iCreateWorkoutService
{
    public function exec(): Workout;

}