@component('mail::message')

# Your {{$project->project_title}} Project Has Been Declined

Thank you {{ $owner->name }}, for your interest in keeping  ...
<br>
Unfortunately your project has been declined for one of the following reasons:
<br>
1. The project location is on private property
2. incomplete or partial project submittal form
3. No supply request specified
4. Project location is outside of city limits
5. Duplicate project entry
6. other
<br>
<br>
@component('mail::panel' , ['url' =>''])
        Please login to your  Spring up account, edit your project, and click the "Resubmit" button.
@endcomponent
@component('mail::button', ['url' => 'http://psc..com'])
        Click here to login
@endcomponent
@component('mail::panel', ['url' => ''])
        Project {{$project->project_title}} Has Been Declined.
@endcomponent

Thanks,<br>
    {{ config('app.name') }}
@endcomponent
