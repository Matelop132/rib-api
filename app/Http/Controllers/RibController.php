<?php

namespace App\Http\Controllers;

use App\Models\Paiment;
use App\Models\User;
use App\Services\Paiments\PaimentsService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;



class RibController extends Controller
{
    public function __construct(protected UserService $userService, protected PaimentsService $paimentsService)
    {
    }

    public function rib(){
        return new Response("ribcontroller", Response::HTTP_OK);
    }



    public function disconnect(){
        Session::put('user', null);
        return view('disconnect');
    }

    public function recettes(){
        $user = $this->userService->getCurrentUser(Session('user'));
        $payement = $this->paimentsService->getCurrentPaiement($user);
        return view ('recette', ['paiements' => $payement]);
    }

    public function ajout_paiment(){
        return view('ajout_paiement');
    }

    public function operations_rib(Request $request){
        $this->paimentsService->replaceCurrentRib($request->input('rib'));
        $rib = $this->userService->getCurrentUser(Session('user'));
        return view('operations', ['data' => $rib]);
    }

    public function verification_paiement(Request $request){

        $user = $this->userService->getCurrentUser(Session('user'));

        $label=$request->input('lieu');
        $amount = floatval($request->input('montant'));
        $payment=$request->input('datepaiement');

        $this->paimentsService->addCurrentPayment($label, $amount, $payment, $user);
        $data = [$request->input('lieu'), $request->input('datepaiement'),$request->input('montant')];


        return view('verification_paiement', ['data' => $data]);
    }


    public function depenses(){
        $user = $this->userService->getCurrentUser(Session('user'));
        $payment = $this->paimentsService->getCurrentPaiement($user);
        return view ('depense', ['paiements' => $payment]);
    }

    public function paiements(){
        $user = $this->userService->getCurrentUser(Session('user'));
        $payment = $this->paimentsService->getCurrentPaiement($user);
        return view ('paiements', ['paiements' => $payment]);
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


}
