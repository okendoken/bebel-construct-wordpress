/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


(function($) {
   
   $.fn.bebelTouchSlider = function(options)
   {
       
       var defaults = {
           
           'startWith': 0,
           'transitionSpeed': 700,
           'transitionDelay': 3000,
           'autoRotate': true,
           'hoverControls': false,
           'enableSwipe': true
       
       };
       
       this.each(function()
       {
           if(options)
           {
               $.extend(defaults, options);
           }
           
           
           $container = $(this);
           
           // save all images in one object
           var BebelSlider = function()
           {
               
               this.images = $container.find('.wrapper li');
               this.imageCount = this.images.length-1;
               this.buttonNext = $container.find('.nav .next');
               this.buttonPrev = $container.find('.nav .prev');
               
               
               // get the current location of the slider
               this.getCurrentSlide = function()
               {
                   return this.images.filter('.current').index();
               };
               
               // go to a specific slide
               this.goTo = function(index)
               {
                   this.images.removeClass('current')
                              .fadeOut(defaults.transitionSpeed)
                              .eq(index)
                              .fadeIn(defaults.transitionSpeed)
                              .addClass('current');
               };
               
               // go to the next slide
               this.next = function()
               {
                   var index = this.getCurrentSlide();
                   if(index < this.imageCount)
                   {
                       this.goTo(index + 1);
                   }else {
                       this.goTo(0); // go to first
                   }
               };
               
               // go to the previous slide
               this.prev = function()
               {
                   var index = this.getCurrentSlide();
                   if(index > 0)
                   {
                       this.goTo(index - 1);
                   }else {
                       this.goTo(this.imageCount); // go to last
                   }
               };
              
               // initializing the slider
               this.initSlider = function()
               {
                   this.images.hide()
                              .first()
                              .addClass('current')
                              .show();
               };
	               
               
           };// end slider object that holds all the images
           
           
           var slider = new BebelSlider();
           slider.initSlider();
           
           $container.hover(function()
           {
               
           });
           
           // clicking on the next button
           slider.buttonNext.click(function(e)
           {
               e.preventDefault();
               slider.next();
           });
           
           // clicking on the prev button
           slider.buttonPrev.click(function(e)
           {
               e.preventDefault();
               slider.prev();
           });
           
           
           // auto rotate
           
           if(defaults.autoRotate === true)
           {

				var timer = function(){
						slider.next();
				};
				var interval = setInterval(timer, defaults.transitionDelay);
	
				// Pause when hovering image
				$container.hover(function(){clearInterval(interval);}, function(){interval=setInterval(timer, defaults.transitionDelay);});

				// Reset timer when clicking thumbnail or bullet
				//slider.thumbs.click(function(){clearInterval(interval);interval=setInterval(timer, defaults.transitionDelay);});
				//slider.bullets.click(function(){clearInterval(interval);interval=setInterval(timer, defaults.transitionDelay);});	
		
			
           }
           
           if(defaults.enableSwipe === true)
           {
               
                var swipeOptions = {
                    swipe:function(event, direction)
                    {
                        if (direction == "left") {
                            slider.next();
                        }
                        else if (direction == "right") {
                            slider.prev();
                        }
                    },
                    threshold: 70
                }

                $(function()
                {			
                    //Enable swiping...
                    $container.swipe(swipeOptions);
                    

                });

                //Swipe handlers.
                //The only arg passed is the original touch event object			
                
           }
           
           
           
       });
       
   };
   
   
})(jQuery);
