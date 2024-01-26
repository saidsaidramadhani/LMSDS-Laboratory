<div class="modal fade borrow-modal-lg" id="borrow-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Info Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="borrow-form" class="form-horizontal">
                    <input type="hidden" value="" name="borrow_id"/>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                    <label class="control-label">Equipment</label>
                                    <select name="equipment_id" class="form-control select2">
										<option value="">-- Please select --</option>
									</select>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Start Date</label>
                                    <input type="date" id="start_at" name="start_at" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">End Date</label>
                                    <input type="date" id="end_at" name="end_at" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>	
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Status</label><br>
										<div class="icheck-primary  icheck-inline">
											<input type="radio" id="status1" name="status"  value="0" />
											<label for="status1">Progress</label>
										</div>
										<div class="icheck-success icheck-inline">
											<input type="radio" id="status2" name="status" value="1" />
											<label for="status2">Approve</label>
										</div>	
										<div class="icheck-danger icheck-inline">
											<input type="radio" id="status3" name="status" value="2" />
											<label for="status3">Reject</label>
										</div>	
								</div>
							</div>
						</div>
						
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveBorrow" class="btn btn-primary waves-effect" onclick="save_borrows()">Save Changes</button>
                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>