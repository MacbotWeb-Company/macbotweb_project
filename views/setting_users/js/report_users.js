function alertDialog(sizeAlert,messageAlert){
    var dialogAlert = bootbox.dialog({
        message: '<p class="text-center">' + messageAlert + '</p>',
        closeButton: false,
        size: sizeAlert
    });
    setTimeout(function() {
        dialogAlert.modal('hide');
    },3000);
}

$(document).ready(function() {
    $('#listusers-data-table').DataTable({
            responsive: true,
            dom         : 'rtip',

            columnDefs  : [
                { "orderable": false, "targets": 0 },
                { "orderable": false, "targets": 1 },
                { "orderable": false, "targets": 7 },
                { "orderable": false, "targets": 8 },                  
                {
                    targets   : 5,
                    filterable: false,
                    render    : function (data, type)
                    {
                        if ( type === 'display' )
                        {
                            if ( data === 'A' )
                            {
                                return '<i class="icon-checkbox-marked-circle text-success"></i>';
                            }

                            return '<i class="icon-cancel text-danger"></i>';
                        }

                        if ( type === 'filter' )
                        {
                            if ( data )
                            {
                                return '1';
                            }

                            return '0';
                        }

                        return data;
                    }
                },
                {
                    // Target the actions column
                    targets           : 7,
                    responsivePriority: 1,
                    filterable        : false,
                    sortable          : false
                }
            ],
            initComplete: function ()
        {
        var api = this.api(),
            searchBox = $('#products-search-input');

        // Bind an external input as a table wide search box
        if ( searchBox.length > 0 )
        {
            searchBox.on('keyup', function (event)
            {
                api.search(event.target.value).draw();
            });
        }
        },
            lengthMenu  : [10, 20, 30, 50, 100],
            pageLength  : 10,
            scrollY     : 'auto',
            scrollX     : false,
            responsive  : true,
            autoWidth   : false,
            "aaSorting": [[ 4, "asc" ]],
            "bDestroy": true
        }
    );

    $( ".delete_users" ).click(function( event) {
        event.preventDefault();
        var id_user = $(this).attr('id'); 
        var url     = $(this).attr('href'); 
        bootbox.confirm({
            message: "Do you are sure you want to delete the record?",
            size: "small",
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel',
                    className: 'btn-default-bootbox'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> OK',
                    className: 'btn-primary-bootbox'
                }
            },
            callback: function (result) {
              if(result == 1){
                alertDialog("small", "Record deleted correctly");
                $(location).attr('href', url);
              }
            }
        });
    });


    

});