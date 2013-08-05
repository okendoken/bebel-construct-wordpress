<?php

add_action('wp_ajax_nopriv_bebel_do_ajax', 'bebel_do_ajax');
add_action('wp_ajax_bebel_do_ajax', 'bebel_do_ajax');
function bebel_do_ajax(){
    
    $fn = (isset($_GET['fn'])) ? $_GET['fn'] : $_POST['fn'];
    
    switch(esc_attr($fn))
    {
        case 'mailchimp_subscribe':
            bebel_mailchimp_subscribe($_POST);
            break;
        default:
            break;
    }
    
}

function bebel_mailchimp_subscribe($post)
{
    $settings = BebelSingleton::getInstance('BebelSettings');
    foreach($post as $key => $value)
    {
        $valid_data[esc_attr($key)] = esc_attr($value);
    }

    if(!isset($valid_data['email']) || $valid_data['email'] == '' || !is_email($valid_data['email']))
    {
        die('<div class="error">'.__('Please enter a valid Email Address', $settings->getPrefix()).'</div>');
    }


    $api = new BebelMailchimp();
    if($api->check() == 'valid')
    {

        $mc_list = $settings->get('mailchimp_default_list');

        $mc_result = $api->listSubscribe($mc_list, $valid_data['email']);


        // everything went fine
        
        if($mc_result === true)
        {
            die('<div class="success">'.__('Successfully Subscribed. Thanks', $settings->getPrefix()).'</div>');
        }else {
            die('<div class="error">'.$mc_result.'</div>');
        }

}
}