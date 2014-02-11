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
        case 'generate_2x_images':
            bebel_generate_2x_images($_POST);
            break;
        case 'send_contact_form':
            bebel_send_contact_form($_POST);
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
        die(__('Please enter a valid Email Address', 'bebel'));
    }


    $api = new BebelMailchimp();
    if($api->check() == 'valid')
    {

        $mc_list = $settings->get('mailchimp_default_list');

        $mc_result = $api->listSubscribe($mc_list, $valid_data['email']);


        // everything went fine
        
        if($mc_result === true)
        {
            die(__('Successfully Subscribed. Thanks', 'bebel'));
        }else {
            die($mc_result);
        }

}
}

function bebel_generate_2x_images($post)
{
    echo json_encode(
        bebelRetinaHelper::generate2xImageForAllAttachments()
    );
    die();
}

function bebel_send_contact_form($post)
{
    $bSettings = BebelSingleton::getInstance('BebelSettings');
    $required = array(
        'name' => array('string', _x('Please tell us your name :)', 'bebel')),
        'email' => array('email', _x('We need a valid email address to get back to you.', 'bebel')),
        'message' => array('string', _x('What do you want to tell us? Enter some text, please!', 'bebel')),
        'subject' => array('string', _x('Please enter message subject.', 'bebel')),
    );

    $mail = new bebelThemeMailing();
    $mail->validateFields($required, $post);


    if(!$mail->isValid())
    {
        $mail->displayErrors();
    }

    $mail->send();
}