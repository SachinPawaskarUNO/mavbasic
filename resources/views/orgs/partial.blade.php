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

<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
    {!! Form::label('address', trans('labels.address').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('address', null, ['class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('address'))
            <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
    {!! Form::label('city', trans('labels.city').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('city', null, ['class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('city'))
            <span class="help-block">
                <strong>{{ $errors->first('city') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
    {!! Form::label('state', trans('labels.state').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('state', null, ['class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('state'))
            <span class="help-block">
                <strong>{{ $errors->first('state') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
    {!! Form::label('zip', trans('labels.zip').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('zip', null, ['class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('zip'))
            <span class="help-block">
                <strong>{{ $errors->first('zip') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('geo_lat') ? ' has-error' : '' }}">
    {!! Form::label('geo_lat', trans('labels.geo_lat').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('geo_lat', null, ['class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('geo_lat'))
            <span class="help-block">
                <strong>{{ $errors->first('geo_lat') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('geo_long') ? ' has-error' : '' }}">
    {!! Form::label('geo_long', trans('labels.geo_long').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('geo_long', null, ['class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('geo_long'))
            <span class="help-block">
                <strong>{{ $errors->first('geo_long') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
    {!! Form::label('website', trans('labels.website_url').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::url('website', null, ['type' => 'url', 'class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('website'))
            <span class="help-block">
                <strong>{{ $errors->first('website') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    {!! Form::label('phone', trans('labels.phone').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('phone', null, ['type' => 'phone', 'class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('toll_free') ? ' has-error' : '' }}">
    {!! Form::label('toll_free', trans('labels.toll_free').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('toll_free', null, ['type' => 'phone', 'class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('toll_free'))
            <span class="help-block">
                <strong>{{ $errors->first('toll_free') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
    {!! Form::label('fax', trans('labels.fax').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('fax', null, ['type' => 'phone', 'class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('fax'))
            <span class="help-block">
                <strong>{{ $errors->first('fax') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
    {!! Form::label('contact_name', trans('labels.contact_name').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('contact_name', null, ['class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('contact_name'))
            <span class="help-block">
                <strong>{{ $errors->first('contact_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
    {!! Form::label('contact_email', trans('labels.contact_email').':', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email('contact_email', null, ['class' => 'col-md-6 form-control']) !!}
        @if ($errors->has('contact_email'))
            <span class="help-block">
                <strong>{{ $errors->first('contact_email') }}</strong>
            </span>
        @endif
    </div>
</div>

{{--<div class="form-group">--}}
    {{--<label class="col-md-4 control-label">@lang('labels.roles')</label>--}}
    {{--<div class="col-md-6">{!! Form::select('rolelist[]', $list_role, null, ['id' => 'roles', 'class' => 'form-control roles mav-select', 'multiple', 'style' => 'width: 50%; margin-top: 10px;']) !!}</div>--}}
{{--</div>--}}

@if ($CRUD_Action != 'View')
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            {!! Form::button('<i class="fa fa-btn fa-save"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>
    </div>
@endif