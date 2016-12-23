@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right"> <!-- Action Button Section -->
                        @include ('eulas._action', ['CRUD_Action' => 'Update', 'object' => $eula, 'resource' => 'eulas', 'disableMenu' => ['delete']])
                    </div>
                    <div><h4>{{ $heading }}</h4></div>
                </div>

                <div class="panel-body">
                    {!! Form::model($eula, ['method' => 'PATCH', 'action' => ['EulasController@update', $eula->id], 'class' => 'form-horizontal', 'onsubmit' => 'return validateOnSave();']) !!}
                    @include('common.errors')
                    @include('common.flash')

                    @include ('eulas.partial', ['CRUD_Action' => 'Update'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@include ('common._footer', ['CRUD_Action' => 'Edit', 'includeStyle' => true, 'includeScript' => true])
<script>
    $(document).ready(function($) {
        $("input#eula_effective_at").prop("disabled", true);
    });

    // ToDo: update validations for this view
    function validateOnSave() {
        var rc = true;
        if ($("input#agreement").val() === "") {
            alert("Please enter a agreement");
            rc = false;
        }
        return rc;
    }
</script>
@endsection