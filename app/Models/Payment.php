<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function contract()
    {
        return $this->belongsTo(FreelanceUser::class, 'contract_id');
    }
}
