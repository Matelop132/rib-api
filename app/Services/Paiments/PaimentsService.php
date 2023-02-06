<?php

namespace App\Services\Paiments;

use App\Models\Paiment;
use App\Models\User;

class PaimentsService
{
    public function getCurrentPaiement(mixed $paiementId, mixed $sign = null): mixed
    {
        if ($sign == null){
            return Paiment::where('user_id', $paiementId)->get();
        }
        return Paiment::where('user_id', $paiementId)
            -> where('amount', $sign, 0)->get();

    }


    public function replaceCurrentRib(int $userRib): mixed
    {
        return User::where('name', Session('user'))
            ->update(['rib' => $userRib]);

    }

    public function addCurrentPayment(string $label, float $amount, $date, mixed $rib): mixed
    {
        $user = new Paiment();
        $user->lieu= $label ;
        $user->amount= $amount;
        $user->datepaie=$date;
        $user->user_id=$rib->id;
        return $user ;
    }
}
