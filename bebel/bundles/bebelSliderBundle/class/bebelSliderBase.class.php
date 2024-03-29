<?php

class bebelSliderBase
{
    
    protected $image;
    protected $html   = false;
    protected $settings;
    protected $post_id;
    protected $sliderId;
    protected $image_size;
    protected $warning = '';
    
    public function __construct($post_id, $size = "full")
    {
        $this->post_id = $post_id;
        $this->settings = BebelSingleton::getInstance('BebelSettings');
        $this->setImageSize($size);
    }
    
    public function setImageSize($size)
    {
        $this->image_size = $size;
    }

    public function hasSlider(){
        return !!$this->sliderId;
    }

    public function hasImage(){
        return !!$this->image;
    }
}