<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'code', 'is_optional', 'user_id',];

    public function groups()
    {
        return $this->belongsToMany(
            GroupModule::class, // related model
            'group_subject',    // pivot table
            'subject_id',       // foreign key on pivot table referencing this model
            'group_id'          // foreign key on pivot table referencing related model
        )->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
