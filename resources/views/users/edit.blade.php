@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right"> <!-- Action Button Section -->
                        @include ('common._action', ['CRUD_Action' => 'Update', 'object' => $user, 'resource' => 'users', 'disableMenu' => [],
                                  'pluginMenus' => [array('url' => 'users/'.$user->id.'/settings', 'menuicon' => 'fa-cog', 'menulabel' => 'labels.settings')]])
                    </div>
                    <div><h4>{{ $heading }}</h4></div>
                </div>

                <div class="panel-body">
                    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UsersController@update', $user->id], 'class' => 'form-horizontal', 'onsubmit' => 'return validateOnSave();']) !!}
                    @include('common.errors')
                    @include('common.flash')

                    @include ('users.partial', ['CRUD_Action' => 'Update'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include ('common._footer', ['CRUD_Action' => 'Update', 'includeStyle' => true, 'includeScript' => true])
@endsection