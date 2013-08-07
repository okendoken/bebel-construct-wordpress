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
                    $this->images[] = $image_url;
                }else {
                    $image_url = wp_get_attachment_image_src($image_id, $this->image_size);
                    $this->images[] = $image_url[0];
                    
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
            $slider_set = $this->settings->get('bebel_slider_set');
            
            $query = array(
                'post_type' => $this->settings->getPrefix() . '_slider',
                'posts_per_page' => $this->settings->get('bebel_slider_count'),
                'tax_query' => array(
                    array(
                        'taxonomy' => BebelUtils::getTaxonomyFullName('slider'),
                        'field' => 'term_id',
                        'terms' => $slider_set,
                    )
                )
            );
            
            $slides = new WP_Query($query);
            $images = false;
            
            if($slides->have_posts())
            {
                while($slides->have_posts())
                {
                    $slides->the_post();
                    if(has_post_thumbnail())
                    {
                        // prepare images for our next round.
                        
                        $link = wp_get_attachment_image_src(get_post_thumbnail_id(), $this->image_size);
                        $this->images[] = $link[0];

                    }
                }
            }
            
            
        }
        
        $this->prepareHtml();
    }
    
    
    public function prepareHtml()
    {
        if($this->hasImages())
        {
            $html = '';
            if ($this->hasSingleImage()){
                $html .= '        <img src="'.$this->images[0].'" alt="'.__('Post Image ', $this->settings->getPrefix())."\">\n";
            } else {
                $i = 0;
                $html .= "    <div class=\"carousel-inner\">\n";
                $active = ' active';
                foreach($this->images as $image)
                {
                    $i++;

                    $html .= "      <div class='item{$active}'>\n";
                    $html .= '        <img src="'.$image.'" alt="'.__(sprintf('Slider Image %d', $i), $this->settings->getPrefix())."\">\n";
                    $html .= "      </div>\n";
                    $active = '';
                }
                $html .= "    </div>\n";
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
        $j = 0;
        $slider_set = BebelUtils::getCustomMeta('slide_set', false, $this->post_id);

        $query = array(
            'post_type' => $this->settings->getPrefix() . '_slide',
            'tax_query' => array(
                array(
                    'taxonomy' => BebelUtils::getTaxonomyFullName('slide'),
                    'field' => 'id',
                    'terms' => $slider_set,
                )
            )
        );

        $slides = new WP_Query($query);
        $images = false;

        if($slides->have_posts())
        {
            while($slides->have_posts())
            {
                $slides->the_post();
                if(has_post_thumbnail())
                {
                    // prepare images for our next round.

                    $link = wp_get_attachment_image_src(get_post_thumbnail_id(), $this->image_size);
                    $this->images[] = $link[0];

                }
            }
        }
        wp_reset_postdata();

        //if no slides and post image present
        if(has_post_thumbnail($this->post_id) && !$this->hasImages())
        {
            // get url
            $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), $this->image_size);
            $this->images[] = $image_url[0];
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
    
    
    public function refreshImageList($size)
    {
        // in case we have to get other image sizes
        $this->image_size = $size;
        $this->images = array();
        $this->getImages();
    }
    
    
    public function getArray()
    {
        return $this->images;
    }
    
    
    
    
}