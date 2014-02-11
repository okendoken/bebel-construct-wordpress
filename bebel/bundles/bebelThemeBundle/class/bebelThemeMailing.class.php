<?php

class bebelThemeMailing 
{
    /**
     * Contains the bebel Settings object
     *
     * @var BebelSettings 
     */
    protected $settings;
    
    /**
     * contains all the success messages
     *
     * @var array 
     */
    protected $messages;
    
    
    /**
     * contains all the errors
     *
     * @var array
     */
    protected $errors;
    
    /**
     * after validation we will save the validated data in here.
     *
     * @var array 
     */
    protected $validated_data;
    
    
    /**
     * if the validation was not successful, we save the array in here
     * to build the error message and get it back if not ajax request
     *
     * @var array
     */
    protected $invalid_data;
    
    
    /**
     * Creates a new object of this class and sets the settings up
     *
     * @param integer $event_id 
     */
    public function __construct()
    {
        $this->settings = BebelSingleton::getInstance('BebelSettings');
    }
    
    /**
     * A simple validation method
     *
     * @param array $required
     * @param array $values 
     */
    public function validateFields($required, $values)
    {
        $errors = array();
        foreach($required as $field => $type)
        {
            switch($type[0])
            {
                case 'string':
                    if(!isset($values[$field]) || $values[$field] == '')
                    {
                       $errors[] = _x($type[1], $this->settings->getPrefix()); 
                    }
                    break;

                case 'email':
                    if(!isset($values[$field]) || $values[$field] == '' || !is_email($values[$field]))
                    {
                       $errors[] = _x($type[1], $this->settings->getPrefix()); 
                    }
                    break;
                case 'checkbox':
                    if(!isset($values[$field]) || $values[$field] == "false" || $values[$field] == "off" || $values[$field] == "")
                    {
                       $errors[] = _x($type[1], $this->settings->getPrefix()); 
                    }
                    break;
                case 'canbeempty':
                    break;
            }
        }
        
        $this->errors = $errors;
        if(empty($errors))
        {
            $this->validated_data = $values;
        }else {
            $this->invalid_data = $values;
        }
    }
    
    /**
     * return if the form is valid
     *
     * @return boolean 
     */
    public function isValid()
    {
        return empty($this->errors) ? true : false;
    }
    
    
    
    
    public function displayErrors()
    {
       
        die($this->buildErrorHtml());
        
    }
    
    public function displaySuccess()
    {
        if($this->ajax)
        {
            // just die the message, thats all we need for ajax
            die($this->buildSuccessHtml());
        }else {
            $permalink = get_permalink($this->event_id);
            $return_link = BebelUtils::addParameterToPermalink($permalink, array('step' => 'done'));
            
            header("Location: $return_link");
        }
    }
    
    
    /**
     * Build an html string for displaying the errors
     *
     * @return string
     */
    public function buildErrorHtml()
    {
        $errors = $this->errors;
        
        $return = "<div class='alert alert-default'>
                    <a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a>
                    <ul class='text-warning'>";
        foreach($errors as $message)
        {
            $return .= '<li>'.$message.'</li>';
        }
        $return .= '</ul></div>';
        
        return $return;
    }
    
    
    /**
     * Build an html string for displaying the success messages
     *
     * @return string 
     */
    public function buildSuccessHtml()
    {
        $text = _x('Your message has been sent. Thank you for your time. We will respond to your request as soon as possible.', 'bebel');
        return "<div class='alert alert-default'>
                    <a class='close' data-dismiss='alert' href='#' aria-hidden='true'>&times;</a>
                    <p class='text-success'>
                        {$text}
                    </p>
                </div>";
    }
    
    
    public function send()
    {
        $blogname = get_bloginfo('name');
        $subject = _x(sprintf("New Contact Request on %s", $blogname), $this->settings->getPrefix());

        $send_to = $this->settings->get('contact_email');
        $author_name = _x('Admin', 'bebel');
        
        $hi = _x(sprintf('Hi %s,', $author_name), $this->settings->getPrefix());
        $intro = _x(sprintf('somebody just sent you an email through your contact form on %s,', $blogname), $this->settings->getPrefix());
        $outro = _x('your mailingbot.', 'bebel');
        
        $name = _x('Name: ', 'bebel');
        $email = _x('Email: ', 'bebel');
        $subject = _x('Website URL: ', 'bebel');
        $message = _x('Message: ', 'bebel');
        
        
        $message =
<<<EOF
{$hi}

{$intro}

{$name}       {$this->validated_data['name']}
{$email}      {$this->validated_data['email']}
{$subject}      {$this->validated_data['subject']}
{$message}      
{$this->validated_data['message']}

{$outro}
EOF;

         wp_mail($send_to, $subject, $message);
        
        
        die($this->buildSuccessHtml());
    }
    
}