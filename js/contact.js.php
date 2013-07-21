<?php require_once('../../../../wp-load.php'); ?>

function onlyNumbers(evt)
{
	var e = event || evt; // for trans-browser compatibility
	var charCode = e.which || e.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

function show_error_msg(id,val)
{
	jQuery("#R_" + id).remove();
	jQuery("#C_" + id).remove();
	var bB = '<span id="R_' + id + '" class="error_arows"></span> \
						<span id="C_' + id + '" class="font12t error-email webkit10 error_wordss">' + val + '</span>';
	jQuery("#" + id).append(bB);	
}

function hide_error_msg(id)
{
	jQuery("#R_" + id).remove();
	jQuery("#C_" + id).remove();
}
function validateEmail(email) 
{ 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function send_contact()
{
	var full_name = jQuery("#____full_name____").val();	
	var email     = jQuery("#____email____").val();	
	var phone     = jQuery("#____phone____").val();	
	var note     = jQuery("#____note____").val();	


	hide_error_msg('error____full_name____');
	hide_error_msg('error____email____');
	hide_error_msg('error____phone____');
	hide_error_msg('error____note____');

	if(!full_name)
	{
		show_error_msg('error____full_name____','<?php _e( 'Please write your name', 'CircleLaw' ); ?>');	
		jQuery("#____full_name____").focus();
		return false;
	}
	// ---------------------
	if(!email)
	{
		show_error_msg('error____email____','<?php _e( 'Please write your e-mail address', 'CircleLaw' ); ?>');	
		jQuery("#____email____").focus();
		return false;
	}
	if(!validateEmail(email))
	{
		show_error_msg('error____email____','<?php _e( 'Please write a correct e-mail address', 'CircleLaw' ); ?>');	
		jQuery("#____email____").focus();
		return false;
	}
	// ------------------
	if(!phone)
	{
		show_error_msg('error____phone____','<?php _e( 'Please write message subject', 'CircleLaw' ); ?>');	
		jQuery("#____phone____").focus();
		return false;
	}
	// ------------------
	if(!note)
	{
		show_error_msg('error____note____','<?php _e( 'Please write your message', 'CircleLaw' ); ?>');	
		jQuery("#____note____").focus();
		return false;
	}
	jQuery("#login-loading_2").fadeIn();
	return true;
	
}

function send_contact_done()
{
	jQuery("#login-loading_2").html('<div class="after_send"><?php echo CircleLaw_option('contact-page-msg'); ?></div>');
}
