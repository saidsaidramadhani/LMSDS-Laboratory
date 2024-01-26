<div class="modal fade inventory-modal-lg" id="inventory-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Info Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="inventory-form" class="form-horizontal">
                    <input type="hidden" value="" name="inventory_id"/>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Item Name</label>
                                    <select name="item_id" class="form-control select2">
										<option value="">-- Please select --</option>
									</select>                           </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="description" class="form-control" placeholder=" Description"></textarea>
                                </div>
                            </div>							
                        </div>	
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Cost Amount</label>
                                    <input type="number" id="buy_price" name="buy_price" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Supplied Quantity</label>
                                    <input type="number" id="amount" name="amount" class="form-control" placeholder="Amount supplied">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Serial Number</label>
                                    <input type="text" id="Supplied Quantity" name="serial_number" class="form-control" placeholder="Amount supplied">
                                </div>
                            </div>
                        </div>						
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Location</label>
                                    <select name="location_id" class="form-control select2">
										<option value="">-- Please select --</option>
									</select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Supplier</label>
                                    <select name="supplier_id" class="form-control select2">
										<option value="">-- Please select --</option>
									</select>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveInventory" class="btn btn-primary waves-effect" onclick="save_inventories()">Save Changes</button>
                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>