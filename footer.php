<?php 
	if (is_home() or is_page_template('team.php') or is_page_template('clients.php')){
		$socialmargin = '';
	}else{
		$socialmargin = ' class="social-margin"';
	}
?>
	<!-- Social Network -->
	<div id="social"<?php echo $socialmargin; ?>>
		<!-- Latest Twitts -->
		<?php if (CircleLaw_option('twitter-user-latest') != ""): ?>
		<ul class="latest-twitts"></ul>
		<?php endif ?>
		<!-- Social Icons -->
		<div class="social">
			<?php if (CircleLaw_option('social-network-tw') != ""): ?>
			<a href="<?php echo CircleLaw_option('social-network-tw') ?>" target="_blank" alt="Twitter" title="Twitter" class="tw"></a>
			<?php endif ?>
			<?php if (CircleLaw_option('social-network-fc') != ""): ?>
			<a href="<?php echo CircleLaw_option('social-network-fc') ?>" target="_blank" alt="Facebook" title="Facebook" class="fc"></a>
			<?php endif ?>
			<?php if (CircleLaw_option('social-network-in') != ""): ?>
			<a href="<?php echo CircleLaw_option('social-network-in') ?>" target="_blank" alt="Linkedin" title="Linkedin" class="in"></a>
			<?php endif ?>
			<?php if (CircleLaw_option('social-network-google') != ""): ?>
			<a href="<?php echo CircleLaw_option('social-network-google') ?>" target="_blank" alt="Google" title="Google" class="go"></a>
			<?php endif ?>
		</div>
		<!-- Social Icons -->
	<div class="clear"></div>
	</div>
	<!-- Social Network -->

  </div><!--End Main Content-->
  <div class="clear"></div>
<!-- end .container --></div>

<!--BackGround Slider-->
<?php $getbgslide = CircleLaw_option('background-sLider'); if (is_array($getbgslide)): ?>
<div id="slideshow">
	<?php if (count($getbgslide) > 1):  $i = 0; foreach ($getbgslide as $bgslide): $i++; ?>
	    <img src="<?php print $bgslide; ?>"<?php if ($i==1) print ' class="active"'; ?> />
	<?php endforeach; else: ?>
	    <img src="<?php print $getbgslide['0']; ?>" class="active" />
	    <img src="<?php print $getbgslide['0']; ?>" />
	<?php endif; ?>
</div><?php endif; ?><!--End BackGround Slider-->
<?php
wp_footer();
?>
</body>
</html>