<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;

class ScheduleDetail extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'schedule_details';
    public $timestamps = false;

    public function schedule()
    {
        return $this->belongsTo(\App\Models\Schedule::Class);
    }
}
