<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ReportYearDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'smart_wash_air_con.report_year_detail';


}
