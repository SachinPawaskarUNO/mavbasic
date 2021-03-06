@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right"> <!-- Action Button Section -->
                        @include ('eulas._action', ['CRUD_Action' => 'Create', 'resource' => 'eulas', 'disableMenu' => []])
                    </div>
                    <div><h4>{{ $heading }}</h4></div>
                </div>
                <div class="panel-body">
                    {!! Form::open(['class' => 'form-horizontal', 'route' => 'eulas.store', 'onsubmit' => 'return validateOnSave();']) !!}
                    @include('common.errors')
                    @include('common.flash')

                    @include ('eulas.partial', ['CRUD_Action' => 'Create'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include ('common._footer', ['CRUD_Action' => 'Create', 'includeStyle' => true, 'includeScript' => true])
@endsection
