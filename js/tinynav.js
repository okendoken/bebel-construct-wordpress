/*! http://tinynav.viljamis.com v1.1 by @viljamis */
(function (jQuery, window, i) {
  jQuery.fn.tinyNav = function (options) {

    // Default settings
    var settings = jQuery.extend({
      'active' : 'selected', // String: Set the "active" class
      'header' : '', // String: Specify text for "header" and show header instead of the active item
      'label'  : '' // String: sets the <label> text for the <select> (if not set, no label will be added)
    }, options);

    return this.each(function () {

      // Used for namespacing
      i++;

      var $nav = jQuery(this),
        // Namespacing
        namespace = 'tinynav',
        namespace_i = namespace + i,
        l_namespace_i = '.l_' + namespace_i,
        $select = jQuery('<select/>').attr("id", namespace_i).addClass(namespace + ' ' + namespace_i);

      if ($nav.is('ul,ol')) {

        if (settings.header !== '') {
          $select.append(
            jQuery('<option/>').text(settings.header)
          );
        }

        // Build options
        var options = '';

        $nav
          .addClass('l_' + namespace_i)
          .find('a')
          .each(function () {
            var durl = document.URL
            if (durl == jQuery(this).attr('href')) {
              options += '<option value="' + jQuery(this).attr('href') + '" selected="selected">';
            }else {
              options += '<option value="' + jQuery(this).attr('href') + '">';
            };
            var j;
            for (j = 0; j < jQuery(this).parents('ul, ol').length - 1; j++) {
              options += '- ';
            }
            options += jQuery(this).text() + '</option>';
          });

        // Append options into a select
        $select.append(options);

        // Change window location
        $select.change(function () {
          window.location.href = jQuery(this).val();
        });

        // Inject select
        jQuery(l_namespace_i).after($select);

        // Inject label
        if (settings.label) {
          $select.before(
            jQuery("<label/>")
              .attr("for", namespace_i)
              .addClass(namespace + '_label ' + namespace_i + '_label')
              .append(settings.label)
          );
        }

      }

    });

  };
})(jQuery, this, 0);
