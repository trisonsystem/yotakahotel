// Call the dataTables jQuery plugin
$(document).ready(function() {
    // alert('test');
    $('#dataTable').DataTable({
        // "language": "/assets/sbadmin/vendor/datatables/lang/th.json"
        "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
    });
});

// https://datatables.net/examples/basic_init/language.html