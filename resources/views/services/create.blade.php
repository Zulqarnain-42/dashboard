<x-app-layout>

    @section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <form method="POST" action="{{ route('services.store') }}" id="" autocomplete="off" class="need-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="card">
            <div class="card-head">
                <button class="btn btn-success add-btn add_form_field" style="float: right;margin:5px"><i class="ri-add-line align-bottom me-1"></i>Add New</button>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <label for="itemlbl">Product Name</label>
                        <input type="text" name="item[]" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="lblmodel">Model</label>
                        <input type="text" name="model[]" class="form-control">
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-6">
                            <label for="">Brand</label>
                            <select class="js-example-basic-single" name="brandid[]">
                                <option>Select a Brand</option>
                                @foreach ($collectionbrand as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Serial No</label>
                            <input type="text" name="serialno[]" class="form-control" style="text-transform:uppercase">
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Comments</label>
                        <textarea class="form-control" name="comments[]" rows="6" style="resize: none;" required></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="">Includes</label>
                    <textarea class="form-control" name="includes[]" rows="6" style="resize: none;" required></textarea>
                </div>
            </div>
        </div>
        <div class="new-form">
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
            $(wrapper).append('<div class="card remove-card"><div class="card-head"><button class="btn btn-danger delete" style="float:right;margin:5px;"><i class="ri-add-line align-bottom me-1"></i>Delete</button></div><div class="card-body"><div class="row"><div class="col-md-6"><label for="itemlbl">Product Name</label><input type="text" name="item[]" class="form-control"></div><div class="col-md-6"><label for="lblmodel">Model</label><input type="text" name="model[]" class="form-control"></div></div><div class="row"><div class="col-md-6"><label for="">Brand</label><select class="form-control" name="brandid[]"><option>Select a Brand</option>@foreach ($collectionbrand as $brand)<option value="{{ $brand->id }}">{{ $brand->title }}</option>@endforeach</select></div><div class="col-md-6"><label for="">Serial No</label><input type="text" name="serialno[]" class="form-control" style="text-transform:uppercase"></div></div><div class="row"><div class="col-md-12"><label for="">Comments</label><textarea class="form-control" name="comments[]" rows="6" style="resize: none;" required></textarea></div></div><div class="col-md-12"><label for="">Includes</label><textarea class="form-control" name="includes[]" rows="6" style="resize: none;" required></textarea></div></div></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $('.remove-card').remove();
        x--;
    })
});
    </script>
    @endsection
</x-app-layout>
