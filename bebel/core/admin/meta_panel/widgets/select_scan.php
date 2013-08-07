<?php

/*
 * scans a folder
 */

$folder = $widget['options']['folder'];
$scan = scandir($folder);

$elements = count($scan);
$options = array();

$removeExtension = isset($widget['options']['removeExtension']) ? true : false;

for($i=0;$i<$elements;$i++)
{
    if($scan[$i] != '.' && $scan[$i] != '..')
    {
        
        $replace = array('.jpg', '.png', '.gif', '.jpeg');
        
        if($widget['options']['getTitleFromFunction'])
        {
            $title = str_replace($replace, '', strtolower($scan[$i]));
            $title = call_user_func(array($widget['options']['getTitleFromFunction'][0], $widget['options']['getTitleFromFunction'][1]), $title);
            
            // ignore if function told us this is shit.
            if($title !== false)
            {
                if($removeExtension)
                {
                    $value = str_replace($replace, '', strtolower($scan[$i]));
                    $options[$value] = $title;
                }else {
                    $options[$scan[$i]] = $title;
                }
                
            }
            
        }else {
            $title = str_replace($replace, '', strtolower($scan[$i]));
            if($removeExtension)
            {
                $value = str_replace($replace, '', strtolower($scan[$i]));
            }else {
                $value = $scan[$i];
            }
            $options[$value] = ucfirst($title);
        }
    }
    
}

if($this->getOption($key) == '' && $widget['defaultSettingName'] != '')
{
    // get option from setting
    $value = $this->settings->get($widget['defaultSettingName']).".png";
}else {
    $value = $this->getOption($key);
}


?>

<div class="widget_title">
  <h4><?php echo $widget['title'] ?></h4>
</div>

<div class="widget_widget">
  <select name="<?php echo $this->settings->getPrefix().'_'.$key ?>">
    <?php echo BebelUtils::createListByOptions($value, $options); ?>
  </select>
  <p class="help"><?php echo $widget['description']?></p>
</div>


<div class="clear" > </div>

