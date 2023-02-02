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

    /**
     * @param string $userEmail
     * @return mixed
     */
    public function getCurrentMail(string $userEmail): mixed
    {
        return User::where('email', $userEmail)->first();

    }

    /**
     * @param string $name
     * @return mixed
     */
    public function addCurrentSessionUser(string $name): mixed
    {
        return Session::put('user', $name);

    }

    /**
     * @param string $password
     * @return mixed
     */
    public function getPasswordUser(string $password): mixed
    {
        return User::where('password', $password)->first();

    }

    /**
     * @param string $name
     * @param string $password
     * @param string $mail
     * @return User
     */
    public function addUser(string $name, string $password, string $mail)
    {
        $user = new User([
            'name'=>$name,
            'password'=>$password,
            'email'=>$mail
           ]);
        $user->save();
        return $user;
    }


}
