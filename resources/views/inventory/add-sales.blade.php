<div id="zoomInModal" class="modal fade zoomIn" tabindex="-1" aria-labelledby="zoomInModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="zoomInModalLabel">Add Sales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('inventory.storesales') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mt-2 pb-2">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="warehouse" id=""
                                    value="0">
                                <label class="form-check-label" for="">For Warehouse</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="warehouse" id=""
                                    value="1">
                                <label for="" class="form-check-label">For Office</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Model</label>
                            <select class="js-example-basic" name="productmodel">
                                <option>Select a Model</option>
                                @foreach ($collectionproduct as $product)
                                    <option value="{{ $product->id }}">{{ $product->mfr }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Receipt #</label>
                            <input type="text" class="form-control" id="" name="salereceipt">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Quantity</label>
                            <input type="text" class="form-control" name="salequantity" id="">
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
