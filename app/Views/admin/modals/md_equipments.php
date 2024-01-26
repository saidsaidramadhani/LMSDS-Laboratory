<div class="modal fade equipment-modal-lg" id="equipment-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Info Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="equipment-form" class="form-horizontal">
                    <input type="hidden" value="" name="equipment_id"/>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Equipment Name</label>
                                    <select name="name" class="form-control select2">
										<option value="">-- Please select --</option>
									</select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Description"></textarea>
                                </div>
                            </div>							
                        </div>	
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Rent Amount</label>
                                    <input type="text" id="rent_amount" name="rent_amount" class="form-control" placeholder="amount">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Serial Number</label>
                                    <input type="text" id="serial_number" name="serial_number" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>	
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Functional Condition</label>
                                    <input type="text" id="functional_condition" name="functional_condition" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Expriment no before service</label>
                                    <input type="text" id="expriment_no_before_service" name="expriment_no_before_service" class="form-control" placeholder="">
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
                                    <label class="control-label">Equipment Type</label>
                                    <select name="equipment_type_id" class="form-control select2">
										<option value="">-- Please select --</option>
									</select>
                                </div>
                            </div>
                            </div>
							<div class="row">
								<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">is for borrowing</label><br>
									<div class="icheck-success  icheck-inline">
										<input type="radio" id="borrowing1" name="borrowing"  value="1" />
										<label for="borrowing1">Yes</label>
									</div>
									<div class="icheck-danger icheck-inline">
										<input type="radio" id="borrowing2" name="borrowing" value="0" />
										<label for="borrowing2">No</label>
									</div>	
								</div>
								</div>
								<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Status</label><br>
									<div class="icheck-success  icheck-inline">
										<input type="radio" id="status1" name="status"  value="1" />
										<label for="status1">Available</label>
									</div>
									<div class="icheck-danger icheck-inline">
										<input type="radio" id="status2" name="status" value="0" />
										<label for="status2">Not Available</label>
									</div>	
								</div>								
								</div>								
							</div>								


                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveEquipment" class="btn btn-primary waves-effect" onclick="save_equipments()">Save Changes</button>
                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>