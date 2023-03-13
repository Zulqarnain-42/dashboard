<x-app-layout>
    @section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    @endsection

    {{ Breadcrumbs::render('products') }}

    <div class="pb-1 mb-3 row">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                <div class="flex-grow-1"></div>
                <div class="mt-3 mt-lg-0">
                    <form action="javascript:void(0);">
                        <div class="mb-0 row g-3 align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('product.create') }}" type="button" class="shadow-none btn btn-soft-success"><i
                                    class="align-middle ri-add-circle-line me-1"></i>
                                    Add Product
                                </a>
                                <button type="button" class="btn btn-info">
                                    <i class="align-bottom ri-file-download-line me-1"></i>Import
                                </button>
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
                    @if (session('alert'))
                    <div class="shadow alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('alert') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    @endif

                    @if (session('success'))
                    <div class="shadow alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <table id="product-datatable" class="table align-middle table-bordered nowrap table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>MFR</th>
                                <th>Price</th>
                                <th>Length</th>
                                <th>Width</th>
                                <th>Height</th>
                                <th>Weight</th>
                                <th>Featured</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <input type="hidden" id="productid">
                        <div class="pt-2 mx-4 mt-4 fs-15 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="mx-4 mb-0 text-muted">Are you sure you want to remove this record ?</p>
                        </div>
                    </div>
                    <div class="gap-2 mt-4 mb-2 d-flex justify-content-center">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" onclick="delproductjax()" id="delete-record">Yes, Delete It!</button>
                    </div>
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
<script src="{{ URL::asset('assets/js/pages/datatables/productdatatable.js')}}"></script>
@endsection
</x-app-layout>
