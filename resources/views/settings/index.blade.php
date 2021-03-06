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
                        @if (count($settings) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mav-datatable">
                                    <thead> <!-- Table Headings -->
                                    <th>@lang('labels.description')</th><th>@lang('labels.kind')</th><th>@lang('labels.default_value')</th><th>@lang('labels.display_type')</th>
                                    <th>@lang('labels.group')</th><th>@lang('labels.display_order')</th>
                                    </thead>
                                    <tbody> <!-- Table Body -->
                                    @foreach ($settings as $setting)
                                        <tr>
                                            <td class="table-text"><div><a href="{{ url('/settings/'.$setting->id.'/') }}">{{ $setting->description }}</a></div></td>
                                            <td class="table-text"><div>{{ $setting->kind }}</div></td>
                                            <td class="table-text"><div>{{ $setting->default_value }}</div></td>
                                            <td class="table-text"><div>{{ $setting->display_type }}</div></td>
                                            <td class="table-text"><div>{{ $setting->group }}</div></td>
                                            <td class="table-text"><div>{{ $setting->display_order }}</div></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="panel-body"><h4>@lang('labels.no_records_found')</h4></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include ('common._footer', ['CRUD_Action' => 'List', 'includeStyle' => true, 'includeScript' => true])
@endsection