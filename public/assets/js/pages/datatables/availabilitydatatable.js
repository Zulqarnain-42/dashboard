var AvailabilityDatatable;
$(function () {
    AvailabilityDatatable = $('#availability-datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [0, 'asc'],
        ajax: "availability",
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },

        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            {
                "data": "status", render: function (data, type, full_row, meta) {
                    if (full_row.status == true) {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" onclick="ChangeAvailabilityStatus('+full_row.id+')" checked></div>';
                    } else {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" onclick="ChangeAvailabilityStatus('+full_row.id+')"></div>';
                    }
                }
            },
        ],
        'columnDefs': [{
            'targets': 3,
            'defaultContent': '-',
            'searchable': false,
            'orderable': false,
            'width': '10%',
            'className': 'dt-body-center',
            'render': function (data, type, full_row, meta) {
                return '<ul class="list-inline hstack gap-2 mb-0">' +
                    '<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">' +
                    '<a href="#" id="edit-availability" data-id="'+full_row.id+'" class="text-primary d-inline-block edit-item-btn">' +
                        '<i class="ri-pencil-fill fs-16"></i></a>' +
                        '</li>' +
                        '<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title data-bs-original-title="Remove">' +
                        '<a class="text-danger d-inline-block remove-item-btn" onclick="Delavailability(' + full_row.id + ');" data-bs-toggle="modal" href="">' +
                        '<i class="ri-delete-bin-5-fill fs-16"></i>' +
                        '</a>' +
                        '</li>' +
                    '</ul>';
            }
        }],
    });
});


$('#create-availability').click(function () {
    $('#edit-btn').hide();
    $('#add-btn').show();
    $('#exampleModalLabel').html("Add Availability");
    $('#availabilityform').trigger("reset");
    $('#AddEditModal').modal("show");
})


$('#add-btn').click(function () {
    var availabilityname = $("#availabilityname").val();
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url: "/availability",
        type: 'POST',
        dataType: 'json',
        data: {
            "availabilityname": availabilityname,
            "_token": token,
        },
        success: function () {
            AvailabilityDatatable.ajax.reload();
            $('#AddEditModal').modal('hide');
        }
    });

})


function Delavailability(availabilityid) {
    $('#availabilityid').val(availabilityid);
    $('#deleteRecordModal').modal('show');
}

function delavailabilityajax() {
    var id = $('#availabilityid').val();
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/availability/" + id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function () {
            AvailabilityDatatable.ajax.reload();
            $('#deleteRecordModal').modal('hide');
        }
    });
}


function ChangeAvailabilityStatus(availabilityid) {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/changeavailabilitystatus/" + availabilityid,
        type: 'POST',
        data: {
            "availabilityid": availabilityid,
            "_token": token,
        },
        success: function () {
            AvailabilityDatatable.ajax.reload();
        }
    });
}


$('body').on('click', '#edit-availability', function () {
    var availabilityid = $(this).data('id');
    $.get("/availability" + '/' + availabilityid + '/edit', function (data) {
        $('#add-btn').hide();
        $('#exampleModalLabel').html("Edit Availability");
        $('#availabilityid').val(data.data.id);
        $('#availabilityname').val(data.data.name);
        $('#edit-btn').show();
        $('#AddEditModal').modal("show");
    })
})


$('#edit-btn').click(function () {
    var availabilityid = $("#availabilityid").val();
    var availabilityname = $("#availabilityname").val();
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url: "availability/"+availabilityid,
        type: 'PUT',
        dataType: 'json',
        data: {
            "availabilityid" : availabilityid,
            "availabilityname": availabilityname,
            "_token": token,
        },
        success: function () {
            AvailabilityDatatable.ajax.reload();
            $('#AddEditModal').modal('hide');
        }
    });

})
