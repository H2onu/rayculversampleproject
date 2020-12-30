<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

@component('mail::message')

# Your {{$project->project_title}} Project Has Been Approved

Thank you {{ $owner->name }}, for keeping  ...Your project has been approved.
<br>
<br>
We have {{$owner->primary_contact_fname ,  $owner->primary_contact_lname}} on record as being the primary contact for this project.
<br>
<br>
If this information is incorrect you may login to your  Spring up account at any time to make changes.
<br>
@component('mail::panel' , ['url' =>''])
        Be on the lookout for your project voucher the week of March 26th. All supply pickups require a project voucher.
@endcomponent

@component('mail::button', ['url' => 'http://psc..com/'])
        Click here to login
@endcomponent

@component('mail::panel', ['url' => ''])
        Project {{$project->project_title}} Has Been Approved.
@endcomponent
<?php echo $social; ?>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
