<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray($request)
    {
        return[
            'task_id'=> $this->task_id,
            'task_name'=>$this->task_name,
            'assign_date'=>$this->whenPivotLoaded('assigns',function(){
                return $this->pivot->assign_date;
            }),
        ];  
    }
}
