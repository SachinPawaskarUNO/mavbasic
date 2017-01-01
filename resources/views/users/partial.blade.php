@if ($CRUD_Action != 'Create')
    <div class="form-group{{ $errors->has('org_name') ? ' has-error' : '' }}">
        {!! Form::label('org_name', trans('labels.org').':', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('org_name', $user->org->name, ['id' => 'org_name', 'class' => 'col-md-6 form-control', 'required' => 'required']) !!}
            @if ($errors->has('org_name'))
                <span class="help-block"><strong>{{ $errors->first('org_name') }}</strong></span>
            @endif
        </div>
    </div>
@endif

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', trans('labels.name').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {!! Form::label('email', trans('labels.email_address').'s:', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('email', null, ['class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <div class="checkbox">
            <label>
                {{ Form::hidden('active', false) }}{{ Form::checkbox('active', true, old('active'),
                ['class' => 'form-control-checkbox']) }} @lang('labels.active')
            </label>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">@lang('labels.roles')</label>
    <div class="col-md-6">{!! Form::select('rolelist[]', $list_role, null, ['id' => 'roles', 'class' => 'form-control roles mav-select', 'multiple', 'style' => 'width: 50%; margin-top: 10px;']) !!}</div>
</div>

@if($CRUD_Action == 'Create')
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">@lang('labels.password')</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password">
            @if ($errors->has('password'))
                <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">@lang('labels.confirm_password')</label>
        <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirmation">
            @if ($errors->has('password_confirmation'))
                <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
            @endif
        </div>
    </div>
@endif

@if ($CRUD_Action != 'View')
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            {!! Form::button('<i class="fa fa-btn fa-save"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>
    </div>
@endif