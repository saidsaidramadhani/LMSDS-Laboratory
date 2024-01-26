	  
<div class="modal fade role-permission-modal-lg" id="role-permission-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Info Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="role-permission-form" class="form-horizontal">
                    <input type="hidden" value="" name="role_id"/>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Role</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="name">
                                </div>
                            </div>
                        </div>
						<div class="row">
						  <div class="col-12">
							<div class="form-group">
							  <label>Permissions</label>
							  <select class="duallistbox" multiple="multiple" name="permission_id" id="permission_id">
							  </select>
							</div>
							<!-- /.form-group -->
						  </div>
						  <!-- /.col -->
						</div>             
		 
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveRole" class="btn btn-primary waves-effect" onclick="save_role_permissions()">Save Changes</button>
                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>