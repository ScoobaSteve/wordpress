<?php
/*
Template Name: Contact Form
*/
global $k_options;
$name_of_your_site = get_option('blogname');
$email_adress_reciever = $k_options['contact']['contact_mail'] != "" ? $k_options['contact']['contact_mail'] : get_option('admin_email');

if(isset($_POST['Send']))
{
include('send.php');	
}
get_header(); ?>


 <div id="content" class="bg_sidebar">
           <div id="inner_content">
           
            <?php if (have_posts()) : while (have_posts()) : the_post();
            $punchline = get_post_meta($post->ID, "punchline", true);
			$portfolio_image = get_post_meta($post->ID, "portfolio-image", true);	
			?>
			 	
            <div class="entry">

           <span class="meta"><?php echo $punchline; ?></span> 
           <h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
           
           
           <div class="entry-content">
           <?php 
           if($portfolio_image != "") echo '<img class="aligncenter" src="'.$portfolio_image.'" alt="" />';
           ?> 
           <?php the_content(); ?>
 			</div><!--end entry-content-->
 			
 			<form action="" method="post" class="ajax_form">
			<fieldset><?php if (!isset($errorC) || $errorC == true){ ?><legend><span>Send us a mail</span></legend>
			
			<p class="<?php echo $the_nameclass; ?>" ><input name="yourname" class="text_input empty" type="text" id="name" size="20" value='<?php echo $the_name?>'/><label for="name">Your Name*</label>
			</p>
			<p class="<?php echo $the_emailclass; ?>" ><input name="email" class="text_input email" type="text" id="email" size="20" value='<?php echo $the_email?>' /><label for="email">E-Mail*</label></p>
			<p><input name="website" class="text_input" type="text" id="website" size="20" value="<?php echo $the_website?>"/><label for="website">Website</label></p>
			<label for="message" class="blocklabel">Your Message*</label>
			<p class="<?php echo $the_messageclass; ?>"><textarea name="message" class="text_area empty" cols="40" rows="7" id="message" ><?php echo $the_message ?></textarea></p>
			
			
			<p>
			<input type="hidden" id="myemail" name="myemail" value="<?php echo $email_adress_reciever; ?>" />
			<input type="hidden" id="myblogname" name="myblogname" value="<?php echo $name_of_your_site; ?>" />
			
			<input name="Send" type="submit" value="Send" class="button" id="send" size="16"/></p>
			<?php } else { ?> 
			<p><h3>Your message has been sent!</h3> Thank you!</p>
			
			<?php } ?>
			</fieldset>
			
			</form>
 			
			</div><!--end entry-->
           </div><!-- end inner_content-->
           
           	<?php endwhile; else: ?>
	
	<p>Sorry, no posts matched your criteria.</p>

<!--do not delete-->
<?php endif; ?>
           
           
 <?php get_sidebar(); ?>          
          	            
</div><!-- end content-->
<?php get_footer(); ?>