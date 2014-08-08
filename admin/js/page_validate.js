/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars for Register Form
	var form = $("#pages");
	var title = $("#title");
	var url = $("#url");
	
	//On blur
	title.blur(validateTitle);
	url.blur(validateUrl);

	//On key press
	title.keyup(validateTitle);
	url.keyup(validateUrl);
	
	//On Submitting
	form.submit(function(){
	if(validateTitle() & validateUrl())
			return true;
		else
			return false;
	});
	function validateTitle(){
		//if it's NOT valid
		if(title.val().length < 1){
			title.addClass("error");
			return false;
		}
		//if it's valid
		else{
			title.removeClass("error");
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