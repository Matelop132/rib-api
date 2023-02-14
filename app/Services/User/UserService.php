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
    public function getCurrentUser(string $userId): string
    {
        return User::where('name', $userId)->first();

    }

    /**
     * @param string $userEmail
     * @return mixed
     */
    public function getCurrentMail(string $userEmail): string
    {
        return User::where('email', $userEmail)->first();

    }

    /**
     * @param string $name
     * @return mixed
     */
    public function addCurrentSessionUser(string $name): string
    {
        $nom = Session::put('user', $name);
        return $nom;

    }

    /**
     * @param string $password
     * @return mixed
     */
    public function getPasswordUser(string $password): string
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
