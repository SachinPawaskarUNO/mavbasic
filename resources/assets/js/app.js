//
// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * include Vue and Vue Resource. This gives a great starting point for
//  * building robust, powerful web applications using Vue and Laravel.
//  */
//
// require('./bootstrap');
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the body of the page. From here, you may begin adding components to
//  * the application, or feel free to tweak this setup for your needs.
//  */
//
// Vue.component('example', require('./components/Example.vue'));
//
// const app = new Vue({
//     el: '#app'
// });

// New stuff added by Sachin.
/*
 * ConfirmDelete: Asks the user for confirmation when a record is being deleted
 */
function ConfirmDelete() {
    var x = confirm("Are you sure you want to delete?");

    if (x) {
        return true;
    } else {
        return false;
    }
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    $('table.mav-datatable').DataTable({
        "columnDefs": [ {
            "targets"  : 'no-sort',
            "orderable": false
        }]
    });
});
