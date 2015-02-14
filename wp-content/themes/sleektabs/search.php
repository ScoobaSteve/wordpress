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
    <h2> Search Results </h2>
		<?php while (have_posts()) : the_post(); ?>
				<div <?php 
				if(function_exists(post_class)){
				post_class('entry'); 
				}else{
				echo " class='entry' ";	
				}
				
				?>>
  
                
                
                
                <div class="entry_content">
                
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
					<?php the_excerpt('Read on'); ?>
                    <a class="more-link" href="<?php the_permalink() ?>">Read on</a>
					<div class="seperator"></div>
					<!--you need trackback rdf for pings from non wp blogs do not delete the html comments they are necessary-->
		 <!--<?php trackback_rdf(); ?>-->
                 </div><!--entry_content-->
			</div><!-- end entry -->
            
		<?php endwhile; ?>

        <?php if (function_exists(kriesi_pagination)){
	kriesi_pagination($query_string);
	}?>
		
	<?php else : ?>

		<div class="entry"><h2>No Search Results</h2>
		<p>Sorry, but you are looking for something that isn't here.</p>
        </div>
	<?php endif; ?>

	

<?php 
if ($ajaxcall == false){ get_sidebar(); get_footer(); }else{
	echo "</div>";
	}
?>
