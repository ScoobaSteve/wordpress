<?php
global $k_options;
##############
#edit Option name:
$optionname = "general";
#############
$saved_optionname = get_current_theme()."_".$optionname;

$k_options[$optionname] = get_option($saved_optionname);

function admin_top_level()
{
	global $top_level_basename;
	$top_level_basename = basename(__FILE__);
	$optionpage_top_level = get_current_theme()." Options";

	add_menu_page($optionpage_top_level, $optionpage_top_level, 7, basename(__FILE__), 'k_generate');
}

add_action('admin_menu', 'admin_top_level');

function admin_head_addition() 
{	
	$current_folder = preg_replace("!".TEMPLATEPATH."!","", dirname(__FILE__));
	
	$admin_stylesheet_url = get_bloginfo('template_url').$current_folder.'/admin.css';
	echo '<link rel="stylesheet" href="'. $admin_stylesheet_url . '" type="text/css" />';
	
	$admin_js_url = get_bloginfo('template_url').$current_folder.'/supporting_scripts.js';
	echo '<script type="text/javascript" src="'.$admin_js_url.'"></script>';	
}

if($_GET['page'] == basename(__FILE__))
{
	add_action('admin_head', 'admin_head_addition');	
}

function k_generate()
{	
	$optionname = "general";
	$saved_optionname = get_current_theme()."_".$optionname;

	global $optionpage_top_level;
	
	$options = $newoptions  = get_option($saved_optionname);

	if ( $_POST['save_my_options'] ) 
	{
		foreach ($_POST as $key => $value)
		{
			$newoptions[$key] = stripslashes($value); 
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
<h2><?php echo $optionpage_top_level; ?></h2>

<form method="post" action="">
<table class="form-table">
<tr valign="top">
  <th scope="row">Twicet Design</th>
  <td><br/>
    <label><input type="radio" name="whichdesign" id="whichdesign" value="1" <?php if ($options['whichdesign'] == 1 || $options['whichdesign'] == false){echo "checked = checked";}?> /> Design 1 - Twicet Light Grey</label><br/>
    <label><input type="radio" name="whichdesign" id="whichdesign2" value="2" <?php if ($options['whichdesign'] == 2){echo "checked = checked";}?>/> Design 2 - Twicet Dark Grey</label><br/>
    <label><input type="radio" name="whichdesign" id="whichdesign3" value="3" <?php if ($options['whichdesign'] == 3){echo "checked = checked";}?>/> Design 3 - Twicet Light Green</label><br/>
    <label><input type="radio" name="whichdesign" id="whichdesign4" value="4" <?php if ($options['whichdesign'] == 4){echo "checked = checked";}?>/> Design 4 - Twicet Dark Orange</label><br/>
	<label><input type="radio" name="whichdesign" id="whichdesign5" value="5" <?php if ($options['whichdesign'] == 5){echo "checked = checked";}?>/> Design 5 - Twicet Modern/Transparent</label><br/>
    </td>
</tr>

<tr valign="top">
  <th scope="row">Twicet Automatic Image scaling </th>
  <td><br/>
  <strong>Should the images be scaled automaticaly?</strong>
 <br/>
	<?php
if (function_exists("gd_info")){
	
$path = TEMPLATEPATH."/cache/";

if (!is_writeable($path))
{
	echo "Your server supports automatic resizing for your portfolio and Frontpage pictures, however the folder 'cache' ($path) is not writable for the resizing script<br/>
	To make this feature work you have to set the folder permission to 777 (write for everyone)<br/><br/>";
	}else{
		
	?>
    (A script will automatically resize the frontpage and portfolio images and generate thumbnails for you when needed)
    <br/>
    <label><input type="radio" name="tim" id="tim" value="1" <?php if ($options['tim'] == 1){echo "checked = checked";}?> /> Auto Scaling on </label><br/>
	<label><input type="radio" name="tim" id="tim" value="" <?php if ($options['tim'] == false){echo "checked = checked";}?> /> Auto Scaling off</label><br/>
		<br/>
	<?php 
	}
	
}else{
	?>
    Sorry your server does not support automatic resizing, because gd library is not installed. <br/>Please contact the server administrator to install it, meanwhile you have to enter the different image sizes by hand.<br/><br/>
    <input type="hidden" name="tim" id="tim" value="" /> 
   <?php
}
?>
    </td>
</tr>

<tr valign="top">
<th scope="row"><label for="com_page">Page Navigation</label></th>
<td>

<input name="com_page" type="text" id="com_page" value="<?php if ($options['com_page']){echo $options['com_page'];}?>" size="70" maxlength="255" /><br/>
	Enter the query string of the pages you want to display in the main menu (top left corner of the page)<br/>
    If left empty it will display all pages<br/>
    Some Examples:<br/>
    <strong>include=9,16,22,24,33</strong> (this would display 5 menu items for the pages with the id 9, 16, 22, 24, 33)<br/>
    <strong>exclude=2,6,12</strong> (this would display menu itemsfor all pages except those with id 2, 6, 12)<br/><br/><br/>
</td>
</tr>

<tr valign="top">
<th scope="row"><label for="google_analytics">Google analytics tracking code</label></th>
<td>
<textarea class="code" style="width: 98%; font-size: 12px;" id="google_analytics" rows="10" cols="60" name="google_analytics">
<?php if ($options['google_analytics']){echo $options['google_analytics'];}?>
</textarea>
	Enter your analtics tracking code here
</td>
</tr>


</table>

<p class="submit">
<input id="save_my_options" type="hidden" value="1" name="save_my_options"/>
<input type="submit" name="Submit" value="Save Changes" /></p>

</form>

</div>
<?php
}

?>