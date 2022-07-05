<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;
use DB;

class Schedule extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'schedules';
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(\App\Models\ScheduleDetail::Class);
    }

    public function seminarNavigator()
    {
        return $this->belongsTo(\App\Models\User::Class, 'navigator', 'username');
    }

    public function applier()
    {
        return $this->hasMany(\App\Models\ScheduleParticipant::Class, 'schedule_uniq', 'uniq')->where('is_approved', 0);
    }

    public function participant()
    {
        return $this->hasMany(\App\Models\ScheduleParticipant::Class, 'schedule_uniq', 'uniq')->where('is_approved', 1);
    }

    public static function loadSchedule($filters)
    {
        $data = [];
        $dp = new Schedule();

        $type = 'customer';
        if(!empty($filters['type']) && $filters['type'] !== '')
            $type = $filters['type'];
        $dp = $dp->where('type','=',$type);

        if(!empty($filters['category']) && $filters['category'] !== '')
            $dp = $dp->where('category','=',$filters['category']);
        
        /*if(!empty($filters['is_for_member_only']) && $filters['is_for_member_only'] !== '') {
            $dp = $dp->whereIn('is_for_member_only',$filters['is_for_member_only']);
        }*/

        if((!empty($filters['start']) && $filters['start'] !== '')
            || (!empty($filters['end']) && $filters['end'] !== '')) {
            if((!empty($filters['start']) && $filters['start'] !== '')
                && (!empty($filters['end']) && $filters['end'] !== '')) {
                $dp = $dp->whereBetween('start_at', [$filters['start'], $filters['end']]);
            } else if ((!empty($filters['start']) && $filters['start'] !== '')
                && (empty($filters['end']) && $filters['end'] == '')) {
                $dp = $this->where('start_at', '>=', $filters['start']);
            } else if ((empty($filters['start']) && $filters['start'] == '')
                && (!empty($filters['end']) && $filters['end'] !== '')) {
                $dp = $dp->where('start_at', '<=', $filters['end']);
            }
        }
        
        $schedules = $dp->where('is_active', 1)->get()->toArray();
        $data = $schedules;

        return $schedules;
    }

    public static function formatFullCalendar($data, $allDay = true)
    {
        $return = [];
        foreach($data as $each) {
            $eventStartTime = date('H:i', strtotime($each['start_at']));
            $temp = [
                'eventId' => $each['id'],
                'title' => $eventStartTime.'-'.$each['name'],
                'start' => $each['start_at'],
                'end' => $each['end_at'],
                'allDay' => $allDay,
            ];

            if(isset($each['category']))
                $temp['backgroundColor'] = \App\Helpers\ApplicationConstant::SCHEDULE_BACKGROUND[$each['category']];

            $return[] = $temp;
        }

        return $return;
    }

    public function isAllowedToApply()
    {
        return true;
        if(strtotime($this->start_at) < strtotime(date("Y-m-d H:i:s")))
            return 'schedule-application-date-is-end';

        $application_closing_date = strtotime('-1 day', strtotime(date("Y-m-d", strtotime($this->start_at))));
        if(strtotime(date("Y-m-d H:i:s")) >= $application_closing_date)
            return 'schedule-application-date-is-end';
        
        if($this->participant_limit != 0 && count($this->participant) >= $this->participant_limit)
            return 'schedule-application-reach-limit';


        if(!$this->is_for_member_only) return true;
        else {
            if(!\Auth::check()) return 'only-member-is-allowed-to-apply';
            if(\Auth::user()->name) {
                $schedule_participant = ScheduleParticipant::where([
                    'schedule_uniq' => $this->uniq,
                    'user_slug' => \Auth::user()->slug
                ])->first();

                if($schedule_participant) return 'you-have-applied';
            }
        }

        return 'schedule-application-error';
    }

    public function apply($data)
    {
        $applyValidation = $this->isAllowedToApply();
        if($applyValidation !== true)
            return $applyValidation;
        
        $scheduleParticipant = new ScheduleParticipant();
        $scheduleParticipant->fill($data);
        if(\Auth::check()) {
            $scheduleParticipant->name = \Auth::user()->name;
            $scheduleParticipant->user_slug = \Auth::user()->slug;
        }
        $scheduleParticipant->schedule_uniq = $this->uniq;
        $scheduleParticipant->is_approved = ($this->is_auto_approve == 1);
        $scheduleParticipant->save();

        return true;
    }

    public function register($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails())
                return $validator;

            $this->fill($data);
            $this->uniq = uniqid();
            if($this->poster) {
                $fullPath = \App\Utils\FileUtil::upload('schedule_poster', $this->poster, $this->uniq);
                $this->poster = $fullPath;
            }
            if($this->schedule_qr) {
                $fullPath = \App\Utils\FileUtil::upload('schedule_qr', $this->schedule_qr, $this->uniq);
                $this->schedule_qr = $fullPath;
            }
            $this->save();

            $type = "add_schedule";
            $replacement = [
                'schedule_name' => $this->name,
                'schedule_desc' => $this->short_desc,
                'schedule_link' => route('pages.schedule-detail', ['id' => $this->id]),
            ];

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('password', $e->getMessage());
        }
    }

    public function edit($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails()) {
                return $validator;
            }

            $this->fill($data);
            if ($this->isDirty('poster')) {
                $fullPath = \App\Utils\FileUtil::upload('schedule_poster', $this->poster, $this->uniq);
                $this->poster = $fullPath;
            }
            if ($this->isDirty('schedule_qr')) {
                $fullPath = \App\Utils\FileUtil::upload('schedule_qr', $this->schedule_qr, $this->uniq);
                $this->schedule_qr = $fullPath;
            }
            $this->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('password', $e->getMessage());
        }
    }

    public function filter($filters, $options = [])
    {
        $dp = $this;
        $dp = $dp->filterId($dp, $filters);

        if(isset($filters['name']) && $filters['name'] != "")
            $dp = $dp->where('name', 'LIKE', '%'.$filters['name'].'%');
        if(isset($filters['type']) && $filters['type'] != "")
            $dp = $dp->where('type', $filters['type']);
        if(isset($filters['category']) && $filters['category'] != "")
            $dp = $dp->where('category', $filters['category']);

        if((!empty($filters['start_at_start']) && $filters['start_at_start'] !== '')
            || (!empty($filters['start_at_end']) && $filters['start_at_end'] !== '')) {
            if((!empty($filters['start_at_start']) && $filters['start_at_start'] !== '')
                && (!empty($filters['start_at_end']) && $filters['start_at_end'] !== '')) {
                $dp = $dp->whereBetween($this->table.'.start_at', [$filters['start_at_start'], $filters['start_at_end']]);
            } else if ((!empty($filters['start_at_start']) && $filters['start_at_start'] !== '')
                && (empty($filters['start_at_end']) && $filters['start_at_end'] == '')) {
                $dp = $this->where($this->table.'.start_at', '>=', $filters['start_at_start']);
            } else if ((empty($filters['start_at_start']) && $filters['start_at_start'] == '')
                && (!empty($filters['start_at_end']) && $filters['start_at_end'] !== '')) {
                $dp = $dp->where($this->table.'.start_at', '<=', $filters['start_at_end']);
            }
        }

        $dp = $this->filterIsActive($dp, $filters);
        $dp = $this->filterCreatedAt($dp, $filters);
        $dp = $this->filterUpdatedAt($dp, $filters);
        $dp = $this->sortBy($dp, $options);
        $dp = $this->retrieve($dp, $options);

        return $dp;
    }


    public function sendNotification($type, $replacement)
    {
        $broadcast = Broadcast::where(['name' => $type])->first();
        $contain = \App\Utils\StringUtil::replaceTemplateVariable($broadcast->contain, $replacement);

        Broadcast::sendBroadcast($contain);
    }
}
