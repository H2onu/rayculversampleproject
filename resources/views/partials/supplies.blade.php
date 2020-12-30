<div class="row">

    <h3>REQUESTED SUPPLIES</h3>

    <hr>

    <span>Please check the requested items below. Note that quantities and availability are subject to demand and Streets Department discretion.</span>

    <br>

    {!! Form::label('Bags', 'Bags', ['class' => 'control-label']) !!}
    {!! Form::checkbox('bags', '1', null,  ['id' => 'bags']) !!}

    <br>

    {!! Form::label('gloves', 'Gloves', ['class' => 'control-label']) !!}
    {!! Form::checkbox('gloves', '1', null,  ['id' => 'gloves']) !!}

    <br>

    {!! Form::label('brooms', 'Brooms', ['class' => 'control-label']) !!}
    {!! Form::checkbox('brooms', '1', null,  ['id' => 'Brooms']) !!}

    <br>

    {!! Form::label('rakes', 'Rakes', ['class' => 'control-label']) !!}
    {!! Form::checkbox('rakes', '1', null,  ['id' => 'rakes']) !!}

    <br>

    {!! Form::label('shovels', 'Shovels', ['class' => 'control-label']) !!}
    {!! Form::checkbox('shovels', '1', null,  ['id' => 'shovels']) !!}

    <br>

    {{--{!! Form::label('paint', 'Paint', ['class' => 'control-label']) !!}--}}
    {{--{!! Form::checkbox('paint', '1', null,  ['id' => 'paint']) !!}--}}

    <hr>

    {{--Note: Projects taking place at Parks and Recreation locations are not eligible for paint/paint supplies.--}}

    <br>

    {{--Note: For paint area: color can be selected upon pick up - first come, first serve basis.--}}

    <hr>

    {!! Form::label('learn_more_zero_waste', "Yes, Im interested in learning more about the Streets Department anti-litter efforts", ['class' => 'control-label']) !!}
    <br>
    {!! Form::checkbox('learn_more_zero_waste', 'yes', null,  ['id' => 'learn_more_zero_waste']) !!}


</div>

