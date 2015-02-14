<?php
global $kriesi_options;

function k_generate(){
$options = $newoptions  = get_option('kriesi_options');

if ( $_POST['kriesi_options'] ) {
		$newoptions['whichdesign'] = strip_tags(stripslashes($_POST['whichdesign']));
		$newoptions['com_page'] = strip_tags(stripslashes($_POST['com_page']));
		$newoptions['pagenav'] = stripslashes($_POST['pagenav']);
		}
		
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('kriesi_options', $options);
		}
		
$whichdesign = empty( $options['whichdesign'] ) ? 1 : $options['whichdesign'];
$com_page = empty( $options['com_page'] ) ? "" : $options['com_page'];
$pagenav = empty( $options['pagenav'] ) ? false : true;

?>
<div class="wrap">
<h2>SleekTabs Options</h2>

<form method="post" action="">
<table class="form-table">
<tr valign="top">
  <th scope="row">SleekTabs Design</th>
  <td><br/>
    <label><input type="radio" name="whichdesign" id="whichdesign" value="1" <?php if ($whichdesign == 1){echo "checked = checked";}?> /> Design 1 - SleekTabs Standard</label><br/>
    <label><input type="radio" name="whichdesign" id="whichdesign2" value="2" <?php if ($whichdesign == 2){echo "checked = checked";}?>/> Design 2 - SleekTabs Grunge</label><br/>
    <label><input type="radio" name="whichdesign" id="whichdesign3" value="3" <?php if ($whichdesign == 3){echo "checked = checked";}?>/> Design 3 - SleekTabs Coffee</label><br/>

    
    
    
    
    </td>
</tr>

<tr valign="top">
  <th scope="row"><label for="com_page">Page Navigation</label></th>
  <td>
  <label for="pagenav">
  <input type="checkbox" <?php if ($pagenav){echo "checked='checked'";}?> value="1" id="pagenav" name="pagenav"/>
  Preload Pages?</label><br/>
  Check this option if you want to preload the content that is linked in your main menu. (recommended to check if you use only pages (no blog) and not more then about 4-6)
  <br/><br/>
    
  <input name="com_page" type="text" id="com_page" value="<?php if ($com_page){echo $com_page;}?>" size="70" maxlength="255" /><br/>
    Enter the IDs of the pages you want to display in the main menu (top left corner of the page)<br/>
    If left empty it will display all pages<br/>
    Example:<br/>
    <strong>9,16,22,24,33</strong> (this would display 5 posts with the id 9, 16, 22, 24, 33)<br/>
  </td>
</tr>


</table>

<p class="submit">
<input id="kriesi_options" type="hidden" value="1" name="kriesi_options"/>
<input type="submit" name="Submit" value="Save Changes" /></p>

</form>

</div>
<?php
}

?>