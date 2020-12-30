<div class="row">

    <h3>General Project Details</h3>

    <hr>

    @if($form != 'shortForm')
        <h4>**Examples of private property are parking lots, inside homes, businesses, etc.</h4>
        {!! Form::label('private_property', 'Is this on Private Property?', ['class' => 'control-label']) !!}

        <br>

        <span>Yes {!! Form::radio('private_property', 'Yes' , '' ,  array('data-toggle' => 'collapse' , 'data-target' => '#privateProperty' , 'href' => '#privateProperty' , 'aria-controls' => "privateProperty")) !!}</span>

        <br>

        <span>No {!! Form::radio('private_property', 'No' , true , array('data-toggle' => 'collapse' , 'data-target' => '#privateProperty' , 'href' => '#privateProperty' , 'aria-controls' => "privateProperty")) !!}</span>

        <br>
        <div class="collapse" id="privateProperty">
            <div id="private_property" class="alert-danger">

                Thank you for your interest, but the PSC event does not support events on private property.

            </div>
        </div>
        <hr>

    @endif

    {!! Form::label('project_title', 'Project Title *', ['class' => 'control-label']) !!}

    <br>

    {!! Form::text('project_title', null , ['class' => 'form-control' , 'placeholder' => 'Project Title' ] )  !!}

    <br>

    @if($form != 'shortForm')

        {!! Form::label('park_rec_fac', 'My project is taking place at a park and/or recreation facility. *', ['class' => 'control-label']) !!}

        {!! Form::hidden('park_rec_fac', '0') !!}
        {!! Form::checkbox('park_rec_fac', '1', null,   ['id' => 'park_rec_fac']) !!}

        <br>

        {!! Form::label('comm_cdc_group', 'My project is organized by a community group or CDC. *', ['class' => 'control-label']) !!}
        {!! Form::hidden('comm_cdc_group', '0') !!}
        {!! Form::checkbox('comm_cdc_group', '1', null ,  ['id' => 'comm_cdc_group']) !!}

        <br>

        {!! Form::label('comm_cdc_group_name', 'If you checked above, please enter the name of the park, recreation center, or community group *', ['class' => 'control-label']) !!}
        {!! Form::text('comm_cdc_group_name', null , ['class' => 'form-control' , 'placeholder' => 'Park Or Recreation Center Name'])  !!}

        <br>

    @endif

    {!! Form::label('proj_description' , 'Enter a brief project description.' , ['class' =>'control-label']) !!}
    {!! Form::textarea('proj_description', null, ['class' => 'form-control' , 'placeholder' => 'Project Description' , 'maxlength' => '200', 'rows' => '3' , 'required' => 'required']) !!}

    <br>

    @if($form == 'shortForm')

        {!! Form::label('rally_supplies', 'Does this project require supplies?', ['class' => 'control-label']) !!}

        {!! Form::checkbox('rally_supplies', 'yes', null ,  ['id' => 'rally_supplies']) !!}

    @endif

    @if($events->allowLogoUpload == 1)
        {!! Form::label('logo', 'Logo Upload', ['class' => 'control-label']) !!}
        <div id="imagePreview" style="display:none"></div>
        <input id="uploadFile" type="file" name="image" class="img"/>
        <hr>

        @if(!empty($project['imagePath']))
            {{ Form::image('images/project/thumbnails/thumb-'.$project['imagePath']) }}
        @endif

    @endif

</div>

@if($form != 'shortForm')

    <div class="row">

        <h3>Volunteer Details</h3>

        <hr>

        {!! Form::label('volunteers_requested', 'Total Number of Volunteers Requested/Projected *', ['class' => 'control-label']) !!}

        <br>

        <span>This includes yourself and any volunteers you can identify at the time of submitting this form.
          <br>Please note, your project will no longer be available to accept volunteers once your requested number of volunteers is reached.
</span>

        {!! Form::text('volunteers_requested', null , ['class' => 'form-control' , 'placeholder' => '# of Requested Volunteers' , 'required' => 'required'])  !!}

    </div>

@endif

<hr>

<div class="row">

    <h3>Project Location & Refuse Collection Details</h3>

    <hr>

    <span>This is the physical location of the project. It will also serve as the location where collected waste and litter should be left for city collection.</span>

    <br>
    <br>

    {!! Form::label('neighborhood', 'Neighborhood', ['class' => 'control-label']) !!}

    {!! Form::select('neighborhood', $neighborhood, null, ['id' => 'neighborhood' ] ) !!}

    <br>
    <br>

    {!! Form::label('proj_loc_name', 'Project Location Name', ['class' => 'control-label']) !!}

    <br>

    {!! Form::text('proj_loc_name', null , ['class' => 'form-control', 'placeholder' => 'Project Location Name', 'required' => 'required'])  !!}

    <br>

    {!! Form::label('proj_loc_street_address', 'Project Location Street Address', ['class' => 'control-label']) !!}

    <br>

    {!! Form::text('proj_loc_street_address', null , ['class' => 'form-control', 'placeholder' => 'Project Location Street Address', 'required' => 'required'])  !!}

    <br>

    {!! Form::label('proj_loc_zip', 'Project Location Zip Code', ['class' => 'control-label']) !!}

    <br>

    {!! Form::text('proj_loc_zip', null , ['class' => 'form-control' , 'placeholder' => 'Project Location Zip', 'required' => 'required'])  !!}

    <br>

    @if($form == 'shortForm')
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control addProject']) !!}
    @endif

</div>

