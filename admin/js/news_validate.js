/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars for Register Form
	var form = $("#news");
	var entitle = $("#entitle");
	var kmtitle = $("#kmtitle");
	var encontent = $("#encontent");
	var kmcontent = $("#kmcontent");
	var category = $("#newscategory");
	
	//On blur
	entitle.blur(validateName);
	category.blur(validateCategory);
	kmtitle.blur(validateKhmername);
	encontent.blur(validateEncontent);
	kmcontent.blur(validateKmcontent);

	//On key press
	entitle.keyup(validateName);
	kmtitle.keyup(validateKhmername);
	encontent.keyup(validateEncontent);
	kmcontent.keyup(validateKmcontent);
	category.keyup(validateCategory);

	
	//On Submitting
	form.submit(function(){
	if(validateName() & validateKhmername() & validateKmcontent() & validateEncontent() & validateCategory())
			return true;
		else
			return false;
	});
	function validateName(){
		//if it's NOT valid
		if(entitle.val().length < 1){
			entitle.addClass("error");
			return false;
		}
		//if it's valid
		else{
			entitle.removeClass("error");
			return true;
		}
	}
	function validateKhmername(){
		//if it's NOT valid
		if(kmtitle.val().length < 1){
			kmtitle.addClass("error");
			return false;
		}
		//if it's valid
		else{
			kmtitle.removeClass("error");
			return true;
		}
	}
	
	function validateEncontent(){
		//if it's NOT valid
		if(encontent.val().length < 1){
			encontent.addClass("error");
			return false;
		}
		//if it's valid
		else{
			encontent.removeClass("error");
			return true;
		}
	}
	
	function validateKmcontent(){
		//if it's NOT valid
		if(kmcontent.val().length < 1){
			kmcontent.addClass("error");
			return false;
		}
		//if it's valid
		else{
			kmcontent.removeClass("error");
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