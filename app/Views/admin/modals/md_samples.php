<div class="modal fade sample-modal-lg" id="sample-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Info Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="sample-form" class="form-horizontal">
                    <input type="text" value="" name="sample_id"/>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Sample Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder=" name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <label class="control-label">Location</label>
                                    <select name="location_id" class="form-control select2">
										<option value="">-- Please select --</option>
									</select>
                            </div>							
                        </div>	
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Expire Date</label>
                                    <input type="date" id="expire_date" name="rent_amount" class="form-control" placeholder="amount">
                                </div>
                            </div>
                            <div class="col-md-6">
								<label class="control-label">Condition</label><br>
								<div class="icheck-success  icheck-inline">
									<input type="radio" id="status1" name="status"  value="1" />
									<label for="status1">Good</label>
								</div>
								<div class="icheck-danger icheck-inline">
									<input type="radio" id="status2" name="status" value="0" />
									<label for="status2">Expire</label>
								</div>	
                            </div>
                        </div>						
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
										<label class="control-label">Storage Condition</label>
										<textarea name="storage_condition" class="form-control" placeholder="Storage Condition"></textarea>
                                </div>
                            </div>						
                            <div class="col-md-6">
                                <div class="form-group">
									<div class="form-group">
										<label class="control-label">Description</label>
										<textarea name="description" class="form-control" placeholder="other Description of the sample"></textarea>
									</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveSample" class="btn btn-primary waves-effect" onclick="save_samples()">Save Changes</button>
                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>