<div id="shipmentmodel" class="modal fade zoomIn" tabindex="-1" aria-labelledby="shipmentmodelLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shipmentmodelLabel">Add Shipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('inventory.shipment')}}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="productid" id="productid" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="officequantity">Office Qunatity</label>
                            <input type="text" class="form-control" name="officequnatity">
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
