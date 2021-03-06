<?php

namespace App\Models;

use Validator;
use session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Admin extends Authenticatable
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'admins';
    protected $guarded = [];

    public function register($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'name' => 'required',
                'password' => 'required|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'required'
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails()) {
                dd($validator);
                return $validator;
            }

            $this->username = $data['username'];
            $this->name = $data['name'];
            $this->password = bcrypt($data['password']);
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
                'name' => 'required',
                'password' => 'required_with:confirm_password|same:confirm_password',
                'confirm_password' => ''
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails()) {
                return $validator;
            }

            $this->username = $data['username'];
            $this->name = $data['name'];
            if( $data['password'])
                $this->password = bcrypt($data['password']);
            
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

    public function resetPassword()
    {
        $this->password = bcrypt('admin123');
        $this->save();

        return true;
    }

    public function changePassword($data)
    {
        $validator = null;
        DB::beginTransaction();

        try {
            $rules = [
                'password' => 'required|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'required'
            ];

            $validator = Validator::make($data, $rules);
            if($validator->fails())
                return $validator;

            $this->password = bcrypt($data['password']);
            $this->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return $validator->getMessageBag()->add('password', $e->getMessage());
        }
    }
}
