<?php
/*
Template Name: Blog
*/
global $more, $k_options; 
get_header(); 

$more = 0;
$negative_cats = preg_replace("|(\d)|","-${1}$1", $k_options['blog']['blog_cat_final']);

$query_string = "cat=".$negative_cats."&paged=$paged";
query_posts($query_string);

?>


 <div id="content" class="bg_sidebar">
           <div id="inner_content">
           
            <?php if (have_posts()) : while (have_posts()) : the_post();
            $punchline = get_post_meta($post->ID, "punchline", true);
			$portfolio_image = get_post_meta($post->ID, "portfolio-image", true);	
			?>
			 	
            <div class="entry">
          
           <span class="meta"><?php echo $punchline; ?></span> 
           <h2 id="post-<?php the_ID(); ?>"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
           
           <div class="entry-head">
               <span class="categories"><?php the_category(', ') ?></span>
               <span class="date">on <?php the_time('F jS, Y') ?></span>
               <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><?php edit_post_link('Edit', ' ,', ''); ?></span>
           </div>
          
           
           <div class="entry-content">
           <?php 
           if($portfolio_image != "") echo '<img class="aligncenter" src="'.$portfolio_image.'" alt="" />';
           ?> 
           <?php the_content("Read more &#187;"); ?>
 			</div><!--end entry-content-->
 			<?php the_tags( '<p class="meta">Tags: ', ', ', '</p>'); ?>
			</div><!--end entry-->
           
           	<?php endwhile; 
           	kriesi_pagination($query_string);
           	else: ?>
	<div class="entry">
	<h2>Nothing Found</h2>
	<p>Sorry, no posts matched your criteria.</p>
	</div>
	
<!--do not delete-->
<?php endif; ?>
 </div><!-- end inner_content-->          
           
 <?php get_sidebar(); ?>          
          	            
</div><!-- end content-->
<?php get_footer(); ?>