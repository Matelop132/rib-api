<?php

namespace App\Http\Controllers;

use App\Services\Iban\IbanServices;

use Illuminate\Http\Request;
use App\Models\Paiment;
use App\Models\User;
use App\Services\Paiments\PaimentsService;
use App\Services\User\UserService;
use Illuminate\Http\Response;

class IbanController extends Controller
{
    public function __construct(protected IbanServices $ibanService, protected UserService $userService)
    {
    }
    public function iban()
    {

        $Iban=$this->ibanService->getIban();
        return view('iban', ['data' => $Iban]);
    }

    public function iban_verifified(Request $request)
    {
        $bank=str($request->input('CodeBanque'));
        $code=str($request->input('CodeGuichet'));
        $numaccount=str($request->input('NumCompte'));
        $key=str($request->input('CleIB'));
        $BIC=str($request->input('BIC'));
        $user = $this->userService->getCurrentUser(Session('user'));
        $this->ibanService->addIban($bank, $code, $numaccount, $key, $BIC, $user->id);
        $Iban = $this->ibanService->getIban();
        return view('iban', ['data' => $Iban]);
    }
}

