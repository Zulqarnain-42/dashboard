itemid = 13,
    ClassicEditor.create(
        document.querySelector("#ckeditor-classic")).then(
            function (e) {
                e.ui.view.editable.element.style.height = "200px"
            }).catch(
                function (e) {
                    console.error(e)
                });
ClassicEditor.create(
    document.querySelector("#inthebox-classic")).then(
        function (e) {
            e.ui.view.editable.element.style.height = "200px"
        }).catch(
            function (e) {
                console.error(e)
            });
ClassicEditor.create(
    document.querySelector("#specification-classic")).then(
        function (e) {
            e.ui.view.editable.element.style.height = "200px"
        }).catch(
            function (e) {
                console.error(e)
            });
ClassicEditor.create(
    document.querySelector("#shortdescription-classic")).then(
        function (e) {
            e.ui.view.editable.element.style.height = "200px"
        }).catch(
            function (e) {
                console.error(e)
            });



var dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
dropzonePreviewNode.itemid = "";
var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);


