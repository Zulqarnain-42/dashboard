<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Invoice Details</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                        <li class="breadcrumb-item active">Invoice Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header border-bottom-dashed p-4">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <img src="{{ URL::asset('fa-bt/logo/FABT-Logo2.png') }}" class="card-logo card-logo-dark" alt="logo dark" height="60">
                                    {{-- <img src="assets/images/logo-light.png" class="card-logo card-logo-light" alt="logo light" height="17"> --}}
                                    <div class="mt-sm-5 mt-4">
                                        <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                        <p class="text-muted mb-1" id="address-details">Technic building Office No. 204, Salah Al Din Street, Close to Salah Al Din Metro Station - Dubai</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 mt-sm-0 mt-3">
                                    {{-- <h6><span class="text-muted fw-normal">Legal Registration No:</span><span id="legal-register-no">987654</span></h6> --}}
                                    <h6><span class="text-muted fw-normal">Email:</span><span id="email">fabt@fa-bt.com</span></h6>
                                    <h6><span class="text-muted fw-normal">Website:</span> <a href="https://fabt.pro/" class="link-primary" target="_blank" id="website">www.fa-bt.com</a></h6>
                                    <h6 class="mb-0"><span class="text-muted fw-normal">Contact No: </span><span id="contact-no"> 042-2722039</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            @foreach ($service as $serve)
                            <div class="row g-3">
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Invoice No</p>
                                    <h5 class="fs-14 mb-0">#<span id="invoice-no">{{ $serve->joborder }}</span></h5>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                    <h5 class="fs-14 mb-0">
                                        <span id="invoice-date">{{ $serve->arrivingdate }}</span>
                                    </h5>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">#</th>
                                            <th scope="col">Product Details</th>
                                            <th scope="col">Model</th>
                                            <th scope="col">Serial No</th>
                                            <th scope="col" class="text-end">Brand</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        @foreach ($collectionservicesdetails as $servicesdetail)
                                        <tr>
                                            <th scope="row">0{{ $loop->iteration }}</th>
                                            <td class="text-start">
                                               {{$servicesdetail->productname}}
                                            </td>
                                            <td>{{ $servicesdetail->model }}</td>
                                            <td>{{ strtoupper($servicesdetail->serialno) }}</td>
                                            <td class="text-end">{{ $servicesdetail->title }}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
