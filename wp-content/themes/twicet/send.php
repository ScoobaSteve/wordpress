<?php 
if(isset($_POST['Send'])){
	
		$errorC = false;
	
		$the_name = $_POST['yourname'];
		$the_email = $_POST['email'];
		$the_website = $_POST['website'];
		$the_message = $_POST['message'];
		
		#want to add aditional fields? first add them to the form in template_contact.php, then create variables like the ones above
		#
		# $your_field = $_POST['name_of_your_field'];
		#
		# last thing to do is to edit the message, see bottom of this file
		
		
		
		if(!checkmymail($the_email))
		{
			$errorC = true;
			$the_emailclass = "error";
		}else{
			$the_emailclass = "valid";
			}
		
		if($the_name == "")
		{
			$errorC = true;
			$the_nameclass = "error";
		}else{
			$the_nameclass = "valid";
			}
		
		if($the_message == "")
		{
			$errorC = true;
			$the_messageclass = "error";
		}else{
			$the_messageclass = "valid";
			}
		
		if($errorC == false)
		{	
			$to      =  $_POST['myemail'];
			$subject = "New Message from " . $_POST['myblogname'];
			$header  = 'MIME-Version: 1.0' . "\r\n";
			$header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$header .= 'From:'. $_POST['email']  . " \r\n";
		
			$message1 = nl2br($_POST['message']);
			
			
			$message = "New message from  $the_name <br/>
			Mail: $the_email<br />
			Website: $the_website <br /><br />
			Message: $message1 <br />";
			
			
			/*
			$message = "New message from  $the_name <br/>
			YOUR FIELD: $your_field <br/>
			Mail: $the_email<br />
			Website: $the_website <br /><br />
			Message: $message1 <br />";
			*/
			
			
			mail($to,
			$subject,
			$message,
			$header); 
			
			if(isset($_POST['ajax'])){
			echo"<h3>Your message has been sent!</h3><p> Thank you!</p>";
			}
		}
		
}
	
	
function checkmymail($mailadresse){
	$email_flag=preg_match("!^\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$!",$mailadresse);
	return $email_flag;
}
	




?>