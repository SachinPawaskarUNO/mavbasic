@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        @include ('common._action', ['CRUD_Action' => 'View', 'id' => $user->id, 'resource' => 'users'])
                    </div>
                    <div><h4>{{ $heading }}</h4></div>
                </div>

                <div class="panel-body">
                    {!! Form::model($user, ['class'=>'form-horizontal']) !!}
                    @include ('users.partial', ['CRUD_Action' => 'View'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script type="text/javascript">
    $(document).ready(function(){
        $('select').select2();
        $('.form-control').prop("disabled", true);
        $('.form-control-checkbox').prop("disabled", true);
    });
</script>
@endsection