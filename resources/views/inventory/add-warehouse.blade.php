<div id="zoomInModal" class="modal fade zoomIn" aria-labelledby="zoomInModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="zoomInModalLabel">Add Inventory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('inventory.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" style="text-transform:uppercase" name="productmodel" required>
                        </div>
                        <div class="col-md-4">
                            <label for="ean">EAN</label>
                            <input type="text" class="form-control" name="productean">
                        </div>
                        <div class="col-md-4">
                            <label for="upc">UPC</label>
                            <input type="text" class="form-control" name="productupc">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="sharjahwarehousequantity">Warehouse Quantity</label>
                            <input type="text" class="form-control" name="warehousequnatity">
                        </div>
                        <div class="col-md-4">
                            <label for="officequantity">Office Qunatity</label>
                            <input type="text" class="form-control" name="officequnatity">
                        </div>
                        <div class="col-md-4">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" name="location">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="brnad">Brand</label>
                            <select class="js-example-basic-single" name="brand">
                                <option>Select a Brand</option>
                                @foreach ($collectionbrand as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="length">Length</label>
                            <input type="text" class="form-control" name="length">
                        </div>
                        <div class="col-md-4">
                            <label for="width">Width</label>
                            <input type="text" class="form-control" name="width">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="height">Height</label>
                            <input type="text" class="form-control" name="heihgt">
                        </div>
                        <div class="col-md-4">
                            <label for="weight">Weight</label>
                            <input type="text" class="form-control" name="weight">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
