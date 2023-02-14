<?php

namespace App\Http\Controllers;

use App\Models\Paiments;
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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */


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

        $lieu=$request->input('lieu');
        $nombre = floatval($request->input('montant'));
        $datepaie=$request->input('datepaiement');
        $this->paimentsService->addCurrentPayment($lieu, $nombre, $datepaie, $user)->save();
        $data = [$request->input('lieu'), $request->input('datepaiement'),$request->input('montant')];


        return view('verification_paiement', ['data' => $data]);
    }
    

    public function depenses(Request $request){
        $this->userId_verification($request->json('userId'));

        $paie = $this->paimentsService->getCurrentPaiement($request->json('userId'), '<');
        return response($paie, ResponseAlias::HTTP_OK);
    }
    public function recettes(Request $request){
        $this->userId_verification($request->json('userId'));
        $paie = $this->paimentsService->getCurrentPaiement($request->json('userId'), '>');

        return response($paie, ResponseAlias::HTTP_OK);
    }

    public function paiements(Request $request){
        $this->userId_verification($request->json('userId'));

        $paie = $this->paimentsService->getCurrentPaiement($request->json('userId'));
        return response($paie, ResponseAlias::HTTP_OK);
    }


    public function userId_verification($userId){
        
        if(gettype($userId) != 'integer'){
            return response('non nombre');
        }

    }


    public function ajout(){
        return "ajout";
    }

    public function retrait(){
        return "retrait";
    }

}