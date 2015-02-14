<?php 

//mailing function


function checkmymail($mailadresse){
	$email_flag=preg_match("!^\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$!",$mailadresse);
	return $email_flag;
}

if(isset($_POST['Send'])){
	$error = false;
	if($_POST['yourname'] != ""){$class1 = "";}else{$class1 = "invalid-form"; $error = true;}
	if(checkmymail($_POST['email'])){$class2 = "";}else{$class2 = "invalid-form"; $error = true;}
	if($_POST['message'] != ""){$class3 = "";}else{$class3 = "invalid-form"; $error = true;}
		$the_name = $_POST['yourname'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$website = $_POST['website'];
	if($error == false){
	
		
	
 		$to      =  $_POST['myemail'];
		$subject = "New Message from " . $_POST['myblogname'];
		$header  = 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$header .= 'From:'. $email . " \r\n";
	
		$message1 = nl2br($_POST['message']);
		$message = "New message from  $the_name <br/>
		Mail: $email<br />
		Website: $website <br /><br />
		Message: $message1 <br />";
		
		mail($to,
		$subject,
		$message,
		$header); 
		
		$noform = true;
		}
	
	}





?>

		</div><!--end ajaxed_content-->
    </div><!-- end content-->
<div class="sidebar"> 


<ul class="widget_block tablist">
<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Right Sidebar') ) : else : ?>
		<li class="widget widget_text">			
        <h3 class="widgettitle">An Easy to use premium Theme</h3>			
        <div class="textwidget">Sleektabs is a jQuery improved, premium Wordpress Theme which is for sale at themeforest.net. Use sidebar widgets to edit the looks of the sidebar =)
</div>
		</li>
        <li class="widget widget_text">	
        <div class="textwidget"><div><div class="icon icon1"></div>The theme comes with multiple skins for a satisfying color experience.
<br/><br/></div>
<div>
<div class="icon icon2"></div>Sleektabs was designed with the help of a Grid System for pixel perfect alignment.
</div></div>
		</li>
        

<?php endif;?> 
<li class="widget widget_text">	
       <div id="ajax_response"></div>
        <div id="ajax_form">
        <form action="" method="post" class="ajax_form">
<?php if ($noform != true){ ?><h3>Send us an email</h3>
<div class="ajaxstyle">
<p><input name="yourname" class="text_input empty  <?php echo $class1?> " type="text" id="name" size="20" value='<?php echo $the_name?>'/><label for="name">Your Name*</label>
</p>
<p><input name="mail" class="text_input email  <?php echo $class2?> " type="text" id="mail" size="20" value='<?php echo $email?>' /><label for="email">E-Mail*</label></p>
<p><input name="website" class="text_input" type="text" id="website" size="20" value="<?php echo $website?>"/><label for="website">Website</label></p>

<p><label for="message" class="nopadding">Your Message*</label><textarea name="message" class="text_area empty <?php echo $class3 ?>" cols="40" rows="7" id="message" ><?php echo $message ?></textarea></p>

</div>
<p>
<input type="hidden" id="myemail" name="myemail" value="<?php echo get_option('admin_email'); ?>" />
<input type="hidden" id="myblogname" name="myblogname" value="<?php echo get_option('blogname'); ?>" />

<input name="Send" type="submit" value="Send" id="send" size="16"/></p>
<?php } else { ?> 
<h3>Your message has been sent!</h3> <div><p>Thank you!</p></div>
<?php } ?>

</form> 
</div>


</li>
</ul>


	</div><!-- end sidebar -->
