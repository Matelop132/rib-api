<?php

namespace App\Http\Controllers;

use App\Services\Paiments\PaimentsService;
use App\Services\User\UserService;
use App\Services\Iban\IbanServices;
use Session;
use App\Models\User;
use Illuminate\Http\Request;

class UserAuth extends Controller
{
    public function __construct(protected IbanServices $ibanServices, protected UserService $userService, protected PaimentsService $paimentsService)
    {
    }
    function userLogin(Request $request)
    {
        $this->userService->addCurrentSessionUser($request->input('user'));

        return view('operations');
    }

    public function verification(Request $request){
//        $name = User::all();
//        foreach ($name as $value){
//            if($request['user'] == $value['name'] or $request['mail'] == $value['email']){
//                echo "identifiant déjà pris";
//                return view('welcome' );
//            }
        //};
        if ($request->input('password') == null){
            echo 'mot de passe incorrect';
            return view('welcome');
        }
        if ($request->input('user') == null){
            echo 'identifiant incorrect';
            return view('welcome');
        }
        if ($request->input('mail') == null){
            echo 'email incorrect';
            return view('welcome');
        }
        $user = $this->userService->getCurrentMail($request->input('mail'));
        if ($user){
            return "ce mail existe déjà";
        }
        $user = $this->userService->getCurrentUser($request->input('user'));
        if ($user){
            return "ce nom existe déjà";
        }

        $name =$request->input('user');
        $password =$request->input('password');
        $mail =$request->input('mail');
        $this->userService->addUser($name, $password, $mail);
        $this->userService->addCurrentSessionUser($request->input('user'));
        $user = $this->userService->getCurrentUser(Session('user'));
        $this->ibanServices->createIban($user->id);


        return view('operations', ['data' => $user] ) ;
    }

    public function api_operations_login(Request $request){
        if ($request->input('password') == null){
            echo 'mot de passe incorrect';
            return view('login');
        }
        if ($request->input('user') == null){
            echo 'identifiant incorrect';
            return view('login');
        }
        $user2 = $this->userService->getCurrentUser($request->input('user'));
        $user = $this->userService->getCurrentMail($request->input('user' ));
        $password = $this->userService->getPasswordUser($request->input('password' ));
        if ($user){
            if ($password) {
                $this->userService->addCurrentSessionUser($request->input('user'));
                return view('operations') ;
            }
        } elseif ($user2) {
            if ($password) {
                $this->userService->addCurrentSessionUser($request->input('user'));
                $rib = $this->userService->getCurrentUser($request->input('user'));

                return view('operations', ['data' => $rib] ) ;
            }
        }

        echo "erreur de connexion" ;
        return view('login');

    }

    public function api_operations(){
        $user = $this->userService->getCurrentUser(Session('user'));
        return view('operations', ['data' => $user] ) ;
    }

    public function login(){
        return view("login");
    }

}
