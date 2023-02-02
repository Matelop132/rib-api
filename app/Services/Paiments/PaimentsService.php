<?php

namespace App\Services\Paiments;

use App\Models\Paiment;
use App\Models\User;

/**
 *
 */
class PaimentsService
{
    /**
     * @param mixed $paiementId
     * @return Paiements|null
     */
    public function getCurrentPaiement(mixed $paiementId): Paiements | null
    {
        return Paiment::where('user_id', $paiementId->id)->get();

    }

    /**
     * @param int $userRib
     * @return bool
     */
    public function replaceCurrentRib(int $userRib): bool
    {
        return User::where('name', Session('user'))
            ->update(['rib' => $userRib]);

    }


    /**
     * @param string $label
     * @param float $amount
     * @param $date
     * @param mixed $rib
     * @return Paiments
     */

    public function addCurrentPayment(string $label, float $amount, $date, mixed $rib) : Paiments
    {
        $payment = new Paiment([
            "lieu"=> $label ,
            "amount"=> $amount,
            "datepaie"=>$date,
            "user_i"=>$rib->id
            ]
        );
        $payment->save();
        return $payment ;
    }
}
