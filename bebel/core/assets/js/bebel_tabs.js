/**
	Please note:
	This script was written by bebel.
	If you want to use it in your projects, please ask for permission. You can contact us through http://blog.thebebel.com

	This script is an easy to use tabs script without the overhead due by jquery.ui. see default options to know how to use it.

*/
(function($) {
	$.fn.btabs = function(options) {

		var
			tabBox = $(this),
			defaults = {
				'count': 3,
				'active': 1,
				'effect': 'slide',
				'effectTime': 1000,
                'autoSlide' : false,
                'autoSlideTime': 4000,
                'autoSlideStartTab': 1,
				'debug': false, //if you want to debug your output, set to true or activate via options
				'linkActiveStateClass': 'active', //without dot. (not ".active", but "active")
				'tabWrapperClass': '.tabWrapper',
                'tabNavigationClass' : 'bebel-tab-nav'
			},
			settings = $.extend({}, defaults, options),
			a = $('#'+tabBox.attr('id')+' .'+settings.tabNavigationClass).children().find('a');


		//get and count the links, so we know how many tabs we have to loop.
		var countTabs = a.length;

		if(countTabs != settings.count && settings.debug === true) {
			alert('You told me there were '+settings.count+' Tabs, but I found '+countTabs);
		}


		//only display the first tab, if not already done with css.

		toggleTabs('#'+tabBox.attr('id')+"-"+1);

		//remove unwanted css class
		initCss();

		//define what happens on click
		a.click(function() {
			//on click, activate the desired tab and hide every other tab.
			toggleTabs($(this).attr('href'), settings.effect);
			//now activate settings.linkActiveStateClass class
			$(this).addClass(settings.linkActiveStateClass);
      stop_rotating = true;


			return false;
		});

    //settings.autoslide is enabled, scroll automatically every settings.autoslideTime seconds
    if(settings.autoSlide) {
        var stop_rotating = false;
        startTab = settings.autoSlideStartTab;
        //check id
        if(countTabs < startTab) {
            alert('You cannot start with a tab that does not exist! You have declared '+ countTabs +'tabs, but you tried to start with '+startTab+'.');
        }else {
            //大丈夫だった
            var scrolled = startTab+1;
            moveToNext = $.doTimeout(settings.autoSlideTime, function() {
               if(!stop_rotating) {
                   toggleTabs('#'+tabBox.attr('id')+"-"+scrolled, settings.effect);
                   $('a[href$="#'+tabBox.attr('id')+'-'+scrolled+'"]').addClass(settings.linkActiveStateClass);
                   if(scrolled < countTabs){
                       scrolled = scrolled + 1;
                   }else {
                       scrolled = 1;
                   }
                   return true;
               }
            });
            return false;
        }

    }


		function toggleTabs(tab, effect) {
			// toggle display, hide all tabs except the one we want to display.
			for(var i=1;i<=countTabs;i++) {

				switch(effect) {
					case 'slide':
						(tab == '#'+tabBox.attr('id')+"-"+i) ?
							$('#'+tabBox.attr('id')+"-"+i).stop(true, true).slideDown(settings.effectTime) :
							$('#'+tabBox.attr('id')+"-"+i).stop(true, true).slideUp(settings.effectTime);
						break;
					case 'fade':
						(tab == '#'+tabBox.attr('id')+"-"+i) ?
							$('#'+tabBox.attr('id')+"-"+i).stop(true, true).fadeIn(settings.effectTime) :
							$('#'+tabBox.attr('id')+"-"+i).hide();
						break;
					default:

						(tab == '#'+tabBox.attr('id')+"-"+i) ?
							$('#'+tabBox.attr('id')+"-"+i).show() :
							$('#'+tabBox.attr('id')+"-"+i).hide();
						break;
				}
			}
			//remove active state class.

			a.each(function() {
				$(this).removeClass(settings.linkActiveStateClass)
			});

		}

		function initCss() {
			//remove overflow
			$(settings.tabWrapperClass).css('overflow-y', 'none');
			//set position to absolute for nicer fading effect.
			if(settings.effect == 'fade') {
				for(var i=1;i<=countTabs;i++) {
					//$('#'+tabBox.attr('id')+"-"+i).css('position', 'absolute');
				}
			}
			//activate first tab navigation element
			a.first().addClass(settings.linkActiveStateClass);

		}

	}

})(jQuery);

