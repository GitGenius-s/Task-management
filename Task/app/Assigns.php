<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Assigns extends Model
{
    protected $guarded=[];
    public function task()
    {
        return $this->belongsToMany(Task::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public static function change($user_id,$task_id)
    {
        $assign=self::where('user_id',$user_id)->where('task_id',$task_id)->first();
        if($assign)
        {
            if($assign->status==0)
            {
                Assigns::where('user_id',$user_id)
                ->where('task_id',$task_id)
                ->update(['completed_date' => Carbon::now(),'status' => "1"]);
                Insights::change($user_id);
            }
        }
    }
}
