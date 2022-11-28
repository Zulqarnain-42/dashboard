itemid = 13,
ClassicEditor.create(
    document.querySelector("#ckeditor-classic")).then(function (e) {
            e.ui.view.editable.element.style.height = "200px"
    }).catch(function (e) {
        console.error(e)
    });

$(document).ready(function () {
    $("#title").keyup(function () {
        $("#metatitle").val($(this).val());
    });
});


FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginFileValidateType);
const inputElement = document.querySelector('#BrandUploadFilePond');
const pond = FilePond.create(inputElement, {
    server: {
        url: '/uploadbrand',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }
});
