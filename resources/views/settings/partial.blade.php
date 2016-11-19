<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Name:', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    {!! Form::label('description', 'Description:', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('description', null, ['class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('help') ? ' has-error' : '' }}">
    {!! Form::label('help', 'Help:', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('help', null, ['class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('help'))
            <span class="help-block">
                <strong>{{ $errors->first('help') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('default_value') ? ' has-error' : '' }}">
    {!! Form::label('default_value', 'Default Value:', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('default_value', null, ['class' => 'col-md-6 form-control', 'required' => 'required']) !!}
        @if ($errors->has('default_value'))
            <span class="help-block">
                <strong>{{ $errors->first('default_value') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Kind:</label>
    <div class="col-md-6">{!! Form::select('kind', $list_kind, null, ['id' => 'kind', 'class' => 'form-control roles mav-select', 'style' => 'width: 50%; margin-top: 10px;']) !!}</div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Display Type:</label>
    <div class="col-md-6">{!! Form::select('display_type', $list_display_type, null, ['id' => 'display_type', 'class' => 'form-control roles mav-select', 'style' => 'width: 50%; margin-top: 10px;']) !!}</div>
</div>


@if ($CRUD_Action != 'View')
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            {!! Form::button('<i class="fa fa-btn fa-save"></i>Save', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>
    </div>
@endif