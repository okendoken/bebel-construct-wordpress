<div id="bebel_admin_panel_tabs-2" class="grid_24" style="display: none;">
  <input type="submit" name="submit" class="button-primary" style="float: right; margin-bottom: 15px;" value="<?php _e('Save your changes!', $this->settings->getPrefix()) ?>" />
  <table class="sidebars_table">
    <thead>
      <tr>
        <th><?php _e('Sidebar #', $this->settings->getPrefix()) ?></th>
        <th><?php _e('Sidebar Name', $this->settings->getPrefix()) ?></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
  <?php

  // show all existing sidebars

  
  $i = 0;
  foreach($sidebars['sidebars'] as $sidebar => $settings):
    $i++;
  ?>
    <tr>
      <td>#<?php echo $i; ?></td>
      <td><input <?php echo ($settings['can_delete'] == 'false') ? 'readonly="readonly"' : '' ?>  type="text" name="sidebar[<?php echo $sidebar ?>]" value="<?php echo $settings['title']; ?>" /></td>
      <td>
        <?php if($settings['can_delete'] == 'true'): ?>
        <a href="admin.php?page=bebelSidebars&delete=<?php echo $sidebar; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/bebelCp2/core/assets/images/icons/delete_16.png" alt="delete" /></a>
        <?php endif; ?>
      </td>
    </tr>
  <?php
  
  endforeach;
  ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3">
          <a style="float: right;" href="#" id="new-sidebar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/bebelCp2/core/assets/images/icons/add_32.png" alt="delete" /></a>
        </td>
      </tr>
    </tfoot>
  </table>

  <div id="dialog-form" title="Create new Sidebar" style="display: none; ">
	<p class="validateTips">All form fields are required.</p>

	<form>
	<fieldset>
		<label for="title">Sidebar Title</label>
		<input type="text" name="title" id="title" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>

  <script type="text/javascript">
    jQuery(function() {
      

		var title = jQuery( "#title" ),
			allFields = jQuery( [] ).add( name ),
			tips = jQuery( ".validateTips" ),
      i = <?php echo $i; ?>;

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}

		jQuery( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 200,
			width: 350,
			modal: true,
			buttons: {
				"Create sidebar": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );

					bValid = bValid && checkLength( title, "title", 3, 50 );

					bValid = bValid && checkRegexp( title, /^[a-z]([0-9a-z_])+/i, "The sidebar's name may consist of a-z, 0-9, underscores, begin with a letter." );
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
					
					if ( bValid ) {
            i++;
						jQuery( ".sidebars_table tbody" ).append( '<tr>' +
							"<td>#" + i + "</td>" +
							'<td><input type="text" value="' + title.val() + '" name="sidebar[]" /></td>' +
              '<td><a href="#" class="delete_row"><img src="<?php echo get_stylesheet_directory_uri(); ?>/bebelCp2/core/assets/images/icons/delete_16.png" alt="delete" /></a></td>' +
						"</tr>" );
						jQuery( this ).dialog( "close" );
					}
				},
				Cancel: function() {
					jQuery( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		jQuery( "#new-sidebar" )
			.click(function() {
				jQuery( "#dialog-form" ).dialog( "open" );
			});

		jQuery( ".delete_row" )
			.live('click',function() {
				jQuery(this).parent().parent().remove();
			});
	});
  </script>

</div>
