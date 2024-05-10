<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public $user;

    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->user = $user;
    }
}
