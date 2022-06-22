<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class WashAirSuggestion extends Authenticatable
{
    use Notifiable;

    protected $table = 'smart_wash_air_con.suggestion';


}
