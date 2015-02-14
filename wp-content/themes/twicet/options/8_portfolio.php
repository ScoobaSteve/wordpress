<?php
global $k_options;
##############
#edit Option name:
$optionname = "portfolio";
#############
$saved_optionname = get_current_theme()."_".$optionname;

$k_options[$optionname] = get_option($saved_optionname);



############ Adding to the menu - always do this!
function options_portfolio() 
{	
	global $top_level_basename, $optionpage_name;
  	$optionpage_top_level = get_current_theme()." Options";
  	$optionpage_name ="Portfolio Options";

  	add_submenu_page($top_level_basename, $optionpage_name, $optionpage_name, 7, basename(__FILE__), 'k_generate_portfolio');
  
  
  	
  	#options###########################
}
add_action('admin_menu', 'options_portfolio');


############ Adding styles and script to the menu page - only do when we are on this page

if($_GET['page'] == basename(__FILE__))
{
	add_action('admin_head', 'admin_head_addition');	
}

function k_generate_portfolio()
{		
	$optionname = "portfolio";
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
<h2>Portfolio Options</h2>

<form method="post" action="">
<table class="form-table">
<tr>
  <th scope="row">Twicet Portfolio</th>
  <td><br/>
  The Page you choose here will display your Portfolio instead of the normal page content:<br/>
  The Portfolio Section shows only categories you defined above<br/>
 <br/>

<select class="postform" id="folio_page" name="folio_page"> 
<option value="">Select Page</option>  
<?php 
	$pages = get_pages('title_li=&orderby=name');
	foreach ($pages as $page){
		
		if ($options['folio_page'] == $page->ID){
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
  <th scope="row">Portfolio Categories</th>
  <td><br/>
  The portfolio Page is populated through one or more post categories of your choice:<br/>
 <br/>
<div class="multiple_box">
<noscript>ATTENTION: JAVASCRIPT IS DISABLED, THIS CAN BREAK THE MULTIPLE CATEGORY OPTION<br/></noscript>
<?php

if($options['slider_port_hidden'] == "" || $options['slider_port_hidden'] == false) 
	{
		$options['slider_port_hidden'] = 1;
	}
	
for($i = 0; $i < $options['slider_port_hidden']; $i++)
{?>
	
 
<select class="postform multiply_me" id="slider_port_<?php echo $i; ?>" name="slider_port_<?php echo $i; ?>"> 
<option value="">Select additional category?</option>  
<?php 
	$categories = get_categories('title_li=&orderby=name');
	foreach ($categories as $category){
		
		if ($options['slider_port_'.$i] == $category->term_id){
		$selected = "selected='selected'";	
			}else{
		$selected = "";		
		}
		echo"<option $selected value='". $category->term_id."'>". $category->name."</option>";
		}
?>
</select> 
    
    
    
<?php } ?>
<input name="slider_port_hidden" class="slider_port_hidden" type="hidden" value="<?php echo $options['slider_port_hidden'] ?>" />
</div>

<br/>How many items do you want to display per page? (default is 9)<br/>
<input name="portfolio_entry_count" type="text" id="portfolio_entry_count" value="<?php if ($options['portfolio_entry_count']){echo $options['portfolio_entry_count'];}else{echo"9";}?>" size="4" maxlength="4" />  

    </td>
</tr>
<tr valign="top">
  <th scope="row">Twicet Portfolio Content <br/> Bottom Area</th>
  <td><br/>
  You can choose for each of the 3 bottom columns at your Portfolio Page how to populate them:<br/>
  Post, Page or Widget. if nothing is choosen a default HTML Placeholder Text is displayed (you can of course edit this text in the index.php file if you want to)
 <br/>
</td>
</tr>

<?php $columns = 3;

for ($i = 1; $i <= $columns; $i++){
?>

<tr valign="top">
  <th scope="row">Bottom Area - Column <?php echo $i;?></th>
  <td>
  	How to populate Column <?php echo $i;?>?<br/>
  	<div class="how_to_populate">
	<select name='box<?php echo $i;?>_content' class="postform selector">
	<option value=''>HTML (simple placeholder text gets applied) </option>
	<option <?php if ($options['box'.$i.'_content'] == 'post') echo 'selected="selected"'; ?> value='post'>Post </option>
	<option <?php if ($options['box'.$i.'_content'] == 'page') echo 'selected="selected"'; ?> value='page'>Page </option>
	<option <?php if ($options['box'.$i.'_content'] == 'widget') echo 'selected="selected"'; ?> value='widget'>Widget </option>
	</select><br/>
	
	<span class='selected_post <?php if ($options['box'.$i.'_content'] != 'post') echo 'hidden'; ?>'>
	<select class="postform" id="box<?php echo $i;?>_content_post" name="box<?php echo $i;?>_content_post"> 
	<option value="">Select post category</option>  
	<?php 
	$categories = get_categories('title_li=&orderby=name');
	foreach ($categories as $category){
		
		if ($options['box'.$i.'_content_post'] == $category->term_id){
		$selected = "selected='selected'";	
			}else{
		$selected = "";		
		}
		echo"<option $selected value='". $category->term_id."'>". $category->name."</option>";
		}
		?>
	</select> <br/>
	</span>
	<span class='selected_page <?php if ($options['box'.$i.'_content'] != 'page') echo 'hidden'; ?>'>
		<select class="postform" id="box<?php echo $i;?>_content_page" name="box<?php echo $i;?>_content_page"> 
		<option value="">Select Page</option>  
		<?php 
		$pages = get_pages('title_li=&orderby=name');
		foreach ($pages as $page){
		
		if ($options['box'.$i.'_content_page'] == $page->ID){
		$selected = "selected='selected'";	
			}else{
		$selected = "";		
		}
		echo"<option $selected value='". $page->ID."'>". $page->post_title."</option>";
		}
		?>
		</select><br/>
	</span>
	<span class='selected_widget <?php if ($options['box'.$i.'_content'] != 'widget') echo 'hidden'; ?>'>Please save this page, then head over to the widget page and add widgets to the "Frontpage Box <?php echo $i;?>" Widget Area <br/></span>
	</div>
	
 
 <br/>
</td>
</tr>
<?php } ?>

</table>

<p class="submit">
<input id="kriesi_options" type="hidden" value="1" name="save_my_options"/>
<input type="submit" name="Submit" value="Save Changes" /></p>

</form>

</div>

<?php
}
?>