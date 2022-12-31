var CurrencyDatatable;
$(function () {
    CurrencyDatatable = $('#currency-datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [0, 'asc'],
        ajax: "currency",
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },

        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'symbol', name: 'symbol' },
            {
                "data": "status", render: function (data, type, full_row, meta) {
                    if (full_row.status == true) {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" onclick="ChangeCurrencyStatus('+full_row.id+');" value="true" checked></div>';
                    } else {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" onclick="ChangeCurrencyStatus('+full_row.id+');" value="false"></div>';
                    }
                }
            },
        ],
        'columnDefs': [{
            'targets': 4,
            'defaultContent': '-',
            'searchable': false,
            'orderable': false,
            'width': '10%',
            'className': 'dt-body-center',
            'render': function (data, type, full_row, meta) {
                return '<ul class="list-inline hstack gap-2 mb-0">' +
                    '<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">' +
                    '<a href="#" id="edit-currency" data-id="'+full_row.id+'" class="text-primary d-inline-block edit-item-btn" data-bs-toggle="modal" data-bs-target="#fadeInRightModal">' +
                    '<i class="ri-pencil-fill fs-16"></i>' +
                    '</a>' +
                    '</li>' +
                    '<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title data-bs-original-title="Remove">' +
                    '<a class="text-danger d-inline-block remove-item-btn" onclick="Delcurrency(' + full_row.id + ');" data-bs-toggle="modal" href="">' +
                    '<i class="ri-delete-bin-5-fill fs-16"></i>' +
                    '</a>' +
                    '</li>' +
                    '</ul>';
            }
        }],
    });
});

function Delcurrency(currencyid) {
    $('#currencyid').val(currencyid);
    $('#deleteRecordModal').modal('show');
}

function delcurrencyajax() {
    var id = $('#currencyid').val();
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/currency/" + id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function () {
            CurrencyDatatable.ajax.reload();
            $('#deleteRecordModal').modal('hide');
        }
    });
}


function ChangeCurrencyStatus(currencyid) {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/changecurrencystatus/" + currencyid,
        type: 'POST',
        data: {
            "currencyid": currencyid,
            "_token": token,
        },
        success: function () {
            CurrencyDatatable.ajax.reload();
        }
    });
}


$('#create-currency').click(function () {
    $('#exampleModalLabel').html("Add Currency");
    $('#edit-btn').hide();
    $('#currency-form').trigger("reset");
    $('#AddEditModal').modal("show");
})

$('#add-btn').click(function () {
    var currencyname = $("#currencyname").val();
    var currencysymbol = $("#currencysymbol").val();
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url: "/currency",
        type: 'POST',
        dataType: 'json',
        data: {
            "currencyname": currencyname,
            "currencysymbol": currencysymbol,
            "_token": token,
        },
        success: function () {
            CurrencyDatatable.ajax.reload();
            $('#AddEditModal').modal('hide');
        }
    });

})


$('body').on('click', '#edit-currency', function () {
    var currencyid = $(this).data('id');
    $.get("/currency" + '/' + currencyid + '/edit', function (data) {
        $('#add-btn').hide();
        $('#exampleModalLabel').html("Edit Permission");
        $('#currencyid').val(data.data.id);
        $('#currencyname').val(data.data.name);
        $('#currencysymbol').val(data.data.symbol);
        $('#AddEditModal').modal("show");
    })
})


$('#edit-btn').click(function () {
    var currencyid = $("#currencyid").val();
    var currencyname = $("#currencyname").val();
    var currencysymbol = $("#currencysymbol").val();
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url: "/currency/"+currencyid,
        type: 'PUT',
        dataType: 'json',
        data: {
            "currencyid":currencyid,
            "currencyname": currencyname,
            "currencysymbol": currencysymbol,
            "_token": token,
        },
        success: function () {
            CurrencyDatatable.ajax.reload();
            $('#AddEditModal').modal('hide');
        }
    });
})
