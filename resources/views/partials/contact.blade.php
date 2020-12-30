<div class="row">

    <h3>Primary Contact</h3>

    <hr>

    <span>This will become the PRIMARY contact information to be used for all communication regarding this project.</span>

    <br>

    {!! Form::label('primary_contact_fname', 'First Name', ['class' => 'control-label']) !!}

    <br>

    {!! Form::text('primary_contact_fname', null, ['class' => 'form-control', 'placeholder' => 'Primary Contact First Name', 'required' => 'required'])  !!}

    <br>

    {!! Form::label('primary_contact_lname', 'Last Name', ['class' => 'control-label']) !!}

    <br>

    {!! Form::text('primary_contact_lname', null , ['class' => 'form-control' , 'placeholder' => 'Primary Contact Last Name', 'required' => 'required'])  !!}


    <br>

    {!! Form::label('primary_contact_email', 'Email', ['class' => 'control-label']) !!}

    <br>

    {!! Form::text('primary_contact_email', null , ['class' => 'form-control', 'placeholder' => 'Primary Contact Email Address', 'required' => 'required'])  !!}

    <br>

    {!! Form::label('primary_contact_phone', 'Primary Contact Phone Number', ['class' => 'control-label']) !!}

    <br>

    {!! Form::text('primary_contact_phone', null , ['class' => 'form-control', 'placeholder' => 'Primary Contact Phone Number', 'required' => 'required'])  !!}

    <br>

    {!! Form::label('blockCaptain', 'Is The Primary Contact a Block Captain?', ['class' => 'control-label']) !!}

    <br>

    @if($form != 'shortForm')

        <span>Yes {!! Form::radio('blockCaptain' , "Yes" , '', array('data-toggle' => 'collapse' , 'data-target' => '#block_captain' , 'href' => '#block_captain' , 'aria-controls' => "block_captain")) !!}</span>

        <span>No {!! Form::radio('blockCaptain' , "No" , 'true' , array('data-toggle' => 'collapse' , 'data-target' => '#block_captain' , 'href' => '#block_captain' , 'aria-controls' => "block_captain")) !!}</span>

    @elseif($form == 'shortForm')

        <span>Yes {!! Form::radio('blockCaptain' , "Yes" , 'true', array('data-toggle' => 'collapse' , 'data-target' => '#block_captain' , 'href' => '#block_captain' , 'aria-controls' => "block_captain")) !!}</span>

        <span>No {!! Form::radio('blockCaptain' , "No" , '' , array('data-toggle' => 'collapse' , 'data-target' => '#block_captain' , 'href' => '#block_captain' , 'aria-controls' => "block_captain")) !!}</span>

    @endif

</div>

<div class="collapse" id="block_captain">

    <div id="block_Captain" class="alert-danger">

        Note: All Block Captains will be required to show their block captain ID card upon supply pickup.

    </div>

</div>

<hr>

@if($form != 'shortForm')

    <div class="row">

        <h3>Alternate Contact Details</h3>

        <span>Although the primary method for communication about this project will be conducted through the above PRIMARY CONTACT fields, you can optionally
                add an additional person of contact. All communication about this project will go to both the Primary Contact and this Secondary Contact. </span>

        <br>
        <br>

        {!! Form::label('alternate_contact_fname', 'Alternate Contact First Name', ['class' => 'control-label']) !!}

        <br>

        {!! Form::text('alternate_contact_fname', null, ['class' => 'form-control', 'placeholder' => "Alternate Contact First Name"])  !!}

        <br>

        {!! Form::label('alternate_contact_lname', 'Alternate Contact Last Name', ['class' => 'control-label']) !!}

        <br>

        {!! Form::text('alternate_contact_lname', null, ['class' => 'form-control' , 'placeholder' => 'Alternate Contact Last Name'])  !!}


        <br>

        {!! Form::label('alternate_contact_email', 'Alternate Contact Email', ['class' => 'control-label']) !!}

        <br>

        {!! Form::text('alternate_contact_email', null, ['class' => 'form-control', 'placeholder' => 'Alternate Contact Email Address'])  !!}

        <br>


        {!! Form::label('alternate_contact_phone', 'Alternate Contact Phone Number', ['class' => 'control-label']) !!}

        <br>

        {!! Form::text('alternate_contact_phone', null, ['class' => 'form-control', 'placeholder' => 'Alternate Contact Phone Number'])  !!}

        <br>

    </div>

@endif
