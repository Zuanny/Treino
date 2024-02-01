<?php
namespace Source\Tests;

use Source\Export\Export;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ExportTest extends TestCase
{
    #[Test]
    public function ShouldCreateWorkout()
    {
        $NUser = new User('RodStub');

        $workoutRepository = $this->createStub(MongoWorkoutRepository::Class);
        $userRepository = $this->createStub(MongoUserRepository::Class);

        $workoutRepository->method('save')->willReturn(null);
        $userRepository->method('getByID')->willReturn($NUser);



        $createUserService = new CreateWorkoutService($workoutRepository, $userRepository);
        $exercise = new Exercise('Supino Reto', 'Peito');
        $workoutLine = new WorkoutLine($exercise, 2, 10, 8.5, 300 );

        $WorkoutFinal = $createUserService->exec('Peito', $NUser->ID, [$workoutLine]);

        $this->assertContainsEquals($workoutLine, $WorkoutFinal->show());
    }
}

class Workout {
    public string $ID;
    public string $Name;
    private array $Lines = [];
    public string $UserID;

    public function __construct(string $Name, string $UserID)
    {
        $this->ID = uniqid();
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

class Exercise {
    private string $ID;
    private string $Name;
    private string $PrincipalMuscle;
    private array $SecondaryMuscles;

    public function __construct(string $Name, string $PrincipalMuscle)
    {
        $this->ID = uniqid();
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

class WorkoutLine {
    public string $ID;
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
        $this->ID = uniqid();
        $this->Exercise = $Exercise;
        $this->Series = $Series;
        $this->Reps = $Reps;
        $this->RPE = $RPE;
        $this->Technique = $Technique;
        $this->Rest = $Rest;
    }

}

class User {
    public string $ID;
    private string $Name;

    public function __construct(string $Name)
    {
        $this->ID = uniqid();
        $this->Name = $Name;
    }
}

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

interface IWorkoutRepository{
public function save(Workout $Workout);
}

interface IUserRepository{
    public function save(User $user): void;
    public function getByID(string $ID): User;
}

class MongoWorkoutRepository implements IWorkoutRepository {

    public function save(Workout $Workout)
    {
        // TODO: Implement save() method.
    }
}

class MongoUserRepository implements IUserRepository{

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }

    public function getByID(string $ID): User
    {
        return new User('rods');
    }
}