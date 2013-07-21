<?php
ob_start();
session_start();
require_once('../../../wp-load.php');


// Single Gallery
if (isset($_POST['page'] )){

        $custom = get_post_custom($_POST['postid']);
        $kgallery = unserialize( $custom["kboxgallery"][0] );
        $kgallery = array_reverse($kgallery);
        if (get_post_meta($_POST['postid'], 'gallery_layout', true) == "gallery_layout_random"){
          $per = 6;
        }else{
          $per = 8;
        }
        $pages = ceil(count($kgallery)/$per);

          $pageid = ($_POST['page']*$per)-$per;

        $start = $pageid;
        $end = $start + $per;
        $i = 0;
        foreach ($kgallery as $key => $item):
          if ($key >= $start & $key < $end):
            $i++;
            switch ($i) {
              case '1':
                $style_number = "one";
                $style_w = 255;
                $style_h = 295;
                break;
              case '2':
                $style_number = "two";
                $style_w = 255;
                $style_h = 220;
                break;
              case '3':
                $style_number = "three";
                $style_w = 385;
                $style_h = 220;
                break;
              case '4':
                $style_number = "four";
                $style_w = 255;
                $style_h = 220;
                break;
              case '5':
                $style_number = "five";
                $style_w = 385;
                $style_h = 295;
                break;
              case '6':
                $style_number = "six";
                $style_w = 255;
                $style_h = 295;
                break;
            }
        ?>
          <!--Post-->
          <?php if (get_post_meta($_POST['postid'], 'gallery_layout', true) == "gallery_layout_random"): ?>
            <div class="post v-<?php echo $style_number; ?>">
                <img src="<?php img_resize($item,$style_w,$style_h) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>">
                <div class="thumb-hover">
                    <a href="<?php echo $item ?>" rel="prettyPhoto[gallery]"></a>
                </div>  
            </div>
          <?php else: ?>
            <div class="post v-squres">
                <img src="<?php img_resize($item,220,220) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>">
                <div class="thumb-hover">
                    <a href="<?php echo $item ?>" rel="prettyPhoto[gallery]"></a>
                </div>  
            </div>
          <?php endif ?>
          <!--Post-->
        <?php endif; endforeach;
  die();
}
// Single Gallery


$date = time();
if($_POST['do'] == 'submit_contact')

{
	$blogname = get_option('blogname');
	$admin_emails = CircleLaw_option('contact-page-mail');
	$full_name =  $_POST[name];
	$email = $_POST[email];
	$phone =  $_POST[phone];
	$note =  $_POST[message] ? nl2br($_POST[message]) : __( 'No Message', 'CircleLaw' );
	$subject =  $phone.' | '.__( 'Message From Site', 'CircleLaw' ).' '.$blogname;
	$text = '
	<div class="ajax-1">
		<br />
		<br />
		<div class="ajax-2">
			'.__( 'Message From Site', 'CircleLaw' ).' '.$blogname.'
			<br />
			<br />
			<br /><b>'.__( 'Name', 'CircleLaw' ).' :</b> ' . $full_name . ' 
			<br /><br /><b>'.__( 'E-mail', 'CircleLaw' ).' :</b> ' . $email . '
			<br /><br /><b>'.__( 'Subject', 'CircleLaw' ).' :</b> ' . $phone . '
			<br /><br /><b>'.__( 'Nessage', 'CircleLaw' ).' :</b> ' . $note . '
		</div>
		<br /><br />
	</div>';
	// ---------------------------
	$headers = "From: ".$email."" . "\n" ;
	$headers .= 'MIME-Version: 1.0' . "\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\n";
	// ---------------------------
	mail($admin_emails, $subject, $text, $headers) ;
	echo '<script language="javascript" type="text/javascript">window.top.window.send_contact_done();</script>';
	exit;
}

?>

