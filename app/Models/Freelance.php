<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Freelance extends Model
{
    /** @use HasFactory<\Database\Factories\FreelanceFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function applicants(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(FreelanceUser::class)->withPivot(['status', 'start_date', 'end_date', 'final_salary'])->withTimestamps();
    }
}
