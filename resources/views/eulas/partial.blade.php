@if ($CRUD_Action != 'Create')
    <div class="form-group{{ $errors->has('org_name') ? ' has-error' : '' }}">
        {!! Form::label('org_name', trans('labels.org').':', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('org_name', $eula->org->name, ['id' => 'org_name', 'class' => 'col-md-6 form-control', 'required' => 'required']) !!}
            @if ($errors->has('org_name'))
                <span class="help-block"><strong>{{ $errors->first('org_name') }}</strong></span>
            @endif
        </div>
    </div>
@endif

<div class="form-group{{ $errors->has('version') ? ' has-error' : '' }}">
    {!! Form::label('version', trans('labels.version').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('version', null, ['id' => 'version', 'class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('version'))
            <span class="help-block">
                <strong>{{ $errors->first('version') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('agreement') ? ' has-error' : '' }}">
    {!! Form::label('agreement', trans('labels.agreement').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('agreement', null, ['id' => 'agreement', 'class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('agreement'))
            <span class="help-block">
                <strong>{{ $errors->first('agreement') }}</strong>
            </span>
        @endif
    </div>
</div>

@if ($CRUD_Action != 'Create')
<div class="form-group">
    <label class="col-md-4 control-label">@lang('labels.status')</label>
    <div class="col-md-6">{!! Form::select('status', $list_eula_status, null, ['id' => 'status', 'class' => 'form-control roles mav-select', 'style' => 'width: 50%; margin-top: 10px;']) !!}</div>
</div>


@if($eula->status != 'Draft')
<div class="form-group{{ $errors->has('effective_at') ? ' has-error' : '' }}">
    {!! Form::label('effective_at', trans('labels.effective_date').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('effective_at', null, ['id' => 'eula_effective_at', 'class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('effective_at'))
            <span class="help-block"><strong>{{ $errors->first('effective_at') }}</strong></span>
        @endif
    </div>
</div>
@endif
@endif

@if ($CRUD_Action != 'View')
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            {!! Form::button('<i class="fa fa-btn fa-save"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>
    </div>
@endif