jQuery(document).ready(function($) {
	// my Tabbed pannel
	$("#panel-tabs ul li:first").addClass("active");
	$("#kadoo_form .block:first").addClass("on");
	$("#kadoo_form .block:not(:first)").addClass("hidden");
	$("#panel-tabs li").click(function(e) {
		e.preventDefault();
		var index = $(this).index();
		$("#panel-tabs li.active").removeClass("active").addClass("inactive");
		$(this).removeClass("inactive").addClass("active");
		//index = index + 1
		//alert(index);
		//$("#kadoo_form .block.on").slideUp(100).removeClass("on");
		$("#kadoo_form .block.on").fadeOut(0).removeClass("on");
		//$("#kadoo_form .block").eq(index).slideDown(500).removeClass("hidden").addClass("on");
		$("#kadoo_form .block").eq(index).fadeIn(10).removeClass("hidden").addClass("on");
	});

	
	//$(".on-of:checkbox").checkbox();
	$("img.radio-img-img").click(function(){
		$(this).parent().parent().find(".radio-img-img").removeClass("radio-img-selected");
		$(this).addClass("radio-img-selected");		
	});	

	
	//$(".on-of:checkbox").checkbox();
	$("ul.radio-list li.singleli-img").click(function(){

		$(this).parent().find(".singleli-img").removeClass("radio-list-selected");
		$(this).parent().find("input:radio").attr('checked', false);
		$(this).addClass("radio-list-selected");
		$(this).find("input:radio").attr('checked', true);

	});	


	// check box inputs
	$("ul.checkbox_img li.ghghgh").click(function(){
		
		if ( $(this).hasClass("checkbox_img-selected") ) {
			$(this).removeClass("checkbox_img-selected");
			$(this).find("input:checkbox").attr('checked', false);
		}else{
			$(this).addClass("checkbox_img-selected");
			$(this).find("input:checkbox").attr('checked', true);
		}

	});	

	// check box inputs
	$("div.on-off").click(function(){
		
		if ($(this).hasClass("on-botton") ) {
			$(this).removeClass("on-botton");
			$(this).find("input:text").attr('value', "false");
		}else{
			$(this).addClass("on-botton");
			$(this).find("input:text").attr('value', "true");
		}

	});	



	jQuery(".addnewfield").live("click" ,function () {
		var arrid = $(this).parent().parent().attr('id');
		jQuery(this).parent().parent().append(
		'<div class="upload-r">\
		<input class="regular-text text-upload" type="text" name="koption['+ arrid +'][]" id="" value=""  />\
		<input type="button" class="button button-upload" value="Upload an image"/>\
		<input type="button" class="addnewfield" value="+"/>\
		<input type="button" class="removefield" value="-"/>\
		<div class="clear"></div>\
		</div>');
	});

	jQuery(".removefield").live("click" , function() {
		jQuery(this).parent().remove();
	});


	
});