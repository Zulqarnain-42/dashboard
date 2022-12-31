<x-app-layout>
    <form method="POST" action="{{ isset($service) ? route('services.update', $service->id) : route('services.store') }}" id="" autocomplete="off" class="need-validation" enctype="multipart/form-data" novalidate>
        @csrf
        @if (isset($service))
            @method('PUT')
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="lblpromotiontitle">Promotion Title</label>
                        <input type="text" name="promotiontitle" class="form-control" value="{{ isset($product) ? $product->metatitle : old('metatitle') }}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="promotionstartdate">Start Date</label>
                        <input type="text" name="promotionstartdate" class="form-control" value="{{ isset($product) ? $product->metatitle : old('metatitle') }}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="promotionenddate">End Date</label>
                        <input type="text" name="promotionenddate" class="form-control" value="{{ isset($product) ? $product->metatitle : old('metatitle') }}">
                    </div>
                </div>
            </div>

        </div>
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-success w-sm">Submit</button>
        </div>
    </form>
</x-app-layout>
