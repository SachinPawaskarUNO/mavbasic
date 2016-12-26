@extends('layouts.standard')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">End User License Agreement</div>

            <div class="panel-body">
                {{ App\Eula::getActiveSystemEulaForUser($user)->agreement }}
            </div>
        </div>
    </div>
</div>
@endsection
