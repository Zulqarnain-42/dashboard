<x-app-layout>
    <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Create Slider</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                    <li class="breadcrumb-item active">Create Slider</li>
                </ol>
            </div>

        </div>
    </div>
</div>
    <form id="createpromotion-form" autocomplete="off" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="promotion-title-input">Promotion Title</label>
                            <input type="text" class="form-control" id="promotion-title-input" value="" placeholder="Enter Promotion title" required>
                            <div class="invalid-feedback">Please Enter a promotion title.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-search">Search Product</label>
                            <input type="text" class="form-control" id="promotion-search-input" value="" placeholder="Search">
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Products</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="invoice-table table table-borderless table-nowrap mb-0">
                                <thead class="align-middle">
                                    <tr class="table-active">
                                        <th scope="col" style="width: 50px;">#</th>
                                        <th scope="col">Product Details</th>
                                        <th scope="col" style="width: 120px;">
                                            <div class="d-flex currency-select input-light align-items-center">
                                                Price
                                            </div>
                                        </th>
                                        <th scope="col" style="width: 120px;">Quantity</th>
                                        <th scope="col" class="text-end" style="width: 105px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="newlink">
                                    <tr id="1" class="product">
                                        <th scope="row" class="product-id">1</th>
                                        <td class="text-start">
                                            <div class="mb-2">
                                                <input type="text" class="form-control bg-light border-0" id="productName-1" placeholder="Product Name" required />
                                                <div class="invalid-feedback">
                                                    Please enter a product name
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control product-price bg-light border-0" id="productRate-1" step="0.01" placeholder="0.00" required />
                                            <div class="invalid-feedback">
                                                Please enter a rate
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mb-2">
                                                <input type="text" class="form-control bg-light border-0" id="productName-1" placeholder="0" required />
                                            </div>
                                        </td>
                                        <td class="product-removal">
                                            <a href="javascript:void(0)" class="btn btn-danger"><i class="mdi mdi-trash-can"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Status</label>
                            <select class="form-select" id="choices-publish-status-input" data-choices data-choices-search-false>
                                @foreach ($collectionstatus as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Date & Time</h5>
                    </div>
                    <!-- end card body -->
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="startdate-input" class="form-label">Start Date</label>
                            <input type="date" id="startdate-input" class="form-control" placeholder="Enter publish date" data-provider="flatpickr" data-date-format="d.m.y">
                        </div>
                        <div class="mb-3">
                            <label for="enddate-input" class="form-label">End Date</label>
                            <input type="text" id="enddate-input" class="form-control" placeholder="Enter Ending date" data-provider="flatpickr" data-date-format="d.m.y">
                        </div>
                    </div>
                </div>
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
        </div>
    </form>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
        <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
        <script src="{{ asset('assets/js/algolia.js') }}"></script>
    @endsection
</x-app-layout>
