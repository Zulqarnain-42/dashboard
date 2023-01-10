var sliderdatatable
$(function () {
    sliderdatatable = $('#slider-datatable').DataTable({
        processing: true,
        serverSide: true,
        order: [0, 'asc'],
        ajax: "/slider",
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            $("td:first", nRow).html(iDisplayIndex + 1);
            return nRow;
        },

        columns: [
            { data: 'id', name: 'id' },
            { data: 'slidercode', name: 'slidercode' },
            { data: 'heading', name: 'heading' },
            { data: 'slug', name: 'slug' },
            {
                "render": function (data, type, full_row, meta) {
                    return '<img src="' + full_row.image + '" class="avatar" height="50px">';
                }
            },
            {
                "data": "status", render: function (data, type, full_row, meta) {
                    if (full_row.status == true) {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="slidercheckbox" onclick="ChangeSliderStatus('+full_row.id+');" name="slidercheckbox" value="true" checked></div>';
                    } else {
                        return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="slidercheckbox" onclick="ChangeSliderStatus('+full_row.id+');" name="slidercheckbox" value="false"></div>';
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
                    '<a href="slider/' + full_row.id + '/edit" class="text-primary d-inline-block edit-item-btn"><i class="ri-pencil-fill fs-16"></i></a>' +
                    '</li>' +
                    '<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title data-bs-original-title="Remove">' +
                    '<a class="text-danger d-inline-block remove-item-btn" onclick="DelSlider(' + full_row.id + ');" data-bs-toggle="modal" href="#">' +
                    '<i class="ri-delete-bin-5-fill fs-16"></i>' +
                    '</a>' +
                    '</li>' +
                    '</ul>';
            }
        }],
    });
});


function DelSlider(sliderid) {
    $('#sliderid').val(sliderid);
    $('#deleteRecordModal').modal('show');
}


function delsliderajax() {
    var id = $('#sliderid').val();
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/slider/" + id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function () {
            sliderdatatable.ajax.reload();
            $('#deleteRecordModal').modal('hide');
        }
    });
}


function ChangeSliderStatus(sliderid) {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "/changesliderstatus/" + sliderid,
        type: 'POST',
        data: {
            "sliderid": sliderid,
            "_token": token,
        },
        success: function () {
            sliderdatatable.ajax.reload();
        }
    });
}
