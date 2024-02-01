<?php

namespace Source\Domain\Repositories;

use Source\Domain\Entities\User;

interface IUserRepository{
    public function save(User $user): void;
    public function getByID(string $ID): User;
}