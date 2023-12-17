<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'charge_description',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
