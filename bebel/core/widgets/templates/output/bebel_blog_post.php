<?php
if($posts->have_posts())
{
  while($posts->have_posts())
  {
    $posts->the_post();
    the_title();
  }
}