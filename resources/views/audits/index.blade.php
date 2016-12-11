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
                        @if (count($audits) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mav-datatable">
                                    <thead> <!-- Table Headings -->
                                    <th>Activity Date</th><th>Activity</th><th>Activity User</th><th>After</th>
                                    </thead>
                                    <tbody> <!-- Table Body -->
                                    @foreach ($audits as $current)
                                        <tr>
                                            <td class="table-text"><div>{{ $current->created_at }}</div></td>
                                            <td class="table-text"><div><a href="{{ url('/audits/'.$current->id.'/') }}">{{ $current->activityname }}</a></div></td>
                                            <td class="table-text"><div>{{ $current->user->name }}</div></td>
                                            {{--<td class="table-text"><div>{{ $current->before }}</div></td>--}}
                                            <td class="table-text" style="word-wrap: break-word; max-width: 300px;"><div>{{ $current->after }}</div></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="panel-body"><h4>No Audit Records found</h4></div>
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
            oTableApi.order([0, 'desc']).draw();
        } );
    </script>
@endsection