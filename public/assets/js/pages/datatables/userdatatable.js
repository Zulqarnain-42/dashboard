var userdatatable;
$(function () {
    userdatatable = $('#user-datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [0, 'asc'],
        ajax: "users",
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },

        columns: [
            { data: 'id', name: 'id' },
            {
                "render": function (data, type, full_row, meta) {
                    return '<img src="' + full_row.image + '" class="avatar" height="35px">';
                }
            },
            { data: 'firstname', name: 'firstname' },
            { data: 'lastname', name: 'lastname' },
            { data: 'username', name: 'username' },
            { data: 'email', name: 'email' },
            { data: 'mobile', name: 'mobile' },
            {
                "data": "status", render: function (data, type, full_row, meta) {
                    if (full_row.status == true) {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" onclick="ChangeUserStatus('+full_row.id+');" checked></div>';
                    } else {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" onclick="ChangeUserStatus('+full_row.id+');"></div>';
                    }
                }
            },
        ],
        'columnDefs': [
            {
                'targets': 8,
                'defaultContent': '-',
                'searchable': false,
                'orderable': false,
                'width': '10%',
                'className': 'dt-body-center',
                'render': function (data, type, full_row, meta) {
                    return '<ul class="list-inline hstack gap-2 mb-0">' +
                        '<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">' +
                        '<a href="users/' + full_row.id + '/edit" class="text-primary d-inline-block edit-item-btn"><i class="ri-pencil-fill fs-16"></i></a>' +
                        '</li>' +
                        '<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title data-bs-original-title="Remove">' +
                        '<a class="text-danger d-inline-block remove-item-btn" onclick="Deluser(' + full_row.id + ');" data-bs-toggle="modal" href="">' +
                        '<i class="ri-delete-bin-5-fill fs-16"></i>' +
                        '</a>' +
                        '</li>' +
                        '</ul>';
                }
            }
        ],
    });
});

function Deluser(userid) {
    $('#userid').val(userid);
    $('#deleteRecordModal').modal('show');
}

function deluserajax() {
    var id = $('#userid').val();
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/users/" + id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function () {
            userdatatable.ajax.reload();
            $('#deleteRecordModal').modal('hide');
        }
    });
}

function ChangeUserStatus(userid) {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/changeuserstatus/" + userid,
        type: 'POST',
        data: {
            "userid": userid,
            "_token": token,
        },
        success: function () {
            userdatatable.ajax.reload();
        }
    });
}
