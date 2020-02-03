<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

    protected $table = 'players';

    protected $fillable = [
        'first_name',
        'last_name'
    ];

    public function getFullName()
    {
        return $this->first_name . " " . $this->last_name;
    }

}
