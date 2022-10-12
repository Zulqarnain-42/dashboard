<x-app-layout>
    <form method="POST" action="{{ isset($brand) ? route('brand.update', $brand->id) : route('brand.store') }}" id="createproduct-form" autocomplete="off" class="needs-validation" enctype="multipart/form-data" novalidate>
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
                            <input type="text" class="form-control" id="title" name="title" value="{{ isset($brand) ? $brand->title : old('title') }}" placeholder="Enter Brand Title" required>
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
                                <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-metadata" role="tab">
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
                                            <input type="text" class="form-control" name="metatitle" value="{{ isset($brand) ? $brand->metatitle : old('metatitle') }}" placeholder="Enter meta title" id="metatitle">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta-keywords-input">Meta Keywords</label>
                                            <input type="text" class="form-control" name="metakeyword" value="{{ isset($brand) ? $brand->metakeywords : old('metakeyword') }}" placeholder="Enter meta keywords" id="metakeyword">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label" for="meta-description-input">Meta Description</label>
                                    <textarea class="form-control" id="metadescription" name="metadescription" value="{{ isset($brand) ? $brand->metadescription : old('metadescription') }}" placeholder="Enter meta description" rows="3"></textarea>
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
                            <select class="form-select" name="status" id="status" data-choices data-choices-search-false>
                                @foreach ($collectionstatus as $status)
                                <option value="{{ $status->id }}" {{ (isset($brand) && $brand->status == $status->id) ? 'selected' : '' }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="choices-publish-visibility-input" class="form-label">Visibility</label>
                            <select class="form-select" name="visibility" id="visibility" data-choices data-choices-search-false>
                                @foreach ($collectionvisibility as $visibilty)
                                    <option value="{{ $visibilty->id }}" {{ (isset($brand) && $brand->visibility == $visibilty->id) ? 'selected' : '' }}>{{ $visibilty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Brand Gallery</h5>
                    </div>
                    <div class="card-body">
                        <input type="file" name="BrandUploadFilePond" id="BrandUploadFilePond" accept="image/*">
                    </div>
                </div>
            </div>
        </div>
    </form>
    @section('scripts')
        <script src="{{ URL::asset('assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ URL::asset('assets/js/pages/ecommerce-brand-create.init.js') }}"></script>
        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            const inputElement = document.querySelector('#BrandUploadFilePond');
            const pond = FilePond.create(inputElement,{
                server:{
                    url:'/uploadbrand',
                    headers:{
                        'X-CSRF-TOKEN':'{{ csrf_token() }}'
                    }
                }
            });
        </script>
    @endsection
</x-app-layout>
