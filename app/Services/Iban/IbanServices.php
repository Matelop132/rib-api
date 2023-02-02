<?php

namespace App\Services\Iban;

use App\Services\User\UserService;
use App\Models\Paiment;
use App\Models\User;
use App\Models\Rib;
use Session;

/**
 *
 */
class IbanServices
{


    /**
     * @param int $userId
     * @return Rib
     */
    public function createIban(int $userId)
    {
        $user = new Rib([
            "CodeBanque"=> null ,
            "CodeGuichet"=> null,
            "NumerodeCompte"=>null,
            "CleRIB"=>null,
            "BIC"=>null,
            "user_id"=>$userId,
            "IBAN"=> null
        ]);
        $user->save();
        return $user;
    }

    /**
     * @param string $codebanque
     * @param string $codeguichet
     * @param string $numcompte
     * @param string $clerib
     * @param string $BIC
     * @param int $userId
     * @return mixed
     */
    public function addIban(string $codebanque, string $codeguichet, string $numcompte, string $clerib, string $BIC, int $userId): mixed
    {

        return Rib::where('user_id', $userId)
            ->update(
                [
                    'CodeBanque' => $codebanque,
                    'CodeGuichet' => $codeguichet,
                    'NumerodeCompte' => $numcompte,
                    'CleRIB' => $clerib,
                    'BIC' => $BIC,
                    'IBAN' => $codebanque.$codeguichet.$numcompte.$clerib.$BIC
                ]
            );

    }

    /**
     * @return string
     */
    public function getIban()
    {
        $user = User::where('name', Session('user'))->first();
        $rib = Rib::where('user_id', $user->id)->first();

        return "FR". $rib->CodeBanque . $rib->CodeGuichet . $rib->NUmerodeCompte . $rib->CleRIB;

    }



}
