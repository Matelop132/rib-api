<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiments extends Model
{
    use HasFactory;

    protected $fillable = [
        'lieu',
        'datepaie',
        'amount',
    ];

}
