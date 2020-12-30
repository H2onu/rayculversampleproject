@component('mail::message')

#THIS IS YOUR GENERAL SUPPLY VOUCHER

@component('mail::button', ['url' => 'http://psc..com'])
Login to PSC Website Projects
@endcomponent
<h2>
PLEASE PRINT THIS PAGE AND PRESENT IT TO THE STREETS DEPARTMENT STAFF WHEN YOU PICKUP YOUR PROJECT SUPPLIES.
<br>
<br>
YOU MUST PRESENT THIS VOUCHER TO RECEIVE YOUR SUPPLIES - NO EXCEPTIONS.
</h2>
<br>
@component('mail::panel' , ['url' =>''])
# REDEMPTION DETAILS:
<br>
# PSC Voucher: {{ $project->project_title }}
<h1>PROJECT #: {{ $project->pin }}</h1>
<br>
#  SUPPLY PICKUP LOCATION
{{ $event->supplyPickupLocation }}
<br>
# DATES & TIMES
{{ $event->supplyPickupLocationDates }}
@endcomponent

Thanks,<br>
 Spring up
@endcomponent
