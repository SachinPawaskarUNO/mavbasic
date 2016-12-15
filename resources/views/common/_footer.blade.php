{{--
 * Footer section for Views
 *
 * @category   Footer section for Views
 * @package    Common
 * @author     Sachin Pawaskar - spawaskar@unomaha.edu
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
--}}

<!-- Reusable footer section buttons for views -->
<!-- Parameter passed $CRUD_Action:     string valid values "List", "Create", "View", "Update", "Delete"  -->
<!-- Parameter passed $includeStyle:    boolean true or false -->
<!-- Parameter passed $includeScript:   boolean true or false -->
@if($CRUD_Action == 'List')
    @if ($includeStyle == true)
        <style>
            .table td { border: 0px !important; }
        </style>
    @endif

    @if ($includeScript == true)
        <script>
            $(document).ready(function() {
                var oTableApi = $('table.mav-datatable').dataTable().api();
                oTableApi.page.len( {{ Auth::user()->getSettingValue('LinesPerPage') }} ).draw();
            });
        </script>
    @endif
@elseif($CRUD_Action == 'Create')
@elseif($CRUD_Action == 'View')
@elseif($CRUD_Action == 'Update')
@elseif($CRUD_Action == 'Delete')
@endif