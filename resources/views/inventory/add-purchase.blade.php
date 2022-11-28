<x-app-layout>
    <form method="POST" action="" id="" autocomplete="off" class="need-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="lbldate">Date</label>
                        <input type="text" name="adjustmentdate" class="form-control" value="">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="lblwarehouse">Warehouse</label>
                        <input type="texe" name="warehouse" class="form-control" value="">
                    </div>
                </div>
            </div>

        </div>
        <div class="text-end mb-3">
            <button type="submit" class="btn btn-success w-sm">Submit</button>
        </div>
    </form>
</x-app-layout>
