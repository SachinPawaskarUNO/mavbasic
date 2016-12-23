@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-right"> <!-- Action Button Section -->
                            @include ('eulas._action', ['CRUD_Action' => 'List', 'resource' => 'eulas', 'disableMenu' => []])
                        </div>
                        <div><h4>{{ $heading }}</h4></div>
                    </div>
                    <div class="panel-body">
                        @if (count($eulas) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mav-datatable">
                                    <thead> <!-- Table Headings -->
                                    <th>Name</th><th>Status</th><th>Description</th><th>Effective Date</th><th>Country Language</th>
                                    </thead>
                                    <tbody> <!-- Table Body -->
                                    @foreach ($eulas as $eula)
                                        <tr>
                                            <td class="table-text"><div><a href="{{ url('/eulas/'.$eula->id.'/') }}">{{ $eula->version }}</a></div></td>
                                            <td class="table-text"><div>{{ $eula->status }}</div></td>
                                            <td class="table-text"><div>{{ substr($eula->agreement, 0, 128) }}</div></td>
                                            <td class="table-text"><div>{{ $eula->effective_at }}</div></td>
                                            <td class="table-text"><div>{{ $eula->languagecountry }}</div></td>
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
    @include ('common._footer', ['CRUD_Action' => 'List', 'includeStyle' => true, 'includeScript' => true])
@endsection