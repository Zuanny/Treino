<?php

namespace Source\Application\Services;

use Source\Domain\Entities\Workout;
use Source\Domain\Repositories\IUserRepository;
use Source\Domain\Repositories\IWorkoutRepository;

class CreateWorkoutService {
    private readonly IWorkoutRepository $__WorkoutRepository;
    private readonly IUserRepository $__UserRepository;
    public function __construct(IWorkoutRepository $WorkoutRepository, IUserRepository $__UserRepository)
    {
        $this->__WorkoutRepository = $WorkoutRepository;
        $this->__UserRepository = $__UserRepository;
    }
    public function exec(
        string $WorkoutName,
        string $UserID,
        array $WorkoutList
    ): Workout
    {
        $userID = $this->__UserRepository->getByID($UserID);
        $Workout = new Workout($WorkoutName, $userID->ID);
        $Workout->addLines($WorkoutList);
        $this->__WorkoutRepository->save($Workout);
        return $Workout;
    }
}