@extends('layouts.standard')

@section('content')
<div class="Ad-space" style="background-color: white;">
<table style="width: 100%">
    <tr>
        <td class="pull-left"><a href="https://sachinpawaskaruno.github.io/mavbasic" class="logo" target="_blank"><img src="images/UNO-Mav.png"/></a></td>
        <td class="pull-right"><a href="http://www.unomaha.edu" class="logo" target="_blank"><img src="images/UNO-icon-color.png" style="float: right;"/></a></td>
    </tr>
</table>
</div>
@if ($about)
<div class="panel-body panel-body-about">
    <div class="table-responsive" style="margin: 0px;">
        <table class="table table-striped about">
            <tbody> <!-- Table Body -->
                <tr><td class="name">@lang('labels.application_name'):</td><td class="value">{{ config('app.name', 'MavBasic') }}</td></tr>
                <tr><td class="name">@lang('labels.version'):</td><td class="value">{{ config('app.version') }}</td></tr>
                <tr><td class="name">@lang('labels.copyright'):</td><td class="value">@lang('messages.copyright', ['yearto' => '2017'])</td></tr>
                <tr><td class="name">@lang('labels.product_protection'):</td><td class="value">@lang('messages.product_protection')</td></tr>
                <tr><td class="name">@lang('labels.optimized_for_browser'):</td><td class="value">@lang('messages.optimized_for_browser')</td></tr>
                <tr><td class="name">@lang('labels.supported_browsers'):</td>
                    <td class="value">
                        <ul class="supportedbrowser">
                            <li><a href="http://www.google.com/chrome" target="_blank">http://www.google.com/chrome</a></li>
                            <li><a href="http://www.mozilla.org/firefox" target="_blank">http://www.mozilla.org/firefox</a></li>
                            <li><a href="http://www.microsoft.com/ie" target="_blank">http://www.microsoft.com/ie</a></li>
                        </ul>
                    </td>
                </tr>
                <tr><td class="name">@lang('labels.popup_blocker'):</td><td class="value">@lang('messages.popup_blocker')</td></tr>
                <tr><td class="name">@lang('labels.support_center'):</td><td class="value"> </td></tr>
            </tbody>
        </table>
    </div>
</div>
@endif
@if ($aboutbrowser)
<div class="panel-body panel-body-aboutbrowser">
    <div class="table-responsive" style="margin: 0px;">
        <table class="table table-striped aboutbrowser">
            <tbody> <!-- Table Body -->
            <tr>
                <td class="name">@lang('labels.browser_name'):</td>
                <td class="value">
                    <script>
                        document.write(navigator.appName);
                        document.write(" (codename: "); document.write(navigator.appCodeName); document.write(")");
                    </script>
                </td>
            </tr>
            <tr><td class="name">@lang('labels.browser_version'):</td><td class="value"><script>document.write(navigator.appVersion);</script></td></tr>
            <tr><td class="name">@lang('labels.cookies'):</td><td class="value"><script>document.write(navigator.cookieEnabled);</script></td></tr>
            <tr><td class="name">@lang('labels.geo_location'):</td><td id="app-geoLocation" class="value"></td></tr>
            <tr><td class="name">@lang('labels.language'):</td><td class="value"><script>document.write(navigator.language);</script></td></tr>
            <tr><td class="name">@lang('labels.online'):</td><td class="value"><script>document.write(navigator.onLine);</script></td></tr>
            <tr><td class="name">@lang('labels.product'):</td><td class="value"><script>document.write(navigator.product);</script></td></tr>
            <tr><td class="name">@lang('labels.operating_system'):</td><td class="value"><script>document.write(navigator.platform);</script></td></tr>
            <tr><td class="name">@lang('labels.user_agent'):</td><td class="value"><script>document.write(navigator.userAgent);</script></td></tr>
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection

@section('footer')
<style>
    td.name { text-align: right;}
    td.value { text-align: left; white-space: normal; }
    div.panel-body-about, div.panel-body-aboutbrowser { padding: 0px;}
    a.logo img { width: 100px; height: 100px; }
</style>
<script>
    var appGeoLocation = document.getElementById("app-geoLocation");
    $(document).ready(function() {
        appGeoLocation = document.getElementById("app-geoLocation");
        getLocation();
    });

    function getLocation() {
        if (navigator.geolocation) {
            appGeoLocation.innerHTML = navigator.geolocation.getCurrentPosition(showPosition, showPositionError);
        } else {
            appGeoLocation.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    function showPosition(position) {
        appGeoLocation.innerHTML =  "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
    }
    function showPositionError(error) {
        var error_msg = "Missing error code";
        switch(error.code) {
            case error.PERMISSION_DENIED:
                error_msg = "User denied the request for Geolocation.";
                break;
            case error.POSITION_UNAVAILABLE:
                error_msg = "Location information is unavailable.";
                break;
            case error.TIMEOUT:
                error_msg = "The request to get user location timed out.";
                break;
            case error.UNKNOWN_ERROR:
                error_msg = "An unknown error occurred.";
                break;
        }
        appGeoLocation.innerHTML =  error_msg;
    }
</script>
@endsection