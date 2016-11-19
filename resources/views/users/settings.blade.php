@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div><h4>{{ $heading }}</h4></div>
                </div>

                <div class="panel-body">
                    {!! Form::model($user, ['method' => 'post', 'action' => ['UsersController@updateSettings', $user->id], 'class' => 'form-horizontal', 'onsubmit' => 'return validateOnSave();']) !!}
                    @include('common.errors')
                    @include('common.flash')

                    <div class="panel-body">
                        @if (count($users) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead> <!-- Table Headings -->
                                    <th>Key</th><th>Value</th><th>Default Value</th>
                                    </thead>
                                    <tbody> <!-- Table Body -->
                                    @foreach ($the_user_settings as $current)
                                        <fieldset>
                                        <tr class="user-settings">
                                            <td><div class="form-group">
                                                <div class="col-lg-10">
                                                    <a class="help" data-toggle="tooltip" data-html="true" data-title="<strong>Help:</strong> {{ $current->help }}"><i class="fa fa-lg fa-question-circle-o" style="padding-right: 10px;"></i></a>
                                                    {{ Form::label('usersettings['.$current->id.'][description]', $current->description, ['id'=>'description']) }}
                                                    {{ Form::hidden('usersettings['.$current->id.'][id]', $current->id, ['id'=>'id']) }}
                                                    {{ Form::hidden('usersettings['.$current->id.'][name]', $current->name, ['id'=>'name']) }}
                                                    {{ Form::hidden('usersettings['.$current->id.'][kind]', $current->kind, ['id'=>'kind']) }}
                                                    {{ Form::hidden('usersettings['.$current->id.'][display_type]', $current->display_type, ['id'=>'display_type']) }}
                                                </div>
                                            </div></td>
                                            @if ($current->display_type == 'dropdown')
                                                <td><div class="form-group">
                                                    <div class="col-lg-10">{{ Form::select('usersettings['.$current->id.'][value]', array([10 => 10, 25 => 25, 50 => 50, 100 => 100]), $user->getSettingValue($current->name), ['id' => 'value', 'placeholder' => 'Select Option', 'class' => 'mav-select']) }}</div>
                                                    {{--<div class="col-lg-10">{{ Form::select('usersettings['.$current->id.'][value]', json_decode("{'10': 10, '25': 25, '50': 50, '10': 100}"), null, ['id' => 'value', 'placeholder' => 'Select Option', 'class' => 'mav-select']) }}</div>--}}
                                                </div></td>
                                            @elseif ($current->display_type == 'checkbox')
                                            <td class="table-text">
                                            <div class="checkbox" style="position: relative; left: 20px;">
                                                {{ Form::hidden('usersettings['.$current->id.'][value]', false) }}{{ Form::checkbox('usersettings['.$current->id.'][value]', true,  $user->getSettingValue($current->name), ['class' => 'form-control-checkbox']) }}
                                            </div>
                                            </td>
                                            @else
                                            {{--default is "input"--}}
                                            <td class="table-text"><div>
                                                {!! Form::text('usersettings['.$current->id.'][value]', $user->getSettingValue($current->name), ['class' => 'col-md-6 form-control']) !!}
                                            </div></td>
                                            @endif
                                            <td class="table-text"><div>
                                                {!! Form::text('usersettings['.$current->id.'][default_value]', $current->default_value, ['class' => 'col-md-6 form-control', 'readonly' => 'readonly']) !!}
                                            </div></td>
                                        </tr>
                                        </fieldset>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-5">
                                        {!! Form::button('<i class="fa fa-btn fa-save"></i>Save', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="panel-body"><h4>No User Records found</h4></div>
                        @endif
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<style>
    /*a.btn { z-index: 1000; }*/
    .tooltip-inner { white-space:pre-wrap; max-width: 250px; }
    .tooltip { position: fixed; }
    .popover-inner { white-space:pre-wrap; max-width: 250px; }
    .popover { position: fixed; }
</style>
<script>
    $(document).ready(function($) {
        $('select').select2();
        $('a.help').tooltip({html: true, placement: 'auto'});
    });

    // ToDo: update validations for this view
    function validateOnSave() {
        var rc = true;
//        if ($("select#sb_id").val() === "") {
//            alert("Please select a Type");
//            rc = false;
//        } else if ($("input#x_number").val() === "") {
//            alert("Please input a X-number");
//            rc = false;
//        }
        return rc;
    }
</script>
@endsection