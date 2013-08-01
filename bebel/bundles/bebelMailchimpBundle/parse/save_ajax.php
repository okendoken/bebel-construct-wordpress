<?php

define('WP_USE_THEMES', false);
include_once '../../../../../../../wp-load.php';
include_once get_template_directory().'/functions.php';

foreach($_POST as $key => $value)
{
    $valid_data[esc_attr($key)] = esc_attr($value);
}


if(!isset($valid_data['email']) || $valid_data['email'] == '' || !is_email($valid_data['email']))
{
    die('<div class="error"></div>');
}


$api = new BebelMailchimp();
if($api->check() == 'valid')
{
    
    $mc_list = $bSettings->get('mailchimp_default_list');
    
    $mc_result = $api->listSubscribe($mc_list, $valid_data['email']);

    
    // everything went fine
    if($mc_result === true)
    {
        die('<div class="success"></div>');
    }else {
        die('<div class="error"></div>');
    }

}