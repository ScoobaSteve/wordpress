<?php
/*
Template Name: Portfolio
*/

global $k_options;
		

$kriesi_options['mainbox_cat_final'] = 4;
 
get_header();


global $kriesi_options;
?>

<div id="content">
		  	<div id="inner_content_big">
            <?php if (have_posts()) : while (have_posts()) : the_post();
            $punchline = get_post_meta($post->ID, "punchline", true);
			?>
           <span class="meta"><?php echo $punchline; ?></span> 
           <h2 id="post-<?php the_ID(); ?>"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
           	</div>
           	

<?php endwhile; endif; 

$more = 0;
$posts_per_page = $k_options['portfolio']['portfolio_entry_count'];
$query_string ="posts_per_page=".$k_options['portfolio']['portfolio_entry_count'];
$query_string .= "&cat=".$k_options['portfolio']['slider_port_final']."&paged=$paged";
query_posts($query_string);
$boxnumber = 1;
if (have_posts()) : while (have_posts()) : the_post();
			$portfolio_image = get_post_meta($post->ID, "portfolio-image", true);	
			$portfolio_image_small= get_post_meta($post->ID, "portfolio-image-small", true);
			
			if($portfolio_image != "" && $k_options['general']['tim'] == 1)
			{
				$resizepath = get_bloginfo('template_url')."/timthumb.php?src="; #timthumb path	
				$resize_options1 = "&amp;w=250&amp;h=132&amp;zc=1";
				
				$portfolio_image_small = $resizepath.$portfolio_image.$resize_options1;
			}
			
			if($portfolio_image_small != ""){
			
				if ($boxnumber == 1) echo '<div class="entry_portfolio">'; ?>
           
          		<div class="small_box box<?php echo $boxnumber; ?>">
				<div class="portfolio_item">
           		<h3 id="post-<?php the_ID(); ?>"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h3>
           <?php 
           echo '<a href="'.$portfolio_image.'" rel="lightbox[portfolio]"><img class="aligncenter" src="'.$portfolio_image_small.'" alt="" /></a>';
           
           ?>
 			</div><!--end portfolio_item-->
 			<?php the_excerpt(); ?>
 			</div><!--end small_box-->
           <?php if ($boxnumber == 3) echo '</div>'; ?>
           	<?php 
           $boxnumber = $boxnumber == 3 ? '1' : $boxnumber + 1;
           }
           	endwhile; 
           	echo"<div class='inner_content portfolio_inner_content'>";
           	kriesi_pagination($query_string);
           	echo'</div>';
           	else: ?>
	<div class="entry">
	<h2>Nothing Found</h2>
	<p>Sorry, no posts matched your criteria.</p>
	</div>
	
<!--do not delete-->
<?php endif; 
if($boxnumber != 1){
echo '</div>';
}


      	 	#start of portfolio content boxes
      	 	$runs = 3;
      	 				
			for($counter = 1; $counter <= $runs; $counter++)
			{
      	 		switch($k_options['portfolio']['box'.$counter.'_content'])
      	 		{
      	 		case 'post':
      	 		$query_string = "&showposts=1";
      	 		$offset = 0;
      	 		#calculate offset
      	 		if($counter > 1)
      	 		{
      	 			for($i = 1; $i < $counter; $i++)
      	 			{
      	 				if($k_options['portfolio']['box'.$i.'_content'] == $k_options['portfolio']['box'.$counter.'_content'])
      	 				{
      	 					if($k_options['portfolio']['box'.$i.'_content_post'] == $k_options['portfolio']['box'.$counter.'_content_post'] )
      	 					{
      	 					$offset++;
      	 					}
      	 				}
      	 			}
      	 		}
      	 		
      	 		$query_string .= "&offset=".$offset.".&cat=".$k_options['portfolio']['box'.$counter.'_content_post'];
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
      	 		$query_string = "page_id=".$k_options['portfolio']['box'.$counter.'_content_page'];
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
      	 		if (function_exists('dynamic_sidebar') && dynamic_sidebar('Portfolio Box'.$counter)){}
      	 		break;
      	 		default:
      	 		apply_placeholder($counter);
      	 		}
			}
					
			function apply_placeholder($column)
			{	
				$themeurl = get_bloginfo('template_url');
				
				if($column == 1)
				{
				echo '
<div class="small_box box1">
            	<span class="meta">latest technology</span>
            	<h3><a href="#">Software that works</a></h3>
                <p>Our software works perfectly on every system and is coded with the latest standards in mind.</p><p>It is easy to use and very customizable, and our support is top-notch :)</p><img class="ie6fix" alt="" src="'.$themeurl.'/files/front5.png"/>
            </div>';
				}
				
				if($column == 2)
				{
				echo'
<div class="small_box box2">
            	<span class="meta">masterpieces for everone</span>
            	<h3><a href="#">We build for every system</a></h3>
                <p>Our workpieces are made to operate on Windows, Linux and Mac OSX in every single browser you can imagine.</p>
				<p>Be sure to get a quote if you are interested in getting one of our products.</p>
				<img class="ie6fix" alt="" src="'.$themeurl.'/files/front2.png"/>
            </div>';
				}
				
				if($column == 3)
				{
				echo'
<div class="small_box box3">
            	<span class="meta">writ a mail or letter</span>
            	<h3><a href="#">Contact Us</a></h3>
                <p>If you are interested in using our service feel free to contact us.</p><p>Either by sending a mail to office[at]twicet[dot]com, or by using our jQuery improved ajax contact form ;D</p><img class="ie6fix" alt="" src="'.$themeurl.'/files/front4.png"/>
            </div>';
				}
			}
			
		
      	 ?>

            
            
          
          </div><!-- end content-->
<?php get_footer(); ?>