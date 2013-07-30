<?php

/*
 * scans a folder
 */

$folder = $widget['options']['folder'];
$scan = scandir($folder);

$elements = count($scan);
$options = array();


for($q=0;$q<$elements;$q++)
{
    if($scan[$q] != '.' && $scan[$q] != '..')
    {
        
        $replace = array('.jpg', '.png', '.gif', '.jpeg');
        
        if($widget['options']['getTitleFromFunction'])
        {
            $title = str_replace($replace, '', strtolower($scan[$q]));
            $title = call_user_func(array($widget['options']['getTitleFromFunction'][0], $widget['options']['getTitleFromFunction'][1]), $title);
            
            // ignore if function told us this is shit.
            if($title !== false)
            {
                if($widget['options']['getTitleFromFunction'])
                {
                    $value = str_replace($replace, '', strtolower($scan[$q]));
                    $options[$value] = $title;
                }else {
                    $options[$scan[$q]] = $title;
                }
                
            }
            
        }else {
            $title = str_replace($replace, '', strtolower($scan[$q]));
            if($widget['options']['getTitleFromFunction'])
            {
                $value = str_replace($replace, '', strtolower($scan[$q]));
                
            }else {
                $value = $scan[$q];
            }
            $options[$value] = ucfirst($title);
        }
    }
    
}



?>

<div class="grid_4 push_1 alpha">
  <h4><?php echo $widget['title'] ?></h4>
</div>

<div class="grid_15 omega">
  <div class="widget">
    <select name="<?php echo $this->settings->getPrefix() ?>-settings[<?php echo $key ?>]">
        <?php echo BebelUtils::createListByOptions($this->settings->get($key), $options); ?>
    </select>
    <p class="help"><?php echo $widget['description']?></p>
  </div>
</div>


<br class="clear" />
