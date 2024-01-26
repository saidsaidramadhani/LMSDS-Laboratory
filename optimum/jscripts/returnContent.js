/***********************************************
* This Ajax Script was designed by Fratern M. Hassan, 2011
* This notice MUST stay intact for legal use
* Further Info or Assistance: fratern.hassan@yahoo.com
***********************************************/


function ajax_combo(parent_field_id, child_field_id, uri, child_array, child_key_name, child_value_name, extra_field_id) {
//alert('xxx');	
//parent_field_id: this the id of the parent (populating) combo box on the form  eg. id='country'
//child_field_id: this the id of the child (being populated) combo box on the form  eg. id='cities'
//extra_field_id: any other field on the form that provides necessary data in addition to the parent_field_id to fill the child_field_id ...
// ... for example: 

//uri: the controller/method combination for the child, excluding the last slash; e.g. user/get_cities (user controller, get_cities method)
//NOTE: uri must be set properly in the config/routes.php: e.g. $route['user/get_cities/(:num)'] = "user/get_cities/$1";

	if((typeof(extra_field_id)==='undefined') || (extra_field_id == null)) {

		extra_field_id = ''; //initialize extra_field_id just in case does not pass anything.

	} else {
	
		ajax_combo_clear_grand_child(child_field_id, extra_field_id); //call this function whic is defined below ...
	
	}


	$(document).ready(function(){

		$('#'+parent_field_id).click(function() {
		
	//alert('xxx');
			var parent_value_id = $('#'+parent_field_id).val(); //parent_value_id: the actual value of the id of the perent value; e.g. 1=>Tanzania, 2=>Kenye, 3=>Rwanda, etc.
			var extra_value_id = $('#'+extra_field_id).val();
			
				$.ajax({
					type: "POST",
					url: uri+'/'+parent_value_id+'/'+extra_value_id,
					
					dataType : "JSON",
					success: function(child_array) {
					//alert(extra_value_id);
					
						$('#'+child_field_id).empty();
						
						$.each(child_array,function(child_key_name,child_value_name) {
								var opt = $('<option />');
								opt.val(child_key_name);
								opt.text(child_value_name);
								$('#'+child_field_id).append(opt);
							});
					}
				});
		});
	});

}


function ajax_combo_clear_grand_child(child_field_id, extra_field_id) {
//this function is being called by the above funtion: ajax_combo

	$(document).ready(function(){

		$('#'+extra_field_id).change(function() { //if extra_field_id changes, clear child_field_id
		
			$('#'+child_field_id).empty();
			
		});
	});

}




function return_Content(div, sourceURL) {

//This function returns a content into a div element by clicking a link similar to the following:
//<a href="javascript:return_Content('#main', 'http://localhost/rcc/application/views/mo_admin/hello.php');">Link 1</a>

	$(""+div+"").load(""+sourceURL+"");

}


function preserve_URL(div, sourceURL) {
//This function preserves div content when the user refresh/reload the page. It depends on the above function
//For PHP, you can save the sourceURL value into a $_SESSION vairable and pass it during reload.

	$(window).load(function () {

		return_Content(div, sourceURL);
	
	});

}

function return_Text(div, text) {
//This function displays a text onto a div element when the page reloads.

	$(document).ready(function() {

		$(""+div+"").html(text);

	});

}


/*
function return_Content(divID, sourceURL, formFieldID) {

$(document).ready(function() {

        $('#'+divID).load(sourceURL);

        });

if(formFieldID === '') {

	} else {
	
		var fieldToFocus = document.getElementById(formFieldID);
	
		fieldToFocus.focus();
	
	}


}

*/



/*
var bustcachevar=1 //bust potential caching of external pages after initial request? (1=yes, 0=no)
var loadedobjects=""
var rootdomain="http://"+window.location.hostname
var bustcacheparameter=""

function return_Content(containerid, url, formFieldID){
var page_request = false
if (window.XMLHttpRequest) // if Mozilla, Safari etc
page_request = new XMLHttpRequest()
else if (window.ActiveXObject){ // if IE
try {
page_request = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){
try{
page_request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}
}
}
else
return false
page_request.onreadystatechange=function(){
loadpage(containerid, page_request, formFieldID)
}
if (bustcachevar) //if bust caching of external page
bustcacheparameter=(url.indexOf("?")!=-1)? "&"+new Date().getTime() : "?"+new Date().getTime()
page_request.open('GET', url+bustcacheparameter, true)
page_request.send(null)
}

function loadpage(containerid, page_request, formFieldID){

	if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1)) {

	document.getElementById(containerid).innerHTML=page_request.responseText;

	
	if(formFieldID === '') {

	} else {
	
	var fieldToFocus = document.getElementById(formFieldID);
	
	fieldToFocus.focus();
	
	}

//}
}
}





function loadobjs(){
if (!document.getElementById)
return
for (i=0; i<arguments.length; i++){
var file=arguments[i]
var fileref=""
if (loadedobjects.indexOf(file)==-1){ //Check to see if this object has not already been added to page before proceeding
if (file.indexOf(".js")!=-1){ //If object is a js file
fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript");
fileref.setAttribute("src", file);
}
else if (file.indexOf(".css")!=-1){ //If object is a css file
fileref=document.createElement("link")
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", file);
}
}
if (fileref!=""){
document.getElementsByTagName("head").item(0).appendChild(fileref)
loadedobjects+=file+" " //Remember this object as being already added to page
}
}
}
*/