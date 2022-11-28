<x-app-layout>
    @section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    @endsection
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <div class="col-lg-4">
                        <select class="js-example-basic-single" name="brands" id="brandid">
                            <option>Select a Brand</option>
                            @foreach ($collectionbrand as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                @if (Session::get('product_data'))
                    <div class="card-body">
                        <table id="model-datatables" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Model</th>
                                    <th>Title</th>
                                    <th>Office Stock</th>
                                    <th>Warehouse Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Session::get('product_data') as $products)
                                    <tr>
                                        <td>{{ strtoupper($products->productcode) }}</td>
                                        <td>{{ $products->mfr }}</td>
                                        <td>{{ $products->title }}</td>
                                        <td>{{ $products->office_opening }}</td>
                                        <td>{{ $products->warehouse_opening }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="assets/js/pages/select2.init.js"></script>
        <script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
        <script>
        $("#brandid").on('change',function(){
            var brandid=$(this).val();
            $.ajax({
                url: "/opening_stock_brand/"+brandid,
                type: 'get',
                dataType: 'JSON',
                success: function(response){
                    console.log(response);
                }
            });
        })
        </script>
    @endsection
</x-app-layout>
