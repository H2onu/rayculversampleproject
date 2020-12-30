<div class="row">
    <div class="col-md-6">
        {!! Form::label('Event Name', 'Event Name', ['class' => 'control-label']) !!}
        {!! Form::text('event_name', null, ['class' => 'form-control' , 'id' => 'event_name' , 'placeholder' => 'Event Name' , 'required' => 'required'])  !!}

    </div>

    <div class="col-md-4">
        {!! Form::label('active', 'Activate Project', ['class' => 'control-label']) !!}
        <br>
        {!! Form::hidden('active', '0',  ['id' => 'active']) !!}
        {!! Form::checkbox('active', '1', null,  ['id' => 'active']) !!}
    </div>


</div>
<br>
<div>
    <div>{!! Form::label('logo', 'Event Banner Upload', ['class' => 'control-label']) !!}</div>
    <div id="imagePreview" style="display:none"></div>
    <input id="uploadFile" type="file" name="image" class="img"/>
</div>
<br>
<div>
    @if(!empty($events['imagePath']))
        {{ Form::image('images/events/thumbnails/thumb-'.$events['imagePath']) }}
    @endif
</div>

<br>
<br>

<div class="row">

    <span>

        {!! Form::label('event_start_date', 'Event Start Date', ['class' => 'control-label']) !!}
        {!! Form::text('event_start_date', null, ['class' => 'form-control' , 'id' => 'event_start_date' , 'placeholder' => 'Event Start Date' , 'required' => 'required' ])  !!}

    </span>
    <br>
    <span>

        {!! Form::label('event_end_date', 'Event End Date', ['class' => 'control-label']) !!}
        {!! Form::text('event_end_date', null, ['class' => 'form-control' , 'id' => 'event_end_date', 'placeholder' => 'Event End Date' , 'required' => 'required'])  !!}


    </span>
    <br>
    <span>

        {!! Form::label('event_description', 'Event Description', ['class' => 'control-label']) !!}
        {!! Form::text('event_description', null, ['class' => 'form-control' , 'id' => 'event_description', 'placeholder' => 'Event Description' , 'required' => 'required'])  !!}


    </span>

</div>

<hr>


<div class="row">


    <h4>Project Registration Form</h4>


    <div class="col-md-4">

        <span>Auto ON/Off Date</span>

        <span>

            {!! Form::label('projRegFormOnDate', 'Project Registration Form On Date', ['class' => 'control-label' ]) !!}
            {!! Form::text('projRegFormOnDate', null , ['class' => 'form-control' , 'id' => 'projRegFormOnDate' , 'placeholder' => 'Project Registration Form On Date', 'required' => 'required'])  !!}

                </span>
    </div>

    <div class="col-md-4">
                <span>

                    {!! Form::label('projRegFormOffDate', 'Project Registration Form Off Date', ['class' => 'control-label']) !!}
                    {!! Form::text('projRegFormOffDate', null , ['class' => 'form-control' , 'id' => 'projRegFormOffDate' , 'placeholder' => 'Project Registration Form Off Date' , 'required' => 'required'])  !!}

                </span>
    </div>

    <div class="col-md-4">
                <span>

                    {!! Form::label('projRegFormOverride', 'Project Submit Override', ['class' => 'control-label']) !!}

                    <br>

                    {!! Form::hidden('projRegFormOverride', '0', ['id' => 'projRegFOverrormOverride']) !!}
                    {!! Form::checkbox('projRegFormOverride', '1', null,  ['id' => 'projRegFormOver ride']) !!}

                </span>

    </div>

    <br>
    <br>
    <br>
    <br>

    <div>

        <span>

            {!! Form::label('projRegAdminEmail' , 'Project Registration Form Admin Emails (received when new projects are submitted)' , ['class' => 'control-label']) !!}

            <br>

            {!! Form::text('projRegAdminEmail', null , ['class' => 'form-control' , 'id' => 'projRegAdminEmail' , 'placeholder' => 'Enter Admin Emails Separated With A Comma' , 'required' => 'required'])  !!}

        </span>

    </div>
    <br>
    <div>

        <span>

          {!! Form::label('emailProjectOwnerSubmittal', 'Email the project owner a confirmation of their project submittal', ['class' => 'control-label']) !!}

            <br>

            {!! Form::hidden('emailProjectOwnerSubmittal', '0',  ['id' => 'emailProjectOwnerSubmittal']) !!}
            {!! Form::checkbox('emailProjectOwnerSubmittal', '1', null,  ['id' => 'emailProjectOwnerSubmittal']) !!}


        </span>

    </div>

</div>

<hr>

<div class="row">


    <h4>Volunteer Registration Form</h4>


    <div class="col-md-4">

        <span>Auto ON/Off Date</span>

        <span>

            {!! Form::label('volRegFormOnDate', 'Volunteer Form On Date', ['class' => 'control-label']) !!}
            {!! Form::text('volRegFormOnDate', null , ['class' => 'form-control' , 'id' => 'volRegFormOnDate' , 'placeholder' => 'Volunteer Form On Date' , 'required' => 'required'])  !!}

                </span>
    </div>

    <div class="col-md-4">
                <span>

                    {!! Form::label('volRegFormOffDate', 'Volunteer Form Off Date', ['class' => 'control-label']) !!}
                    {!! Form::text('volRegFormOffDate', null , ['class' => 'form-control' , 'id' => 'volRegFormOffDate' , 'placeholder' => 'Volunteer Form Off Date' , 'required' => 'required'])  !!}

                </span>
    </div>

    <div class="col-md-4">

                <span>

                    {!! Form::label('volRegFormOverride', 'Volunteer Form Override', ['class' => 'control-label']) !!}

                    <br>

                    {!! Form::hidden('volRegFormOverride', '0',  ['id' => 'volRegFormOverride']) !!}
                    {!! Form::checkbox('volRegFormOverride', '1', null,  ['id' => 'volRegFormOverride']) !!}

                </span>
        <br>
        <br>
    </div>

</div>

<hr>


<div class="row">
    <h4>Voucher Auto/On Date</h4>

    <div class="col-md-4">

        <span>Auto ON/Off Date</span>

        <span>

            {!! Form::label('voucherOnDate', 'Voucher Form On Date', ['class' => 'control-label']) !!}
            {!! Form::text('voucherOnDate', null , ['class' => 'form-control' , 'id' => 'voucherOnDate' , 'placeholder' => 'Voucher On Date' , 'required' => 'required'])  !!}

                </span>
    </div>

    <div class="col-md-4">
                <span>

                    {!! Form::label('voucherOffDate', 'Voucher Form Off Date', ['class' => 'control-label']) !!}
                    {!! Form::text('voucherOffDate', null , ['class' => 'form-control' , 'id' => 'voucherOffDate' , 'placeholder' => 'Voucher Off Date' , 'required' => 'required'])  !!}

                </span>
    </div>

    <div class="col-md-4">

                <span>

                    {!! Form::label('voucherOverride', 'Voucher Override', ['class' => 'control-label']) !!}

                    <br>

                    {!! Form::hidden('voucherOverride', '0',  ['id' => 'voucherOverride']) !!}
                    {!! Form::checkbox('voucherOverride', '1', null,  ['id' => 'voucherOverride']) !!}

                </span>
        <br>
        <br>
    </div>

</div>


<hr>

<div class="row">

    <h4>Email Preferences</h4>
    <h5>(These settings determine who will receive notification emails when a project is approved)</h5>

    <div class="col-md-4">

        <span>


          {!! Form::label('emailProjectOwner', 'Email the project Owner', ['class' => 'control-label']) !!}

            <br>
            {!! Form::hidden('emailProjectOwner', '0',  ['id' => 'emailProjectOwner']) !!}
            {!! Form::checkbox('emailProjectOwner', '1', null,  ['id' => 'emailProjectOwner']) !!}


        </span>

    </div>

    <div class="col-md-4">

        <span>

          {!! Form::label('emailPrimaryContact', 'Email the Primary Contact', ['class' => 'control-label']) !!}

            <br>
            {!! Form::hidden('emailPrimaryContact', '0',  ['id' => 'emailPrimaryContact']) !!}
            {!! Form::checkbox('emailPrimaryContact', '1', null,  ['id' => 'emailPrimaryContact']) !!}


        </span>

    </div>

</div>

<hr>

<div class="row">

    <h4>Allow Logo Upload</h4>

    <span>


        {!! Form::label('allowLogoUpload', 'Allow project owners to upload a logo.', ['class' => 'control-label']) !!}

        <br>
        {!! Form::hidden('allowLogoUpload', '0',  ['id' => 'allowLogoUpload']) !!}
        {!! Form::checkbox('allowLogoUpload', '1', null,  ['id' => 'allowLogoUpload']) !!}


        </span>

</div>

<hr>


<div class="row">
    <h4>Enter Supply Quantities</h4>
    <h5>(These fields will be used to calculate project distribution quantities)</h5>
    <div class="col-md-2">
    <span>

        {!! Form::label('Bags', 'Bag Inventory', ['class' => 'control-label' ]) !!}
        {!! Form::number('bags', null, ['class' => 'form-control' , 'placeholder' => 'Enter Bag Inventory']) !!}

    </span>
    </div>

    <div class="col-md-2">
    <span>

        {!! Form::label('Brooms', 'Broom Inventory', ['class' => 'control-label']) !!}
        {!! Form::number('brooms', null, ['class' => 'form-control' , 'placeholder' => 'Enter Broom Inventory']) !!}

    </span>
    </div>

    <div class="col-md-2">
    <span>

        {!! Form::label('Gloves', 'Glove Inventory', ['class' => 'control-label']) !!}
        {!! Form::number('gloves', null, ['class' => 'form-control' , 'placeholder' => 'Enter Glove Inventory']) !!}

    </span>
    </div>
    <div class="col-md-2">
    <span>

        {!! Form::label('Rakes', 'Rake Inventory', ['class' => 'control-label']) !!}
        {!! Form::number('rakes', null, ['class' => 'form-control' , 'placeholder' => 'Enter Rake Inventory']) !!}

    </span>
    </div>
    <div class="col-md-2">
    <span>

        {!! Form::label('Shovels', 'Shovel Inventory', ['class' => 'control-label']) !!}
        {!! Form::number('shovels', null, ['class' => 'form-control' , 'placeholder' => 'Enter Shovel Inventory']) !!}

    </span>
    </div>
    <div class="col-md-2">
    <span>

        {!! Form::label('Paint', 'Paint Inventory', ['class' => 'control-label']) !!}
        {!! Form::number('paint', null, ['class' => 'form-control' , 'placeholder' => 'Enter Paint Inventory']) !!}

    </span>
    </div>

</div>
<br>
<div class="row">

    <table class="table">
        <thead>
        <tr>
            <th># of Participants</th>
            <th scope="col">Bags</th>
            <th>Brooms</th>
            <th>Gloves</th>
            <th>Rakes</th>
            <th>Shovels</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>Block Captain Package</td>
            <td>
                {!! Form::label('block_pkg_bags', 'Bags Allocation', ['class' => 'control-label']) !!}
                {!! Form::number('block_pkg_bags', null, ['class' => 'form-control' , 'placeholder' => 'Enter Bags Allocation']) !!}
            </td>
            <td>
                {!! Form::label('block_pkg_brooms', 'Brooms Allocation', ['class' => 'control-label']) !!}
                {!! Form::number('block_pkg_brooms', null, ['class' => 'form-control' , 'placeholder' => 'Enter Brooms Allocation']) !!}
            </td>
            <td>
                {!! Form::label('block_pkg_gloves', 'Gloves Allocation', ['class' => 'control-label']) !!}
                {!! Form::number('block_pkg_gloves', null, ['class' => 'form-control' , 'placeholder' => 'Enter Gloves Allocation']) !!}
            </td>
            <td>
                {!! Form::label('block_pkg_rakes', 'Rakes Allocation', ['class' => 'control-label']) !!}
                {!! Form::number('block_pkg_rakes', null, ['class' => 'form-control' , 'placeholder' => 'Enter Rakes Allocation']) !!}
            </td>
            <td>
                {!! Form::label('block_pkg_shovels', 'Shovels Allocation', ['class' => 'control-label']) !!}
                {!! Form::number('block_pkg_shovels', null, ['class' => 'form-control' , 'placeholder' => 'Enter Shovels Allocation']) !!}
            </td>
            <td>
                {!! Form::label('block_pkg_paint', 'Paint Allocation', ['class' => 'control-label']) !!}
                {!! Form::number('block_pkg_paint', null, ['class' => 'form-control' , 'placeholder' => 'Enter Paint Allocation']) !!}
            </td>
        </tr>
        <tr>
            <td>25 or Less</td>
            <td>
                {{--{!! Form::label('twenty_five_pkg_bags', 'Bags Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('twenty_five_pkg_bags', null, ['class' => 'form-control' , 'placeholder' => 'Enter Bags Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('twenty_five_pkg_brooms', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('twenty_five_pkg_brooms', null, ['class' => 'form-control' , 'placeholder' => 'Enter Brooms Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('twenty_five_pkg_gloves', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('twenty_five_pkg_gloves', null, ['class' => 'form-control' , 'placeholder' => 'Enter Gloves Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('twenty_five_pkg_rakes', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('twenty_five_pkg_rakes', null, ['class' => 'form-control' , 'placeholder' => 'Enter Rakes Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('twenty_five_pkg_shovels', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('twenty_five_pkg_shovels', null, ['class' => 'form-control' , 'placeholder' => 'Enter Shovels Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('twenty_five_pkg_paint', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('twenty_five_pkg_paint', null, ['class' => 'form-control' , 'placeholder' => 'Enter Paint Allocation']) !!}
            </td>
        </tr>
        <tr>
            <td>26 - 50</td>
            <td>
                {{--{!! Form::label('fifty_pkg_bags', 'Bags Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('fifty_pkg_bags', null, ['class' => 'form-control' , 'placeholder' => 'Enter Bags Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('fifty_pkg_brooms', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('fifty_pkg_brooms', null, ['class' => 'form-control' , 'placeholder' => 'Enter Brooms Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('fifty_pkg_gloves', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('fifty_pkg_gloves', null, ['class' => 'form-control' , 'placeholder' => 'Enter Gloves Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('fifty_pkg_rakes', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('fifty_pkg_rakes', null, ['class' => 'form-control' , 'placeholder' => 'Enter Rakes Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('fifty_pkg_shovels', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('fifty_pkg_shovels', null, ['class' => 'form-control' , 'placeholder' => 'Enter Shovels Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('fifty_pkg_paint', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('fifty_pkg_paint', null, ['class' => 'form-control' , 'placeholder' => 'Enter Paint Allocation']) !!}
            </td>
        </tr>
        <tr>
            <td>51 -100</td>
            <td>
                {{--{!! Form::label('one_hundred_pkg_bags', 'Bags Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('one_hundred_pkg_bags', null, ['class' => 'form-control' , 'placeholder' => 'Enter Bags Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('one_hundred_pkg_brooms', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('one_hundred_pkg_brooms', null, ['class' => 'form-control' , 'placeholder' => 'Enter Brooms Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('one_hundred_pkg_gloves', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('one_hundred_pkg_gloves', null, ['class' => 'form-control' , 'placeholder' => 'Enter Gloves Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('one_hundred_pkg_rakes', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('one_hundred_pkg_rakes', null, ['class' => 'form-control' , 'placeholder' => 'Enter Rakes Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('one_hundred_pkg_shovels', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('one_hundred_pkg_shovels', null, ['class' => 'form-control' , 'placeholder' => 'Enter Shovels Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('one_hundred_pkg_paint', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('one_hundred_pkg_paint', null, ['class' => 'form-control' , 'placeholder' => 'Enter Paint Allocation']) !!}
            </td>
        </tr>
        <tr>
            <td>101+</td>
            <td>
                {{--{!! Form::label('over_hundred_pkg_bags', 'Bags Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('over_hundred_pkg_bags', null, ['class' => 'form-control' , 'placeholder' => 'Enter Bags Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('over_hundred_pkg_brooms', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('over_hundred_pkg_brooms', null, ['class' => 'form-control' , 'placeholder' => 'Enter Brooms Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('over_hundred_pkg_gloves', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('over_hundred_pkg_gloves', null, ['class' => 'form-control' , 'placeholder' => 'Enter Gloves Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('over_hundred_pkg_rakes', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('over_hundred_pkg_rakes', null, ['class' => 'form-control' , 'placeholder' => 'Enter Rakes Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('over_hundred_pkg_shovels', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('over_hundred_pkg_shovels', null, ['class' => 'form-control' , 'placeholder' => 'Enter Shovels Allocation']) !!}
            </td>
            <td>
                {{--{!! Form::label('over_hundred_pkg_paint', 'Brooms Allocation', ['class' => 'control-label']) !!}--}}
                {!! Form::number('over_hundred_pkg_paint', null, ['class' => 'form-control' , 'placeholder' => 'Enter Paint Allocation']) !!}
            </td>
        </tr>

        </tbody>

    </table>

</div>

<hr>

<div class="row">

    <h4>Vouchers & Supply Pickup Information</h4>
    <h5>(these fields will auto-populate the vouchers with dates and times for supply
        pickup)</h5>

    <div class="col-md-4">
    <span>

        {!! Form::label('supplyPickupLocation', 'Supply Pickup Location Address', ['class' => 'control-label']) !!}
        {!! Form::text('supplyPickupLocation', null, ['class' => 'form-control' , 'placeholder' => 'Supply Pickup Location Address']) !!}

    </span>
    </div>
    <br>
    <br>
    <div class="col-md-4">

        <span>

        {!! Form::label('supplyPickupLocationDates', 'Supply Pickup Location Dates', ['class' => 'control-label']) !!}
            {!! Form::textarea('supplyPickupLocationDates', null, ['class' => 'form-control' , 'placeholder' => 'Supply Pickup Dates']) !!}

    </span>

    </div>
    <div class="col-md-4">

        <span>

        {!! Form::label('redemptionDetails', 'Redemption Details', ['class' => 'control-label']) !!}
            {!! Form::textarea('redemptionDetails', null, ['class' => 'form-control' , 'placeholder' => 'Redemption Details']) !!}

    </span>

    </div>
</div>

<hr>

<div class="row">

    <h4>Email Vouchers To Project Owners</h4>
    <div class="alert-danger"><h5>To prevent accidental sending, this button will only appear on the date that vouchers
                                  can be accessed by the project owners or if the voucher
                                  override is ticked.</h5></div>
    @if(!empty($events))
        @if($events->voucherOn == '1')
            <div class="col-md-4">

                {{--<span><a href="{{URL::route( 'voucher' )}}" class="btn btn-primary">Email All Project Vouchers</a></span>--}}

            </div>
        @endif
    @endif
</div>
<br>
<br>
<hr>
<div class="row">

    <div>

        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}

    </div>

    <br>
    <br>

</div>
