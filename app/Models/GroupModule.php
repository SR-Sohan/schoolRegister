<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupModule extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'is_active'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
