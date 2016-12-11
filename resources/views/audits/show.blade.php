@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        @include ('audits._action', ['CRUD_Action' => 'View', 'id' => $audit->id, 'resource' => 'audits'])
                    </div>
                    <div><h4>{{ $heading }}</h4></div>
                </div>

                <div class="panel-body">
                    {!! Form::model($audit, ['class'=>'form-horizontal']) !!}
                    @include ('audits.partial', ['CRUD_Action' => 'View'])
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
        $('.form-control').prop("disabled", true);
        $('.form-control-checkbox').prop("disabled", true);
    });
</script>
@endsection