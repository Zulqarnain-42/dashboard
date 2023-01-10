var categorydatatable;
$(function () {
    categorydatatable = $('#category-datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [0, 'asc'],
        ajax: "/categories",
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },

        columns: [
            { data: 'id', name: 'id' },
            { data: 'categorycode', name: 'categorycode' },
            { data: 'title', name: 'title' },
            {
                "render": function (data, type, full_row, meta) {
                    return '<img src="' + full_row.image + '" class="avatar" height="50px">';
                }
            },
            {
                "render": function (data, type, full_row, meta) {
                    return '<img src="' + full_row.slider + '" class="avatar" height="35px">';
                }
            },
            {
                "data": "status", render: function (data, type, full_row, meta) {
                    if (full_row.isfeatured == true) {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" onclick="ChangeCategoryFeatured('+full_row.id+');" id="" value="true" checked></div>';
                    } else {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" onclick="ChangeCategoryFeatured('+full_row.id+');" id="" value="false"></div>';
                    }
                }
            },
            {
                "data": "status", render: function (data, type, full_row, meta) {
                    if (full_row.status == true) {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" onclick="ChangeCategoryStatus('+full_row.id+');" id="" value="true" checked></div>';
                    } else {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" onclick="ChangeCategoryStatus('+full_row.id+');" id="" value="false"></div>';
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
                    return '<ul class="list-inline hstack gap-2 mb-0">' +
                        '<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">' +
                        '<a href="categories/' + full_row.id + '/edit" class="text-primary d-inline-block edit-item-btn"><i class="ri-pencil-fill fs-16"></i></a>' +
                        '</li>' +
                        '<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title data-bs-original-title="Remove">' +
                    '<a class="text-danger d-inline-block remove-item-btn" onclick="Delcategory(' + full_row.id + ');" data-bs-toggle="modal" href="#">' +
                    '<i class="ri-delete-bin-5-fill fs-16"></i>' +
                    '</a>' +
                    '</li>' +
                        '</ul>';
                }
            }
        ],
    });
});


function Delcategory(categoryid) {
    $('#categoryid').val(categoryid);
    $('#deleteRecordModal').modal('show');
}

function delcategoryajax() {
    var id = $('#categoryid').val();
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/categories/" + id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function () {
            categorydatatable.ajax.reload();
            $('#deleteRecordModal').modal('hide');
        }
    });
}


function ChangeCategoryStatus(categoryid) {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/changecategoriesstatus/" + categoryid,
        type: 'POST',
        data: {
            "categoryid": categoryid,
            "_token": token,
        },
        success: function () {
            categorydatatable.ajax.reload();
        }
    });
}


function ChangeCategoryFeatured(categoryid) {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/changecategoriesfeatured/" + categoryid,
        type: 'POST',
        data: {
            "categoryid": categoryid,
            "_token": token,
        },
        success: function () {
            categorydatatable.ajax.reload();
        }
    });
}
