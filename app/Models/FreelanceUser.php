<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FreelanceUser extends Pivot
{
    /** @use HasFactory<\Database\Factories\FreelanceUserFactory> */
    use HasFactory;
    protected $guarded = ['id'];
}
