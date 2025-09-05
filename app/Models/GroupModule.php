<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupModule extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'class_id',
        'is_active'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function class()
    {
        return $this->belongsTo(ClassModule::class);
    }

      public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'group_subject')
                    ->withTimestamps();
    }


}
