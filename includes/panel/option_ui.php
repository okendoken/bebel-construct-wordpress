<?php
	global $blocks , $sections , $fields , $break , $theme_name , $theme_name_prefix;
	if( get_option('koption') ){
		$get_options = get_option('koption');
		$get_option = $get_options['koption'];
	}
?>




<div class="wrap">
<div id="admin-panel">   

	<div id="panel-tabs">
		<div id="panel-logo">
			Bebel
		</div><!--end of panel header-->
		<ul>
			<?php foreach ($blocks as $block): ?>
			<li class="<?php echo $block['id']; ?>" style="">
				<a href="#<?php echo $block['id']; ?>"><span></span><?php echo $block['name']; ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div><!--end of panel tabs-->


	<div id="admin-panel-content">

		<div id="saved"></div>

		<div class="clear"></div>

		<form method="post" id="kadoo_form">


		<input name="save" type="submit" value="<?php _e('Save', 'CircleLaw') ?>" id="bottop" />
		<input type="hidden" name="action" value="doanha_save_theme_data_ajax" />
		<input type="hidden" name="security" value="<?php echo wp_create_nonce('doanha_theme_nonce'); ?>" />

		<?php foreach ($blocks as $block): ?>

		<div class="block" id="<?php echo $block['id']; ?>">

		<h2 class="block_title"><?php echo $block['name']; ?></h2>

		<div class="block-content">
		
	    <?php foreach ($sections as $section): if ($section['block_id'] == $block['id']): ?>

		<?php 
		switch ( $section['type'] ) :
		case "normal": 
		?>

			<h2 class="section_title"><?php echo $section['name']; ?></h2>
			
			<section id="<?php echo $section['id']; ?>">
			
			<div class="section-content">

				<?php foreach ($fields as $field): if ($field['section_id'] == $section['id']): ?>

					<div class="field_row <?php echo $type; ?>">

					<?php
						if (!isset($field['note'])) {
							$field['note'] = "";
						}
						if (!isset($field['std'])) {
							$field['std'] = "";
						}
						$id = $field['id'];
						$std = $field['std'];
						$type = 't'.$field['type'];
						$label = $field['label'];
						$name = "koption[".$id."]";
						$value = $get_option[$id];
						//($std == "")? $std = "false" : $std = "true";
						//($value == "")? $value = $std : $value = $get_option[$id];
						$note = $field['note'];
					?>

						
					<?php switch ( $field['type'] ) : case "text": 	?>
						<label class="field-title"  for="<?php echo $id; ?>"><?php echo $label; ?></label>
						<input class="widefat" type="text" name="<?php echo $name; ?>" id="<?php echo $id; ?>"
						value="<?php echo $value; ?>" />
						<div class="clear"></div>
						<?php if (!empty($field['note'])){ ?><div class="note"><?php echo $field['note']; ?></div><?php } ?>
					<?php break; ?>


									
					
					
					<?php case "textarea": ?>
						<label class="field-title"  for="<?php echo $id; ?>"><?php echo $label; ?></label>
						<textarea type="text" name="<?php echo $name; ?>" id="<?php echo $id;?>"><?php echo $value; ?></textarea>
						<div class="clear"></div>
						<?php if (!empty($field['note'])){ ?><div class="note"><?php echo $field['note']; ?></div><?php } ?>
					<?php break; ?>



					
					<?php case "editor": ?>
					<label class="field-title"  for="<?php echo $field['id']; ?>"><?php echo $field['label']; ?></label>
					<div class="clear" style="clear:both;"></div>	
					<?php
					$id = $field['id'];
					$con = stripslashes($get_option[$field['id']]);
					
					$settings = array(
					'textarea_name' => 'koption['.$field['id'].']', 
					'editor_class' => $id,
					'media_buttons' => false,
					'textarea_rows' => 6,
					'teeny' => true,
					'wpautop' => false,
					'quicktags' => true,
					'tinymce' => true,
					'editor_css'	=> '<style>.wp-editor-wrap{width:650px;}</style>'
					);
					wp_editor($con, $id, $settings );
					?>
					
					<div class="clear"></div>
					<?php if (!empty($field['note'])){ ?><div class="note"><?php echo $field['note']; ?></div><?php } ?>
					<?php break; ?>



					<?php 
					case "select": 
					$options = $field['options'];
					?>

					<label class="field-title"  for="<?php echo $id; ?>"><?php echo $label; ?></label>
					<select name="<?php echo $name; ?>" id="<?php echo $id; ?>">
						<?php foreach ($options as $option) { ?>
						<option value="<?php echo $option; ?>" <?php if ( $value == $option) { echo 'selected="selected"'; } ?>>
							<?php echo $option; ?>
						</option>
						<?php } ?>
					</select>
					
					<div class="clear"></div>
					<?php if (!empty($field['note'])){ ?><div class="note"><?php echo $note; ?></div><?php } ?>
					<?php break; ?>
				





					<?php case "checkbox_img": ?>
					<label class="field-title"  for="<?php echo $id; ?>"><?php echo $label; ?></label>
					<div style="width:295px; float:left;">
					<ul class="checkbox_img">
					<?php foreach ($field['options'] as $key => $option) : ?>
					<?php
					$name = "koption[".$field['id'].']['.$key.']';
					$label = $field['id'].$key;
					$value = $get_option[$field['id']];
					$checked = ( $value[$key] == $option ? 'checked="checked"' :  ""); 
					$class = ( $value[$key] == $option ? 'checkbox_img-selected' :  ""); 
					?>
					<li class="ghghgh  <?php echo $class; ?>">
						<input type="checkbox" value="<?php echo $option; ?>" name="<?php echo $name;?>" id="" <?php echo $checked; ?> >
						<span><?php echo $option; ?></span>
					</li>
					<?php endforeach; ?>
					</div>
					<div class="clear"></div>
					<?php if (!empty($field['note'])){ ?><div class="note"><?php echo $note; ?></div><?php } ?>
					<?php break; ?>







					<?php case "radio": ?>
					<label class="field-title"  for="<?php echo $id; ?>"><?php echo $label; ?></label>
					<div style="width:295px; float:left;">
					<ul class="radio-list">
					<?php foreach ($field['options'] as $option) : ?>
					<?php $checked = ( $value == $option ? 'checked="checked"' :  ""); ?>
					<?php $checkedc = ( $value == $option ? 'radio-list-selected' :  ""); ?>

					<li class="singleli-img <?php echo $checkedc; ?>">
						<input type="radio" value="<?php echo $option; ?>" name="<?php echo $name; ?>" id="<?php echo $id; ?>" <?php echo $checked; ?> >
						<span><?php echo $option; ?></span>
					</li>

					<?php endforeach;?>
					</ul>
					</div>
					
					<div class="clear"></div>
					<?php if (!empty($field['note'])){ ?><div class="note"><?php echo $note; ?></div><?php } ?>
					<?php break; ?>





					<?php
					/*
						pattern Or Skin Select
					*/
					?>
					<?php case "radio-img": ?>
					<label class="field-title"  for="<?php echo $id; ?>"><?php echo $label; ?></label>
					<div style="float:left; width:378px;">
					<?php foreach ( $field['options'] as $key => $option ): ?>
					<?php 
					if ( $get_option[$field['id']] == $key ){
						$checked = "checked=\"checked\"";
						$img_slcalss = "radio-img-selected";
					}else{
						$checked = "";
						$img_slcalss = "";
					}
					?>
					<div class="row">
						<div class="radio-img-label"><?php echo $key; ?></div>
						<input type="radio" <?php echo $checked; ?> id="<?php echo $key; ?>" class="radio-img-radio" value="<?php echo $key; ?>" name="<?php echo $name; ?>" />
						<img src="<?php echo $option; ?>" class="radio-img-img <?php echo $img_slcalss; ?>" onclick="document.getElementById('<?php echo $key; ?>').checked=true;" />
					</div>
					<?php endforeach; ?>
					</div>
					
					<div class="clear"></div>
					<?php if (!empty($field['note'])){ ?><div class="note"><?php echo $field['note']; ?></div><?php } ?>
					<?php break; ?>
					

					<?php case "on-of": ?>
					<?php ( $value =="true" ) ? $checkedc = "on-botton": $checkedc = ""; ?>
					<?php if ($value == "") $value = "false"; ?>
					<label class="field-title"  for="<?php echo $id; ?>"><?php echo $label; ?></label>
					<div class="on-off <?php echo $checkedc; ?>">
					<input  type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>"  id="<?php echo $id; ?>"/>
					<span>On-off</span>
					</div>
					<div class="clear"></div>			
					<?php if (!empty($field['note'])){ ?><div class="note"><?php echo $note; ?></div><?php } ?>
					<?php break; ?>



					

					<?php case 'slider': ?>
					<label class="field-title"  for="<?php echo $id; ?>"><?php echo $label; ?></label>
					<div class="uislider">
						<div id="<?php echo $id; ?>-slider"></div>
						<input type="text" id="<?php echo $id; ?>" value="<?php echo $value; ?>" name="<?php echo $name; ?>" style="width:50px;" />
						<?php echo $field['unit']; ?>
					</div>
					<script>
					  jQuery(document).ready(function() {
						jQuery("#<?php echo $field['id']; ?>-slider").slider({
							range: "min",
							min: <?php echo $field['min']; ?>,
							max: <?php echo $field['max']; ?>,
							value: <?php if( $get_option[$field['id']] ) echo $get_option[$field['id']]; else echo 0; ?>,

							slide: function(event, ui) {
							jQuery('#<?php echo $field['id']; ?>').attr('value', ui.value );
							}
						});
					  });
					</script>
					<?php if (!empty($field['note'])){ ?><div class="note"><?php echo $note; ?></div><?php } ?>
					<?php break; ?>



				


					<?php case "colorpicker": ?>
					<label class="field-title"  for="<?php echo $id; ?>"><?php echo $label; ?></label>

					<?php //$default_color = '' ?>
					<div class="colorpicker">
						<input type="text" name="<?php echo $name; ?>" id="<?php echo $id; ?>" value="<?php echo $value; ?>" data-default-color="<?php echo $field['default-color']; ?>" />
					</div>
					<script type="text/javascript">
					jQuery(document).ready(function($){
						//var iddd = "#";
					    $("#<?php echo $id; ?>").wpColorPicker();
					});
					</script>
					<div class="clear"></div>
					<?php if (!empty($field['note'])){ ?><div class="note"><?php echo $note; ?></div><?php } ?>
					<?php break; ?>





				

					<?php case "upload": ?>
					<div class="upload">
						<label class="field-title"  for="<?php echo $id; ?>"><?php echo $label; ?></label>
						<input class="regular-text text-upload" type="text" name="<?php echo $name; ?>" id="<?php echo $id; ?>" value="<?php echo $value; ?>"  />
						<input type='button' class='button button-upload' value='Upload an image'/>
					</div>
					<label class="field-title"  for=""></label>
	        		<img style='display: block;' src='<?php echo esc_url( $value ); ?>' class='preview-upload'/>
					<?php if (!empty($field['note'])){ ?><div class="note"><?php echo $note; ?></div><?php } ?>
					<?php break; ?>




					<?php
					case "mu-upload":
					$photo_id = $get_option[$id];
					?>

					<label class="field-title"  for="<?php echo $id; ?>"><?php echo $label; ?></label>
					<div class="clear" style="height:10px;"></div>
					<div class="multiupload" id="<?php echo $id;?>" >


					<?php if($photo_id): $i = 0; ?>
					
						<?php foreach ($photo_id as $key => $photo) :  $i++; ?>

						<?php if ($i == 1) : ?>

							<div class="upload-r">
								<input class="regular-text text-upload" type="text" name="koption[<?php echo $id ?>][]" value="<?php echo $photo; ?>"  />
								<input type='button' class='button button-upload' value='Upload an image'/>
								<input type='button' class='addnewfield' value='+'/>
							<div class="clear"></div>
							</div>

						<?php else: ?>

							<div class="upload-r">
								<input class="regular-text text-upload" type="text" name="koption[<?php echo $id ?>][]" value="<?php echo $photo; ?>"  />
								<input type='button' class='button button-upload' value='Upload an image'/>
								<input type='button' class='addnewfield' value='+'/>
								<input type='button' class='removefield' value='-'/>
							<div class="clear"></div>
							</div>

						<?php endif;?>

						<?php endforeach; //foreach ($photo_id as $key => $photo) : ?>

					<?php else: //if there if no photos in $photo array?>

						<div class="upload-r">
							<input class="regular-text text-upload" type="text" name="koption[<?php echo $id ?>][]" value="<?php echo $photo; ?>"  />
							<input type='button' class='button button-upload' value='Upload an image'/>
							<input type='button' class='addnewfield' value='+'/>
						<div class="clear"></div>
						</div>

					<?php endif; //if($photo_id): ?>
					</div><!--end of multi upload-->
					<?php break; ?>	





					<?php endswitch; //end field type switch ?>
						
					</div><!--end of field_row-->
						
				<?php endif; endforeach; //foreach ($fields as $field): if ($field['section_id'] == $section['id']): ?>

			</div><!--end of section-content-->
			</section><!--end of section-->

		<?php break; //break section normal type ?>

		<?php case "custom": ?>

			<h2 class="section_title"><?php echo $section['name']; ?></h2>
			<section id="<?php echo $section['id']; ?>">
			
			<div class="section-content">

				<?php  $section['func'](); ?>

			</div><!--end of section-content-->
			</section><!--end of section-->

		<?php break; //break section custom type ?>
		<?php endswitch; //end sectipn type switch ?>


		<?php endif; endforeach; //foreach ($sections as $section): if ($section['block_id'] == $block['id']): ?>
		
		</div><!--end of block-content-->
		</div><!--end of block id-->
		<?php endforeach; //foreach ($blocks as $block): ?>

		<div id="savedd"></div>
		<input name="save" type="submit" value="<?php _e('Save', 'CircleLaw') ?>" id="botbottom" class="bo" />
		</form>
	</div><!--end admin-panel-content -->
	
</div><!--end of admin-panel-->
</div><!--end of wrap class-->