<?php

namespace Source\Domain\Repositories;

use Source\Domain\Entities\Workout;

interface IWorkoutRepository{
    public function save(Workout $Workout);
}
