<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $table='tasks';
    protected $primaryKey='task_id';
    protected $fillable = [
        'parent_id', // Add parent_id to the fillable array
        'task_name',
        'created_date',
        'due_date',
    ];
    
    public function subtasks()
    {
        return $this->hasMany(Task::class, 'parent_id', 'task_id');
    }
}
