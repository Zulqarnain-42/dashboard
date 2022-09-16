<x-app-layout>
    @section('styles')
        <link href="{{ URL::asset('assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
    @endsection
    <form method="POST" action="{{ isset($brand) ? route('brand.update', $brand->id) : route('brand.store') }}"
        id="createproduct-form" autocomplete="off" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        @if (isset($brand))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="brand-title-input">Brand Title</label>
                            <input type="hidden" class="form-control" id="formAction" name="formAction" value="add">
                            <input type="text" class="form-control d-none" id="brand-id-input">
                            <input type="text" class="form-control" id="brand-title-input" name="title"
                                value="{{ isset($brand) ? $brand->title : old('title') }}"
                                placeholder="Enter Brand title" required>
                            <div class="invalid-feedback">Please Enter a Brand title.</div>
                        </div>
                        <div>
                            <label>Brand Description</label>

                            <textarea name="description" id="ckeditor-classic">{{ isset($brand) ? $brand->description : old('description') }}</textarea>
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
                                                value="{{ isset($brand) ? $brand->metatitle : old('metatitle') }}"
                                                placeholder="Enter meta title" id="meta-title-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta-keywords-input">Meta Keywords</label>
                                            <input type="text" class="form-control" name="metakeyword"
                                                value="{{ isset($brand) ? $brand->metakeywords : old('metakeyword') }}"
                                                placeholder="Enter meta keywords" id="meta-keywords-input">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label" for="meta-description-input">Meta Description</label>
                                    <textarea class="form-control" id="meta-description-input" name="metadescription"
                                        value="{{ isset($brand) ? $brand->metadescription : old('metadescription') }}"
                                        placeholder="Enter meta description" rows="3"></textarea>
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
                        <h5 class="card-title mb-0">Brand Gallery</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="dropzone">
                                <div class="fallback">
                                    <input name="brandfiles" type="file" multiple="multiple">
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
                                                        name="brandfile" src="#" alt="Product-Image" />
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
            </div>
        </div>
    </form>
    @section('scripts')
        <script src="{{ URL::asset('assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
        <script src="{{ URL::asset('assets/libs/dropzone/dropzone-min.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ URL::asset('assets/js/pages/ecommerce-brand-create.init.js') }}"></script>
        <script>
            var uploadedDocumentMap = {}
            var dropzone = new Dropzone(".dropzone", {
                url: "{{ route('uploadbrand') }}",
                method: "post",
                maxFiles: 1,
                previewTemplate: previewTemplate,
                previewsContainer: "#dropzone-preview",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(file, response) {
                    $('form').append('<input type="hidden" name="brandfiles" value="' + response.name + '">')
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
                    var url = '{{ route('removebrand') }}';

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
                        $('form').find('input[name="brandfiles[]"][value="' + name + '"]').remove();
                    }).fail(function() {
                        console.log('Image could not be removed');
                    });
                },
            });
        </script>
    @endsection
</x-app-layout>
