<x-app-layout>
    @section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    @endsection
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a>
                            </li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 pb-1">
            <div class="col-12">
                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                    <div class="flex-grow-1">
                    </div>
                    <div class="mt-3 mt-lg-0">
                        <form action="javascript:void(0);">
                            <div class="row g-3 mb-0 align-items-center">
                                <div class="col-auto">
                                    <a href="{{ route('product.create') }}" type="button" class="btn btn-soft-success shadow-none"><i
                                            class="ri-add-circle-line align-middle me-1"></i>
                                        Add Product</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <div class="alert alert-secondary alert-dismissible alert-label-icon rounded-label shadow fade show" role="alert">
                            <i class="ri-check-double-line label-icon"></i><strong>Secondary</strong>
                            - Rounded
                            label alert
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label shadow fade show mb-xl-0" role="alert">
                            <i class="ri-error-warning-line label-icon"></i><strong>Danger</strong>
                            - Rounded
                            label alert
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <table id="model-datatables" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SR No.</th>
                                    <th>Image</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>MFR</th>
                                    <th>Original Price</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Visibility</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collectionproduct as $product)
                                <tr>
                                    <td>01</td>
                                    <td><img src="{{ URL::asset('storage/images/products/') }}{{ '/'.$product->thumbnail }}" height="35px"></td>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->mfr }}</td>
                                    <td>{{ $product->orignalprice }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        @if ($product->status == 1)
                                            <span class="badge badge-soft-info">Published</span>
                                        @else
                                            <span class="badge bg-danger">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->visibility == 1)
                                            <span class="badge badge-soft-info">Public</span>
                                        @else
                                            <span class="badge bg-danger">Hidden</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                {{-- <li><a href="#!" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li> --}}
                                                <li><a href="{{ route('product.edit',$product->id) }}" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                                <li>
                                                    <a class="dropdown-item remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection
</x-app-layout>
