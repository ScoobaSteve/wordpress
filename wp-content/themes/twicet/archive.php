<?php get_header(); ?>


<div id="content" class="bg_sidebar">
           <div id="inner_content">
           
            <?php if (have_posts()) : 
            echo"<h3>";
            $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				<?php /* If this is a category archive */ if (is_category()) { ?>				
				Archive for <?php echo single_cat_title(); ?>
				
 			  	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				Archive for <?php the_time('F jS, Y'); ?>
				
			 	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				Archive for <?php the_time('F, Y'); ?>
			
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				Archive for <?php the_time('Y'); ?>
				
			  	<?php /* If this is a search */ } elseif (is_search()) { ?>
				Search Results
				
			  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				Author Archive
			
				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				Blog Archives

              	
				<?php }
            echo"</h3>";
            while (have_posts()) : the_post();
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
           <?php the_excerpt(); ?>
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