<?php
get_header();

$page_layout = BebelUtils::getCustomMeta('page_layout', false, get_the_ID());

if(!$page_layout) {
    $page_layout = "with-image";
}

$settings = BebelSingleton::getInstance('BebelSettings');

$team_page = $settings->get('team_overview_page');
$clients_page = $settings->get('clients_page');
$contact_page = $settings->get('contact_page');
$blog_page = $settings->get('blog_overview_page');
$portfolio_page = $settings->get('portfolio_overview_page');
$home_page = $settings->get('home_page');
$with_offset = false;
if(get_the_ID() == $team_page) {
    $slug = 'team-'.$page_layout;
    $with_offset = $page_layout != 'no-image';
} elseif(get_the_ID() == $clients_page){
    $slug = 'clients-'.$page_layout;
    $with_offset = $page_layout != 'no-image';
} elseif(get_the_ID() == $contact_page){
    $slug = 'contact-'.$page_layout;
    $with_offset = $page_layout != 'no-image';
} elseif(get_the_ID() == $blog_page){
    $slug = 'blog-'.$page_layout;
    $with_offset = $page_layout != 'no-image';
} elseif(get_the_ID() == $portfolio_page){
    $slug = 'portfolio-'.$page_layout;
    $with_offset = $page_layout != 'no-image';
} elseif(get_the_ID() == $home_page){
    $slug = 'home';
} else {
    $slug =  "page-".$page_layout;
    $with_offset = $page_layout != 'no-image';
}
?>
    <!--Start Header-->
    <header>
        <?php bebelThemeUtils::getLogoTemplate(false, $with_offset); ?>
    </header><!--End Header-->
    <!--Start Main Content-->
<div class="content">
<?php

// custom css for this page
$css = BebelUtils::getCustomMeta('css', false, get_the_ID());

?>
<?php if($css): ?>
    <style>
        <?php echo $css; ?>
    </style>
<?php endif; ?>

<?php
get_template_part( 'templates/'.$slug, get_post_format() );
if(get_the_ID() != $home_page){
    bebelThemeUtils::getLogoTemplate(true);
}
get_footer();