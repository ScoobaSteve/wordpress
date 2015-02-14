<?php 
global $k_options; 
get_header(); 
?>

            <div id="featured"> 
            
            <?php
            # Here starts the code for the Mainpage Image Slider
            
            if($k_options['mainpage']['frontpage_image_count']){$mycount = $k_options['mainpage']['frontpage_image_count']; }else{$mycount = 5;}
			$query_string .= "&showposts=$mycount";
			$query_string .= "&cat=".$k_options['mainpage']['slider_cat_final'];
			query_posts($query_string);
			
			$firstitem = "current";
			
			if (have_posts()) : 
				while (have_posts()) : the_post(); 
				$frontpage_image = get_post_meta($post->ID, "frontpage-image", true);
				$frontpage_image_small = get_post_meta($post->ID, "frontpage-image-small", true);
				$frontpage_blank = get_post_meta($post->ID, "frontpage-blank", true);
				$punchline = get_post_meta($post->ID, "punchline", true);
				$link = get_permalink();
				
				if($frontpage_image != "" && $k_options['general']['tim'] == 1)
				{
					$resizepath = get_bloginfo('template_url')."/timthumb.php?src="; #timthumb path	
					$resize_options1 = "&amp;w=44&amp;h=30&amp;zc=1";
				
					$frontpage_image_small = $resizepath.$frontpage_image.$resize_options1;
				}
				
				$previewpics[$link] = $frontpage_image_small; 
				
				echo'<div class="featured_item '.$firstitem.'">'."\n";
				$firstitem = "";
					
					if(!$frontpage_blank) #user did not set the option "no text"
					{
					echo'<div class="featured_text">'."\n";
					echo'<div class="entry">'."\n";
					echo'<span class="meta">'.$punchline.'</span>'."\n";
					echo'<h2><a href="'.$link.'" title="'.get_the_title().'" >'.get_the_title().'</a></h2>'."\n";
					the_excerpt();
					echo'</div>'."\n";
					echo'<a href="'.get_permalink().'" class="read-more">Read more</a><a href="#" class="show-next">Next »</a>'."\n";
					echo'</div><!-- end featured_text-->'."\n";
					}
				
				echo'<div class="featured_image"><!--an image only slide -->'."\n";
				echo'<a href="'.get_permalink().'"><img src="'.$frontpage_image.'" alt="" /></a>'."\n";
				echo'</div><!-- end featured_item-->'."\n";
				echo'</div><!-- end featured_image-->'."\n"; 
				
				
				   	
            	
            	endwhile; 
				endif; 
				
			# Here starts the code for the newsticker
				
			if($k_options['mainpage']['frontpage_ticker_count'] != ""){$ticker_count = $k_options['mainpage']['frontpage_ticker_count']; }else{$ticker_count = 5;}
			$query_string = "&showposts=$ticker_count";
			$query_string .= "&cat=".$k_options['mainpage']['ticker_cat_final'];
			query_posts($query_string);
			
			echo'<div id="featured_bottom">'."\n";
			if($k_options['mainpage']['ticker_autorotate']==1)
			{
			echo'<div class="ticker">'."\n";	
			$firstitem = "class='active_ticker'"."\n";
			
			if (have_posts()) : 
				while (have_posts()) : the_post(); 
				echo'<span '.$firstitem.' ><a href="'.get_permalink().'"><span style="color:black">Latest News</span> '.get_the_title().'</a></span>'."\n";
				$firstitem = "";
				endwhile; 
			endif;
			echo'</div><!--end ticker-->'."\n";
			}

			
			
			#start of small Preview images
			$firstitem = "class='current_prev'";
			echo '<div class="preview_images">'."\n";
			foreach($previewpics as $link => $pic)
			{
				echo '<a '.$firstitem.' href="'.$link.'"><img src="'.$pic.'" alt="" height="30px" width="44px" /></a>'."\n";
				$firstitem = "";
			}
			echo '</div><!-- end preview_images-->'."\n";
			echo '</div><!-- end featured_bottom-->'."\n";
			echo '</div><!-- end featured-->'."\n";
				
            ?> 

        
      	 <?php 

      	 	
      	 	#start of main content boxes
      	 	$runs = 3;
      	 	
      	 	echo '<div class="content_top"></div>'."\n";
			echo '<div id="content">'."\n";
			
			for($counter = 1; $counter <= $runs; $counter++)
			{
      	 		switch($k_options['mainpage']['box'.$counter.'_content'])
      	 		{
      	 		case 'post':
      	 		$query_string = "&showposts=1";
      	 		$offset = 0;
      	 		#calculate offset
      	 		if($counter > 1)
      	 		{
      	 			for($i = 1; $i < $counter; $i++)
      	 			{
      	 				if($k_options['mainpage']['box'.$i.'_content'] == $k_options['mainpage']['box'.$counter.'_content'])
      	 				{
      	 					if($k_options['mainpage']['box'.$i.'_content_post'] == $k_options['mainpage']['box'.$counter.'_content_post'] )
      	 					{
      	 					$offset++;
      	 					}
      	 				}
      	 			}
      	 		}
      	 		
      	 		$query_string .= "&offset=".$offset.".&cat=".$k_options['mainpage']['box'.$counter.'_content_post'];
      	 		query_posts($query_string);
      	 		
    	  		 	if (have_posts()) : 
						while (have_posts()) : the_post(); 
						$punchline = get_post_meta($post->ID, "punchline", true);
						$link = get_permalink();
						$more = 0;
						
						
						echo'<div class="small_box box'.$counter.'">'."\n";
						echo'<span class="meta">'.$punchline.'</span>'."\n";
						echo'<h3><a href="'.$link.'">'.get_the_title().'</a></h3>'."\n";
						the_content('read more &raquo;');
						echo'</div><!--end widget-->'."\n";
						endwhile; 
					endif; 
      	 		break;
      	 		
      	 		case 'page':
      	 		$query_string = "page_id=".$k_options['mainpage']['box'.$counter.'_content_page'];
      	 		query_posts($query_string);
      	 		
      	 		if (have_posts()) : 
						while (have_posts()) : the_post(); 
						$punchline = get_post_meta($post->ID, "punchline", true);
						$link = get_permalink();
						$more = 0;
						
						
						echo'<div class="small_box box'.$counter.'">'."\n";
						echo'<span class="meta">'.$punchline.'</span>'."\n";
						echo'<h3><a href="'.$link.'">'.get_the_title().'</a></h3>'."\n";
						the_content('read more &raquo;');
						echo'</div><!--end widget-->'."\n";
						endwhile; 
					endif; 
      	 		
      	 		break;
      	 		
      	 		case 'widget':
      	 		if (function_exists('dynamic_sidebar') && dynamic_sidebar('Frontpage Box'.$counter)){}
      	 		break;
      	 		default:
      	 		apply_placeholder($counter);
      	 		}
			}
		
			echo'</div><!-- end content-->';
			
			function apply_placeholder($column)
			{	
				$themeurl = get_bloginfo('template_url');
				
				if($column == 1)
				{
				echo '
<div class="small_box box1">
<span class="meta">more for your money</span>
<h3><a href="http://www.kriesi.at/demos/twicet/multiple-skins/">Multiple Skins</a></h3>
<p>Twicet comes with multiple Skins to choose from. To make cusomization of existing skins easier the color informations are stored in separated stylesheets.</p>
<p>Additionally all PSD files that where used to create this theme are included.</p>
<p><img width="260" height="61" alt="front1" src="'.$themeurl.'/files/front1.png" title="front1" class="alignnone ie6fix size-full wp-image-16"/></p>
</div>';
				}
				
				if($column == 2)
				{
				echo'
<div class="small_box box2">
<span class="meta">tested on multiple systems</span>
<h3><a href="http://www.kriesi.at/demos/twicet/works-everywhere/">Works everywhere</a></h3>
<p>This theme works fine under Windows, Linux and Mac OSX.</p>
<p>It was coded with web standards in mind and tested in multiple browsers, among them Internet Explorer 6,7 and 8, Firefox, Opera, Google Chrome and Safari.</p>
<p><img width="260" height="61" alt="front2" src="'.$themeurl.'/files/front2.png" title="front2" class="alignnone ie6fix size-full wp-image-17"/></p>
</div>				';
				}
				
				if($column == 3)
				{
				echo'
<div class="small_box box3">
<span class="meta">custom made scripts</span>
<h3><a href="http://www.kriesi.at/demos/twicet/jquery-improved-theme/">jQuery improved Theme</a></h3>
<p>Twicet uses custom written jQuery scripts that where coded to unobtrusively improve the website with various sleek effects.</p>
<p>These scripts are easy to customize and work with, so that using this website becomes a unique experience.</p>
<p><img width="260" height="61" alt="front3" src="'.$themeurl.'/files/front3.png" title="front3" class="alignnone size-full wp-image-18 ie6fix"/></p>
</div>				';
				}
			}
      	 ?>
          
          
          
          
          	
            
            
            

            
            
          
          
<?php get_footer(); ?>
