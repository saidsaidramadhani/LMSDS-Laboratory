<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo base_url();?>AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<!-- jQuery -->
<script src="<?php echo base_url();?>AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>AdminLTE/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url();?>AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url();?>AdminLTE/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url();?>AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url();?>AdminLTE/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url();?>AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url();?>AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url();?>AdminLTE/plugins/toastr/toastr.min.js"></script>

<!-- Bootstrap Switch -->
<script src="<?php echo base_url();?>AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>AdminLTE/dist/js/demo.js"></script>
<script>

// Initialize DataTable globally


// Function to reload the table data
function reload_table() {
    table.ajax.reload(null, false); // Reloads the DataTable using Ajax 
}

function no_modal()
{
	
	alert(' No Modal Define ');
	//setting-form
}

function do_borrowings(id)
{
	
	//alert(' get data from ajax '+id);
	//setting-form
	save_method = 'update';
    $('#my-borrow-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	
	var url ="<?php echo site_url('equipments/ajax_edit/')?>" + id;
	//alert(url);
    $.ajax({
        url : "<?php echo site_url('equipments/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="equipment_id"]').val(data.equipment_id);
			//$('[name="serial_number"]').val(data.location_id);

			
			$('.my-borrow-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Borrowing - ' + data.name + '[' + serial_number + ']');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_my_borrows()
{
	
    $('#btnSaveMyBorrow').text('saving...'); //change button text
    $('#btnSaveMyBorrow').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('borrowings/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#my-borrow-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveMyBorrow').text('SAVE CHANGE'); //change button text
				$('#btnSaveMyBorrow').attr('disabled',false); //set button enable 
                $('.my-borrow-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveMyBorrow').text('SAVE CHANGE'); //change button text
            $('#btnSaveMyBorrow').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			console.error('AJAX Error:', textStatus);
			console.error('HTTP Status:', jqXHR.status);
			console.error('Status Text:', jqXHR.statusText);
			console.error('Error Thrown:', errorThrown);
			console.error('Response Text:', jqXHR.responseText);

			
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in Borrowings: ' + errorThrown);
			}
            $('#btnSaveMyBorrow').text('SAVE CHANGE'); //change button text
            $('#btnSaveMyBorrow').attr('disabled',false); //set button enable 

        }
    });
	
}

function delete_borrow(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('borrows/delete/')?>" + semunitsid;
		$.ajax({
			url : "<?php echo site_url('borrows/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_borrows(id)
{
	
	//alert(' get data from ajax '+id);
	//setting-form
	save_method = 'update';
    $('#borrow-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	
	var url ="<?php echo site_url('borrows/ajax_edit/')?>" + id;
	//alert(url);
    $.ajax({
        url : "<?php echo site_url('borrows/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			//alert('sss'+data.start_at);
			
            $('[name="borrow_id"]').val(data.borrow_id);
            $('[name="name"]').val(data.name);
            $('[name="description"]').val(data.description);
            $('[name="storage_condition"]').val(data.storage_condition);
            $('[name="start_at"]').val(data.start_at);
            //$('[name="end_at"]').val(data.end_at);
			$("input[name=status][value=" + data.status + "]").prop('checked', true);

			var startDate = new Date(data.start_at);

			// Get the year, month, and day components
			var year = startDate.getFullYear();
			var month = String(startDate.getMonth() + 1).padStart(2, '0'); // Months are zero-based
			var day = String(startDate.getDate()).padStart(2, '0');

			// Create the "YYYY-MM-DD" format
			var formattedStartDate = year + '-' + month + '-' + day;
            $('[name="start_at"]').val(formattedStartDate);

			var endDate = new Date(data.end_at);

			// Get the year, month, and day components
			var year = endDate.getFullYear();
			var month = String(endDate.getMonth() + 1).padStart(2, '0'); // Months are zero-based
			var day = String(endDate.getDate()).padStart(2, '0');

			// Create the "YYYY-MM-DD" format
			var formattedEndDate = year + '-' + month + '-' + day;
            $('[name="end_at"]').val(formattedEndDate);

 			var res=data.equipments;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.equipment_id)
				$('[name="equipment_id"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="equipment_id"]').append('<option value="'+id+'">' + name + '</option>');			
			} 
			
			$('.borrow-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Borrowing');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_borrows()
{
	
    $('#btnSaveBorrow').text('saving...'); //change button text
    $('#btnSaveBorrow').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('borrows/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#borrow-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveBorrow').text('SAVE CHANGE'); //change button text
				$('#btnSaveBorrow').attr('disabled',false); //set button enable 
                $('.borrow-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveBorrow').text('SAVE CHANGE'); //change button text
            $('#btnSaveBorrow').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			console.error('AJAX Error:', textStatus);
			console.error('HTTP Status:', jqXHR.status);
			console.error('Status Text:', jqXHR.statusText);
			console.error('Error Thrown:', errorThrown);
			console.error('Response Text:', jqXHR.responseText);

			
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in Section: ' + errorThrown);
			}
            $('#btnSaveBorrow').text('SAVE CHANGE'); //change button text
            $('#btnSaveBorrow').attr('disabled',false); //set button enable 

        }
    });
	
}

function delete_inventory(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('inventories/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('inventories/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_inventories(id)
{
	
	//alert(' get data from ajax '+id);
	save_method = 'update';
    $('#inventory-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	
			//$('.inventory-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			//$('.modal-title').text('Inventory Settings');


	var url ="<?php echo site_url('inventories/ajax_edit/')?>" + id;
	//alert(url);
    $.ajax({
        url : "<?php echo site_url('inventories/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="inventory_id"]').val(data.inventory_id);
            $('[name="item_id"]').val(data.item_id);
            $('[name="description"]').val(data.description);
            $('[name="amount"]').val(data.amount);
            $('[name="buy_price"]').val(data.buy_price);
            $('[name="serial_number"]').val(data.serial_number);

 			var res=data.locations;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.location_id)
				$('[name="location_id"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="location_id"]').append('<option value="'+id+'">' + name + '</option>');			
			} 
			
 			var res=data.items;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.item_id)
				$('[name="item_id"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="item_id"]').append('<option value="'+id+'">' + name + '</option>');			
			}

 			var res=data.suppliers;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.supplier_id)
				$('[name="supplier_id"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="supplier_id"]').append('<option value="'+id+'">' + name + '</option>');			
			}
			
			$('.inventory-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Inventory Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_inventories()
{
	
    $('#btnSaveInventory').text('saving...'); //change button text
    $('#btnSaveInventory').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('inventories/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#inventory-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveInventory').text('SAVE CHANGE'); //change button text
				$('#btnSaveInventory').attr('disabled',false); //set button enable 
                $('.inventory-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveInventory').text('SAVE CHANGE'); //change button text
            $('#btnSaveInventory').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			console.error('AJAX Error:', textStatus);
			console.error('HTTP Status:', jqXHR.status);
			console.error('Status Text:', jqXHR.statusText);
			console.error('Error Thrown:', errorThrown);
			console.error('Response Text:', jqXHR.responseText);

			
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in Section: ' + errorThrown);
			}
            $('#btnSaveInventory').text('SAVE CHANGE'); //change button text
            $('#btnSaveInventory').attr('disabled',false); //set button enable 

        }
    });
	
}


function delete_supplier(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('suppliers/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('suppliers/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_suppliers(id)
{
	
	//alert(' get data from ajax '+id);
	//setting-form
	    save_method = 'update';
    $('#supplier-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	


	var url ="<?php echo site_url('suppliers/ajax_edit')?>" + id;
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('suppliers/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="supplier_id"]').val(data.supplier_id);
            $('[name="name"]').val(data.name);
            $('[name="description"]').val(data.description);

			$('.supplier-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Suppliers');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_suppliers()
{
	
    $('#btnSaveSupplier').text('saving...'); //change button text
    $('#btnSaveSupplier').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('suppliers/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#supplier-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveSupplier').text('SAVE CHANGE'); //change button text
				$('#btnSaveSupplier').attr('disabled',false); //set button enable 
                $('.supplier-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveSupplier').text('SAVE CHANGE'); //change button text
            $('#btnSaveSupplier').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			toastr.error('Error in Suuplier');
            $('#btnSaveSupplier').text('SAVE CHANGE'); //change button text
            $('#btnSaveSupplier').attr('disabled',false); //set button enable 

        }
    });
	
}


function delete_equipment(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('equipments/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('equipments/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_equipments(id)
{

	save_method = 'update';
    $('#equipment-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

	var url ="<?php echo site_url('equipments/ajax_edit/')?>" + id;
	//alert(url);
    $.ajax({
        url : "<?php echo site_url('equipments/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="equipment_id"]').val(data.equipment_id);
            $('[name="equipment_type_id"]').val(data.equipment_type_id);
            $('[name="serial_number"]').val(data.location_id);
            $('[name="description"]').val(data.description);
            $('[name="rent_amount"]').val(data.rent_amount);
            $('[name="functional_condition"]').val(data.functional_condition);
            $('[name="expriment_no_before_service"]').val(data.expriment_no_before_service);
            //$('[name="is_for_borrowing"]').val(data.is_for_borrowing);
            //$('[name="status"]').val(data.status);
			$("input[name=status][value=" + data.status + "]").prop('checked', true);
			$("input[name=borrowing][value=" + data.borrowing + "]").prop('checked', true);

 			var res=data.locations;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.location_id)
				$('[name="location_id"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="location_id"]').append('<option value="'+id+'">' + name + '</option>');			
			} 
			
 			var res=data.equipmentType;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.equipment_type_id)
				$('[name="equipment_type_id"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="equipment_type_id"]').append('<option value="'+id+'">' + name + '</option>');			
			}

 			var res=data.items;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.equipment_id)
				$('[name="name"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="name"]').append('<option value="'+id+'">' + name + '</option>');			
			}
			
			$('.equipment-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Equipments');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_equipments()
{
	
    $('#btnSaveEquipment').text('saving...'); //change button text
    $('#btnSaveEquipment').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('equipments/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#equipment-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveEquipment').text('SAVE CHANGE'); //change button text
				$('#btnSaveEquipment').attr('disabled',false); //set button enable 
                $('.equipment-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveEquipment').text('SAVE CHANGE'); //change button text
            $('#btnSaveEquipment').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			console.error('AJAX Error:', textStatus);
			console.error('HTTP Status:', jqXHR.status);
			console.error('Status Text:', jqXHR.statusText);
			console.error('Error Thrown:', errorThrown);
			console.error('Response Text:', jqXHR.responseText);

			
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in Section: ' + errorThrown);
			}
            $('#btnSaveEquipment').text('SAVE CHANGE'); //change button text
            $('#btnSaveEquipment').attr('disabled',false); //set button enable 

        }
    });
	
}



function delete_sample(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('samples/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('samples/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_samples(id)
{
	
	//alert(' get data from ajax '+id);
	//setting-form
	save_method = 'update';
    $('#sample-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	
	var url ="<?php echo site_url('samples/ajax_edit/')?>" + id;
	//alert(url);
    $.ajax({
        url : "<?php echo site_url('samples/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="sample_id"]').val(data.sample_id);
            $('[name="name"]').val(data.name);
            $('[name="description"]').val(data.description);
            $('[name="storage_condition"]').val(data.storage_condition);
            $('[name="expire_at"]').val(data.expire_at);
			$("input[name=status][value=" + data.status + "]").prop('checked', true);

 			var res=data.locations;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.location_id)
				$('[name="location_id"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="location_id"]').append('<option value="'+id+'">' + name + '</option>');			
			} 
			
			$('.sample-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Sample Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_samples()
{
	
    $('#btnSaveSample').text('saving...'); //change button text
    $('#btnSaveSample').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('samples/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#sample-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveSample').text('SAVE CHANGE'); //change button text
				$('#btnSaveSample').attr('disabled',false); //set button enable 
                $('.sample-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveSample').text('SAVE CHANGE'); //change button text
            $('#btnSaveSample').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			console.error('AJAX Error:', textStatus);
			console.error('HTTP Status:', jqXHR.status);
			console.error('Status Text:', jqXHR.statusText);
			console.error('Error Thrown:', errorThrown);
			console.error('Response Text:', jqXHR.responseText);

			
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in Section: ' + errorThrown);
			}
            $('#btnSaveSample').text('SAVE CHANGE'); //change button text
            $('#btnSaveSample').attr('disabled',false); //set button enable 

        }
    });
	
}

function delete_equipment_type(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('equipment_types/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('equipment_types/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}



function do_equipment_types(id)
{
	
	//alert(' get data from ajax '+id);
	//setting-form
	    save_method = 'update';
    $('#equipment-type-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	


	var url ="<?php echo site_url('equipment_types/ajax_edit')?>" + id;
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('equipment_types/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="equipment_type_id"]').val(data.equipment_type_id);
            $('[name="name"]').val(data.name);
            $('[name="description"]').val(data.description);

			$('.equipment-type-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Equipment Type Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_equipment_types()
{
	
    $('#btnSaveEquipmentType').text('saving...'); //change button text
    $('#btnSaveEquipmentType').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('equipment_types/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#equipment-type-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveEquipmentType').text('SAVE CHANGE'); //change button text
				$('#btnSaveEquipmentType').attr('disabled',false); //set button enable 
                $('.equipment-type-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveEquipmentType').text('SAVE CHANGE'); //change button text
            $('#btnSaveEquipmentType').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in User: ' + errorThrown);
			}
            $('#btnSaveEquipmentType').text('SAVE CHANGE'); //change button text
            $('#btnSaveEquipmentType').attr('disabled',false); //set button enable 

        }
    });
	
}



function delete_user(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('users/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('users/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_users(id)
{
	
	//setting-form
	save_method = 'update';
    $('#user-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	var url ="<?php echo site_url('users/ajax_edit/')?>" + id;
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('users/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            //$('[name="user_type_id"]').val(data.user_type_id);
            $('[name="user_id"]').val(data.user_id);
            $('[name="firstname"]').val(data.firstname);
            $('[name="midname"]').val(data.midname);
            $('[name="surname"]').val(data.surname);
            $('[name="phone"]').val(data.phone);
            $('[name="email"]').val(data.email);
			
			$("input[name=gender][value=" + data.gender + "]").prop('checked', true);
			$("input[name=status][value=" + data.status + "]").prop('checked', true);
            //$('[name="gender"]').val(data.gender);

			var res=data.userTypes;
			var seminar=res;
			var slen   = seminar.length;
			
			$('[name="user_type_id"]').append('<option value="">--Select--</option>');
			for (var j = 0; j < slen; j++){
			  //alert(seminar[j]['name']);
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.user_type_id)
				$('[name="user_type_id"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="user_type_id"]').append('<option value="'+id+'">' + name + '</option>');			
			}


			$('.user-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Users Management');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_users()
{
	
    $('#btnSaveUser').text('saving...'); //change button text
    $('#btnSaveUser').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('users/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#user-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveUser').text('SAVE CHANGE'); //change button text
				$('#btnSaveUser').attr('disabled',false); //set button enable 
                $('.user-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveUser').text('SAVE CHANGE'); //change button text
            $('#btnSaveUser').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			console.error('AJAX Error:', textStatus);
			console.error('HTTP Status:', jqXHR.status);
			console.error('Status Text:', jqXHR.statusText);
			console.error('Error Thrown:', errorThrown);
			console.error('Response Text:', jqXHR.responseText);

			
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in User: ' + errorThrown);
			}
            $('#btnSaveUser').text('SAVE CHANGE'); //change button text
            $('#btnSaveUser').attr('disabled',false); //set button enable 

        }
    });
	
}



function save_role_permissions()
{
	//var selectedValues = $('.duallistbox').val();
    var selectedValues = $('.duallistbox').val();
	//var selectedValuesString = $('.duallistbox').val(); // Assuming "1,3" or similar
    //var selectedValues = selectedValuesString.split(',');

    var formData = $('#role-permission-form').serialize();
    
    // Append additional data to the serialized string
    formData += '&selectedValues=' + encodeURIComponent(selectedValues);

    url = "<?php echo site_url('roles/role_update')?>";

    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveRolePermission').text('SAVE CHANGE'); //change button text
				$('#btnSaveRolePermission').attr('disabled',false); //set button enable 
                $('.role-permission-modal-lg').modal('hide');
				toastr.success(data.msg);
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveRolePermission').text('SAVE CHANGE'); //change button text
            $('#btnSaveRolePermission').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			console.error('AJAX Error:', textStatus);
			console.error('HTTP Status:', jqXHR.status);
			console.error('Status Text:', jqXHR.statusText);
			console.error('Error Thrown:', errorThrown);
			console.error('Response Text:', jqXHR.responseText);

			
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in Section: ' + errorThrown);
			}
            //$('#btnSaveRolePermission').text('SAVE CHANGE'); //change button text
            //$('#btnSaveRolePermission').attr('disabled',false); //set button enable 

        }
    });	

	//setting-form
}

function do_role_permission(id)
{

	//alert("User clicked Cancel." + id);
    $('#role-permission-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
		

	var url ="<?php echo site_url('roles/edit_role/')?>" + id;
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('roles/edit_role')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="role_id"]').val(data.role_id);
            $('[name="name"]').val(data.name);

 			var res=data.AssignedPermission;
 			var res=data.permission;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  $('[name="permission_id"]').append('<option value="'+id+'" >'+name+'</option>');
			}
			
 			var res=data.AssignedPermission;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  $('[name="permission_id"]').append('<option value="'+id+'" selected>' + name + '</option>');			
			}
 			
			var options = [
			  'Option 1',
			  'Option 2',
			  'Option 3'
			  // Add more options as needed
			];
			// Initialize Duallistbox
			//$('.duallistbox').bootstrapDualListbox()
			$('.duallistbox').bootstrapDualListbox({
			  nonSelectedListLabel: 'Available Permissions',
			  selectedListLabel: 'Selected Permissions',
			  moveOnSelect: false
			});			
			
			$('.role-permission-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Role Permission Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	

}
function delete_permission(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('permissions/delete/')?>" + semunitsid;
		$.ajax({
			url : "<?php echo site_url('permissions/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_permissions(id)
{
	//alert("User clicked Cancel.");
    $('#permission-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

	var url ="<?php echo site_url('permissions/ajax_edit')?>" + id;
    $.ajax({
        url : "<?php echo site_url('permissions/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="permission_id"]').val(data.permission_id);
            $('[name="name"]').val(data.name);
            $('[name="description"]').val(data.description);
            $('[name="display_name"]').val(data.display_name);
			$("input[name=status][value=" + data.status + "]").prop('checked', true);
			$('.permission-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Permission Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax ');
        }
    });	
	
}

function save_permissions()
{
	
    $('#btnSavePermission').text('saving...'); //change button text
    $('#btnSavePermission').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('permissions/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#permission-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSavePermission').text('SAVE CHANGE'); //change button text
				$('#btnSavePermission').attr('disabled',false); //set button enable 
                $('.permission-modal-lg').modal('hide');
				toastr.success(data.msg);
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSavePermission').text('SAVE CHANGE'); //change button text
            $('#btnSavePermission').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			toastr.error('Error in User Type');
            $('#btnSavePermission').text('SAVE CHANGE'); //change button text
            $('#btnSavePermission').attr('disabled',false); //set button enable 

        }
    });
}

function delete_role(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('roles/delete/')?>" + semunitsid;
		$.ajax({
			url : "<?php echo site_url('roles/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_roles(id)
{

    $('#role-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	


	var url ="<?php echo site_url('roles/ajax_edit')?>" + id;
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('roles/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="role_id"]').val(data.role_id);
            $('[name="name"]').val(data.name);
            $('[name="description"]').val(data.description);
            $('[name="display_name"]').val(data.display_name);
			$("input[name=status][value=" + data.status + "]").prop('checked', true);
			$('.role-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Roles Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_roles()
{
	
    $('#btnSaveRole').text('saving...'); //change button text
    $('#btnSaveRole').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('roles/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#role-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveRole').text('SAVE CHANGE'); //change button text
				$('#btnSaveRole').attr('disabled',false); //set button enable 
                $('.role-modal-lg').modal('hide');
				toastr.success(data.msg);
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveRole').text('SAVE CHANGE'); //change button text
            $('#btnSaveRole').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in : ' + errorThrown);
			}
            $('#btnSaveRole').text('SAVE CHANGE'); //change button text
            $('#btnSaveRole').attr('disabled',false); //set button enable 

        }
    });
}
function delete_user_type(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('user_types/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('user_types/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_user_types(id)
{
	
	//alert(' get data from ajax '+id);
	//setting-form
	    save_method = 'update';
    $('#user-type-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	


	var url ="<?php echo site_url('user_types/ajax_edit')?>" + id;
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('user_types/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="user_type_id"]').val(data.user_type_id);
            $('[name="name"]').val(data.name);
            //$('[name="description"]').val(data.description);

			$('.user-type-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('User type Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_user_types()
{
	
    $('#btnSaveUserType').text('saving...'); //change button text
    $('#btnSaveUserType').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('user_types/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#user-type-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveUserType').text('SAVE CHANGE'); //change button text
				$('#btnSaveUserType').attr('disabled',false); //set button enable 
                $('.user-type-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveUserType').text('SAVE CHANGE'); //change button text
            $('#btnSaveUserType').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			toastr.error('Error in User Type');
            $('#btnSaveUserType').text('SAVE CHANGE'); //change button text
            $('#btnSaveUserType').attr('disabled',false); //set button enable 

        }
    });
	
}


function delete_service(id)
{
	//alert(' No Modal Define ');
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('services/delete/')?>" + semunitsid;
		$.ajax({
			url : "<?php echo site_url('services/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_services(id)
{
	
	save_method = 'update';
    $('#service-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

	var url ="<?php echo site_url('services/ajax_edit/')?>" + id;
	//alert(url);
    $.ajax({
        url : "<?php echo site_url('services/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="service_id"]').val(data.service_id);
            $('[name="name"]').val(data.name);
            $('[name="description"]').val(data.description);
            $('[name="rent_amount"]').val(data.rent_amount);

 			var res=data.section;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.laboratory_id)
				$('[name="laboratory_id"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="laboratory_id"]').append('<option value="'+id+'">' + name + '</option>');			
			} 
						
			$('.service-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Service Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_services()
{
	
    $('#btnSaveService').text('saving...'); //change button text
    $('#btnSaveService').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('services/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#service-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveService').text('SAVE CHANGE'); //change button text
				$('#btnSaveService').attr('disabled',false); //set button enable 
                $('.service-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveService').text('SAVE CHANGE'); //change button text
            $('#btnSaveService').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			console.error('AJAX Error:', textStatus);
			console.error('HTTP Status:', jqXHR.status);
			console.error('Status Text:', jqXHR.statusText);
			console.error('Error Thrown:', errorThrown);
			console.error('Response Text:', jqXHR.responseText);

			
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in Section: ' + errorThrown);
			}
            $('#btnSaveService').text('SAVE CHANGE'); //change button text
            $('#btnSaveService').attr('disabled',false); //set button enable 

        }
    });
	
}



function delete_item_type(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('item_types/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('item_types/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_item_types(id)
{
	
	//alert(' get data from ajax '+id);
	//setting-form
	    save_method = 'update';
    $('#item-type-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	


	var url ="<?php echo site_url('item_types/ajax_edit')?>" + id;
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('item_types/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="item_type_id"]').val(data.item_type_id);
            $('[name="name"]').val(data.name);
            $('[name="description"]').val(data.description);

			$('.item-type-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('item type Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_item_types()
{
	
    $('#btnSaveItemType').text('saving...'); //change button text
    $('#btnSaveItemType').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('item_types/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#item-type-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveItemType').text('SAVE CHANGE'); //change button text
				$('#btnSaveItemType').attr('disabled',false); //set button enable 
                $('.item-type-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveItemType').text('SAVE CHANGE'); //change button text
            $('#btnSaveItemType').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			toastr.error('Error in School');
            $('#btnSaveItemType').text('SAVE CHANGE'); //change button text
            $('#btnSaveItemType').attr('disabled',false); //set button enable 

        }
    });
	
}



function delete_item(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('items/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('items/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_items(id)
{
	
	//alert(' get data from ajax '+id);
	//setting-form
	save_method = 'update';
    $('#item-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	
			//$('.item-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			//$('.modal-title').text('Item Settings');


	var url ="<?php echo site_url('items/ajax_edit/')?>" + id;
	//alert(url);
    $.ajax({
        url : "<?php echo site_url('items/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="item_id"]').val(data.item_id);
            //$('[name="item_type_id"]').val(data.item_type_id);
            //$('[name="location_id"]').val(data.location_id);
            $('[name="name"]').val(data.name);
            $('[name="description"]').val(data.description);
            $('[name="rent_amount"]').val(data.rent_amount);
            $('[name="capacity"]').val(data.capacity);

 			var res=data.locations;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.location_id)
				$('[name="location_id"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="location_id"]').append('<option value="'+id+'">' + name + '</option>');			
			} 
			
 			var res=data.itemType;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.item_type_id)
				$('[name="item_type_id"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="item_type_id"]').append('<option value="'+id+'">' + name + '</option>');			
			}
			
			$('.item-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Item Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_items()
{
	
    $('#btnSaveItem').text('saving...'); //change button text
    $('#btnSaveItem').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('items/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#item-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveItem').text('SAVE CHANGE'); //change button text
				$('#btnSaveItem').attr('disabled',false); //set button enable 
                $('.item-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveItem').text('SAVE CHANGE'); //change button text
            $('#btnSaveItem').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			console.error('AJAX Error:', textStatus);
			console.error('HTTP Status:', jqXHR.status);
			console.error('Status Text:', jqXHR.statusText);
			console.error('Error Thrown:', errorThrown);
			console.error('Response Text:', jqXHR.responseText);

			
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in Section: ' + errorThrown);
			}
            $('#btnSaveItem').text('SAVE CHANGE'); //change button text
            $('#btnSaveItem').attr('disabled',false); //set button enable 

        }
    });
	
}



function delete_item_location(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('item_locations/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('item_locations/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_item_locations(id)
{
	
	//alert(' get data from ajax '+id);
	//setting-form
	    save_method = 'update';
    $('#item-location-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	


	var url ="<?php echo site_url('item_locations/ajax_edit/')?>" + id;
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('item_locations/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="section_id"]').val(data.section_id);
            $('[name="location_id"]').val(data.location_id);
            $('[name="name"]').val(data.name);
            $('[name="description"]').val(data.description);

			var res=data.sections;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  //alert(seminar[j]['name']);
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.section_id)
				$('[name="section_id"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="section_id"]').append('<option value="'+id+'">' + name + '</option>');			
			}


			$('.item-location-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Item Locations Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_item_locations()
{
	
    $('#btnSaveItemLocation').text('saving...'); //change button text
    $('#btnSaveItemLocation').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('item_locations/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#item-location-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveItemLocation').text('SAVE CHANGE'); //change button text
				$('#btnSaveItemLocation').attr('disabled',false); //set button enable 
                $('.item-location-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveItemLocation').text('SAVE CHANGE'); //change button text
            $('#btnSaveItemLocation').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			console.error('AJAX Error:', textStatus);
			console.error('HTTP Status:', jqXHR.status);
			console.error('Status Text:', jqXHR.statusText);
			console.error('Error Thrown:', errorThrown);
			console.error('Response Text:', jqXHR.responseText);

			
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in Section: ' + errorThrown);
			}
            $('#btnSaveItemLocation').text('SAVE CHANGE'); //change button text
            $('#btnSaveItemLocation').attr('disabled',false); //set button enable 

        }
    });
	
}



function delete_section(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('sections/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('sections/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_sections(id)
{
	
	//alert(' get data from ajax '+id);
	//setting-form
	    save_method = 'update';
    $('#section-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	


	var url ="<?php echo site_url('sections/ajax_edit/')?>" + id;
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('sections/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="laboratory_id"]').val(data.laboratory_id);
            $('[name="section_id"]').val(data.section_id);
            $('[name="name"]').val(data.name);
            $('[name="description"]').val(data.description);

			var res=data.laboratories;
			var seminar=res;
			var slen   = seminar.length;

			for (var j = 0; j < slen; j++){
			  //alert(seminar[j]['name']);
			  var id = seminar[j]['id'];
			  var name = seminar[j]['name'];
			  if (id==data.laboratory_id)
				$('[name="laboratory_id"]').append('<option value="'+id+'" selected>'+name+'</option>');
			  else
				$('[name="laboratory_id"]').append('<option value="'+id+'">' + name + '</option>');			
			}


			$('.section-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('laboratory Section Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_sections()
{
	
    $('#btnSaveSection').text('saving...'); //change button text
    $('#btnSaveSection').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('sections/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#section-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveSection').text('SAVE CHANGE'); //change button text
				$('#btnSaveSection').attr('disabled',false); //set button enable 
                $('.section-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveSection').text('SAVE CHANGE'); //change button text
            $('#btnSaveSection').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			console.error('AJAX Error:', textStatus);
			console.error('HTTP Status:', jqXHR.status);
			console.error('Status Text:', jqXHR.statusText);
			console.error('Error Thrown:', errorThrown);
			console.error('Response Text:', jqXHR.responseText);

			
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in Section: ' + errorThrown);
			}
            $('#btnSaveSection').text('SAVE CHANGE'); //change button text
            $('#btnSaveSection').attr('disabled',false); //set button enable 

        }
    });
	
}



function delete_laboratory(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('laboratories/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('laboratories/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_laboratories(id)
{
	
	//alert(' get data from ajax '+id);
	//setting-form
	    save_method = 'update';
    $('#laboratory-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	


	var url ="<?php echo site_url('laboratories/ajax_edit')?>" + id;
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('laboratories/ajax_edit/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="laboratory_id"]').val(data.laboratory_id);
            //$('[name="school_id"]').val(data.school_id);
            $('[name="name"]').val(data.name);
            $('[name="description"]').val(data.description);

			$('.laboratory-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('laboratory Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_laboratories()
{
	
    $('#btnSaveLaboratory').text('saving...'); //change button text
    $('#btnSaveLaboratory').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('laboratories/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#laboratory-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveLaboratory').text('SAVE CHANGE'); //change button text
				$('#btnSaveLaboratory').attr('disabled',false); //set button enable 
                $('.laboratory-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveLaboratory').text('SAVE CHANGE'); //change button text
            $('#btnSaveLaboratory').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			console.error('AJAX Error:', textStatus);
			console.error('HTTP Status:', jqXHR.status);
			console.error('Status Text:', jqXHR.statusText);
			console.error('Error Thrown:', errorThrown);
			console.error('Response Text:', jqXHR.responseText);

			
			try {
				// Attempt to parse responseText as JSON
				var errorDetails = JSON.parse(jqXHR.responseText);
				toastr.error('Error Details: '+ errorDetails.message);
			} catch (e) {
				// If parsing fails, log the raw responseText
				toastr.error('Error in Laboratory: ' + errorThrown);
			}
            $('#btnSaveLaboratory').text('SAVE CHANGE'); //change button text
            $('#btnSaveLaboratory').attr('disabled',false); //set button enable 

        }
    });
	
}

function delete_school(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('schools/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('schools/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_schools(id)
{
	
	//alert(' get data from ajax '+id);
	//setting-form
	    save_method = 'update';
    $('#school-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	


	var url ="<?php echo site_url('schools/ajax_edit')?>" + id;
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('schools/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="school_id"]').val(data.school_id);
            $('[name="name"]').val(data.name);
            $('[name="description"]').val(data.description);

			$('.school-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('School Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_schools()
{
	
    $('#btnSaveSchool').text('saving...'); //change button text
    $('#btnSaveSchool').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('schools/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#school-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveSchool').text('SAVE CHANGE'); //change button text
				$('#btnSaveSchool').attr('disabled',false); //set button enable 
                $('.school-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveSchool').text('SAVE CHANGE'); //change button text
            $('#btnSaveSchool').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			toastr.error('Error in School');
            $('#btnSaveSchool').text('SAVE CHANGE'); //change button text
            $('#btnSaveSchool').attr('disabled',false); //set button enable 

        }
    });
	
}


function delete_setting(id)
{
	var result = confirm("Do you want to proceed to delete ?");
	
	if (result) {
		
		var semunitsid = id;	
		var url ="<?php echo site_url('systems/delete/')?>" + semunitsid;
		//Ajax Load data from ajax
		//alert('sssss' + url);
		$.ajax({
			url : "<?php echo site_url('systems/delete/')?>" + semunitsid,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				toastr.success(data.msg);
				//reload_table();
				location.reload();
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				toastr.error(data.msg);
			}
		});
	} else {
		alert("User clicked Cancel.");
	}

}

function do_settings(id)
{
	
	//alert(' get data from ajax '+id);
	//setting-form
	    save_method = 'update';
    $('#setting-form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	


	var url ="<?php echo site_url('systems/ajax_edit')?>" + id;
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('systems/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
            $('[name="settingid"]').val(data.settingid);
            $('[name="key"]').val(data.key);
            $('[name="valuez"]').val(data.valuez);
            $('[name="context"]').val(data.context);

			$('.setting-modal-lg').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('System Settings');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax '+url);
        }
    });	
	
}

function save_settings()
{
	
    $('#btnSaveSetting').text('saving...'); //change button text
    $('#btnSaveSetting').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('systems/ajax_update')?>";
	//alert(url);	
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#setting-form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
				$('#btnSaveSetting').text('SAVE CHANGE'); //change button text
				$('#btnSaveSetting').attr('disabled',false); //set button enable 
                $('.setting-modal-lg').modal('hide');
				toastr.success(data.msg);
                //reload_table();
				location.reload();
            }
            else
            {
				toastr.error(data.msg);
            }
            $('#btnSaveSetting').text('SAVE CHANGE'); //change button text
            $('#btnSaveSetting').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error in Selection');
			toastr.error('Error in Settings');
            $('#btnSaveSetting').text('SAVE CHANGE'); //change button text
            $('#btnSaveSetting').attr('disabled',false); //set button enable 

        }
    });
	
}

</script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
<script type="text/javascript">


  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        type: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        type: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        type: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        type: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        type: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

    $('.toastsDefaultDefault').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultTopLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'topLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomRight').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomRight',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultAutohide').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        autohide: true,
        delay: 750,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultNotFixed').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        fixed: false,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultFull').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        icon: 'fas fa-envelope fa-lg',
      })
    });
    $('.toastsDefaultFullImage').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        image: '../../dist/img/user3-128x128.jpg',
        imageAlt: 'User Picture',
      })
    });
    $('.toastsDefaultSuccess').click(function() {
      $(document).Toasts('create', {
        class: 'bg-success', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultInfo').click(function() {
      $(document).Toasts('create', {
        class: 'bg-info', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultWarning').click(function() {
      $(document).Toasts('create', {
        class: 'bg-warning', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultDanger').click(function() {
      $(document).Toasts('create', {
        class: 'bg-danger', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultMaroon').click(function() {
      $(document).Toasts('create', {
        class: 'bg-maroon', 
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    //$('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>

</body>
</html>