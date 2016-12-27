<div class="form-group{{ $errors->has('auditable_id') ? ' has-error' : '' }}">
    {!! Form::label('auditable_id', trans('labels.object_id').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('auditable_id', null, ['id' => 'auditable_id', 'class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('auditable_id'))
            <span class="help-block">
                <strong>{{ $errors->first('auditable_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('auditable_type') ? ' has-error' : '' }}">
    {!! Form::label('auditable_type', trans('labels.object_type').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('auditable_type', null, ['id' => 'auditable_type', 'class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('auditable_type'))
            <span class="help-block">
                <strong>{{ $errors->first('auditable_type') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('activity') ? ' has-error' : '' }}">
    {!! Form::label('activity', trans('labels.activity').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('activity', null, ['id' => 'activity', 'class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('activity'))
            <span class="help-block">
                <strong>{{ $errors->first('activity') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('created_at') ? ' has-error' : '' }}">
    {!! Form::label('created_at', trans('labels.created_at').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('created_at', null, ['id' => 'created_at', 'class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('created_at'))
            <span class="help-block">
                <strong>{{ $errors->first('created_at') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
    {!! Form::label('user_id', trans('labels.user').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('user_id', $audit->user->name, ['id' => 'user_id', 'class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('user_id'))
            <span class="help-block">
                <strong>{{ $errors->first('user_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('before') ? ' has-error' : '' }}">
    {!! Form::label('before', trans('labels.before_values').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('before', null, ['id' => 'before', 'class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('before'))
            <span class="help-block">
                <strong>{{ $errors->first('before') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('after') ? ' has-error' : '' }}">
    {!! Form::label('after', trans('labels.after_values').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('after', null, ['id' => 'after', 'class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('after'))
            <span class="help-block">
                <strong>{{ $errors->first('after') }}</strong>
            </span>
        @endif
    </div>
</div>

@if ($CRUD_Action != 'View')
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            {!! Form::button('<i class="fa fa-btn fa-save"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>
    </div>
@endif