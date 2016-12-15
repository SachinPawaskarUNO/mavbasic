@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-right"> <!-- Action Button Section -->
                            @include ('common._action', ['CRUD_Action' => 'List', 'resource' => 'users'])
                        </div>
                        <div><h4>{{ $heading }}</h4></div>
                    </div>
                    <div class="panel-body">
                        @if (count($users) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mav-datatable">
                                    <thead> <!-- Table Headings -->
                                    <th>User</th><th>Email</th><th>Status</th>
                                    </thead>
                                    <tbody> <!-- Table Body -->
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="table-text"><div><a href="{{ url('/users/'.$user->id.'/') }}">{{ $user->name }}</a></div></td>
                                            <td class="table-text"><div>{{ $user->email }}</div></td>
                                            @if ($user->active)<td class="table-text"><div>Active</div></td>@else<td class="table-text"><div>InActive</div></td>@endif
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