@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading welcome-title"><h5><b>Welcome to Basic Starter Application</b></h5></div>
                <div class="app-welcome welcome-image"><img src="images/UNO-Mav.png"></div>
                <div class="panel-body welcome-message">
                    <p>
                        The original intent of this web application is to provide students in the MIS Capstone course with a basic starter web application.
                        Of course, this can also be used by students in other courses that can benefit from having a basic web application and not have to start from scratch.
                    </p>
                    <p>
                        The UNO - MavBasic web application attempts to take the pain out of development by providing common basic functionality such as User Management (includes users, roles and permisssions), Authentication, Authorization, User Settings, etc.
                        so that students can focus on delivering application functionality focused on meeting customer's business requirements.
                    </p>
                    <p>
                        Documentation for the MavBasic application can be found at <a href="https://SachinPawaskarUNO.github.io/mavbasic" target="_blank"></i>MavBasic Online Help <i class="fa fa-btn fa-fw fa-question-circle-o"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<style>
    .welcome-image{ display:none; top: 0px; }
</style>
<script>
    $(document).ready(function(){
        $('div.welcome-image').slideDown(2000);
    });
</script>
@endsection
