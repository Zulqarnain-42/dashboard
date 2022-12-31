var roledatatable;
$(function () {
    roledatatable = $('#roles-datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [0, 'asc'],
        ajax: "roles",
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },

        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },

        ],

        'columnDefs': [
            {
                'targets': 2,
                'defaultContent': '-',
                'searchable': false,
                'orderable': false,
                'width': '10%',
                'className': 'dt-body-center',
                'render': function (data, type, full_row, meta) {
                    return '<ul class="list-inline hstack gap-2 mb-0">' +
                        '<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">' +
                        '<a href="roles/' + full_row.id + '/edit" class="text-primary d-inline-block edit-item-btn"><i class="ri-pencil-fill fs-16"></i></a>' +
                        '</li>' +
                        '<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title data-bs-original-title="Remove">' +
                        '<a class="text-danger d-inline-block remove-item-btn" onclick="DelRole(' + full_row.id + ');" data-bs-toggle="modal" href="">' +
                        '<i class="ri-delete-bin-5-fill fs-16"></i>' +
                        '</a>' +
                        '</li>' +
                        '</ul>';
                }
            }
        ],
    });
});


function DelRole(roleid) {
    $('#roleid').val(roleid);
    $('#deleteRecordModal').modal('show');
}

function delroleajax() {
    var id = $('#roleid').val();
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/roles/" + id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function () {
            roledatatable.ajax.reload();
            $('#deleteRecordModal').modal('hide');
        }
    });
}
