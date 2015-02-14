<?php
global $k_options;
##############
#edit Option name:
$optionname = "mainpage";
#############
$saved_optionname = get_current_theme()."_".$optionname;

$k_options[$optionname] = get_option($saved_optionname);



############ Adding to the menu - always do this!
function options_mainpage() 
{	
	global $top_level_basename, $optionpage_name;
  	$optionpage_top_level = get_current_theme()." Options";
  	$optionpage_name ="Mainpage Options";

  	add_submenu_page($top_level_basename, $optionpage_name, $optionpage_name, 7, basename(__FILE__), 'k_generate_mainpage');
  
  
  	
  	#options###########################
}
add_action('admin_menu', 'options_mainpage');


############ Adding styles and script to the menu page - only do when we are on this page

if($_GET['page'] == basename(__FILE__))
{
	add_action('admin_head', 'admin_head_addition');	
}

function k_generate_mainpage()
{		
	$optionname = "mainpage";
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
<h2>Mainpage Options</h2>

<form method="post" action="">
<table class="form-table">
<tr valign="top">
  <th scope="row">Twicet Starting Page Image Slider</th>
  <td><br/>
  The imageslider is populated through one or more post categories of your choice:<br/>
 <br/>
<div class="multiple_box">
<noscript>ATTENTION: JAVASCRIPT IS DISABLED, THIS CAN BREAK THE MULTIPLE CATEGORY OPTION<br/></noscript>
<?php

if($options['slider_cat_hidden'] == "" || $options['slider_cat_hidden'] == false) 
	{
		$options['slider_cat_hidden'] = 1;
	}
	
for($i = 0; $i < $options['slider_cat_hidden']; $i++)
{?>
	
 
<select class="postform multiply_me" id="slider_cat_<?php echo $i; ?>" name="slider_cat_<?php echo $i; ?>"> 
<option value="">Select additional category?</option>  
<?php 
	$categories = get_categories('title_li=&orderby=name');
	foreach ($categories as $category){
		
		if ($options['slider_cat_'.$i] == $category->term_id){
		$selected = "selected='selected'";	
			}else{
		$selected = "";		
		}
		echo"<option $selected value='". $category->term_id."'>". $category->name."</option>";
		}
?>
</select> 
    
    
    
<?php } ?>
<input name="slider_cat_hidden" class="slider_cat_hidden" type="hidden" value="<?php echo $options['slider_cat_hidden'] ?>" />
</div>

<br/>How many items do you want to display? (default is 5)<br/>
<input name="frontpage_image_count" type="text" id="frontpage_image_count" value="<?php if ($options['frontpage_image_count']){echo $options['frontpage_image_count'];}else{echo"5";}?>" size="4" maxlength="4" />  

    </td>
</tr>



<tr valign="top">
  <th scope="row">Twicet Starting Page Image Slider Autorotate</th>
  <td><br/>
  Should the image slider autorotate?<br/>
 <br/>

    <label><input type="radio" name="autorotate" id="autorotate" value="" <?php if ($options['autorotate'] == false || $options['autorotate'] == ""){echo "checked = checked";}?> /> Autorotation off</label><br/>
    <label><input type="radio" name="autorotate" id="autorotate2" value="1" <?php if ($options['autorotate'] == 1){echo "checked = checked";}?> /> Autorotation on </label><br/><br/>
    
Enter how long each item gets displayed in milliseconds (1 Second = 1000 milliseconds), default is 7 seconds<br/>
<input name="auto_duration" type="text" id="auto_duration" value="<?php if ($options['auto_duration'] != false){echo $options['auto_duration'];}else{echo"7000";}?>" size="6" maxlength="8" /> <br/><br/>   
    </td>
</tr>

<tr valign="top">
  <th scope="row">Twicet Starting Page Newsticker</th>
  <td><br/>
  Should the newsticker be displayed?<br/>
 <br/>

    <label><input type="radio" name="ticker_autorotate" id="ticker_autorotate" value="" <?php if ($options['ticker_autorotate'] == false || $options['ticker_autorotate'] == ""){echo "checked = checked";}?> /> No</label><br/>
    <label><input type="radio" name="ticker_autorotate" id="ticker_autorotate2" value="1" <?php if ($options['ticker_autorotate'] == 1){echo "checked = checked";}?> /> Yes </label><br/><br/>
    
Enter how long each item gets displayed in milliseconds (1 Second = 1000 milliseconds), default is 7 seconds<br/>
<input name="ticker_auto_duration" type="text" id="ticker_auto_duration" value="<?php if ($options['ticker_auto_duration']){echo $options['ticker_auto_duration'];}else{echo"7000";}?>" size="6" maxlength="8" /> <br/><br/>   
    </td>
</tr>

<tr valign="top">
  <th scope="row">Twicet Newsticker Category</th>
  <td><br/>
  The newsticker is populated through one or more post categories of your choice:<br/>
 <br/>
<div class="multiple_box">
<noscript>ATTENTION: JAVASCRIPT IS DISABLED, THIS CAN BREAK THE MULTIPLE CATEGORY OPTION<br/></noscript>
<?php

if($options['ticker_cat_hidden'] == "" || $options['ticker_cat_hidden'] == false) {$options['ticker_cat_hidden'] = 1;}
for($i = 0; $i < $options['ticker_cat_hidden']; $i++)
{?>
	
 
<select class="postform multiply_me" id="ticker_cat_<?php echo $i; ?>" name="ticker_cat_<?php echo $i; ?>"> 
<option value="">Select additional category?</option>  
<?php 
	$categories = get_categories('title_li=&orderby=name');
	foreach ($categories as $category){
		
		if ($options['ticker_cat_'.$i] == $category->term_id){
		$selected = "selected='selected'";	
			}else{
		$selected = "";		
		}
		echo"<option $selected value='". $category->term_id."'>". $category->name."</option>";
		}
?>
</select> 
    
    
    
<?php } ?>
<input name="ticker_cat_hidden" class="ticker_cat_hidden" type="hidden" value="<?php echo $options['ticker_cat_hidden'] ?>" />
</div>

<br/>How many items do you want to display? (default is 5)<br/>
<input name="frontpage_ticker_count" type="text" id="frontpage_ticker_count" value="<?php if ($options['frontpage_ticker_count']){echo $options['frontpage_ticker_count'];}else{echo"5";}?>" size="4" maxlength="4" />  

    </td>
</tr>


<tr valign="top">
  <th scope="row">Twicet Mainpage Content <br/> Bottom Area</th>
  <td><br/>
  You can choose for each of the 3 bottom columns how to populate them:<br/>
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