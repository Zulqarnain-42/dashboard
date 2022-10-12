<x-app-layout>
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
    <div class="row mb-3 pb-1">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                <div class="flex-grow-1">
                </div>
                <div class="mt-3 mt-lg-0">
                    <form action="javascript:void(0);">
                        <div class="row g-3 mb-0 align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('services.create') }}" type="button" class="btn btn-soft-success shadow-none">
                                    <i class="ri-add-circle-line align-middle me-1"></i>
                                    Add Service</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row project-wrapper">
        <div class="col-xxl-8">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary rounded-2 fs-2">
                                        <i data-feather="briefcase"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Active Services</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0">
                                            <span class="counter-value" data-target="0">0</span>
                                        </h4>
                                        {{-- <span class="badge badge-soft-danger fs-12"><i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>5.02 %</span> --}}
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Services this month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning rounded-2 fs-2">
                                        <i data-feather="award"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-medium text-muted mb-3">Pending Services</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0">
                                            <span class="counter-value" data-target="0">0</span>
                                        </h4>
                                        {{-- <span class="badge badge-soft-success fs-12"><i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>3.58 %</span> --}}
                                    </div>
                                    <p class="text-muted mb-0">Pending this month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info rounded-2 fs-2">
                                        <i data-feather="clock"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Completed</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0">
                                            <span class="counter-value" data-target="0">0</span>
                                        </h4>
                                        {{-- <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="0">0</span>h <span class="counter-value" data-target="40">0</span>m</h4>
                                        <span class="badge badge-soft-danger fs-12"><i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35 %</span> --}}
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Completed this month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    @if (session('alert'))
                    <div class="alert alert-warning alert-dismissible shadow fade show" role="alert">
                        {{ session('alert') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    @endif
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible shadow fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <table id="model-datatables" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>Job Order</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Actions</th>
                                <th>Comments</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collectionservices as $services)
                                <tr>
                                    <td>#{{ $services->joborder }}</td>
                                    <td>{{ $services->customername }}</td>
                                    <td>{{ $services->email }}</td>
                                    <td>{{ $services->phone }}</td>
                                    <td>
                                        <ul class="list-inline hstack gap-2 mb-0">
                                            <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Show">
                                                <a href="{{ route('servicesdetails',$services->id) }}" class="text-info d-inline-block edit-item-btn">
                                                    <i class="ri-eye-line fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                <a href="{{ route('services.edit',$services->id) }}"
                                                    class="text-primary d-inline-block edit-item-btn">
                                                    <i class="ri-pencil-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Work Status">
                                                <button type="button" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"
                                                class="text-warning d-inline-block edit-item-btn datatable-btn" data-id="{{ $services->id }} "><i class="ri-message-line fs-16"></i></button>
                                            </li>
                                            <li class="list-inline-item" data-bs-toggle="tooltip"
                                                data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                <form action="{{ route('services.destroy',$services->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="text-danger d-inline-block remove-item-btn datatable-btn">
                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>{{ $services->comments }}</td>
                                    <td>{{ $services->arrivingdate }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="showModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('service.updateworkhistory') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="serviceid" name="serviceid"/>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="firstname">Work Status</label>
                                <select class="js-example-basic-single form-control" name="servicestatus">
                                    <option>Select a Status</option>
                                    @foreach ($collectionservicesStatus as $servicestatus)
                                    <option value="{{ $servicestatus->id }}">{{ $servicestatus->statusname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="email">Additional Comments</label>
                                <input type="text" class="form-control" name="comments" id="comments" value="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="add-btn">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--end row-->
    @section('scripts')

        <script src="{{ URL::asset('assets/js/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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
        <script>
            $(document).on("click", "#create-btn", function () {
                var serviceid = $(this).data('id');
                $("#serviceid").val( serviceid );
                $('#showModal').modal('show');
            });
        </script>
        <script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
    @endsection
</x-app-layout>
