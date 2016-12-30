@php

$displayStartup = Session::get('displayStartup', true);
$wizard = $user->wizardHelp;
$wizardTabs = $user->wizardHelpTabs;
if ($user->showStartupWizard && $displayStartup) {
    $wizard = $user->wizardStartup;
    $wizardTabs = $user->wizardStartupTabs;
    Session::put('displayStartup', false);
}
Log::info('_wizard.blade.php: wizard='.json_encode($wizard));
Log::info('_wizard.blade.php: wizardTabs='.json_encode($wizardTabs));

@endphp

<div id="wizard" class="modal fade" data-userid="{{$user->id}}" data-wizardtype="{{$wizard['wizardType']}}" data-mode="{{$wizard['mode']}}" data-displaytabs="{{$wizard['displaytabs']}}"
     data-modal="{{$wizard['modal']}}" {{ ($wizard['modal'] == 'true') ? "data-backdrop=static data-keyboard=false" : "" }}
     data-starttab="{{$wizard['startTab']}}" data-tabcount="{{count($wizardTabs)}}"
     tabindex="-1" role="dialog" aria-labelledby="windowTitleLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close wizard-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span class="wizard-loading pull-right" style="margin: 2px;"><i class="fa fa-spinner fa-spin fa fa-fw"></i></span>
                <h4 class="modal-title">{{ $wizard['heading'] }}</h4>
            </div>

            <div class="modal-body" style="padding-bottom: 0px;">
                <div class="tabbable">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach($wizardTabs as $currenttab)
                        <li data-name="{{ $currenttab['key'] }}" class="{{ $currenttab['key'] }}" role="presentation" >
                            <a href="#{{ $currenttab['key'] }}" aria-controls="{{ $currenttab['key'] }}" role="tab" data-fetched="false"
                               data-toggle="tab" data-src="{{ $currenttab['src'] }}">{{ $currenttab['name'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        @foreach($wizardTabs as $currenttab)
                        <div class="tab-pane" id="{{ $currenttab['key'] }}" role="tabpanel">
                            <div style="width: 100%; height: 400px;"><iframe id="{{ $currenttab['key'] }}" src=""></iframe></div>
                            @if ($currenttab['key'] === 'Eula')
                                <div id='wizard-welcome' class="wizard-eula modal-footer">
                                    <div class="pull-right">
                                        <button type="submit" class="print btn btn-default"><a class="print" href="#"><i class="fa fa-btn fa-fw fa-print"></i>@lang('labels.print')</a></button>
                                        @if ($wizard['wizardType'] === 'Startup')
                                        <button type="submit" class="btn btn-default">
                                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-btn fa-fw fa-sign-out"></i>@lang('labels.decline')
                                            </a>
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                        </button>
                                        <button type="submit" class="accept btn btn-default">
                                            <a class="accept" href="#"><i class="fa fa-btn fa-fw fa-sign-in"></i>@lang('labels.accept')</a>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            @elseif ($currenttab['key'] === 'Welcome')
                                <div id='wizardwelcome' class="wizard-welcome modal-footer"  data-welcome="{{$user->getSettingValue("welcome_screen_on_startup")}}">
                                    <div class="checkbox pull-left">
                                        <label>{{ Form::hidden('welcome', false) }}{{ Form::checkbox('welcome', true, old('welcome'),['id' => 'WelcomeOnStartupCheckbox', 'class' => 'form-control-checkbox', 'style' => 'top: -10px']) }} @lang('labels.display_welcome_screen_at_start')</label>
                                    </div>
                                    @if ($currenttab['key'] === 'Welcome' && $wizard['wizardType'] === 'Startup')
                                    <div class="pull-right"><button type="submit" class="btn btn-default continue" id="WelcomeContinue">@lang('labels.continue')</button></div>
                                    @endif
                                </div>
                            @else
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @if($wizard['mode'] === true)
            <div class="modal-footer">
                <ul class="pager wizard-buttonbar">
                    <li class="wizard-button previous first"><a href="javascript:;">@lang('labels.first')</a></li>
                    <li class="wizard-button previous"><a href="javascript:;">@lang('labels.previous')</a></li>
                    <li class="wizard-button next last"><a href="javascript:;">@lang('labels.last')</a></li>
                    <li class="wizard-button next"><a href="javascript:;">@lang('labels.next')</a></li>
                    <li class="wizard-button next finish" style="display:none;"><a href="javascript:;">@lang('labels.finish')</a></li>
                </ul>
            </div>
            @endif

            <div class="modal-footer wizard-messagebar" style="padding: 5px;">
                <div class="alert" role="alert" style="margin: 0px;">
                    <span id="displaymessage" class="msg pull-left">Sachin Pawaskar</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    div.modal-header { text-align: center;}
    iframe { width: 100%; height: 100%;}
    ul.wizard-buttonbar { margin: 0px;}
    li.wizard-button a { padding: 15px; }
    div#wizardwelcome { padding-top: 15px; padding-bottom: 0px;}
</style>
<script>
var wizardmode = false;
var displaytabs = false;
var welcomestartupflag = false;
var tabCount = 0;
var eulaaccepted = false;
var currentTab = null;
var wizardType = 'Help';
var startTab = '';
var modal = false;
var wizard = null;
var wizardwelcome = null;

var wizarditems = new Array();
var apiTABs = null;

function initializeVariables() {
    wizard = document.getElementById('wizard');
    wizardwelcome = document.getElementById('wizardwelcome');
    wizardmode = wizard.dataset.mode;
    displaytabs = wizard.dataset.displaytabs;
    tabCount = wizard.dataset.tabcount;
    wizardType = wizard.dataset.wizardtype;
    startTab = wizard.dataset.starttab;
    modal = wizard.dataset.modal;
}

function initializeWelcome() {
    if (wizardwelcome != null) {
        if (wizardwelcome.dataset.welcome === '1') {
            $("input#WelcomeOnStartupCheckbox", wizard).attr('checked', true);
        } else {
            $("input#WelcomeOnStartupCheckbox", wizard).attr('checked', false);
        }
        $("input#WelcomeOnStartupCheckbox", wizard).click(function() {
            updateWelcomeStartup();
        });
    }
}

// Use this function for displaying information messages to the user.
function displayMsg(message, alertClass) {
    var msgbar = $("#displaymessage", wizard);
    msgbar.text(message);
    if (alertClass != "") {
        msgbar.parent().addClass(alertClass);
    }
    showWizardMessageBar(true);
}

function startWizard() { $('div#wizard').modal('show'); }
function closeWizard() { $(".wizard-close", wizard).click(); }
function showcloseWizardButton(show) { (show) ? $(".wizard-close").show() : $(".wizard-close").hide(); }
function showWizardMessageBar(show) { (show) ? $(".wizard-messagebar").show() : $(".wizard-messagebar").hide(); }
function showWizardLoading(show) { (show) ? $(".wizard-loading").show() : $(".wizard-loading").hide(); }

$(document).ready(function($) {
    $('select').select2();
    initializeVariables();
    initializeWelcome();

    $("input.accept, a.accept", wizard).click(function() {
        acceptEula();
        (tabCount == 1) ? closeWizard() : activateTab('Welcome');
        // ToDo: implement moveTab for future more generic reusability
//        (tabCount == 1) ? closeWizard() : moveTab('Next');
    });
    $("input.print, a.print", wizard).click(function() { printEula(); });

    $("button.continue", wizard).click(function() { $(".wizard-close", wizard).click(); });
    if (wizard.dataset.displaytabs === 'false') { $('ul.nav-tabs').hide(); }
    (modal === 'false') ? showcloseWizardButton(true) : showcloseWizardButton(false);

    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        showWizardLoading(false);
        showWizardMessageBar(false);
        var target = $(e.target).attr("href"); // activated tab
        var datasource = $(e.target).attr("data-src");
        var fetched = $(e.target).attr("data-fetched");
        if (fetched === 'false') {
//            alert('show.bs.tab - target:' + target + '\niframe' + target + '\ndata-src:' + datasource);
            $('iframe' + target).attr('src', datasource);
            $(e.target).attr("data-fetched", "true");
        }
    });
    activateTab(startTab);

    if (wizardType == 'Startup') {
        startWizard();
    }
});

function activateTab(tab, force){
    var activateTab = $('.nav-tabs a[href="#' + tab + '"]');
    activateTab.tab('show');
}

function moveTab(nextOrPrev) {
    var currentTab = null;
    $('.nav-tabs li').each(function () {
        if ($(this).hasClass('active')) {
            currentTab = $(this);
        }
    });

    if (nextOrPrev == "Next") {
        if (currentTab.next().length)
        {
            activateTab(currentTab.attr('data-name'));
        }
    } else {
        if (currentTab.prev().length)
        {
            activateTab(currentTab.attr('data-name'));
        }
    }
}
/*********************
 * Wizard API [START]
 * Wizard API functions
 * These set of functions form the Wizard API which can be accessed by child Tabs.
 * The most common use of these API calls will be from the Custom Tabs which
 * will be installed within the wizard via a startwizard call.
 */


// This function returns the number of Tabs in the Wizard.
function getWizardNumTabs() {
    return tabCount;
}
function getWizardTab() {
    return currentTab;
}
//This function allows you to append a callback function to the close button
function addCloseOnClick (newClickClose) {
    $("#StartWizardPopup", parent.document).find(".b-close").click(newClickClose);
}
//This function calls the next Tab in the Wizard.
//EVW:  Note, this does not work!
function nextWizardTab(parms) {
    if (apiTABs !== undefined) {
        if (parms != null) {
            wizarditems[apiTABs.getIndex() + 1].tabContent += parms;
        }
        apiTABs.next();
    }
}
//This function calls the previous Tab in the Wizard.
function prevWizardTab() {
    if (apiTABs !== undefined) {
        apiTABs.prev();
    }
}
//This function calls the passed button's click() in the Wizard.
function clickWizardButton(whichbutton) {
    var button;
    if (whichbutton == "next") {
        button = $("button.next");
    } else if (whichbutton == "prev") {
        button = $("button.prev");
    } else if (whichbutton == "continue") {
        button = $("button.continue");
    } else if (whichbutton == "finish") {
        button = $("button.finish");
    } else {
        alert("No such button in Wizard (next, prev, finish, continue)");
        return;
    }

    $(button).click();
}

//This function enables/disables Wizard Button Bar Buttons
//The Parameter buttonName is the name of the button (valid values are "next", "prev", "finish" and "all")
//The parameter disable is a boolean (true/false)
function enabledisableWizardButtonBar(buttonName, disable) {
    var wizard = $("#wizard");
    if (buttonName == "next" || buttonName == "all") {
        enabledisableWizardButtonBarButton($("button.next", wizard), disable);
    }
    if (buttonName == "prev" || buttonName == "all") {
        enabledisableWizardButtonBarButton($("button.prev", wizard), disable);
    }
    if (buttonName == "finish" || buttonName == "all") {
        enabledisableWizardButtonBarButton($("button.finish", wizard), disable);
    }
}

//This function enables/disables a specific Wizard Button Bar Button
//The Parameter button is the actual button object
//The parameter disable is a boolean (true/false)
function enabledisableWizardButtonBarButton(button, disable) {
    if (button === undefined) {
        return;
    } else {
        if (disable) {
            button.attr("disabled", true).addClass("ui-state-disabled");
        } else {
            button.attr("disabled", false).removeClass("ui-state-disabled");
        }
    }
}

/*********************
 * Wizard API [END]
 */

/*
 * This ajax function handles the inserting of the eula_user record with
 * correct acceptance date and signature/initials (to be implemented).
 */
function acceptEula()
{
    var rc = false;
    var data = { 'accept': true };
    var wizard = document.getElementById('wizard');
    var ajaxURL = '/users/' + wizard.dataset.userid + '/acceptEula';

    $.ajax({
        type: "POST", url: ajaxURL, data: data,
        beforeSend: function (jqXHR, settings) {
            showWizardLoading(true);
            displayMsg("Updating");
        },
        success: function(responseData, responseText) {
            eulaaccepted = true;
            if (responseText=="success") { //Verify the ajax call was successfull
                var json_data = JSON.parse(responseData);
                displayMsg(json_data.msg, (json_data.success === '1' ? "alert-success" : "alert-danger"));
            }
        },
        complete: function (jqXHR, textStatus) {
            showWizardLoading(false);
        },
        error: function() {
            return eulaaccepted = false;
            showWizardLoading(false);
            displayMsg("Ajax call failed", "alert-danger");
        }
    });
}

// This ajax function handles the updating of the user profile preference
// for displaying the welcome screen on startup/login.
function updateWelcomeStartup()
{
    welcomestartupflag = $("#WelcomeOnStartupCheckbox").is(':checked') ? true : false;
    var data = { 'settingname': 'welcome_screen_on_startup', 'settingvalue': welcomestartupflag };
    var wizard = document.getElementById('wizard');
    var ajaxURL = '/users/' + wizard.dataset.userid + '/updateSetting';

    $.ajax({
        type: "POST", url: ajaxURL, data: data,
        beforeSend: function (jqXHR, settings) {
            showWizardLoading(true);
            displayMsg("Updating");
        },
        success: function(responseData, responseText) {
            if (responseText=="success") { //Verify the ajax call was successfull
                var json_data = JSON.parse(responseData);
                displayMsg(json_data.msg, (json_data.success === '1' ? "alert-success" : "alert-danger"));
            }
        },
        complete: function (jqXHR, textStatus) {
            showWizardLoading(false);
        },
        error: function() {
            showWizardLoading(false);
            displayMsg("Ajax call failed", "alert-danger");
        }
    });
}

// ToDo: implement downloadEULA and printEULA functionality
// This function handles the printing of the EULA.
// This is the standard way of handling the print event
function printEula() {
    // open new window and set some parameters size, menubar, resizable
    var print_window = window.open("","Print","width=600,height=600");
    var html = $("iframe#Eula").contents().find("html").html(); // get the html contents of the iframe
    // write the html into the newly opened window
    print_window.document.open();
    print_window.document.write(html);
    print_window.document.close();  // necessary for IE >= 10
    print_window.focus(); // necessary for IE >= 10*/
    print_window.print(); // open print dialog
    print_window.close();
}
</script>
