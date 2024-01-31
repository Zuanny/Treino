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
        $Workout = new Workout('Peito');
        $this->assertIsString($Workout->ID);

        $exercise = new Exercise('Supino Reto', 'Peito');
        $workoutLine = new WorkoutLine($exercise, 2, 10, 8.5, 300 );
        $Workout->addLine($workoutLine);
        $this->assertNotEmpty($Workout->show());
    }
}

class Workout {
    public string $ID;
    public string $Name;
    private array $Lines = [];

    public function __construct(string $Name)
    {
        $this->ID = uniqid();
        $this->Name = $Name;
    }

    public function addLine(WorkoutLine $Workout): void
    {
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

