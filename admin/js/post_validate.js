/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars for Register Form
	var form = $("#posts");
	var title = $("#title");
	var price = $("#price");
	var category = $("#category");

	
	//On blur
	title.blur(validateTitle);
	price.blur(validatePrice);
	category.blur(validateCategory);

	//On key press
	title.keyup(validateTitle);
	price.keyup(validatePrice);
	category.keyup(validateCategory);
	
	//On Submitting
	form.submit(function(){
	if(validateTitle() & validatePrice() & validateCategory())
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
	
	function validatePrice(){
		//if it's NOT valid
		if(price.val().length < 1){
			price.addClass("error");
			return false;
		}
		//if it's valid
		else{
			price.removeClass("error");
			return true;
		}
	}

	function validateCategory(){
		//if it's NOT valid
		if(category.val() == 0){
			category.addClass("error");
			return false;
		}
		//if it's valid
		else{
			category.removeClass("error");
			return true;
		}
	}
	
});