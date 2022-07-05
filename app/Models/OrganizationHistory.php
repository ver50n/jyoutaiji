<?php

namespace App\Models;

use DB;
use Validator;
use Illuminate\Database\Eloquent\Model;

class OrganizationHistory extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'organization_histories';
    public $timestamps = false;
    protected $guarded = [];

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
            $this->save();

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

        if(isset($filters['timeline_tag']) && $filters['timeline_tag'] != "")
            $dp = $dp->where('timeline_tag', 'LIKE', '%'.$filters['timeline_tag'].'%');

        if(isset($filters['event_tag']) && $filters['event_tag'] != "")
            $dp = $dp->where($this->table.'.event_tag', 'LIKE', '%'.$filters['event_tag'].'%');

        $dp = $this->filterIsActive($dp, $filters);
        $dp = $this->filterCreatedAt($dp, $filters);
        $dp = $this->filterUpdatedAt($dp, $filters);
        $dp = $this->sortBy($dp, $options);
        $dp = $this->retrieve($dp, $options);

        return $dp;
    }
}
