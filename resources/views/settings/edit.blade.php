@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right"> <!-- Action Button Section -->
                        @include ('common._action', ['CRUD_Action' => 'Update', 'object' => $setting, 'resource' => 'settings', 'disableMenu' => ['create','delete']])
                    </div>
                    <div><h4>{{ $heading }}</h4></div>
                </div>

                <div class="panel-body">
                    {!! Form::model($setting, ['method' => 'PATCH', 'action' => ['SettingsController@update', $setting->id], 'class' => 'form-horizontal', 'onsubmit' => 'return validateOnSave();']) !!}
                    @include('common.errors')
                    @include('common.flash')

                    @include ('settings.partial', ['CRUD_Action' => 'Update'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@include ('common._footer', ['CRUD_Action' => 'Update', 'includeStyle' => true, 'includeScript' => true])
<script>
    $(document).ready(function($) {
        $('select#display_type').prop("disabled", true);
        $('select#kind').prop("disabled", true);
        $('input#name').prop("readonly", true);
        $('input#default_value').prop("readonly", true);
    });

    // ToDo: update validations for this view
    function validateOnSave() {
        var rc = true;
        if ($("input#description").val() === "") {
            alert("Please enter a description");
            rc = false;
        } else if ($("input#help").val() === "") {
            alert("Please enter some help text");
            rc = false;
        }
        return rc;
    }
</script>
@endsection