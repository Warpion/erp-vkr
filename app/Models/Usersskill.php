<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usersskill extends Model
{
    protected $table = 'usersskills';
    protected $fillable = [
        'user_id', 'skill_id', 'rating',
    ];

    public function skill()
    {
        return $this->belongsTo('App\Models\Skill');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
