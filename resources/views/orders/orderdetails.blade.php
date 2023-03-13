<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Order Details</h4>
                <div class="page-title-right">
                    <ol class="m-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Order #{{$order->order_code}}</h5>
                        <div class="flex-shrink-0">
                            <a href="/invoice/{{$order->order_code}}" class="btn btn-success btn-sm"><i class="align-middle ri-download-2-fill me-1"></i> Invoice</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <table class="table mb-0 align-middle table-nowrap table-borderless">
                                                <thead class="table-light text-muted">
                                                    <tr>
                                                        <th scope="col">Product Details</th>
                                                        <th scope="col">Item Price</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Rating</th>
                                                        <th scope="col" class="text-end">Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0 p-1 rounded avatar-md bg-light">
                                                                    <img src="assets/images/products/img-8.png" alt="" class="img-fluid d-block">
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h5 class="fs-15"><a href="apps-ecommerce-product-details.html" class="link-primary">Sweatshirt for Men (Pink)</a></h5>
                                                                    <p class="mb-0 text-muted">Color: <span class="fw-medium">Pink</span></p>
                                                                    <p class="mb-0 text-muted">Size: <span class="fw-medium">M</span></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>$119.99</td>
                                                        <td>02</td>
                                                        <td>
                                                            <div class="text-warning fs-15">
                                                                <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-half-fill"></i>
                                                            </div>
                                                        </td>
                                                        <td class="fw-medium text-end">
                                                            $239.98
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0 p-1 rounded avatar-md bg-light">
                                                                    <img src="assets/images/products/img-7.png" alt="" class="img-fluid d-block">
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h5 class="fs-15"><a href="apps-ecommerce-product-details.html" class="link-primary">Noise NoiseFit Endure Smart Watch</a></h5>
                                                                    <p class="mb-0 text-muted">Color: <span class="fw-medium">Black</span></p>
                                                                    <p class="mb-0 text-muted">Size: <span class="fw-medium">32.5mm</span></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>$94.99</td>
                                                        <td>01</td>
                                                        <td>
                                                            <div class="text-warning fs-15">
                                                                <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-half-fill"></i>
                                                            </div>
                                                        </td>
                                                        <td class="fw-medium text-end">
                                                            $94.99
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0 p-1 rounded avatar-md bg-light">
                                                                    <img src="assets/images/products/img-3.png" alt="" class="img-fluid d-block">
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h5 class="fs-15"><a href="apps-ecommerce-product-details.html" class="link-primary">350 ml Glass Grocery Container</a></h5>
                                                                    <p class="mb-0 text-muted">Color: <span class="fw-medium">White</span></p>
                                                                    <p class="mb-0 text-muted">Size: <span class="fw-medium">350 ml</span></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>$24.99</td>
                                                        <td>01</td>
                                                        <td>
                                                            <div class="text-warning fs-15">
                                                                <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-half-fill"></i><i class="ri-star-line"></i><i class="ri-star-line"></i>
                                                            </div>
                                                        </td>
                                                        <td class="fw-medium text-end">
                                                            $24.99
                                                        </td>
                                                    </tr>
                                                    <tr class="border-top border-top-dashed">
                                                        <td colspan="3"></td>
                                                        <td colspan="2" class="p-0 fw-medium">
                                                            <table class="table mb-0 table-borderless">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Sub Total :</td>
                                                                        <td class="text-end">$359.96</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Discount <span class="text-muted">(VELZON15)</span> : :</td>
                                                                        <td class="text-end">-$53.99</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Shipping Charge :</td>
                                                                        <td class="text-end">$65.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Estimated Tax :</td>
                                                                        <td class="text-end">$44.99</td>
                                                                    </tr>
                                                                    <tr class="border-top border-top-dashed">
                                                                        <th scope="row">Total (USD) :</th>
                                                                        <th class="text-end">$415.96</th>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-sm-flex align-items-center">
                                            <h5 class="mb-0 card-title flex-grow-1">Order Status</h5>
                                            <div class="flex-shrink-0 mt-2 mt-sm-0">
                                                <a href="javasccript:void(0;)" class="mt-2 shadow-none btn btn-soft-info btn-sm mt-sm-0"><i class="align-middle ri-map-pin-line me-1"></i> Change Address</a>
                                                <a href="javasccript:void(0;)" class="mt-2 shadow-none btn btn-soft-danger btn-sm mt-sm-0"><i class="align-middle mdi mdi-archive-remove-outline me-1"></i> Cancel Order</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="profile-timeline">
                                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                                <div class="border-0 accordion-item">
                                                    <div class="accordion-header" id="headingOne">
                                                        <a class="p-2 shadow-none accordion-button" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 avatar-xs">
                                                                    <div class="shadow avatar-title bg-success rounded-circle">
                                                                        <i class="ri-shopping-bag-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h6 class="mb-0 fs-15 fw-semibold">Order Placed - <span class="fw-normal">Wed, 15 Dec 2021</span></h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="pt-0 accordion-body ms-2 ps-5">
                                                            <h6 class="mb-1">An order has been placed.</h6>
                                                            <p class="text-muted">Wed, 15 Dec 2021 - 05:34PM</p>

                                                            <h6 class="mb-1">Seller has proccessed your order.</h6>
                                                            <p class="mb-0 text-muted">Thu, 16 Dec 2021 - 5:48AM</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border-0 accordion-item">
                                                    <div class="accordion-header" id="headingTwo">
                                                        <a class="p-2 shadow-none accordion-button" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 avatar-xs">
                                                                    <div class="shadow avatar-title bg-success rounded-circle">
                                                                        <i class="mdi mdi-gift-outline"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h6 class="mb-1 fs-15 fw-semibold">Packed - <span class="fw-normal">Thu, 16 Dec 2021</span></h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                        <div class="pt-0 accordion-body ms-2 ps-5">
                                                            <h6 class="mb-1">Your Item has been picked up by courier patner</h6>
                                                            <p class="mb-0 text-muted">Fri, 17 Dec 2021 - 9:45AM</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border-0 accordion-item">
                                                    <div class="accordion-header" id="headingThree">
                                                        <a class="p-2 shadow-none accordion-button" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 avatar-xs">
                                                                    <div class="shadow avatar-title bg-success rounded-circle">
                                                                        <i class="ri-truck-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h6 class="mb-1 fs-15 fw-semibold">Shipping - <span class="fw-normal">Thu, 16 Dec 2021</span></h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                        <div class="pt-0 accordion-body ms-2 ps-5">
                                                            <h6 class="fs-14">RQK Logistics - MFDS1400457854</h6>
                                                            <h6 class="mb-1">Your item has been shipped.</h6>
                                                            <p class="mb-0 text-muted">Sat, 18 Dec 2021 - 4.54PM</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border-0 accordion-item">
                                                    <div class="accordion-header" id="headingFour">
                                                        <a class="p-2 shadow-none accordion-button" data-bs-toggle="collapse" href="#collapseFour" aria-expanded="false">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 avatar-xs">
                                                                    <div class="shadow avatar-title bg-light text-success rounded-circle">
                                                                        <i class="ri-takeaway-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h6 class="mb-0 fs-14 fw-semibold">Out For Delivery</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="border-0 accordion-item">
                                                    <div class="accordion-header" id="headingFive">
                                                        <a class="p-2 shadow-none accordion-button" data-bs-toggle="collapse" href="#collapseFile" aria-expanded="false">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 avatar-xs">
                                                                    <div class="shadow avatar-title bg-light text-success rounded-circle">
                                                                        <i class="mdi mdi-package-variant"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1 ms-3">
                                                                    <h6 class="mb-0 fs-14 fw-semibold">Delivered</h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end accordion-->
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-xl-3">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <h5 class="mb-0 card-title flex-grow-1"><i class="align-middle mdi mdi-truck-fast-outline me-1 text-muted"></i> Logistics Details</h5>
                                            <div class="flex-shrink-0">
                                                <a href="javascript:void(0);" class="badge badge-soft-primary fs-11">Track Order</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop" colors="primary:#4b38b3,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                                            <h5 class="mt-2 fs-16">RQK Logistics</h5>
                                            <p class="mb-0 text-muted">ID: MFDS1400457854</p>
                                            <p class="mb-0 text-muted">Payment Mode : Debit Card</p>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->

                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <h5 class="mb-0 card-title flex-grow-1">Customer Details</h5>
                                            <div class="flex-shrink-0">
                                                <a href="javascript:void(0);" class="link-secondary">View Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="gap-3 mb-0 list-unstyled vstack">
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded shadow avatar-sm">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1 fs-14">Joseph Parkers</h6>
                                                        <p class="mb-0 text-muted">Customer</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><i class="align-middle ri-mail-line me-2 text-muted fs-16"></i>josephparker@gmail.com</li>
                                            <li><i class="align-middle ri-phone-line me-2 text-muted fs-16"></i>+(256) 245451 441</li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end card-->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0 card-title"><i class="align-middle ri-map-pin-line me-1 text-muted"></i> Billing Address</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="gap-2 mb-0 list-unstyled vstack fs-13">
                                            <li class="fw-medium fs-14">Joseph Parker</li>
                                            <li>+(256) 245451 451</li>
                                            <li>2186 Joyce Street Rocky Mount</li>
                                            <li>New York - 25645</li>
                                            <li>United States</li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end card-->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0 card-title"><i class="align-middle ri-map-pin-line me-1 text-muted"></i> Shipping Address</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="gap-2 mb-0 list-unstyled vstack fs-13">
                                            <li class="fw-medium fs-14">Joseph Parker</li>
                                            <li>+(256) 245451 451</li>
                                            <li>2186 Joyce Street Rocky Mount</li>
                                            <li>California - 24567</li>
                                            <li>United States</li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end card-->

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0 card-title"><i class="align-bottom ri-secure-payment-line me-1 text-muted"></i> Payment Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-2 d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <p class="mb-0 text-muted">Transactions:</p>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <h6 class="mb-0">#VLZ124561278124</h6>
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <p class="mb-0 text-muted">Payment Method:</p>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <h6 class="mb-0">Debit Card</h6>
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <p class="mb-0 text-muted">Card Holder Name:</p>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <h6 class="mb-0">Joseph Parker</h6>
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <p class="mb-0 text-muted">Card Number:</p>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <h6 class="mb-0">xxxx xxxx xxxx 2456</h6>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <p class="mb-0 text-muted">Total Amount:</p>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <h6 class="mb-0">$415.96</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

</x-app-layout>
