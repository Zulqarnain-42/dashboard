itemid = 13,
ClassicEditor.create(
    document.querySelector("#ckeditor-classic")).then(
        function (e) {
            e.ui.view.editable.element.style.height = "200px"
            }).catch(
                function (e) {
                    console.error(e)
                });



$(document).ready(function () {
    $("#title").keyup(function () {
        $("#metatitle").val($(this).val());
    });


    $('#category-form').validate({
        rules: {
            title: {
                required: true
            },
        },
    });
});


FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginFileValidateType);
const inputElement = document.querySelector('#CategorySliderUploadFilePond');
const secondinputElement = document.querySelector('#CategoryImageUploadFilePond');
const pond = FilePond.create(inputElement, {
    server: {
        url: '/uploadcategoryslider',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }
});

const secondpond = FilePond.create(secondinputElement, {
    server: {
        url: '/uploadcategoryimage',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }
});
