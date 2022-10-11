itemid = 13,
ClassicEditor.create(
    document.querySelector("#ckeditor-classic")).then(
function (e) {
    e.ui.view.editable.element.style.height = "200px"
}).catch(
function (e) {
        console.error(e)
});

document.querySelector("#product-image-input").addEventListener("change",function(){var e=document.querySelector("#product-img"),t=document.querySelector("#product-image-input").files[0],o=new FileReader;o.addEventListener("load",function(){e.src=o.result},!1),t&&o.readAsDataURL(t)});document.querySelector("#product-image-input").addEventListener("change",function(){var e=document.querySelector("#product-img"),t=document.querySelector("#product-image-input").files[0],o=new FileReader;o.addEventListener("load",function(){e.src=o.result},!1),t&&o.readAsDataURL(t)});


var dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
dropzonePreviewNode.itemid = "";
var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
