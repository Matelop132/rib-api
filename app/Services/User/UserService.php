<?php

namespace App\Services\User;

use App\Models\User;
use Session;

class UserService
{
    /**
     * @param int $userId
     * @return mixed
     */
    public function getCurrentUser(string $userId): mixed
    {
        return User::where('name', $userId)->first();

    }

    public function getCurrentMail(string $userEmail): mixed
    {
        return User::where('email', $userEmail)->first();

    }

    public function addCurrentSessionUser(string $name): mixed
    {
        return Session::put('user', $name);

    }

    public function getPasswordUser(string $password): mixed
    {
        return User::where('password', $password)->first();

    }

    public function addUser(string $name, string $password, string $mail)
    {
        $user = new User();
        $user->name=$name;
        $user->password=$password;
        $user->email=$mail;
        return $user;
    }


}
