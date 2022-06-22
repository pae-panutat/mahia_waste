<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Biomass extends Authenticatable
{
    use Notifiable;

    protected $table = 'expenses_t1';


}
