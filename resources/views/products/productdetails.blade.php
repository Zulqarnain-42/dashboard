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

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row gx-lg-5">
                        <div class="col-xl-4 col-md-8 mx-auto">
                            <div class="product-img-slider sticky-side-div">
                                <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{URL::asset($product->thumbnail)}}" alt="" class="img-fluid d-block" />
                                        </div>
                                    </div>
                                    <div class="swiper-button-next bg-white shadow"></div>
                                    <div class="swiper-button-prev bg-white shadow"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <div class="mt-xl-0 mt-5">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h4>{{$product->title}}</h4>
                                        <div class="hstack gap-3 flex-wrap">
                                            <div><a href="#" class="text-primary d-block">Tommy Hilfiger</a></div>
                                            <div class="vr"></div>
                                            <div class="text-muted">Seller : <span class="text-body fw-medium">Zoetic Fashion</span></div>
                                            <div class="vr"></div>
                                            <div class="text-muted">Published : <span class="text-body fw-medium">26 Mar, 2021</span></div>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div>
                                            <a href="{{route('product.edit',$product->id)}}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="ri-pencil-fill align-bottom"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                    <div class="text-muted fs-16">
                                        <span class="mdi mdi-star text-warning"></span>
                                        <span class="mdi mdi-star text-warning"></span>
                                        <span class="mdi mdi-star text-warning"></span>
                                        <span class="mdi mdi-star text-warning"></span>
                                        <span class="mdi mdi-star text-warning"></span>
                                    </div>
                                    <div class="text-muted">( 5.50k Customer Review )</div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                        <i class="ri-money-dollar-circle-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Price :</p>
                                                    <h5 class="mb-0">{{$product->price}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-6">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                        <i class="ri-file-copy-2-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">No. of Orders :</p>
                                                    <h5 class="mb-0">2,234</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-6">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                        <i class="ri-stack-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">In Stocks :</p>
                                                    <h5 class="mb-0">1,230</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-6">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                        <i class="ri-inbox-archive-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Total Revenue :</p>
                                                    <h5 class="mb-0">$60,645</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="mt-4 text-muted">
                                    <h5 class="fs-14">Description :</h5>
                                    <p>{!! $product->shortdescription !!}</p>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mt-3">
                                            <h5 class="fs-14">Features :</h5>
                                            <ul class="list-unstyled">
                                                <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> Full Sleeve</li>
                                                <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> Cotton</li>
                                                <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> All Sizes available</li>
                                                <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> 4 Different Color</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mt-3">
                                            <h5 class="fs-14">Services :</h5>
                                            <ul class="list-unstyled product-desc-list">
                                                <li class="py-1">10 Days Replacement</li>
                                                <li class="py-1">Cash on Delivery available</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-content mt-5">
                                    <h5 class="fs-14 mb-3">Product Description :</h5>
                                    <nav>
                                        <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab" role="tablist">
                                            @if ($product->specifications)
                                            <li class="nav-item">
                                                <a class="nav-link active" id="nav-speci-tab" data-bs-toggle="tab" href="#nav-speci" role="tab" aria-controls="nav-speci" aria-selected="true">Specification</a>
                                            </li>
                                            @endif
                                            @if ($product->inthebox)
                                            <li class="nav-item">
                                                <a class="nav-link" id="nav-inbox-tab" data-bs-toggle="tab" href="#nav-box" role="tab" aria-controls="nav-box" aria-selected="false">In The Box</a>
                                            </li>
                                            @endif
                                            @if ($product->longdescription)
                                            <li class="nav-item">
                                                <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="false">Details</a>
                                            </li>
                                            @endif

                                        </ul>
                                    </nav>

                                    <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-speci" role="tabpanel" aria-labelledby="nav-speci-tab">
                                            <div class="table-responsive">
                                                {{-- <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" style="width: 200px;">Category</th>
                                                            <td>T-Shirt</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Brand</th>
                                                            <td>Tommy Hilfiger</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Color</th>
                                                            <td>Blue</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Material</th>
                                                            <td>Cotton</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Weight</th>
                                                            <td>140 Gram</td>
                                                        </tr>
                                                    </tbody>
                                                </table> --}}
                                                {!! $product->specifications !!}
                                            </div>
                                        </div>

                                        <div class="tab-pane fade show" id="nav-box" role="tabpanel" aria-labelledby="nav-inbox-tab">
                                            {!! $product->inthebox !!}
                                        </div>
                                        <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                                            <div>
                                                {!! $product->longdescription !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script src="{{ URL::asset('assets/libs/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/ecommerce-product-details.init.js')}}"></script>
    @endsection
</x-app-layout>
