<?php

/**
 * A simple widget to collect the emails and send them to mailchimp. 
 * no local saving allowed for this one.
 *
 * @author ljungi
 */
class bebelWidgetMailchimpNewsletter extends BebelWidgetBase {
    //put your code here
    
     // setup

  protected
    $widget_name = 'BebelWidgetMailchimpNewsletter',
    $desc_name   = 'Mailchimp Newsletter Widget (side)',
    $widget_ops = array(
        'classname' => 'bebel_mailchimp_newsletter',
        'description' => 'Displays a newsletter signup form that directly sends the email addresses to mailchimp.'
    ),
    $widget_settings = array(
        'width' => '200px',
        'bundle' => 'bebelMailchimpBundle',
    ),
    $setup = array(
        
        'title' => array(
          'title' => 'Title',
          'description' => 'Enter the title for the newsletter form field',
          'help' => '',
          'template' => 'input',
          'options' => array('default' => 'Newsletter Sign Up')
        ),
        'mailchimp_list' => array(
          'bundle' => 'bebelMailchimpBundle',
          'title' => 'Mailchimp List',
          'description' => 'Select the list you want to synchronize with',
          'help' => '',
          'template' => 'mailchimp_lists',
          'options' => array('default' => '9')
        ),

    );



	public function widget($args, $instance) {
		extract($args, EXTR_SKIP);

        $this->settings = BebelSingleton::getInstance('BebelSettings');

        echo $before_widget;

        $values = array();
        foreach($this->setup as $key => $widget) {
            $values[$key] = empty($instance[$key]) ? '' : apply_filters('widget_'.$key, $instance[$key]);
        }

        $values['randid'] = BebelUtils::mnemonicCode();
        $values['url'] = get_stylesheet_directory_uri().BebelUtils::getBundlePath().'/bebelMailchimpBundle/parse/save.php';
        $values['url_ajax'] = get_stylesheet_directory_uri().BebelUtils::getBundlePath().'/bebelMailchimpBundle/parse/save_ajax.php';
        $param = array('values' => $values);

        $this->renderOutput($param);

		echo $after_widget;
	}
}

?>
