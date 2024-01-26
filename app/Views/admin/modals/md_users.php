	  
<div class="modal fade user-modal-lg" id="user-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Info Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="user-form" class="form-horizontal">
                    <input type="hidden" value="" name="user_id"/>
                    <div class="form-body">
                        <div class="row">
							<div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="">
                                </div>
                            </div>	
							<div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Middle Name</label>
                                    <input type="text" id="midname" name="midname" class="form-control" placeholder="">
                                </div>
                            </div>							
                        </div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Surname</label>
									<input type="text" id="surname" name="surname" class="form-control" placeholder="">
								</div>
							</div>	
							<div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">User Type</label>
                                    <select name="user_type_id" class="form-control select2">
									</select>
                                </div>

							</div>							
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Gender</label><br>
									<div class="icheck-success icheck-inline ">
										<input type="radio" id="gender1" name="gender"  value="1" />
										<label for="gender1">Male</label>
									</div>
									<div class="icheck-primary icheck-inline">
										<input type="radio" id="gender2" name="gender" value="2" />
										<label for="gender2">Female</label>
									</div>							
								</div>
							</div>	
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">User Status</label><br>
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

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  <label>phone</label>

								  <div class="input-group">
									<div class="input-group-prepend">
									  <span class="input-group-text"><i class="fas fa-phone"></i></span>
									</div>
									<input type="text" class="form-control" id="phone" name="phone"
										   data-inputmask="'mask': ['0999-999-999']" data-mask>
								  </div>
								  <!-- /.input group -->
								</div>
							</div>	
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">E-mail</label>
									<input type="text" id="email" name="email" class="form-control" data-inputmask="'alias': 'email'" data-mask>
								</div>

							</div>							
						</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveUser" class="btn btn-primary waves-effect" onclick="save_users()">Save Changes</button>
                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>