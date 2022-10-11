<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Service Details</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        @foreach ($service as $ser)
                        <h5 class="card-title flex-grow-1 mb-0">Order #{{ $ser->joborder }}</h5>

                        <div class="flex-shrink-0">
                            <a href="{{ route('invoice',$ser->id) }}" class="btn btn-success btn-sm">
                                <i class="ri-download-2-fill align-middle me-1"></i> Invoice
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th scope="col">Product Details</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Serial No</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collectionservicesdetails as $servicedetail)
                                <tr>
                                    <td>{{ $servicedetail->productname }}</td>
                                    <td>{{ $servicedetail->model }}</td>
                                    <td>{{ $servicedetail->title }}</td>
                                    <td>{{ strtoupper($servicedetail->serialno) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if ($collectionworkhistory)
            <div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Work History</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingOne">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle shadow">
                                                    <i class="ri-shopping-bag-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-0 fw-semibold">Service Created</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                    @foreach ($collectionworkhistory as $workhistory)
                                    <h6 class="mb-1">{{ $workhistory->statusname }}</h6>
                                    <p class="text-muted">{{ $workhistory->created_at }}</p>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
