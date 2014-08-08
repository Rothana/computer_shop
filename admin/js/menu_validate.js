/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars for Register Form
	var form = $("#category");
	var name = $("#name");
	var url = $("#url");
	
	//On blur
	name.blur(validateName);
	url.blur(validateUrl);

	//On key press
	name.keyup(validateName);
	url.keyup(validateUrl);

	
	//On Submitting
	form.submit(function(){
	if(validateName() & validateUrl())
			return true;
		else
			return false;
	});
	function validateName(){
		//if it's NOT valid
		if(name.val().length < 1){
			name.addClass("error");
			return false;
		}
		//if it's valid
		else{
			name.removeClass("error");
			return true;
		}
	}
	function validateUrl(){
		//if it's NOT valid
		if(url.val().length < 1){
			url.addClass("error");
			return false;
		}
		//if it's valid
		else{
			url.removeClass("error");
			return true;
		}
	}
	
});