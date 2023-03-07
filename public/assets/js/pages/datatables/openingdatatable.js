var OpeningDataTable;
$(function () {
    OpeningDataTable = $('#opening-datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [0, 'asc'],
        ajax: "product",


       columns: [
            {
                "render": function (data, type, full_row, meta) {
                    return '<img src="' + full_row.thumbnail + '" class="avatar" height="35px">';
                }
            },
            { data: 'title', name: 'title' },
            { data: 'mfr', name: 'mfr' },
            { data: 'quantity', name:'quantity' ,className: 'editablequantity'}
        ],
    });
});

$(document).ready(function () {
    var oldValue = null;
    var token = $("meta[name='csrf-token']").attr("content");
    $(document).on('dblclick', '.editablequantity', function () {
        oldValue = $(this).html();
        $(this).removeClass('editablequantity');	// to stop from making repeated request
        $(this).html('<input type="text" style="width:100px;" class="updatequantity" value="' + oldValue + '" />');
        $(this).find('.updatequantity').focus();
    });

    var newValue = null;
    $(document).on('blur', '.updatequantity', function () {
        var elem = $(this);
        newValue = $(this).val();
        var currentRow = $(this).closest("tr");
        var rowdata = $('#opening-datatable').DataTable().row(currentRow).data();
        var rowid = rowdata['id'];

        if ((newValue != oldValue) && (newValue == 0) && (newValue != ""))
        {
            if(newValue == 0){
                $('#UpdateAvailability').modal('show');
                $('#edit-btn').click(function () {
                    var availabilityid = $("#availability").val();
                    $.ajax({
                        url: "updateproductavailability/" + rowid,
                        type: 'Post',
                        dataType: 'json',
                        data: {
                            "productid": rowid,
                            "quantity": newValue,
                            "availabilityid": availabilityid,
                            "_token": token,
                        },
                        success: function () {
                            $('#UpdateAvailability').modal('hide');
                            $(elem).parent().addClass('editablequantity');
                            $(elem).parent().html(newValue);
                        }
                    });
                });
            }else{
                $.ajax({
                    url: "updateproductavailability/" + rowid,
                    type: 'Post',
                    dataType: 'json',
                    data: {
                        "productid": rowid,
                        "quantity": newValue,
                        "availabilityid": 1,
                        "_token": token,
                    },
                    success: function () {
                        $(elem).parent().addClass('editablequantity');
                        $(elem).parent().html(newValue);
                    }
                });
            }
        }else{
            $(elem).parent().addClass('editablequantity');
            $(this).parent().html(oldValue);
        }

    });
})
