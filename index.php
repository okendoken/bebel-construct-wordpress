<?php

get_header();
get_template_part( 'templates/_navigation', get_post_format() );
get_template_part( 'templates/_carousel', get_post_format() );
get_footer();

?>