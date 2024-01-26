<div class="modal fade service-modal-lg" id="service-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Info Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="service-form" class="form-horizontal">
                    <input type="hidden" value="" name="service_id"/>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Service Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder=" name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="description" class="form-control" placeholder=" Description"></textarea>
                                </div>
                            </div>
                        </div>	
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Cost Amount</label>
                                    <input type="text" id="rent_amount" name="rent_amount" class="form-control" placeholder="amount">
                                </div>
                            </div>
                        </div>						
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Laboratory</label>
                                    <select name="laboratory_id" class="form-control select2">
										<option value="">-- Please select --</option>
									</select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveService" class="btn btn-primary waves-effect" onclick="save_services()">Save Changes</button>
                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>