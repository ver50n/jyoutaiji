<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;

class ScheduleParticipant extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'schedule_participants';
    protected $guarded = [];

    public function schedule()
    {
        return $this->belongsTo(\App\Models\Schedule::Class, 'schedule_uniq', 'uniq');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::Class, 'user_slug', 'slug');
    }

    public function approve()
    {
        $this->is_approved = 1;
        $this->save();

        return true;
    }

    public function reject()
    {
        // $this->is_approved = 0;
        $this->delete();

        return true;
    }
}
