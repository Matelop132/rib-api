<?php

namespace App\Services\Iban;

use App\Models\Payment;
use App\Models\User;
use App\Models\Rib;

class Iban
{
    public function addIban(string $codebanque, string $codeguichet, string $numcompte, string $clerib, string $BIC ): array
    {
        $user = new Rib();
        $user->CodeBanque= $codebanque ;
        $user->CodeGuichet= $codeguichet;
        $user->NumerodeCompte=$numcompte;
        $user->CleRIB=$clerib;
        $user->BIC=$BIC;

        return $user ;
    }
}
