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


    $("#mfrmodelvalue").keyup(function () {
        var productmodel = $("#mfrmodelvalue").val();
        if (productmodel == "") {
            $('#model-suggestions').html("");
        } else {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'get',
                url: '/check-model',
                data: { model: productmodel },
                success: function (resp) {
                    $("#model-suggestions").html(resp);
                },
                error: function () {
                    console.log("Error");
                }
            });
        }
    });

    $(document).on('click', 'li', function () {
        var value = $(this).text();
        $('#mfrmodel').val(value);
        $('#model-suggestions').html("");
    })

    $('#createproduct-form').validate({
        rules: {
            producttitle: {
                required: true
            },
            mfr: {
                required: true
            },
            saleprice: {
                required: true
            },
            productcategories: {
                required: true
            },
            brand: {
                required: true
            }
        },
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
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }
});

const secondpond = FilePond.create(inputSecondElement, {
    server: {
        url: '/uploadthumbnail',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }
});
