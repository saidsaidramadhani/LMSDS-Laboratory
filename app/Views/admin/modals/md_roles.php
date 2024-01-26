	  
<div class="modal fade role-modal-lg" id="role-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Info Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="role-form" class="form-horizontal">
                    <input type="hidden" value="" name="role_id"/>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Type Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Display name</label>
                                    <input type="text" id="display_name" name="display_name" class="form-control" placeholder="name">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
								<label class="control-label">Status</label><br>
								<div class="icheck-success  icheck-inline">
									<input type="radio" id="status1" name="status"  value="1" />
									<label for="status1">Active</label>
								</div>
								<div class="icheck-danger icheck-inline">
									<input type="radio" id="status2" name="status" value="0" />
									<label for="status2">Inactive</label>
								</div>	
                            </div>
                        </div>						
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveRole" class="btn btn-primary waves-effect" onclick="save_roles()">Save Changes</button>
                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>