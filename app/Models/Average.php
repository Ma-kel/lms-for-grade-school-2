<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Average extends Model
{
    protected $fillable = [
        'general_average',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
