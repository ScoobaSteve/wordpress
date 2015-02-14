jQuery.noConflict();
function change_admin(){
	var specialfields = jQuery('.jquery_move');
	var wrapper = jQuery("#normal-sortables");
	
	specialfields.each(function(){								
		wrapper.prepend(jQuery(this).html());
		jQuery(this).html("");
								});
	
	}
	
function duplicate_slider_cat()
{	
	var $dropdown_wrap = jQuery('.multiple_box');
	
	$dropdown_wrap.each(function()
	{	
		var $dropdown = jQuery(this).find('.multiply_me');
		var $current_dropdown_wrapper = jQuery(this);
		
			$dropdown.each(function(i)
			{
			$name = jQuery(this).attr('name').replace(/\d+/,"");
			jQuery(this).attr('id', $name + i);
			jQuery(this).attr('name', $name + i);
			jQuery('.'+$name+'hidden').attr('value', $dropdown.length);
		
			jQuery(this).unbind('change').bind('change',function()
			{
				if(jQuery(this).val() && $dropdown.length == i+1)
				{
				jQuery(this).clone().appendTo($current_dropdown_wrapper);
				duplicate_slider_cat();
				}
				else if(!(jQuery(this).val()) && !($dropdown.length == i+1))
				{
				jQuery(this).remove();
				duplicate_slider_cat();
			}
			
			});
		});
	});
}
	
	
function how_to_populate()
{
	var $group = jQuery('.how_to_populate');
	$group.each(function()
	{	
		var	$currentgroup = jQuery(this);
		var $dropdown = jQuery(this).find('.selector');
		$dropdown.each(function(i)
		{
			jQuery(this).bind('change',function()
			{
				$currentgroup.find('span').css({display:"none"});
				
				if(jQuery(this).val())
				{
				$show = ".selected_"+jQuery(this).val();
				$currentgroup.find($show).css({display:"block"});
				}
			});
		});
	});
}	
	

jQuery(document).ready(function(){
	how_to_populate();
	change_admin();
	duplicate_slider_cat();
});
