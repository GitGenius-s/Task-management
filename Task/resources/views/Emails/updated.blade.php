@component('mail::message')
hi {{$data['user_name']}} your task name {{$data['old_task_name']}} is changes to {{$data['task_name']}} 
@endcomponent
