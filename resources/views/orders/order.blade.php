<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Create Slider</h4>

                <div class="page-title-right">
                    <ol class="m-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Create Slider</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="border-0 card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Order History</h5>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-info">
                                <i class="align-bottom ri-file-download-line me-1"></i> Import
                            </button>
                            <button class="btn btn-soft-danger" onClick="deleteMultiple()">
                                <i class="ri-delete-bin-2-line"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border border-dashed card-body border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-6">
                                <div class="search-box">
                                    <input type="text" class="form-control search" placeholder="Search for order ID, customer, order status or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-6">
                                <div>
                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" id="demo-datepicker" placeholder="Select date">
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                        <option value="">Status</option>
                                        <option value="all" selected>All</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Inprogress">Inprogress</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="Pickups">Pickups</option>
                                        <option value="Returns">Returns</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idPayment">
                                        <option value="">Select Payment</option>
                                        <option value="all" selected>All</option>
                                        <option value="Mastercard">Mastercard</option>
                                        <option value="Paypal">Paypal</option>
                                        <option value="Visa">Visa</option>
                                        <option value="COD">COD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-1 col-sm-4">
                                <div>
                                    <button type="button" class="btn btn-primary w-100" onclick="SearchData();">
                                        <i class="align-bottom ri-equalizer-fill me-1"></i>Filters
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="pt-0 card-body">
                    <div>
                        <ul class="mb-3 nav nav-tabs nav-tabs-custom nav-success" role="tablist">
                            <li class="nav-item">
                                <a class="py-3 nav-link active All" data-bs-toggle="tab" id="All" href="#home1" role="tab" aria-selected="true">
                                    <i class="align-bottom ri-store-2-fill me-1"></i> All Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="py-3 nav-link Delivered" data-bs-toggle="tab" id="Delivered" href="#delivered" role="tab" aria-selected="false">
                                    <i class="align-bottom ri-checkbox-circle-line me-1"></i> Delivered
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="py-3 nav-link Pickups" data-bs-toggle="tab" id="Pickups" href="#pickups" role="tab" aria-selected="false">
                                    <i class="align-bottom ri-truck-line me-1"></i> Pickups <span class="align-middle badge bg-danger ms-1">2</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="py-3 nav-link Returns" data-bs-toggle="tab" id="Returns" href="#returns" role="tab" aria-selected="false">
                                    <i class="align-bottom ri-arrow-left-right-fill me-1"></i> Returns
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="py-3 nav-link Cancelled" data-bs-toggle="tab" id="Cancelled" href="#cancelled" role="tab" aria-selected="false">
                                    <i class="align-bottom ri-close-circle-line me-1"></i> Cancelled
                                </a>
                            </li>
                        </ul>
                        <div class="mb-1 table-responsive table-card">
                            <table class="table align-middle table-nowrap" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th scope="col" style="width: 25px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="id">Order ID</th>
                                        <th class="sort" data-sort="customer_name">Customer</th>
                                        <th class="sort" data-sort="date">Order Date</th>
                                        <th class="sort" data-sort="amount">Amount</th>
                                        <th class="sort" data-sort="payment">Payment Method</th>
                                        <th class="sort" data-sort="status">Delivery Status</th>
                                        <th class="sort" data-sort="city">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($collectionorder as $order)
                                    <tr>

                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="checkAll" value="option1">
                                                </div>
                                            </th>
                                            <td class="id">
                                                <a href="/orderdetails/{{$order->order_code}}" class="fw-medium link-primary">#{{$order->order_code}}</a>
                                            </td>
                                            <td class="customer_name">{{$order->firstname." ".$order->lastname}}</td>
<!--                                            <td class="date">20 Dec, 2021, <small class="text-muted">02:21 AM</small></td>-->
                                        <td class="date">{{$order->created_at}}</td>
                                            <td class="amount">AED {{number_format($order->total,2)}}</td>
                                            <td class="payment">Mastercard</td>
                                            <td class="status"><span class="badge badge-soft-warning text-uppercase">Pending</span></td>
                                            <td>
                                                <ul class="gap-2 mb-0 list-inline hstack">
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                        <a href="/orderdetails/{{$order->order_code}}" class="text-primary d-inline-block">
                                                            <i class="ri-eye-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                        <a href="#showModal" data-bs-toggle="modal" class="text-primary d-inline-block edit-item-btn">
                                                            <i class="ri-pencil-fill fs-16"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="gap-2 pagination-wrap hstack">
                                <a class="page-item pagination-prev disabled" href="#">Previous</a>
                                <ul class="mb-0 pagination listjs-pagination"></ul>
                                <a class="page-item pagination-next" href="#">Next</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="p-3 modal-header bg-light">
                                    <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form action="#">
                                    <div class="modal-body">
                                        <input type="hidden" id="id-field" />
                                        <div class="mb-3" id="modal-id">
                                            <label for="orderId" class="form-label">ID</label>
                                            <input type="text" id="orderId" class="form-control" placeholder="ID" readonly />
                                        </div>
                                        <div class="mb-3">
                                            <label for="customername-field" class="form-label">Customer Name</label>
                                            <input type="text" id="customername-field" class="form-control" placeholder="Enter name" required />
                                        </div>

                                        <div class="mb-3">
                                            <label for="date-field" class="form-label">Order Date</label>
                                            <input type="date" id="date-field" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" data-enable-time required placeholder="Select date" />
                                        </div>

                                        <div class="mb-3 row gy-4">
                                            <div class="col-md-6">
                                                <div>
                                                    <label for="amount-field" class="form-label">Amount</label>
                                                    <input type="text" id="amount-field" class="form-control" placeholder="Total amount" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div>
                                                    <label for="payment-field" class="form-label">Payment Method</label>
                                                    <select class="form-control" data-trigger name="payment-method" id="payment-field">
                                                        <option value="">Payment Method</option>
                                                        <option value="Mastercard">Mastercard</option>
                                                        <option value="Visa">Visa</option>
                                                        <option value="COD">COD</option>
                                                        <option value="Paypal">Paypal</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label for="delivered-status" class="form-label">Delivery Status</label>
                                            <select class="form-control" data-trigger name="delivered-status" id="delivered-status">
                                                <option value="">Delivery Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Inprogress">Inprogress</option>
                                                <option value="Cancelled">Cancelled</option>
                                                <option value="Pickups">Pickups</option>
                                                <option value="Delivered">Delivered</option>
                                                <option value="Returns">Returns</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <div class="gap-2 hstack justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" id="add-btn">Add Order</button>
                                            <button type="button" class="btn btn-success" id="edit-btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->
@section('scripts')
    <script src="{{ URL::asset('assets/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/ecommerce-order.init.js') }}"></script>
@endsection
</x-app-layout>
