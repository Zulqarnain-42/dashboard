var permissiondatatable;
$(function () {
    permissiondatatable = $('#permission-datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [0, 'asc'],
        ajax: "permissions",
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },

        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'url', name: 'url' },
        ],
        'columnDefs': [
            {
                'targets': 3,
                'defaultContent': '-',
                'searchable': false,
                'orderable': false,
                'width': '10%',
                'className': 'dt-body-center',
                'render': function (data, type, full_row, meta) {
                    return '<ul class="list-inline hstack gap-2 mb-0">' +
                        '<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">' +
                        '<a href="#" id="edit-permission" data-id="'+full_row.id+'" class="text-primary d-inline-block edit-item-btn"><i class="ri-pencil-fill fs-16"></i></a>' +
                        '</li>' +
                        '<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title data-bs-original-title="Remove">' +
                        '<a class="text-danger d-inline-block remove-item-btn" onclick="Delpermission(' + full_row.id + ');" data-bs-toggle="modal" href="">' +
                        '<i class="ri-delete-bin-5-fill fs-16"></i>' +
                        '</a>' +
                        '</li>' +
                        '</ul>';
                }
            }
        ],
    });
});

function Delpermission(permissionid) {
    $('#permissionid').val(permissionid);
    $('#deleteRecordModal').modal('show');
}

function delpermissionajax() {
    var id = $('#permissionid').val();
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/permissions/" + id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function () {
            permissiondatatable.ajax.reload();
            $('#deleteRecordModal').modal('hide');
        }
    });
}


$('#create-permission').click(function () {
    $('#edit-btn').hide();
    $('#exampleModalLabel').html("Add Permission");
    $('#permissionform').trigger("reset");
    $('#AddEditModal').modal("show");
})


$('#add-btn').click(function () {
    var permissionname = $("#permission-name").val();
    var permissionurl = $("#permission-url").val();
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url: "/permissions",
        type: 'POST',
        dataType: 'json',
        data: {
            "permissionname": permissionname,
            "permissionurl": permissionurl,
            "_token": token,
        },
        success: function () {
            permissiondatatable.ajax.reload();
            $('#AddEditModal').modal('hide');
        }
    });

})


$('body').on('click', '#edit-permission', function () {
    var permissionid = $(this).data('id');
    $.get("/permissions" + '/' + permissionid + '/edit', function (data) {
        $('#add-btn').hide();
        $('#exampleModalLabel').html("Edit Permission");
        $('#permissionid').val(data.data.id);
        $('#permissionname').val(data.data.name);
        $('#permissionurl').val(data.data.url);
        $('#AddEditModal').modal("show");
    })
})
