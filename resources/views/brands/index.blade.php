<x-app-layout>
    @section('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    @endsection
    <div class="row mb-3 pb-1">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                <div class="flex-grow-1"></div>
                <div class="mt-3 mt-lg-0">
                    <form action="javascript:void(0);">
                        <div class="row g-3 mb-0 align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('brand.create') }}" type="button" class="btn btn-soft-success shadow-none">
                                    <i class="ri-add-circle-line align-middle me-1"></i>
                                    Add Brand
                                </a>
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
                    <table id="brand-datatable" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($collectionbrand as $brand)
                                <tr>
                                    <td>0{{ $loop->iteration }}</td>
                                    <td>{{ strtoupper($brand->brandcode) }}</td>
                                    <td>{{ $brand->title }}</td>
                                    <td><img src="{{ $brand->image }}" height="35px"></td>
                                    <td>
                                        @if ($brand->status == 1)
                                            <div class="form-check form-switch form-switch-md ml-2" style="text-align: center;">
                                                <input type="checkbox" class="form-check-input" id="" checked>
                                            </div>
                                        @else
                                            <div class="form-check form-switch form-switch-md ml-2" style="text-align: center;">
                                                <input type="checkbox" class="form-check-input" id="">
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="list-inline hstack gap-2 mb-0">
                                            <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                <a href="{{ route('brand.edit', $brand->id) }}" class="text-primary d-inline-block edit-item-btn">
                                                    <i class="ri-pencil-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">

                                            <form action="{{ route('brand.destroy', $brand->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="text-danger d-inline-block remove-item-btn datatable-btn">
                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                </button>
                                            </form>
                                        </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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
            $(function(){
                var table = $('#brand-datatable').DataTable({
                    processing:true,
                    serverSide: true,
                    order: [0, 'asc'],
                    ajax : "{{ route('brand.index')}}",
                    "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                        $("td:first", nRow).html(iDisplayIndex + 1);
                        return nRow;
                    },

                    columns:[
                        {data:'id',name:'id'},
                        {data:'brandcode',name:'brandcode'},
                        {data:'title',name:'title'},
                        {
                            "render": function (data, type, full_row, meta) {
                                return '<img src="' + full_row.image + '" class="avatar" height="35px">';
                            }
                        },
                        {
                            "data": "status", render: function (data, type, full_row, meta) {
                                if (full_row.status == true) {
                                    return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id="" checked></div>';
                                } else {
                                    return '<div class="form-check form-switch form-switch-md ml-2" style="text-align: center;"><input type="checkbox" class="form-check-input" id=""></div>';
                                }
                            }
                        },
                    ],
                    'columnDefs': [
                        {
                            'targets': 5,
                            'defaultContent': '-',
                            'searchable': false,
                            'orderable': false,
                            'width': '10%',
                            'className': 'dt-body-center',
                            'render': function (data, type, full_row, meta) {
                                return '<ul class="list-inline hstack gap-2 mb-0">' +
                                    '<li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">' +
                                    '<a href="{{route('brand.edit',"'full_row.id'")}}" class="text-primary d-inline-block edit-item-btn"><i class="ri-pencil-fill fs-16"></i></a>' +
                                    '</li>'+
                                                            '<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title data-bs-original-title="Remove">'+
                            '<a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="">'+
                                '<i class="ri-delete-bin-5-fill fs-16"></i>'+
                                '</a>'+
                                '</li>'+
                                    '</ul>';
                                }
                            }
                        ],
                    });
                });
        </script>
    @endsection
</x-app-layout>
