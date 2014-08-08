/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars for Register Form
	var form = $("#user");
	var name = $("#name");
	var username = $("#username");
	var password = $("#password");
	
	//On blur
	name.blur(validateName);
	username.blur(validateUsername);
	password.blur(validatePassword);

	//On key press
	name.keyup(validateName);
	username.keyup(validateUsername);
	password.keyup(validatePassword);
	
	//On Submitting
	form.submit(function(){
	if(validateName() & validateUsername() & validatePassword())
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
	
	function validateUsername(){
		//if it's NOT valid
		if(username.val().length < 1){
			username.addClass("error");
			return false;
		}
		//if it's valid
		else{
			username.removeClass("error");
			return true;
		}
	}

	function validatePassword(){
		//if it's NOT valid
		if(password.val().length < 1){
			password.addClass("error");
			return false;
		}
		//if it's valid
		else{
			password.removeClass("error");
			return true;
		}
	}

	
});