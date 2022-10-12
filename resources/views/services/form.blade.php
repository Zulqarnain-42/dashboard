<x-app-layout>

    @section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <form method="POST" action="{{ isset($service) ? route('services.update', $service->id) : route('services.store') }}" id="" autocomplete="off" class="need-validation" enctype="multipart/form-data" novalidate>
        @csrf
        @if (isset($service))
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="lblcustomername">Customer Name</label>
                        <input type="text" name="customername" class="form-control" value="{{ $service->customername }}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="lblemail">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $service->email }}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="lblmobile">Mobile</label>
                        <input type="text" name="mobile" class="form-control" value="{{ $service->phone }}">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="">Comments</label>
                        <textarea class="form-control" name="comments" rows="6" style="resize: none;" required>{{ $service->comments }}</textarea>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="">Includes</label>
                        <textarea class="form-control" name="includes" rows="6" style="resize: none;" required>{{ $service->includes }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-11">
                        @if ($collectionservicesdetails)
                        @foreach ($collectionservicesdetails as $servicesdetail)
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label for="itemlbl">Item</label>
                                <input type="text" class="form-control" name="productitem[]" value="{{ isset($servicesdetail) ? $servicesdetail->Item : old('item') }}">
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="lblmodel">Model</label>
                                <input type="text" class="form-control" name="productmodel[]" value="{{ isset($servicesdetail) ? $servicesdetail->model : old('model') }}">
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="lblserialno">Serial No</label>
                                <input type="text" class="form-control" name="serialno[]" value="{{ isset($servicesdetail) ? $servicesdetail->serialno : old('serialno') }}">
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="lblbrand">Brand</label>
                                <select class="js-example-basic-single" name="brand[]">
                                    <option>Select a Brand</option>
                                    @foreach ($collectionbrand as $brand)
                                    <option value="{{ $brand->id }}"  {{ isset($servicesdetail) && $servicesdetail->brandid == $brand->id ? 'selected' : '' }}>{{ $brand->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-md-1">
                        <label for=""></label>
                        <button class="btn btn-success add-btn add_form_field form-control" style="float: right;margin:5px">Add</button>
                    </div>
                </div>
                <div class="new-form">
                </div>
            </div>

        </div>
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-success w-sm">Submit</button>
        </div>
    </form>

    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
    <script>
        $(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".new-form");
    var add_button = $(".add_form_field");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div class="remove-div"><div class="row"><div class="col-md-11"><div class="row"><div class="mb-3 col-md-3"><input type="text" class="form-control" name="productitem[]"></div><div class="mb-3 col-md-3"><input type="text" class="form-control" name="productmodel[]"></div><div class="mb-3 col-md-3"><input type="text" class="form-control" name="serialno[]"></div><div class="mb-3 col-md-3"><select class="js-example-basic-single form-control" name="brand[]"><option>Select a Brand</option>@foreach ($collectionbrand as $brand)<option value="{{ $brand->id }}">{{ $brand->title }}</option>@endforeach</select></div></div></div><div class="col-md-1"><button class="btn btn-danger delete form-control">Delete</button></div></div></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent().parent('div').remove();
        x--;
    })
});
    </script>
    @endsection
</x-app-layout>
