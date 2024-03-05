<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insights extends Model
{
    public $table='insights';
    protected $guarded=[];
    public static function present($id)
    {
         $data=self::where('user_id',$id)->first();
         if($data==null)
         {
            $insight=new Insights();
            $insight->user_id=$id;
            $insight->no_of_task=1;
            $insight->incompleted_task=1;
            $insight->save();
         }else{
            $data->increment('no_of_task');
            $data->increment('incompleted_task');
         }
    }
     public static function change($user_id)
     {
      $insights=Insights::where('user_id',$user_id)->first();
      // dd($insights->weekly_completed);
      if($insights->weekly_completed==null)
      {
          Insights::where('user_id', $user_id)
                  ->update(['weekly_completed' => "1", 'quartly_completed' => "1", 'monthly_completed' => "1"]);
      }else{
          Insights::where('user_id', $user_id)->increment('weekly_completed');
          Insights::where('user_id', $user_id)->increment('quartly_completed');
          Insights::where('user_id', $user_id)->increment('monthly_completed');
      }
          Insights::where('user_id', $user_id)->decrement('no_of_task');
          Insights::where('user_id', $user_id)->decrement('incompleted_task');
     }

}
