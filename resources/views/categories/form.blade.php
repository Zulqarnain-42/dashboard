<x-app-layout>
    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection

    @if (isset($category))

    @else
        {{ Breadcrumbs::render('createcategories') }}
    @endif

    <form method="POST" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" id="category-form" autocomplete="off" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                            <input type="text" class="form-control" name="title" id="title" value="{{ isset($category) ? $category->title : old('title') }}" placeholder="Enter Category title" required>
                        </div>
                        <div>
                            <label>Category Description</label>
                            <textarea name="description" id="ckeditor-classic">{{ isset($category) ? $category->description : old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Categories Slider</h5>
                    </div>
                    <div class="card-body">
                        <input type="file" name="CategorySliderUploadFilePond" id="CategorySliderUploadFilePond" accept="image/*">
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
                                            <input type="text" class="form-control" name="metatitle" placeholder="Enter meta title" value="{{ isset($category) ? $category->metatitle : old('metatitle') }}" id="metatitle">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta-keywords-input">Meta Keywords</label>
                                            <input type="text" class="form-control" name="metakeywords" placeholder="Enter meta keywords" value="{{ isset($category) ? $category->metakeywords : old('metakeywords') }}" id="metakeywords">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label" for="meta-description-input">Meta Description</label>
                                    <textarea class="form-control" id="metadescription" name="metadescription" placeholder="Enter meta description" value="{{ isset($category) ? $category->metadescription : old('metadescription') }}" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Visibility Status</label>
                            <select class="form-select" name="status" id="status" data-choices data-choices-search-false>
                                @foreach ($collectionstatus as $status)
                                    <option value="{{ $status->id }}" {{ (isset($category) && $category->status == $status->id) ? 'selected' : '' }}
                                        {{ (old("status") == $status->id ? "selected":"") }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Category Image</h5>
                    </div>
                    <div class="card-body">
                        <input type="file" name="CategoryImageUploadFilePond" id="CategoryImageUploadFilePond" accept="image/*">
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Sub Categories</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2 text-muted"> Select Sub category</p>
                        <select class="js-example-basic-single" id="maincategory" name="maincategory">
                            <option value="none">Select a Sub Category</option>
                            @foreach ($collectionmaincategory as $maincategory)
                                <option value="{{ $maincategory->id }}" {{ (isset($category) && $category->parent_id == $maincategory->id) ? 'selected' : '' }}
                                    {{ (old("maincategory") == $maincategory->id ? "selected":"") }}>{{ $maincategory->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @section('scripts')
        <script src="{{ URL::asset('assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="{{ URL::asset('assets/js/pages/ecommerce-category-create.init.js') }}"></script>
    @endsection
</x-app-layout>
