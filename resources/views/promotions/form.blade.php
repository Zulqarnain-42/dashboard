<x-app-layout>
    @section('styles')
        <link rel="stylesheet" href="{{URL::asset('assets/css/algolia.css')}}">
    @endsection

    {{ Breadcrumbs::render('createpromotion') }}

    <form method="POST" action="{{route('promotions.store')}}" id="createpromotion-form" autocomplete="off" class="needs-validation" novalidate>
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="promotion-title-input">Promotion Title</label>
                            <input type="text" class="form-control" id="promotion-title-input" value="" name="promotiontitle" placeholder="Enter Promotion title" required>
                            <div class="invalid-feedback">Please Enter a promotion title.</div>
                        </div>
                        <div class="mb-3" style="display: grid;">
                            <label class="form-label" for="product-search">Search Product</label>
                            <input type="text" class="form-control" id="promotion-search-input" value="" placeholder="Search Product with MFR">
                        </div>
                    </div>
                </div>

                <div class="card" id="producttable" style="visibility : hidden;">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Products</h5>
                    </div>
                    <div class="p-4 card-body">
                        <div class="table-responsive">
                            <table id="promotion-table" class="table mb-0 invoice-table table-borderless table-nowrap">
                                <thead class="align-middle">
                                    <tr class="table-active">
                                        <th scope="col" style="width: 50px;">#</th>
                                        <th scope="col">Product title</th>
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
                        <h5 class="mb-0 card-title">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Status</label>
                            <select class="form-select" id="choices-publish-status-input" data-choices data-choices-search-false name="status">
                                @foreach ($collectionstatus as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 card-title">Date & Time</h5>
                    </div>
                    <!-- end card body -->
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="startdate-input" class="form-label">Start Date</label>
                            <input type="date" id="startdate-input" class="form-control" name="startdate" placeholder="Enter publish date" data-provider="flatpickr" data-date-format="d.m.y">
                        </div>
                        <div class="mb-3">
                            <label for="enddate-input" class="form-label">End Date</label>
                            <input type="text" id="enddate-input" class="form-control" name="enddate" placeholder="Enter Ending date" data-provider="flatpickr" data-date-format="d.m.y">
                        </div>
                    </div>
                </div>
                <div class="mb-3 text-end">
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
