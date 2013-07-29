<?php

class bebelThemeBundleLayoutFiles
{

    public $assets_uri;
    public $settings;

    public function __construct()
    {
        $this->assets_uri = get_stylesheet_directory_uri();
        $this->settings = BebelSingleton::getInstance('BebelSettings');
    }

    public function override_css_files()
    {
        wp_enqueue_style("bebel-reset", $this->assets_uri."/css/reset.css");
        wp_enqueue_style("bebel-style", $this->assets_uri."/css/global.css", array('bebel-reset'));
        wp_enqueue_style("bebel-custom", $this->assets_uri."/css/custom.css", array('bebel-style'));
        wp_enqueue_style("supersized", $this->assets_uri."/css/supersized.css", array('bebel-reset'));
        wp_enqueue_style("bebel-wordpress", $this->assets_uri."/css/wordpress.css", array('bebel-reset'));
        wp_enqueue_style("jsscrollpane", $this->assets_uri."/css/jquery.jscrollpane.css", array('bebel-reset'));
        

        if($this->settings->get('contact_overview_page') != '' && get_the_ID() == $this->settings->get('contact_overview_page')) {
            wp_enqueue_style("uniform", $this->assets_uri."/css/uniform.default.css", array('bebel-reset'));
        }
        
        // check for mobile 
        if(is_mobile())
        {
            wp_enqueue_style("bebel-mobile", $this->assets_uri."/css/mobile.css", array('bebel-style'));
        }
        if(is_tablet())
        {
            wp_enqueue_style("bebel-tablet", $this->assets_uri."/css/tablet.css", array('bebel-style'));
        }
    }

    public function override_js_files()
    {

        wp_enqueue_script("jquery");

        //wp_enqueue_script("modernizr", "http://modernizr.com/downloads/modernizr-2.5.3.js");
        wp_enqueue_script("lettering", $this->assets_uri."/js/jquery.lettering-0.6.1.min.js", array('jquery'));
        wp_enqueue_script("supersizedcore", $this->assets_uri."/js/supersized.core.3.2.1.min.js", array('jquery'));
        wp_enqueue_script("supersized", $this->assets_uri."/js/supersized.3.2.6.min.js", array('supersizedcore'));
        wp_enqueue_script("greyscale", $this->assets_uri."/js/jquery.greyscale.js", array('jquery'));
        wp_enqueue_script("mousewheel", $this->assets_uri."/js/jquery.mousewheel.js", array('jquery'));
        wp_enqueue_script("mouswheelintent", $this->assets_uri."/js/mwheelIntent.js", array('jquery'));
        wp_enqueue_script("jsscrollpane", $this->assets_uri."/js/jquery.jscrollpane.min.js", array('mousewheel'));
        
        wp_enqueue_script("global", $this->assets_uri."/js/global.js", array('jquery'));
        

        if($this->settings->get('contact_overview_page') != '' && get_the_ID() == $this->settings->get('contact_overview_page')) {
            wp_enqueue_script("uniform", $this->assets_uri."/js/jquery.uniform.min.js", array('jquery'));
            wp_enqueue_script("google-maps", "http://maps.google.com/maps/api/js?sensor=false", array('jquery'));
        }



    }
}