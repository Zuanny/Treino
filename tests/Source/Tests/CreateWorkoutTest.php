<?php
namespace Source\Tests;


use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Source\Application\Services\CreateWorkoutService;
use Source\Domain\Entities\Exercise;
use Source\Domain\Entities\User;
use Source\Domain\Entities\WorkoutLine;
use Source\Infrastructure\Repositories\MongoUserRepository;
use Source\Infrastructure\Repositories\MongoWorkoutRepository;

class CreateWorkoutTest extends TestCase
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















