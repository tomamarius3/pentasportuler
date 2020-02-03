<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{

    protected $table = 'editions';

    protected $fillable = [
        'sport_id',
        'number',
        'active'
    ];

    public function leagues()
    {
        return $this->hasMany(League::class);
    }
}
