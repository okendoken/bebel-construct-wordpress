<?php
class BebelWidgetAutoInstaller{

    private $widgets, $sidebar;

    function __construct($sidebar, array $widgets)
    {
        $this->sidebar = $sidebar;
        $this->widgets = $widgets;
    }

    public function installWidgets()
    {
        add_action('after_switch_theme', array($this, 'registerAutoloadWidgets'));
    }

    public function registerAutoloadWidgets()
    {
        $sidebars_widgets = get_option('sidebars_widgets');
        $sidebars_widgets[$this->sidebar] = array(); //reset sidebar whatever was there
        foreach ($this->widgets as $widget){
            $widget_name = $widget['name'];
            $db_widget_data = get_option('widget_'.$widget_name);
            if(!is_array($db_widget_data)){
                $db_widget_data = array();
            }
            $widgets_count = count($db_widget_data) + 1;
            $sidebars_widgets[$this->sidebar][] = $widget_name.'-'.$widgets_count;
            $db_widget_data[$widgets_count] = array(
                'title' => ''
            );
            update_option('sidebars_widgets', $sidebars_widgets);
            update_option('widget_'.$widget_name, $db_widget_data);
        }
    }
}