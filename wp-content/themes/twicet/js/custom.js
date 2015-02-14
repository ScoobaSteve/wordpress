jQuery.noConflict();

jQuery(document).ready(function()
{
var autoslide = jQuery("meta[name=twicet1]").attr('content');
var autoslide_dur = jQuery("meta[name=twicet2]").attr('content');
		
whichlightbox();// activates the lightbox used at the portfolio page
k_menu(); //improves the css dropdown menu with animation and ie6 compatibility
k_fader(".preview_images a",".featured_item"); // this is the mainpages fading script-> when a image is clicked a fadeout followed by a fade in occurs
k_pointer(); // this script manages the pointer below the preview pics
if (autoslide == "1"){
if (autoslide_dur != ""){$duration = autoslide_dur}else{$duration = 7000;}
k_autoslide(".preview_images a",$duration); // this script starts the automatic slideshow, number represents the time between the transition in milliseconds
}
k_newsticker(".ticker span",7000); // starts the newsticker, number defines the time between transitions in milliseconds
k_next_slide(".preview_images a",".featured_item",".show-next"); // shows the next slide
k_form(); // initializes ajax sending of the contact form

twicet_improvements(); // adds some improvements to the site
});

function whichlightbox()
{
	var whichtheme = jQuery("meta[name=twicet4]").attr('content');
	
	if(whichtheme == 1 || whichtheme == 3 )
	{
	jQuery("a[rel^='prettyPhoto'], a[rel^='lightbox[portfolio]']").prettyPhoto({
										theme: 'light_rounded' /* light_rounded / dark_rounded / light_square / dark_square */																		   }); 
	}
	else
	{
	jQuery("a[rel^='prettyPhoto'], a[rel^='lightbox[portfolio]']").prettyPhoto({
										theme: 'dark_rounded' /* light_rounded / dark_rounded / light_square / dark_square */																		   }); 
	}

}


function k_menu()
{
		jQuery("#nav a").removeAttr('title');
		jQuery("#nav ul").css({display: "none"}); // Opera Fix
		
		jQuery(" #nav li").hover(function()
		{
			jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).slideDown(400,"easeInOutQuart");
		}
		,function()
		{
			jQuery(this).find('ul:first').css({visibility: "hidden"});
		});
		
}


function k_next_slide($items_to_click, $items_to_fade,$next)
{
	$items = jQuery($items_to_fade);
	$click_these_items = jQuery($items_to_click);
	var x = 0;
	
	$items.each(function(i)
	{
		jQuery(this).find($next).click(function()
		{
		i+1 < $click_these_items.length ? x = i + 1 : x = 0;	
		$click_these_items.filter(":eq("+x+")").trigger('click');
		return false;
		});
	});
}


function k_newsticker($items_to_fade, $display_time)
{
	var $user_display_time = jQuery("meta[name=twicet5]").attr('content');
	
	if($user_display_time != "")
	{
		$display_time = $user_display_time;
	}
	
	tickerchange = setInterval(k_start_ticker, $display_time);
	var $tickeritem = jQuery($items_to_fade);
	var i = 1;
	
	function k_start_ticker()
	{
	$tickeritem.filter(":eq("+i+")").trigger('fade');
	i+1 < $tickeritem.length ? i++ : i = 0;	
	}
	
	  $tickeritem.each(function(i)
	  {
		  jQuery(this).bind("fade",function()
		  {	
			  $new_ticker_item = $tickeritem.filter(":eq("+i+")");
			  
			  if( $new_ticker_item.css("display") == "none" )
			  {
				  $tickeritem.filter(":visible").fadeOut(400, function()
				  {	
					  $new_ticker_item.fadeIn(400);
				  });
			  }
			  
		  });
	  });
}


function k_autoslide($items_to_click, $display_time)
{	
	interval = setInterval(k_start_autoplay, $display_time);
	var $click_these_items = jQuery($items_to_click);
	var i = 1;
	
	$click_these_items.click(function($eventobject, $autoplay)
	{
		if(interval && !$autoplay) clearInterval(interval);
	});
	
	
	function k_start_autoplay()
	{	
		
		$click_these_items.filter(":eq("+i+")").trigger('click',[true]);
		i+1 < $click_these_items.length ? i++ : i = 0;
		
	}
	
}


function k_fader($items_to_click, $items_to_fade)
{	
	var $item = jQuery($items_to_fade);
	
	jQuery($items_to_click).each(function(i)
	{
		jQuery(this).click(function()
		{	
			$new_item = $item.filter(":eq("+i+")");
			
			if( $new_item.css("display") == "none" )
			{
				$item.filter(":visible").fadeOut(400, function()
				{	
					$new_item.fadeIn(400);
				});
			}
			
			return false;
			
		});
		
	});
	
}

function k_pointer()
{	
	var $wrapper = jQuery(".preview_images");
	var $slider = jQuery('<div class="pointer"></div>').appendTo($wrapper);
	
	var $slider_half = $slider.width()/2;
	jQuery(".preview_images a").each(function(i)
	{
		jQuery(this).click(function()
		{	
			jQuery(".current_prev").removeClass('current_prev');
			jQuery(this).addClass('current_prev');
			
			$image_pos = jQuery(this).position();
			$newposition = $image_pos.left + jQuery(this).width()/2 - $slider_half;
			$slider.animate({"left":$newposition},600,"easeOutBack");
		});
		
	});
	
}



function k_form(){
	if(!(jQuery.browser.msie && parseInt(jQuery.browser.version) < 7)) // ajax contact form disabled in ie6, it does work but ie6 shifts layout on error :P
	{
	var template_url = jQuery("meta[name=twicet3]").attr('content');
	var my_error;
	jQuery(".ajax_form #send").bind("click", function(){
											 
	my_error = false;
	jQuery(".ajax_form #name, .ajax_form #message, .ajax_form #email ").each(function(i){
				
				

				
				
				var value = jQuery(this).attr("value");
				var check_for = jQuery(this).attr("id");
				var surrounding_element = jQuery(this).parent();
				if(check_for == "email"){
					if(!value.match(/^\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$/)){
						
						surrounding_element.attr("class","").addClass("error");
						
						my_error = true;
						}else{
						surrounding_element.attr("class","").addClass("valid");	
						}
					}
				
				if(check_for == "name" || check_for == "message"){
					if(value == ""){
						
						surrounding_element.attr("class","").addClass("error");
						
						my_error = true;
						}else{
						surrounding_element.attr("class","").addClass("valid");	
						}
					}
						   if(jQuery(".ajax_form #name, .ajax_form #message, .ajax_form #email").length  == i+1){
								if(my_error == false){
									jQuery(".ajax_form").slideUp(400);
									
									var $datastring = "ajax=true";
									jQuery(".ajax_form input, .ajax_form textarea").each(function(i)
									{
										var $name = jQuery(this).attr('name');	
										var $value = jQuery(this).attr('value');
										$datastring = $datastring + "&" + $name + "=" + $value;
									});
																		
									
									jQuery(".ajax_form #send").fadeOut(100);	
									
									jQuery.ajax({
									   type: "POST",
									   url: template_url+"/send.php",
									   data: $datastring,
									   success: function(response){
									   jQuery(".ajax_form").before("<div class='ajaxresponse' style='display: none;'></div>");
									   jQuery(".ajaxresponse").html(response).slideDown(400); 
									   jQuery(".ajax_form #send").fadeIn(400);
									   jQuery(".ajax_form #name, .ajax_form #message, .ajax_form #email , .ajax_form #website").val("");
										   }
										});
									} 
							}
					});
			return false;
	});
}

}


function twicet_improvements()
{
	jQuery(".featured_item").prepend("<div class='corner_left ie6fix'></div><div class='corner_right ie6fix'></div>");
	
	if((jQuery.browser.msie && parseInt(jQuery.browser.version) < 7))
	{
		jQuery("#nav, .navwrap, #main, #featured, #featured_bottom, .content_top, #content, #footer").addClass("ie6fix");
	}
}










/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 0.6;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 0.6;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */
