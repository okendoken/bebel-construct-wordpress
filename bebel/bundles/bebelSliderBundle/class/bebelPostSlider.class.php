<?php

class bebelPostSlider extends bebelSliderBase
{
    
    public function countSlides()
    {
        return count($this->images);
    }
    
    
    public function getImages()
    {
        if($this->post_id)
        {
            $this->getImagesByPostId();
        }else {
            $this->getImagesBySliderSet();
        }
    }
    
    
    public function getImagesBySliderSet()
    {
        // first, check if slider is on. if not, return do nothing more.
        if($this->settings->get('bebel_slider_enable') == "off")
        {
            // get static mainpage image

            $image_url = $this->settings->get('mainpage_image');
            if($image_url)
            {
                $image_id = BebelUtils::getImageIdByUrl($image_url);
                if(!$image_id)
                {
                    $this->image = $image_url;
                }else {
                    $image_url = wp_get_attachment_image_src($image_id, $this->image_size);
                    $this->image = $image_url[0];
                    
                }
            }else {
                if($this->post_id)
                {
                    $this->warning = __('You have neither set up a featured image, nor uploaded any slider images. Please fix this in your post. Otherwise, use the full width layout, which does not require any image..', $this->settings->getPrefix());
                }else {
                    $this->warning = __('The mainpage slider is currently disabled, but you do not have defined any static image to replace it with. Please upload a static image in the theme backend or enable the slider. You can find help in the documentation.', $this->settings->getPrefix());
                }
                
            }
            
        }else 
        {
            // slider is on. lets get it!
            $slider_set = $this->settings->get('bebel_slide_set');

            if ($slider_set){
                $this->sliderId = $slider_set;
            }
            
            
        }
        
        $this->prepareHtml();
    }
    
    
    public function prepareHtml()
    {
        if($this->hasSlider() || $this->hasImage())
        {
            $html = '';
            if ($this->hasSlider()){
                ob_start();
                putRevSlider($this->sliderId);
                $html .= ob_get_clean();
            } else {
                $html .= '        <img src="'.$this->image.'" alt="'.__('Post Image ', $this->settings->getPrefix())."\">\n";
            }
            
            $this->html = $html;
        }else {
            if($this->post_id)
                {
                    $this->warning = '<div style="padding: 100px">'.__('You have neither set up a featured image, nor uploaded any slider images. Please fix this in your post. Otherwise, use the No Image layout, which does not require any image.', $this->settings->getPrefix()).'</div>';
                }else {
                    $this->warning = '<div style="padding: 100px">'.__('The mainpage slider is currently disabled, but you do not have defined any static image to replace it with. Please upload a static image in the theme backend or enable the slider. You can find help in the documentation.', $this->settings->getPrefix()).'</div>';
                }
        }
    }
    
    
    public function getImagesByPostId()
    {
        $slider_set = BebelUtils::getCustomMeta('slide_set', false, $this->post_id);

        if ($slider_set){
            $this->sliderId = $slider_set;
        }

        //if no slides and post image present
        if(has_post_thumbnail($this->post_id) && !$this->hasSlider())
        {
            // get url
            $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), $this->image_size);
            $this->image = $image_url[0];
        }
        $this->prepareHtml();
    }
    
    public function getHtml()
    {
        if(!$this->html)
        {
            return '<div class="warning">'.$this->warning.'</div>';
        }
        return $this->html;
    }
    
    
    
}