<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;
use DB;

class Contact extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'contacts';
    protected $guarded = [];

    public function register($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => '',
                'content' => 'required'
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

    public function filter($filters, $options = [])
    {
        $dp = $this;
        $dp = $dp->filterId($dp, $filters);

        if(isset($filters['name']) && $filters['name'] != "")
            $dp = $dp->where('name', 'LIKE', '%'.$filters['name'].'%');

        if(isset($filters['email']) && $filters['email'] != "")
            $dp = $dp->where($this->table.'.email', 'LIKE', '%'.$filters['email'].'%');

        $dp = $this->filterIsActive($dp, $filters);
        $dp = $this->filterCreatedAt($dp, $filters);
        $dp = $this->filterUpdatedAt($dp, $filters);
        $dp = $this->sortBy($dp, $options);
        $dp = $this->retrieve($dp, $options);

        return $dp;
    }
}
