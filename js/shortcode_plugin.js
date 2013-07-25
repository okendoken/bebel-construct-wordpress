/* Adapted from http://brettterpstra.com/adding-a-tinymce-button/ */



(function() {

    tinymce.create('tinymce.plugins.flShortcodes', {

        init : function(ed, url) {

            ed.addButton('flshortcodes', {

                title : 'Shortcodes',

                image : url+'/shortcode.png',

                onclick : function() {

                    ed.windowManager.open({

                        file : url + '/tinymce_shortcodes.php',

                        width : 340,

                        height : 120,

                        inline : 1

                    });

                }



            });

        },

        createControl : function(n, cm) {

            return null;

        },

        getInfo : function() {

            return {

                longname : "Shortcodes",

                author : 'd7',

                version : "1.0"

            };

        }

    });

    tinymce.PluginManager.add('flshortcodes', tinymce.plugins.flShortcodes);

})();