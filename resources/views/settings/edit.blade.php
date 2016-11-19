@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right"> <!-- Action Button Section -->
                        @include ('common._action', ['CRUD_Action' => 'Update', 'id' => $setting->id, 'resource' => 'settings'])
                    </div>
                    <div><h4>{{ $heading }}</h4></div>
                </div>

                <div class="panel-body">
                    {!! Form::model($setting, ['method' => 'PATCH', 'action' => ['UsersController@update', $setting->id], 'class' => 'form-horizontal', 'onsubmit' => 'return validateOnSave();']) !!}
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
<script>
//    $(document).ready(function($) {
//        $('select').select2();
//    });
//
    // ToDo: update validations for this view
    function validateOnSave() {
        var rc = true;
        if ($("select#sb_id").val() === "") {
            alert("Please select a Type");
            rc = false;
        } else if ($("input#x_number").val() === "") {
            alert("Please input a X-number");
            rc = false;
        }
        return rc;
    }
</script>
@endsection