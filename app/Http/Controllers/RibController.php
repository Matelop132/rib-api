<?php

namespace App\Http\Controllers;

use App\Models\Paiments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;

class RibController extends Controller
{
    public function rib(){
        return new Response("ribcontroller", Response::HTTP_OK);
    }

    public function verification(Request $request){
//        $name = User::all();
//        foreach ($name as $value){
//            if($request['user'] == $value['name'] or $request['mail'] == $value['email']){
//                echo "identifiant déjà pris";
//                return view('welcome' );
//            }
        //};

        $user = User::where('email', $request->input('mail'))->first();
        if ($user){
            return "ce mail existe déjà";
        }
        $user = User::where('name', $request->input('user'))->first();
        if ($user){
            return "ce nom existe déjà";
        }

        $user = new User();
        $user->name=$request->input('user');
        $user->password=$request->input('password');
        $user->email=$request->input('mail');
        $user->save();
        Session::put('user',  $request->input('user'));
        $rib = User::where('rib', $request->input('email'))->first();
        return view('operations', ['data' => $rib] ) ;
    }

    public function api_operations_login(Request $request){
        $user = User::where('email', $request->input('user'))->first();
        $user2 = User::where('name', $request->input('user'))->first();
        if ($user){
            $password = User::where('password', $request->input('password' ))->first();
            if ($password) {
                Session::put('user',  $request->input('user'));
                return view('operations') ;
            }
        } elseif ($user2) {
            $password = User::where('password', $request->input('password' ))->first();
            if ($password) {
                Session::put('user',  $request->input('user'));
                $rib = User::where('name', $request->input('user'))->first();

                return view('operations', ['data' => $rib] ) ;
            }
         }

        echo "erreur de connexion" ;
        return view('login');

    }

    public function api_operations(){
        $rib = User::where('name', Session('user'))->first();
        return view('operations', ['data' => $rib] ) ;
    }

    public function disconnect(){
        Session::put('user', null);
        return view('disconnect');
    }

    public function recettes(){
        $id = User::where('name', Session('user'))->first();
        $paie = Paiments::where('user_id', $id->id)->get();
        return view ('recette', ['paiements' => $paie]);
    }

    public function ajout_paiment(){
        return view('ajout_paiement');
    }

    public function operations_rib(Request $request){
        User::where('name', Session('user'))
            ->update(['rib' => $request->input('rib')]);



        $rib = User::where('name', Session('user'))->first();
        return view('operations', ['data' => $rib]);
    }

    public function verification_paiement(Request $request){
        $user = new Paiments();
        $rib = User::where('name', Session('user'))->first();

        $user->lieu=$request->input('lieu');
        $nombre = floatval($request->input('montant'));
        $user->amount= $nombre;
        $user->datepaie=$request->input('datepaiement');
        $user->user_id=$rib->id;
        $user->save();

        $data = [$request->input('lieu'), $request->input('datepaiement'),$request->input('montant')];


        return view('verification_paiement', ['data' => $data]);
    }


    public function depenses(){
        $id = User::where('name', Session('user'))->first();
        $paie = Paiments::where('user_id', $id->id)->get();
        return view ('depense', ['paiements' => $paie]);
    }

    public function paiements(){
        $id = User::where('name', Session('user'))->first();
        $paie = Paiments::where('user_id', $id->id)->get();
        return view ('paiements', ['paiements' => $paie]);
    }

    public function ajout(){
        return "ajout";
    }

    public function retrait(){
        return "retrait";
    }

    public function welcome(){
        return view("welcome");
    }

    public function login(){
        return view("login");
    }
}
