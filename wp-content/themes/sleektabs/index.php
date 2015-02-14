<?php global $kriesi_options; ?>
<?php 
if($_POST['preload'] == "true"){
$ajaxcall = true;
}else{
$ajaxcall = false;	
}

if ($ajaxcall == false){ get_header(); }else{
	echo "<div class='ajaxcontent'>";
	}
?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
				<div <?php 
				if(function_exists(post_class)){
				post_class('entry'); 
				}else{
				echo " class='entry' ";	
				}
				
				?>><?php if(get_post_meta($post->ID, "big_preview", true)){ 
				$bigpic = get_post_meta($post->ID, "big_preview", true);
				?>
                
				<div class="small_previewpic">
                <a href="<?php the_permalink() ?>" title=""><img src="<?php echo $bigpic; ?>" alt=""/></a>
                </div>
				<?php }?>
                <div class="meta"><span class="floatleft"><span class='meta_date'><?php the_time('d.m.Y') ?></span>  <span class="meta_cat"><?php the_category(', '); ?></span><span class="meta_comment"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span></span></div>
                
                
                
                
                <div class="entry_content">
                
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
					<?php the_content('Read on'); ?>
					<div class="seperator"></div>
					<!--you need trackback rdf for pings from non wp blogs do not delete the html comments they are necessary-->
		 <!--<?php trackback_rdf(); ?>-->
                 </div><!--entry_content-->
			</div><!-- end entry -->
            
		<?php endwhile; ?>

        <?php if (function_exists(kriesi_pagination)){
	kriesi_pagination($query_string);
	}?>
		<div class="clearboth"></div>
	<?php else : ?>

		<div class="entry"><h2>Not Found</h2>
		<p>Sorry, but you are looking for something that isn't here.</p>
        </div>
	<?php endif; ?>

	

<?php 
if ($ajaxcall == false){ get_sidebar(); get_footer(); }else{
	echo "</div>";
	}
?>
