<x-app-layout>
    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <form method="POST" name="productform" action="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}" id="createproduct-form" autocomplete="off" enctype="multipart/form-data" class="needs-validation" onsubmit="return validateForm()" novalidate>
        @csrf
        @if (isset($product))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Product Title</label>
                            <input type="text" class="form-control" name="producttitle" id="producttitle" value="{{ isset($product) ? $product->title : old('producttitle') }}" placeholder="Enter product title" required>
                        </div>
                        <div>
                            <label>Product Short Description</label>
                            <textarea name="shortdes" id="shortdescription-classic">{{ isset($product) ? $product->shortdescription : old('shortdes') }}</textarea>
                        </div>
                        <div>
                            <label>Product Long Description</label>
                            <textarea name="longdescription" id="ckeditor-classic">{{ isset($product) ? $product->longdescription : old('longdescription') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Gallery</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <input type="file" name="ProductsUploadFilePond[]" id="ProductsUploadFilePond" multiple accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info" role="tab">General Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#addproduct-inthebox" role="tab">In The Box</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#addproduct-specification" role="tab">Specifications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#addproduct-metadata" role="tab">Meta Data</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">MFR</label>
                                            <input type="text" class="form-control" style="text-transform:uppercase" name="mfr" value="{{ isset($product) ? $product->mfr : old('mfr') }}" id="mfr" placeholder="model">
                                            <span id="promodel"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-brand-input">UPC</label>
                                            <input type="text" class="form-control" name="upc" value="{{ isset($product) ? $product->upc : old('upc') }}" id="upc" placeholder="Enter universal product code">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Length</label>
                                            <input type="text" class="form-control" name="length" value="{{ isset($product) ? $product->length : old('length') }}" id="length" placeholder="Length" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="orders-input">Width</label>
                                            <input type="text" class="form-control" name="width" value="{{ isset($product) ? $product->width : old('width') }}" id="width" placeholder="Width" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="orders-input">Height</label>
                                            <input type="text" class="form-control" name="height" value="{{ isset($product) ? $product->height : old('height') }}" id="height" placeholder="Height" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="orders-input">Weight</label>
                                            <input type="text" class="form-control" name="weight" value="{{ isset($product) ? $product->weight : old('weight') }}" id="weight" placeholder="Weight" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Lens Mount Type</label>
                                            <input type="text" class="form-control" name="lensmount" value="{{ isset($product) ? $product->lensmounttype : old('lensmount') }}" id="lensmount" placeholder="Lens Mount" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="orders-input">Display Size</label>
                                            <input type="text" class="form-control" name="displaysize" value="{{ isset($product) ? $product->displaysize : old('displaysize') }}" id="displaysize" placeholder="Display Size" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="orders-input">Video Resolution</label>
                                            <input type="text" class="form-control" name="videoresolution" value="{{ isset($product) ? $product->videoresolution : old('videoresolution') }}" id="videoresolution" placeholder="Video Resolution" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="orders-input">Card Type</label>
                                            <input type="text" class="form-control" name="cardtype" value="{{ isset($product) ? $product->cardtype : old('cardtype') }}" id="cardtype" placeholder="Card Type" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="orders-input">Digital Interface</label>
                                            <input type="text" class="form-control" name="digitalinterface" value="{{ isset($product) ? $product->digitalinterface : old('digitalinterface') }}" id="digitalinterface" placeholder="Digital Interface" required>
                                        </div>
                                    </div>
                                     <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="retail-price">Retail Price</label>
                                            <div class="input-group has-validation mb-3">
                                                <span class="input-group-text" id="retail-price">$</span>
                                                <input type="text" class="form-control" name="retailprice" id="retailprice" placeholder="Retail price" value="{{ isset($product) ? $product->retailprice : old('retailprice') }}" aria-label="Retail Price" aria-describedby="retailprice-addon" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="product-price-input">Sale Price</label>
                                            <div class="input-group has-validation mb-3">
                                                <span class="input-group-text" id="product-price-addon">$</span>
                                                <input type="text" class="form-control" name="saleprice" id="saleprice" placeholder="Enter price" value="{{ isset($product) ? $product->price : old('saleprice') }}" aria-label="Price" aria-describedby="product-price-addon" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="addproduct-inthebox" role="tabpanel">
                                <div>
                                    <label>In The Box</label>
                                    <textarea name="inthebox" id="inthebox-classic">{{ isset($product) ? $product->inthebox : old('inthebox') }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="addproduct-specification" role="tabpanel">
                                <div>
                                    <label>Specifications</label>
                                    <textarea name="specifications" id="specification-classic">{{ isset($product) ? $product->specifications : old('specifications') }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="addproduct-metadata" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta-title-input">Meta title</label>
                                            <input type="text" class="form-control" name="metatitle" value="{{ isset($product) ? $product->metatitle : old('metatitle') }}" placeholder="Enter meta title" id="metatitle">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta-keywords-input">Meta Keywords</label>
                                            <input type="text" class="form-control" name="metakeywords" value="{{ isset($product) ? $product->metakeywords : old('metakeywords') }}" placeholder="Enter meta keywords" id="metakeywords">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label" for="meta-description-input">Meta Description</label>
                                    <textarea class="form-control" id="metadescription" name="metadescription" value="{{ isset($product) ? $product->metadescription : old('metadescription') }}" placeholder="Enter meta description" rows="3"></textarea>
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
                                    <option value="{{ $status->id }}"
                                        {{ isset($product) && $product->status == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="choices-publish-visibility-input" class="form-label">Visibility</label>
                            <select class="form-select" name="visibility" id="visibility" data-choices data-choices-search-false>
                                @foreach ($collectionvisibility as $visibilty)
                                    <option value="{{ $visibilty->id }}"
                                        {{ isset($product) && $product->visibility == $visibilty->id ? 'selected' : '' }}>
                                        {{ $visibilty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Categories</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">
                            <a href="{{ route('categories.create') }}" class="float-end text-decoration-underline">Add New</a>
                            Select product category
                        </p>
                        <select class="js-example-basic-multiple" name="productcategories[]" multiple="multiple">
                            @foreach ($collectioncategory as $category)
                                <option value="{{ $category->id }}"
                                    @if (isset($selectedproductcategories)) @foreach ($selectedproductcategories as $categories) {{ $categories->category_id == $category->id ? 'selected' : '' }} @endforeach @endif>
                                    {{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Brand</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">
                            <a href="{{ route('brand.create') }}" class="float-end text-decoration-underline">Add
                                New</a>
                            Select product Brand
                        </p>
                        <select class="js-example-basic-single" name="brand">
                            <option>Select a Brand</option>
                            @foreach ($collectionbrand as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ isset($product) && $product->brandid == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Thumbnail</h5>
                    </div>
                    <div class="card-body">
                        <input type="file" name="ProductsThumbnailFilePond" id="ProductsThumbnailFilePond" accept="image/*">
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Related Products</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Select Related Products</p>
                        <select class="js-example-basic-multiple1" name="relatedproducts[]" multiple="multiple">
                            @foreach ($collectionproducts as $product)
                                <option
                                    @if (isset($relatedproducts)) @foreach ($relatedproducts as $relprod) {{ $relprod->relatedproductsid == $product->id ? 'selected' : '' }} @endforeach @endif
                                    value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Availability</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Select Availability</p>
                        <select class="js-example-basic-single" name="availability">
                            <option>Select a Availability</option>
                            @foreach ($collectionavailability as $availability)
                                <option value="{{ $availability->id }}"
                                    {{ isset($product) && $product->availabilityid == $availability->id ? 'selected' : '' }}>
                                    {{ $availability->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </form>
    @section('scripts')
        <script src="{{ URL::asset('assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
        <script src="{{ URL::asset('assets/js/pages/ecommerce-product-create.init.js') }}"></script>
    @endsection
</x-app-layout>
