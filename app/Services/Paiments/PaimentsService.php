<?php

namespace App\Services\Paiments;

use App\Models\Payment;
use App\Models\User;

class PaimentsService
{

    
    public function getCurrentPaiement(mixed $paiementId, string $sign = null): string
    {
        if ($sign == null){
            return Payment::where('user_id', $paiementId)->get();
        }

        return Payment::where('user_id', $paiementId)
            -> where('amount', $sign, 0)->get();

    }

     
    
    
    public function replaceCurrentRib(int $userRib): bool
    {
        return User::where('name', Session('user'))
            ->update(['rib' => $userRib]);

    }
    

    public function addCurrentPayment(string $label, float $amount, $date, mixed $rib): bool
    {
        $user = new Payment();
        $user->lieu= $label ;
        $user->amount= $amount;
        $user->datepaie=$date;
        $user->user_id=$rib->id;
        return $user ;
    }
}
