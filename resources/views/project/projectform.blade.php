<div class="row">

    @include('partials.projects')

    <hr>

    @include('partials/contact')

    <hr>

    @include('partials/supplies')

    <br>
    <br>
    <div>

        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control addProject']) !!}

    </div>

    <br>
    <br>

</div>