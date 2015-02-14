<?php
global $k_options;
##############
#edit Option name:
$optionname = "contact";
#############
$saved_optionname = get_current_theme()."_".$optionname;

$k_options[$optionname] = get_option($saved_optionname);



############ Adding to the menu - always do this!
function options_contact() 
{	
	global $top_level_basename, $optionpage_name;
  	$optionpage_top_level = get_current_theme()." Options";
  	$optionpage_name ="Contact Options";

  	add_submenu_page($top_level_basename, $optionpage_name, $optionpage_name, 7, basename(__FILE__), 'k_generate_contact');
  
  
  	
  	#options###########################
}
add_action('admin_menu', 'options_contact');


############ Adding styles and script to the menu page - only do when we are on this page

if($_GET['page'] == basename(__FILE__))
{
	add_action('admin_head', 'admin_head_addition');	
}

function k_generate_contact()
{		
	$optionname = "contact";
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
<h2>Contact Options</h2>

<form method="post" action="">
<table class="form-table">
<tr>
  <th scope="row">Twicet Contact Form</th>
  <td><br/>
  The Page you choose here will display your Contact Form in addition to the normal page content:<br/>
 <br/>

<select class="postform" id="contact_page" name="contact_page"> 
<option value="">Select Page</option>  
<?php 
	$pages = get_pages('title_li=&orderby=name');
	foreach ($pages as $page){
		
		if ($options['contact_page'] == $page->ID){
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
<th scope="row"><label for="com_page">Page Navigation</label></th>
<td>
Enter the Email adress where mails should be delivered to. (default is <?php echo get_option('admin_email'); ?>)<br/>
<input name="contact_mail" type="text" id="contact_mail" value="<?php if ($options['contact_mail']){echo $options['contact_mail'];}else{echo get_option('admin_email');}?>" size="70" maxlength="255" /><br/>
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