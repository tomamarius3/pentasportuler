<?php

namespace App\Models;

use App\ActiveScope;

class ActiveEdition extends Edition
{

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActiveScope());
    }

}
