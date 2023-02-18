var productdatatable;
$(function () {
    productdatatable = $('#product-datatable').DataTable({
        processing: true,
        serverSide: true,
        scrollY : true,
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
            { data: 'price', name: 'price',className: 'editable' },
            { data: 'weight', name: 'weight',className: 'editable' },
            {
                "data": "status", render: function (data, type, full_row, meta) {
                    if (full_row.isfeatured == true) {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" onclick="ChangeFeaturedStatus('+full_row.id+');" value="true" checked></div>';
                    } else {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" onclick="ChangeFeaturedStatus('+full_row.id+');" value="false"></div>';
                    }
                }
            },
            {
                "data": "status", render: function (data, type, full_row, meta) {
                    if (full_row.status == true) {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" onclick="ChangeProductStatus('+full_row.id+');" value="true" checked></div>';
                    } else {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" onclick="ChangeProductStatus('+full_row.id+');" value="false"></div>';
                    }
                }
            },
        ],
        'columnDefs': [
            {
                'targets': 7,
                'defaultContent': '-',
                'searchable': false,
                'orderable': false,
                'width': '10%',
                'className': 'dt-body-center',
                'render': function (data, type, full_row, meta) {
                    return '<div class="dropdown d-inline-block">' +
                        '<button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">' +
                        '<i class="ri-more-fill align-middle"></i>' +
                        '</button>' +
                        '<ul class="dropdown-menu dropdown-menu-end">' +
                        '<li><a href="product/'+full_row.id+'" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>' +
                        '<li><a href="product/' + full_row.id + '/edit" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>' +
                        '<li>' +
                        '<button class="dropdown-item remove-item-btn" onclick="Delproduct(' + full_row.id + ');" data-bs-toggle="modal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</button>' +
                        '</li>' +
                        '</ul>' +
                        '</div>';
                }
            }
        ],
    });
});


function Delproduct(productid) {
    $('#productid').val(productid);
    $('#deleteRecordModal').modal('show');
}

function delproductjax() {
    var id = $('#productid').val();
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/product/" + id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function () {
            productdatatable.ajax.reload();
            $('#deleteRecordModal').modal('hide');
        }
    });
}


function ChangeProductStatus(productid) {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/changeproductstatus/" + productid,
        type: 'POST',
        data: {
            "productid": productid,
            "_token": token,
        },
        success: function () {
            productdatatable.ajax.reload();
        }
    });
}


function ChangeFeaturedStatus(productid) {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/makefeatured/" + productid,
        type: 'POST',
        data: {
            "productid": productid,
            "_token": token,
        },
        success: function () {
            productdatatable.ajax.reload();
        }
    });
}


$(document).ready(function () {
    var oldValue = null;
    $(document).on('dblclick', '.editable', function () {
        oldValue = $(this).html();
        $(this).removeClass('editable');	// to stop from making repeated request
        $(this).html('<input type="text" style="width:100px;" class="update" value="' + oldValue + '" />');
        $(this).find('.update').focus();
    });

    var newValue = null;
    $(document).on('blur', '.update', function () {
        var elem = $(this);
        newValue = $(this).val();
        var rowid = $(this).attr('id');

        alert(rowid);
        if (newValue != oldValue)
        {
            $.ajax({
                url: '',
                method: 'post',
                data:
                {
                    rowid: rowid,
                    newValue: newValue,
                },
                success: function (respone)
                {
                    $(elem).parent().addClass('editable');
                    $(elem).parent().html(newValue);
                }
            });
        }
        else
        {
            $(elem).parent().addClass('editable');
            $(this).parent().html(newValue);
        }
    });
})
