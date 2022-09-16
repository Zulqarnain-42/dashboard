<x-app-layout>
    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="{{ URL::asset('assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
    @endsection
    <form method="POST"
        action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
        id="createproduct-form" autocomplete="off" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @if (isset($category))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="category-title-input">Category Title</label>
                            <input type="hidden" class="form-control" id="formAction" name="formAction" value="add">
                            <input type="text" class="form-control d-none" id="category-id-input">
                            <input type="text" class="form-control" name="title" id="category-title-input"
                                value="{{ isset($category) ? $category->title : old('title') }}"
                                placeholder="Enter Category title" required>
                            <div class="invalid-feedback">Please Enter a Category title.</div>
                        </div>
                        <div>
                            <label>Category Description</label>
                            <textarea name="description" id="ckeditor-classic">{{ isset($category) ? $category->description : old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Categories Slider</h5>
                    </div>
                    <div class="card-body">

                        <div>
                            <div class="dropzone">
                                <div class="fallback">
                                    <input name="categorysliderfile" type="file" multiple="multiple">
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                    </div>
                                    <h5>Drop files here or click to upload.</h5>
                                </div>
                            </div>
                            <ul class="list-unstyled mb-0" id="dropzone-preview">
                                <li class="mt-2" id="dropzone-preview-list">
                                    <div class="border rounded">
                                        <div class="d-flex p-2">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm bg-light rounded">
                                                    <img data-dz-thumbnail class="img-fluid rounded d-block"
                                                        src="#" alt="Product-Image" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="pt-1">
                                                    <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                    <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-3">
                                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-metadata"
                                    role="tab">
                                    Meta Data
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="addproduct-metadata" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta-title-input">Meta title</label>
                                            <input type="text" class="form-control" name="metatitle"
                                                placeholder="Enter meta title"
                                                value="{{ isset($category) ? $category->metatitle : old('metatitle') }}"
                                                id="meta-title-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta-keywords-input">Meta Keywords</label>
                                            <input type="text" class="form-control" name="metakeywords"
                                                placeholder="Enter meta keywords"
                                                value="{{ isset($category) ? $category->metakeywords : old('metakeywords') }}"
                                                id="meta-keywords-input">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label" for="meta-description-input">Meta Description</label>
                                    <textarea class="form-control" id="meta-description-input" name="metadescription"
                                        placeholder="Enter meta description"
                                        value="{{ isset($category) ? $category->metadescription : old('metadescription') }}" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Status</label>
                            <select class="form-select" name="status" id="choices-publish-status-input" data-choices
                                data-choices-search-false>
                                <option value="1" selected>Published</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>
                        <div>
                            <label for="choices-publish-visibility-input" class="form-label">Visibility</label>
                            <select class="form-select" name="visibility" id="choices-publish-visibility-input"
                                data-choices data-choices-search-false>
                                <option value="1" selected>Public</option>
                                <option value="0">Hidden</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Category Image</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="text-center">
                                <div class="position-relative d-inline-block">
                                    <div class="position-absolute top-100 start-100 translate-middle">
                                        <label for="product-image-input" class="mb-0" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Select Image">
                                            <div class="avatar-xs">
                                                <div
                                                    class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                    <i class="ri-image-fill"></i>
                                                </div>
                                            </div>
                                        </label>
                                        <input class="form-control d-none" value="" name="categoryimage"
                                            id="product-image-input" type="file"
                                            accept="image/png, image/gif, image/jpeg">
                                    </div>
                                    <div class="avatar-lg">
                                        <div class="avatar-title bg-light rounded">
                                            <img src="#" id="product-img" class="avatar-md h-auto" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Sub Categories</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2"> Select Sub category</p>
                        <select class="js-example-basic-single" id="choices-category-input" name="maincategory">
                            <option>Select a Sub Category</option>
                            @foreach ($collectionmaincategory as $maincategory)
                                <option value="{{ $maincategory->id }}">{{ $maincategory->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @section('scripts')
        <script src="{{ URL::asset('assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
        <script src="{{ URL::asset('assets/libs/dropzone/dropzone-min.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
        <script src="{{ URL::asset('assets/js/pages/ecommerce-category-create.init.js') }}"></script>
        <script>
            var uploadedDocumentMap = {}
            var dropzone = new Dropzone(".dropzone", {
                url: "{{ route('uploadcategoryslider') }}",
                method: "post",
                maxFiles: 1,
                previewTemplate: previewTemplate,
                previewsContainer: "#dropzone-preview",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(file, response) {
                    $('form').append('<input type="hidden" name="categorysliderfiles" value="' + response.name +
                        '">')
                    console.log(response);
                    uploadedDocumentMap[file.name] = response.name
                },
                removedfile: function(file) {
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedDocumentMap[file.name]
                    }
                    var url = '{{ route('removecategoryslider') }}';

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            name: name,
                            "_token": "{{ csrf_token() }}",
                        }
                    }).done(function(data) {
                        file.previewElement.remove();
                        delete uploadedDocumentMap[file.name];
                        $('form').find('input[name="categorysliderfiles"][value="' + name + '"]').remove();
                    }).fail(function() {
                        console.log('Image could not be removed');
                    });
                },
            });
        </script>
    @endsection
</x-app-layout>
