var brandCategoryDatatable;
$(function () {
    brandCategoryDatatable = $('#brandcategory-datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [0, 'asc'],
        ajax: "brandcategory",

        columns: [
            { data: 'id', name: 'id' },
            { data: 'categorycode', name: 'categorycode' },
            { data: 'title', name: 'title' },
            {
                "render": function (data, type, full_row, meta) {
                    if (full_row.image) {
                        return '<img src="' + full_row.image + '" class="avatar" height="50px">';
                    }
                }
            },
            {
                "render": function (data, type, full_row, meta) {
                    if (full_row.slider) {
                        return '<img src="' + full_row.slider + '" class="avatar" height="35px">';
                    }
                }
            },
            {
                "data": "status", render: function (data, type, full_row, meta) {
                    if (full_row.status == true) {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" onclick="ChangeBrandCategoryStatus('+full_row.id+');" value="true" checked></div>';
                    } else {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" onclick="ChangeBrandCategoryStatus('+full_row.id+');" value="false"></div>';
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
                    '<a href="brandcategory/' + full_row.id + '/edit" class="text-primary d-inline-block edit-item-btn"><i class="ri-pencil-fill fs-16"></i></a>' +
                    '</li>' +
                    '<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title data-bs-original-title="Remove">' +
                    '<a class="text-danger d-inline-block remove-item-btn" onclick="Delbrandcategory(' + full_row.id + ');" data-bs-toggle="modal" href="">' +
                    '<i class="ri-delete-bin-5-fill fs-16"></i>' +
                    '</a>' +
                    '</li>' +
                    '</ul>';
            }
        }],
    });
});


function Delbrandcategory(brandcategoryid) {
    $('#brandcategoryid').val(brandcategoryid);
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


function ChangeBrandCategoryStatus(brandcategoryid) {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/changebrandcategorystatus/" + brandcategoryid,
        type: 'POST',
        data: {
            "brandcategoryid": brandcategoryid,
            "_token": token,
        },
        success: function () {
            brandCategoryDatatable.ajax.reload();
        }
    });
}
