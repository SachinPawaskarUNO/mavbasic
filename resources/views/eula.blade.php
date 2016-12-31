@extends('layouts.standard')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">@lang('labels.eula_long')</div>

            <div class="panel-body">
                @if ($user->eulaAccepted)
                    {{ $user->getActiveEula()->agreement }}
                @else
                    {{ $user->org->getActiveEulaForUser($user)->agreement }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
