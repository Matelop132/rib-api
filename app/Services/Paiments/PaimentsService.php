<?php

namespace App\Services\Paiments;

use App\Models\Paiments;
use App\Models\User;

class PaimentsService
{
    public function getCurrentPaiement(mixed $paiementId): mixed
    {
        return Paiments::where('user_id', $paiementId->id)->get();

    }

    public function replaceCurrentRib(int $userRib): mixed
    {
        return User::where('name', Session('user'))
            ->update(['rib' => $userRib]);

    }

    public function addCurrentPayment(string $label, float $amount, $date, mixed $rib): mixed
    {
        $user = new Paiments();
        $user->lieu= $label ;
        $user->amount= $amount;
        $user->datepaie=$date;
        $user->user_id=$rib->id;
        return $user ;
    }
}
