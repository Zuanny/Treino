<?php

namespace Source\Infrastructure\Repositories;

use Source\Domain\Entities\User;
use Source\Domain\Repositories\IUserRepository;

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