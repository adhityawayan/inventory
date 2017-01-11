  $(document).ready(function(){
    

        var dt = $('#dtables' ).DataTable();
 
 
    // Name of the filename when exported (except for extension)
    var export_filename = 'Filename';
     
    // Configure Export Buttons
    new $.fn.dataTable.Buttons( dt, {
        buttons: [
            {
                text: '<i class="fa fa-print"></i> Print Assets',
                extend: 'print',
                className: 'btn btn-primary'
            },
            {
                extend: 'excel',
                text: 'Save current page',
                exportOptions: {
                    modifier: {
                        page: 'current'
                    }
                }
            }
        ]
    } );
     
    // Add the Export buttons to the toolbox
    dt.buttons( 0, null ).container().appendTo( '#export-assets' );

});