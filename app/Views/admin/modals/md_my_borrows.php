<div class="modal fade my-borrow-modal-lg" id="my-borrow-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Info Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="my-borrow-form" class="form-horizontal">
                    <input type="hidden" value="" name="equipment_id"/>
                    <div class="form-body">
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
						
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveMyBorrow" class="btn btn-primary waves-effect" onclick="save_my_borrows()">Save Changes</button>
                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>