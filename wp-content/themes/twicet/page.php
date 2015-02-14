<?php 
global $k_options;
if ($post->ID == $k_options['contact']['contact_page']) $contactpage = true;
if ($post->ID == $k_options['portfolio']['folio_page']) $portfoliopage = true;
if ($post->ID == $k_options['blog']['blog_page']) $blogpage = true;

if($contactpage)
{
	include(TEMPLATEPATH."/template_contact.php");
}
else if($blogpage)
{
	include(TEMPLATEPATH."/template_blog.php");
}
else if($portfoliopage)
{
	include(TEMPLATEPATH."/template_portfolio.php");
}else{

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
 			
			</div><!--end entry-->
           </div><!-- end inner_content-->
           
           	<?php endwhile; else: ?>
	
	<p>Sorry, no posts matched your criteria.</p>

<!--do not delete-->
<?php endif; ?>
           
           
 <?php get_sidebar(); ?>          
          	            
</div><!-- end content-->
<?php get_footer(); } ?>