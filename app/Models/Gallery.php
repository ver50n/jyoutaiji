<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;
use DB;

class Gallery extends Model
{
    use \App\Traits\DataProviderTrait, \App\Traits\RelationTrait;
    public $table = 'galleries';
    protected $guarded = [];

    public function galleryCategory()
    {
        return $this->belongsTo(\App\Models\GalleryCategory::Class, 'category_cd', 'category');
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
            if($this->thumbnail) {
                $name = $this->category.'_'.time();
                $fileName = \App\Utils\FileUtil::upload('gallery_thumbnail', $this->thumbnail, $name);
                $this->thumbnail = $fileName;
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
            if ($this->isDirty('thumbnail')) {
                $fullPath = \App\Utils\FileUtil::upload('gallery_thumbnail', $this->thumbnail);
                $this->thumbnail = $fullPath;
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

        if(isset($filters['title']) && $filters['title'] != "")
            $dp = $dp->where('title', 'LIKE', '%'.$filters['title'].'%');

        if(isset($filters['category']) && $filters['category'] != "")
            $dp = $dp->where($this->table.'.category', 'LIKE', '%'.$filters['category'].'%');

        if(isset($filters['is_slider']) && $filters['is_slider'] != "")
            $dp = $dp->where($this->table.'.is_slider', $filters['is_slider']);

        $dp = $this->filterIsActive($dp, $filters);
        $dp = $this->filterCreatedAt($dp, $filters);
        $dp = $this->filterUpdatedAt($dp, $filters);
        $dp = $this->sortBy($dp, $options);
        $dp = $this->retrieve($dp, $options);

        return $dp;
    }
}
