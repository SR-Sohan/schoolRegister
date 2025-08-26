<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassModule extends Model
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

      public function groupModule(): HasMany
    {
        return $this->hasMany(groupModule::class, 'class_id', 'id');
    }

}
