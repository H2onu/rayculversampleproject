@component('mail::message')
# New Project Notification

{{$user->name }} has submitted a project to the  Spring up 2018 event.

@component('mail::button', ['url' => 'http://psc..com/1/dashboard'])
Administer Projects
@endcomponent

@component('mail::panel' , ['url' =>''])
   # Project Name: {{ $project->project_title }}
    @endcomponent

Thanks,<br>
 Spring up
@endcomponent
