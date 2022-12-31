var PromotionDatatable;
$(function () {
    PromotionDatatable = $('#promotion-datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [0, 'asc'],
        ajax: "promotions",

        columns: [
            { data: 'id', name: 'id' },
            { data: 'promotioncode', name: 'promotioncode' },
            { data: 'title', name: 'title' },
            { data: 'start_date', name: 'start_date' },
            {data:'end_date',name:'end_date'},
            {
                "data": "status", render: function (data, type, full_row, meta) {
                    if (full_row.status == true) {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" value="true" checked></div>';
                    } else {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" value="false"></div>';
                    }
                }
            },
        ],
        'columnDefs': [{
            'targets': 6,
            'defaultContent': '-',
            'searchable': false,
            'orderable': false,
            'width': '10%',
            'className': 'dt-body-center',
            'render': function (data, type, full_row, meta) {
                return '<ul class="list-inline hstack gap-2 mb-0">' +
                    '<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">' +
                    '<a href="promotions/' + full_row.id + '/edit" class="text-primary d-inline-block edit-item-btn"><i class="ri-pencil-fill fs-16"></i></a>' +
                    '</li>' +
                    '<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title data-bs-original-title="Remove">' +
                    '<a class="text-danger d-inline-block remove-item-btn" onclick="Delpromotion(' + full_row.id + ');" data-bs-toggle="modal" href="">' +
                    '<i class="ri-delete-bin-5-fill fs-16"></i>' +
                    '</a>' +
                    '</li>' +
                    '</ul>';
            }
        }],
    });
});


function Delpromotion(promotionid) {
    $('#brandcategoryid').val(promotionid);
    $('#deleteRecordModal').modal('show');
}

function delbrandcategoryajax() {

    var id = $('#brandcategoryid').val();
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/brandcategory/" + id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function () {
            brandCategoryDatatable.ajax.reload();
            $('#deleteRecordModal').modal('hide');
        }
    });
}

