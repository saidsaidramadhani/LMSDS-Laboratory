/* AUTOSUGGEST SEARCH */
// triggered by input field onKeyUp
function autosuggest(str,uurl){
	// if there's no text to search, hide the list div
	//alert('Hi');
	if (str.length == 0) {
		$('#autosuggest_list').fadeOut(500);
	} else {
		//alert('sss kk'+uurl);
		// first show the loading animation
		$('#class_activity').addClass('loading');
		
		// Ajax request to CodeIgniter controller "ajax" method "autosuggest"
		// post the str paramter value
		//var sug = "<?php echo base_url().'/index.php/admission/autosuggest'; ?>";
		//var sug="http://"+window.location.hostname+"index.php/admission/autosuggest";
		var sug	=	uurl+"Admission/autosuggest";	
		//alert(sug);
		$.post(sug,
			{ 'str':str },
			function(result) {
				// if there is a result, fill the list div, fade it in 
				// then remove the loading animation
				//alert(sug);
				if(result) {
					$('#autosuggest_list').html(result);
					$('#autosuggest_list').fadeIn(500);
					$('#reg_no').removeClass('loading');
			} 
		});
	}
}

function autosuggestinv(str,uurl){

		// if there's no text to search, hide the list div

	if (str.length == 0) {

		$('#autosuggest_list').fadeOut(500);

	} else {

		// first show the loading animation

		$('#class_activity').addClass('loading');

		

		// Ajax request to CodeIgniter controller "ajax" method "autosuggest"

		// post the str paramter value

		//var sug = "<?php echo base_url().'/index.php/admission/autosuggest'; ?>";

		//var sug="http://"+window.location.hostname+"index.php/admission/autosuggest";

		//alert(uurl);

		var sug	=	uurl+"index.php/admission/autosuggestinv";	

		//alert(sug);

		$.post(sug,

			{ 'str':str },

			function(result) {

				// if there is a result, fill the list div, fade it in 

				// then remove the loading animation

				//alert(sug);

				if(result) {

					$('#autosuggest_list').html(result);

					$('#autosuggest_list').fadeIn(500);

					$('#reg_no').removeClass('loading');

			} 

		});

	}

}


function autosuggests(str,uurl){
	// if there's no text to search, hide the list div
	//alert('Hi');
	if (str.length == 0) {
		$('#autosuggest_lists').fadeOut(500);
	} else {
		// first show the loading animation
		$('#class_activity').addClass('loading');
		
		// Ajax request to CodeIgniter controller "ajax" method "autosuggest"
		// post the str paramter value
		//var sug = "<?php echo base_url().'/index.php/admission/autosuggest'; ?>";
		//var sug="http://"+window.location.hostname+"index.php/admission/autosuggest";
		//alert(uurl);
		var sug	=	uurl+"index.php/admission/autosuggest";	
		//alert(sug);
		$.post(sug,
			{ 'str':str },
			function(result) {
				// if there is a result, fill the list div, fade it in 
				// then remove the loading animation
				//alert(sug);
				if(result) {
					$('#autosuggest_lists').html(result);
					$('#autosuggest_lists').fadeIn(500);
					$('#regno').removeClass('loading');
			} 
		});
	}
}
/* AUTOSUGGEST SET ACTIVITY */
// triggered by an onClick from any of the li's in the autosuggest list


function set_activity(activity_name) {
	//alert('Hello world');
	$('#reg_no').val(activity_name);
	setTimeout("$('#autosuggest_list').fadeOut(500);", 250);
}

function set_activitys(activity_name) {
	//alert('Hello world');
	$('#regno').val(activity_name);
	setTimeout("$('#autosuggest_lists').fadeOut(500);", 250);
}
/* AUTOSUGGEST DISPLAY ACTIVITY DETAILS */
// called by set_activity()
// get the HTML to display and display it

function autoante(str,uurl){
	// if there's no text to search, hide the list div
	if (str.length == 0) {
		$('#autoante_list').fadeOut(500);
	} else {
		// first show the loading animation
		$('#class_ante').addClass('loading');
		
		var sug	=	uurl+"index.php/admission/autoante";	
		//alert(sug);
		$.post(sug,
			{ 'str':str },
			function(result) {
				// if there is a result, fill the list div, fade it in 
				// then remove the loading animation
				//alert(sug);
				if(result) {
					$('#autoante_list').html(result);
					$('#autoante_list').fadeIn(500);
					$('#ante').removeClass('loading');
			} 
		});
	}
}
function set_ante(ante_name) {
	//alert('Hello world');
	$('#ante').val(ante_name);
	setTimeout("$('#autoante_list').fadeOut(500);", 250);
}

function autopfno(str,uurl){
	// if there's no text to search, hide the list div
	if (str.length == 0) {
		$('#autopfno_list').fadeOut(500);
	} else {
		// first show the loading animation
		$('#class_pfno').addClass('loading');
		
		var sug	=	uurl+"index.php/admission/autopfno";	
		//alert(sug);
		$.post(sug,
			{ 'str':str },
			function(result) {
				// if there is a result, fill the list div, fade it in 
				// then remove the loading animation
				//alert(sug);
				if(result) {
					$('#autopfno_list').html(result);
					$('#autopfno_list').fadeIn(500);
					$('#pfno').removeClass('loading');
			} 
		});
	}
}
function set_pfno(pfno_name) {
	//alert('Hello world');
	$('#pfno').val(pfno_name);
	setTimeout("$('#autopfno_list').fadeOut(500);", 250);
}

	function set_student(user_name) {
		var username=user_name;
		alert('ffff');
		$.post('<?php echo base_url() ?>index.php/mo_admission/studyyear_reg/findd',
				  {'user_id':username},
				  function(result) {
					var res=result;
					var n=res.split('--')
						$('#firstname').val(n[0])	
						$('#midname').val(n[1])	
						$('#surname').val(n[2])	
						$('#index_no').val(n[3])	
						$('#sex').val(n[4])	
						$('#datepicker').val(n[5])	
						$('#maritalid').val(n[6])	
						$('#programcode').val(n[7])	
						$('#countryid').val(n[8])	
						$('#regioncode').val(n[9])	
						$('#address').val(n[10])	
						$('#phone').val(n[11])	
						$('#fax').val(n[12])	
						$('#datepickers').val(n[13])	
						$('#email').val(n[14])	

				  }
				);

	}	
	