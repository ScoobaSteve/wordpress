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
                <img src="<?php echo $bigpic; ?>" alt=""/>
                </div>
				<?php }?>
                <div class="entry_content">
                
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
					<?php the_content('Read on'); ?>
                    <?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
                 </div>
			</div><!-- end entry -->
		<?php endwhile; ?>
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