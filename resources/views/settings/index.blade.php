@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-right"> <!-- Action Button Section -->
                            @include ('common._action', ['CRUD_Action' => 'List', 'resource' => 'settings'])
                        </div>
                        <div><h4>{{ $heading }}</h4></div>
                    </div>
                    <div class="panel-body">
                        @if (count($settings) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mav-datatable">
                                    <thead> <!-- Table Headings -->
                                    <th>Name</th><th>Description</th><th>Kind</th><th>Default Value</th>
                                    </thead>
                                    <tbody> <!-- Table Body -->
                                    @foreach ($settings as $setting)
                                        <tr>
                                            <td class="table-text"><div><a href="{{ url('/settings/'.$setting->id.'/') }}">{{ $setting->name }}</a></div></td>
                                            <td class="table-text"><div>{{ $setting->description }}</div></td>
                                            <td class="table-text"><div>{{ $setting->kind }}</div></td>
                                            <td class="table-text"><div>{{ $setting->default_value }}</div></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="panel-body"><h4>No User Records found</h4></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<style>
    .table td { border: 0px !important; }
</style>

<script>
    $(document).ready(function() {
        var oTableApi = $('table.mav-datatable').dataTable().api();
        oTableApi.page.len( {{ Auth::user()->getSettingValue('LinesPerPage') }} ).draw();
    });
</script>
@endsection