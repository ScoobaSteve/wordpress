jQuery.noConflict();
function kriesi_mainmenu(){
jQuery("#nav a").removeAttr('title');
jQuery(" #nav ul ").css({display: "none"}); // Opera Fix

jQuery(" #nav li").hover(function(){
		jQuery(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).show(400);
		},function(){
		jQuery(this).find('ul:first').css({visibility: "hidden"});
		});
}
function kriesi_noscript(){
    $content =jQuery(".widget_rss h3 a:eq(1)").html();
    jQuery(".widget_rss h3 a").remove();
    jQuery(".widget_rss h3").append($content);
	jQuery("#wrapper").prepend("<div class='ajaxloader'><div class='ajaxloader_content'>preloading content</div></div>")

	}

var no_ajax_yet = true;

function preload_pages(){
	jQuery(".ajaxloader").fadeIn(100);
	no_ajax_yet = false;	
	jQuery('#nav li a').each(function(i){
										if(location.hostname == this.hostname)
										{
										jQuery(this).addClass("preloaded preload_item_"+i);
										jQuery('.content').append("<div class='ajaxbox preloaded_item_"+i+"'></div>");
										var content_to_load = jQuery(this).attr('href').replace(/\/#.+/,"");
											if(!content_to_load.match(/(\/)$/)){
												content_to_load = content_to_load + "/";
												}
											var ie6_content_to_load = content_to_load;
											content_to_load = content_to_load +' .ajaxcontent'; 
											
										if ((jQuery.browser.msie && jQuery.browser.version < 7) && i == 0){
											content_to_load = ie6_content_to_load+"index.php .ajaxcontent"
										}
																				
										jQuery('.preloaded_item_'+i).load(content_to_load, {preload: "true"});
										
										}  
									  });
	
		 jQuery(".ajaxloader").ajaxStop(function(){
   			jQuery(this).fadeOut(400);
			no_ajax_yet = true;
		 });
		 
	}

	
function sleektabs(selector)
{
	jQuery(".current-cat>a, .current_page_item>a").addClass("current-tab");
	jQuery(".current-cat, .current_page_item").removeClass("current-cat").removeClass("current_page_item");
	var startingheight = jQuery(".content_relative").height();
	jQuery('.content').css({height:startingheight});
	jQuery(".content_relative").removeClass("content_relative");
	var install_url = jQuery("meta[name=Sleek_option0]").attr('content');
	
	
	//check if subpage must be loaded
     function loadhash(){ 
	 if(window.location.hash != "" && window.location.hash !="#" && window.location.hash !="#home"){
 
		var content_to_load =install_url + "/"+(window.location.hash).substring(1)+" .ajaxcontent";
          
			jQuery(".ajaxloader").fadeIn(100);
             jQuery('.current_content').html("").load(content_to_load, {preload: "true"},adjustheight);
			 
			 	jQuery(".current-tab").removeClass("current-tab");
				
				 jQuery('a').each(function(){  
					var newhash = jQuery(this).attr('href').replace(install_url, "");
					newhash = newhash.replace(/^\//,"").replace(/\/$/,"").replace(/\/#.+/,"");
					
					
         			if(window.location.hash == "#"+newhash){ 
							jQuery(this).addClass("current-tab");
							}
					 });
				 
         }   
		 function adjustheight(){
				var newheight = jQuery('.current_content').height();
				jQuery('.content').animate({height:newheight},1200,"easeInQuint");
				jQuery(".ajaxloader").fadeOut(400);

				ajaxed_comment();
				 jQuery("a[rel^='prettyPhoto'], a[rel='lightbox']").not('.lightboxed').addClass('lightboxed').prettyPhoto();
				add_it(selector);
				}
		
     }
	
	
	loadhash();
	add_it(selector);
	
function add_it(selector){	
	jQuery(selector).not('.no_ajax').not("[rel^='lightbox']").bind("click",function()
	{	
		var content_to_load = jQuery(this).attr('href').replace(/\/#.+/,"")+' .ajaxcontent'; 

			
		if(location.hostname == this.hostname)
		{
			
			
			if (!jQuery(this).hasClass("preloaded")){
				var i =jQuery(".preloaded").length;
			jQuery(this).addClass("preloaded preload_item_"+i);
			}else{
				var currentclass = jQuery(this).attr("class").match(/preload_item_[\d]+/);
				var i = parseInt(currentclass[0].replace(/preload_item_/g, ""));
			}
			
			
			
			if(no_ajax_yet)
			{
				
				var newhash = jQuery(this).attr('href').replace(install_url, "");
				newhash = newhash.replace(/^\//,"").replace(/\/$/,"").replace(/\/#.+/,"");
			// if ( window.location.hash != "#"+newhash && !jQuery(this).hasClass("current-tab")) // problem with opera, must take worse solution one line bellow
			if (!jQuery(this).hasClass("current-tab"))
			{
			if(newhash == "" && jQuery.browser.safari){newhash = "#home";}else if(newhash == ""){newhash = "#";}//old: if(newhash == ""){newhash = "#";}
				
				no_ajax_yet = false;
				jQuery(".current-tab").removeClass("current-tab");
				jQuery(this).addClass("current-tab");
				
				var clicked_link = jQuery(this).attr('href');
				jQuery("a").each(function(){
										  if(clicked_link == jQuery(this).attr('href'))
										  jQuery(this).addClass("current-tab");
										  });
				var border_top = jQuery(window).scrollTop();
				if (border_top > 80){
						jQuery('html,body').animate({scrollTop: 0}, 250,"easeOutExpo");
						}
				window.location.hash = newhash;

				
				
				if(!jQuery('.preloaded_item_'+i).length)
				
				{
					jQuery(".ajaxloader").fadeIn(100);
					jQuery('.content').append("<div class='ajaxbox preloaded_item_"+i+"'></div>");
					var content_to_load = jQuery(this).attr('href').replace(/\/#.+/,"")+' .ajaxcontent'; 
					jQuery('.preloaded_item_'+i).load(content_to_load, {preload: "true"}, preloadedContent);

				}
				else
				{
					preloadedContent();
				}
				
				
						
				
				}
			}
		return false;
		}
		 
		
		function preloadedContent()
		{ 
		  var transition = "easeInOutExpo";
		  jQuery('.current_content').animate({left:-600},700,transition);
		  
		  var loaditem = '.preloaded_item_'+i;

		  jQuery(loaditem).css({display:"block"}).animate({left:0},700,transition, function()
		  {
			jQuery('.current_content').css({left:600,display:"none"}).removeClass('current_content');
			jQuery(this).addClass('current_content');
			var newheight = jQuery('.current_content').height();
			jQuery('.content').animate({height:newheight},1200,transition);
			add_it(".current_content a");
			jQuery(".ajaxloader").fadeOut(100);
			ajaxed_comment();
			no_ajax_yet = true;
			
			 jQuery("a[rel^='prettyPhoto'], a[rel='lightbox']").not('.lightboxed').addClass('lightboxed').prettyPhoto();
			
		  });
		}
   });
	}
}

function ajaxed_comment(){
	var install_url = jQuery("meta[name=Sleek_option0]").attr('content');
	jQuery('.current_content #commentform #submit').bind("click",function(){
											function field_style($fieldname, $invalid)
											{
												if($invalid)
												{
												jQuery($fieldname).addClass('invalid-form');
												}else{
												jQuery($fieldname).removeClass('invalid-form');
												}
											}

											var $error = false;
											$author = jQuery('.current_content #commentform #author').val();
											$email = jQuery('.current_content #commentform #email').val();
											$website = jQuery('.current_content #commentform #url').val();
											$message = jQuery('.current_content #commentform #comment').val();
											$post = jQuery(".current_content [name=comment_post_ID]").val();
											$loggedin = jQuery(".current_content [name=loggedin]").val();
											
											$html = "&_wp_unfiltered_html_comment="+jQuery(".current_content [name=_wp_unfiltered_html_comment]").val();
											
											if($loggedin == "true"){
												$email ="";
												$author ="";
												$website ="";
											}else{
												if($author == ""){
													$error = true;
													field_style('.current_content #commentform #author',true);
													}else{
													field_style('.current_content #commentform #author',false);	
													}
												
												if(!$email.match(/^\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$/)){
													$error = true;
													field_style('.current_content #commentform #email',true);
													}else{
													field_style('.current_content #commentform #email',false);	
													}
											}

											if($message == ""){
												$error = true;
												field_style('.current_content #commentform #comment',true);
												}else{
												field_style('.current_content #commentform #comment',false);	
												}
											if($error == false){
											  jQuery.ajax({
														 type: "POST",
														 url: install_url + "/wp-comments-post.php",
														 data: "author="+$author+"&email="+$email+"&url="+$website+"&comment="+$message+"&comment_post_ID="+$post+"&submit=submit comment="+$html,
														 beforeSend:function()
														 {
								  						jQuery(".current_content .ajaxerror, #submit").fadeOut(400);
														jQuery('.current_content #commentform #comment').addClass("ajaxloader_white");
														  },
														 error:function()
														 {
														jQuery(".current_content #submit").fadeIn(400);
														jQuery('.current_content #commentform #comment').removeClass("ajaxloader_white");
														jQuery(".current_content .ajaxerror").css({display:"none"}).html("An error occured during submission of your comment, please try again").slideDown(400);	 
														  },
														 success: function(response)
														 {
														jQuery(".current_content .ajax_commentform").slideUp(400,"easeInOutExpo"); 
														var commentheight = jQuery(".current_content .commentlist").height() + 1;
														var content_to_load = jQuery(".current_content #ajax_geturl").val() +' .commentlist'; 
														jQuery(".current_content #commentwrap").css({height:commentheight});
														jQuery('.current_content #commentwrap').load(content_to_load, {preload: "true"}, insertcontent);
														
														function insertcontent(){
															var commentheight = jQuery(".current_content .commentlist").height() + 1;
															jQuery(".current_content #commentwrap").animate({height:commentheight},400,"easeInOutExpo",changecontentheight);
															
															function changecontentheight(){
															var allheight = jQuery(".current_content").height();
															jQuery(".content").animate({height:allheight},400,"easeInOutExpo");
															}
															}
														 }
											  });
										  
										  }
													   
											return false;		   
													   });
	 
	
	
	 
}

function form_validation(){
	jQuery("#name, #mail, #message").each(function(i){
									  
				jQuery(this).bind("blur", function(){
				
				var value = jQuery(this).attr("value");
				var check_for = jQuery(this).attr("id");
				var surrounding_element = jQuery(this);

				if(check_for == "mail"){
					if(!value.match(/^\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$/)){
						surrounding_element.attr("class","").addClass("invalid-form");
						}else{
						surrounding_element.attr("class","").addClass("ajax_valid");	
						}
					}
				
				if(check_for == "name" || check_for == "message"){
					if(value == ""){
						surrounding_element.attr("class","").addClass("invalid-form");
						}else{
						surrounding_element.attr("class","").addClass("ajax_valid");	
						}
					}
					
				
		 });
	});
}



function validate_all(){
	var my_error;
	jQuery(".ajax_form #send").bind("click", function(){
	my_error = false;
	jQuery(".ajaxstyle #name, .ajaxstyle #message, .ajaxstyle #mail ").each(function(i){
										   
				var value = jQuery(this).attr("value");
				var check_for = jQuery(this).attr("id");
				var surrounding_element = jQuery(this);
				var template_url = jQuery("meta[name=Sleek_option1]").attr('content');

				if(check_for == "mail"){
					if(!value.match(/^\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$/)){
						surrounding_element.attr("class","").addClass("invalid-form");
						my_error = true;
						}else{
						surrounding_element.attr("class","").addClass("ajax_valid");	
						}
					}
				
				if(check_for == "name" || check_for == "message"){
					if(value == ""){
						surrounding_element.attr("class","").addClass("invalid-form");
						my_error = true;
						}else{
						surrounding_element.attr("class","").addClass("ajax_valid");	
						}
					}
						   if(jQuery(".ajaxstyle #name, .ajaxstyle #message, .ajaxstyle #mail").length  == i+1){
								if(my_error == false){
									jQuery("#ajax_form").slideUp(400);
									var yourname = jQuery("#name").attr('value');
									var email = jQuery("#mail").attr('value');
									var website = jQuery("#website").attr('value');
									var message = jQuery("#message").attr('value');
									var myemail = jQuery("#myemail").attr('value');
									var myblogname = jQuery("#myblogname").attr('value');
									
									jQuery.ajax({
									   type: "POST",
									   url: template_url + "/send.php",
									   data: "Send=true&yourname="+yourname+"&email="+email+"&website="+website+"&message="+message+"&myemail="+myemail+"&myblogname="+myblogname,
									   success: function(response){
									   jQuery("#ajax_response").css({display:"none"}).html(response).slideDown(400);   
										   }
										});
									} 
							}
					});
			return false;
	});
}


	
	
jQuery(document).ready(function(){
form_validation();
validate_all();
ajaxed_comment();
kriesi_noscript();
var preload = jQuery("meta[name=Sleek_option2]").attr('content');
if (preload == 1){
 preload_pages();
}
 sleektabs("a");
 kriesi_mainmenu();
 
 jQuery("a[rel^='prettyPhoto'], a[rel='lightbox']").not('.lightboxed').addClass('lightboxed').prettyPhoto();
});



































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