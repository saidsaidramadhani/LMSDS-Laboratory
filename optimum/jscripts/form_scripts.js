function getURL(strURL) {  
var r = $.ajax({  
type: 'GET',  
url: strURL,  
async: false  
 }).responseText;  
return r;  
}
  
function fillCombo(targetURL, targetDIV) {
$('#'+targetDIV).html(getURL(targetURL));
}


function writeText(inputID, defaultText) {

var oText;

oText = $('#'+inputID).val();

	if((oText==defaultText) || (oText=='')) {

		$('#'+inputID).val(defaultText);
		$('#'+inputID).css('color', '#ccc');

	}

}


function clearText(inputID, defaultText) {

var oText;

oText = $('#'+inputID).val();

if(oText==defaultText) {

$('#'+inputID).val('');
$('#'+inputID).css('color', '#000');

} else {

if(oText=='') {

$('#'+inputID).val(defaultText);
$('#'+inputID).css('color', '#ccc');


} 

}

}