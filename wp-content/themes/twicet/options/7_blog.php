<?php
global $k_options;
##############
#edit Option name:
$optionname = "blog";
#############
$saved_optionname = get_current_theme()."_".$optionname;

$k_options[$optionname] = get_option($saved_optionname);



############ Adding to the menu - always do this!
function options_blog() 
{	
	global $top_level_basename, $optionpage_name;
  	$optionpage_top_level = get_current_theme()." Options";
  	$optionpage_name ="Blog Options";

  	add_submenu_page($top_level_basename, $optionpage_name, $optionpage_name, 7, basename(__FILE__), 'k_generate_blog');
  
  
  	
  	#options###########################
}
add_action('admin_menu', 'options_blog');


############ Adding styles and script to the menu page - only do when we are on this page

if($_GET['page'] == basename(__FILE__))
{
	add_action('admin_head', 'admin_head_addition');	
}

function k_generate_blog()
{		
	$optionname = "blog";
	$saved_optionname = get_current_theme()."_".$optionname;
	$options = $newoptions  = get_option($saved_optionname);

	if ( $_POST['save_my_options'] ) 
	{
		foreach ($_POST as $key => $value)
		{	
			$newoptions[$key] = stripslashes($value); 
			
			if (preg_match("/(\w+)(hidden)$/", $key, $result))
			{
				$loops = $newoptions[$key];
				$newoptions[$key] = 0;
				$final =  $result[1].'final';
				$newoptions[$final] = "";
				for($i = 0; $i < $loops; $i++)
				{
					$name = $result[1].$i;
					$newoptions[$name] = stripslashes($_POST[$name]);
					if($newoptions[$name] != "")
					{
						$newoptions[$key]++;
						
						$newoptions[$final] .= $newoptions[$name];
						if($i+2 < $loops)
						{
							$newoptions[$final] .=", ";
						}
					}		
				}
				$newoptions[$key]++;
			}
		}
	}
		
	if ( $options != $newoptions ) 
	{
		$options = $newoptions;
		update_option($saved_optionname, $options);
	}
	
	if($options)
	{
		foreach ($options as $key => $value)
		{
			$options[$key] = empty($options[$key]) ? false : $options[$key];
		}
	}
?>




<div class="wrap">
<h2>Blog Options</h2>

<form method="post" action="">
<table class="form-table">
<tr>
  <th scope="row">Twicet Blog Page</th>
  <td><br/>
  The Page you choose here will display the Blog in addition to the normal page content:<br/>
  
 <br/>

<select class="postform" id="blog_page" name="blog_page"> 
<option value="">Select Page</option>  
<?php 
	$pages = get_pages('title_li=&orderby=name');
	foreach ($pages as $page){
		
		if ($options['blog_page'] == $page->ID){
		$selected = "selected='selected'";	
			}else{
		$selected = "";		
		}
		echo"<option $selected value='". $page->ID."'>". $page->post_title."</option>";
		}
?>
</select><br/><br/>
    </td>
</tr>
<tr valign="top">
  <th scope="row">EXCLUDE Categroies</th>
  <td><br/>
  The blog Page usually displays all Categorys, since sometimes you want to exclude some of these categories (for example porfolio entries) you can EXCLUDE multiple categories here:<br/>
 <br/>
<div class="multiple_box">
<noscript>ATTENTION: JAVASCRIPT IS DISABLED, THIS CAN BREAK THE MULTIPLE CATEGORY OPTION<br/></noscript>
<?php

if($options['blog_cat_hidden'] == "" || $options['blog_cat_hidden'] == false) 
	{
		$options['blog_cat_hidden'] = 1;
	}
	
for($i = 0; $i < $options['blog_cat_hidden']; $i++)
{?>
	
 
<select class="postform multiply_me" id="blog_cat_<?php echo $i; ?>" name="blog_cat_<?php echo $i; ?>"> 
<option value="">Select additional category?</option>  
<?php 
	$categories = get_categories('title_li=&orderby=name');
	foreach ($categories as $category){
		
		if ($options['blog_cat_'.$i] == $category->term_id){
		$selected = "selected='selected'";	
			}else{
		$selected = "";		
		}
		echo"<option $selected value='". $category->term_id."'>". $category->name."</option>";
		}
?>
</select>   
    
<?php } ?>
<input name="blog_cat_hidden" class="blog_cat_hidden" type="hidden" value="<?php echo $options['blog_cat_hidden'] ?>" />
</div>

    </td>
</tr>

</table>

<p class="submit">
<input id="kriesi_options" type="hidden" value="1" name="save_my_options"/>
<input type="submit" name="Submit" value="Save Changes" /></p>

</form>

</div>

<?php
}
?>