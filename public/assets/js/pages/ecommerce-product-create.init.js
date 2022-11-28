itemid = 13,
ClassicEditor.create(
    document.querySelector("#ckeditor-classic")).then(
        function (e) {
            e.ui.view.editable.element.style.height = "200px"
        }).catch(function (e) {
    console.error(e)
});

ClassicEditor.create(
    document.querySelector("#inthebox-classic")).then(
        function (e) {
            e.ui.view.editable.element.style.height = "200px"
        }).catch(function (e) {
    console.error(e)
});

ClassicEditor.create(
    document.querySelector("#specification-classic")).then(
        function (e) {
            e.ui.view.editable.element.style.height = "200px"
        }).catch(function (e) {
    console.error(e)
});

ClassicEditor.create(
    document.querySelector("#shortdescription-classic")).then(
        function (e) {
            e.ui.view.editable.element.style.height = "200px"
        }).catch(function (e) {
    console.error(e)
});

$(document).ready(function () {
    $("#producttitle").keyup(function () {
        $("#metatitle").val($(this).val());
    });


    $("#mfr").keyup(function () {
        var productmodel = $("#mfr").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/check-model',
            data: { model: productmodel },
            success: function (resp) {
                if (resp == "false") {
                    $("#mfr").css("border-color", "red");
                    $("#promodel").html("<font color=red>Model Already Exist</font>");
                } else {
                    $("#mfr").css("border-color", "");
                    $("#promodel").html("");
                }
            },
            error: function () {
                console.log("Error");
            }
        });
    });
});



FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginFileValidateType);
const inputElement = document.querySelector('#ProductsUploadFilePond');
const inputSecondElement = document.querySelector('#ProductsThumbnailFilePond');
const pond = FilePond.create(inputElement, {
    server: {
        url: '/uploadproducts',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }
});

const secondpond = FilePond.create(inputSecondElement, {
    server: {
        url: '/uploadthumbnail',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }
});
