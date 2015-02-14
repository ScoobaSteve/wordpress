<?php
/*
Attention: all functions within this file are developed by Christian "Kriesi" Budschedl
You are allowed to use them in non-commercial projects as well as in commercial projects. What you are not allowed to do is to redistribute the functions or part of them (eg in wordpress templates)

Contact: office@kriesi.at or at http://www.kriesi.at/contact
*/
global $kriesi_options;
$kriesi_options  = get_option('kriesi_options');

if($kriesi_options['enable_jquery'] && !is_admin()){
add_action('wp_print_scripts', 'addjquery');
function addjquery() {
	$my_jquery = get_bloginfo('template_url'). "/js/jquery-1.2.6.min.js";
	wp_deregister_script( 'jquery' ); 
    wp_register_script( 'jquery', $my_jquery, false, '' ); 
	wp_enqueue_script('jquery');
}
}


function kriesi_pagination($query_string){
global $posts_per_page, $paged;
$my_query = new WP_Query($query_string ."&posts_per_page=-1");
$total_posts = $my_query->post_count;
if(empty($paged))$paged = 1;
$prev = $paged - 1;							
$next = $paged + 1;	
$range = 2; // only edit this if you want to show more page-links
$showitems = ($range * 2)+1;

$pages = ceil($total_posts/$posts_per_page);
if(1 != $pages){
	echo "<div class='pagination'>";
	echo ($paged > 2 && $paged > $range+1 && $showitems < $pages)? "<a href='".get_pagenum_link(1)."'>&laquo;</a>":"";
	echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."'>&lsaquo;</a>":"";
	
		
	for ($i=1; $i <= $pages; $i++){
	if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
	echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>"; 
	}
	}
	
	echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."'>&rsaquo;</a>" :"";
	echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."'>&raquo;</a>":"";
	echo "</div>\n";
	}
}


################ admin

function kriesi_admin_panel() {	
	if (!current_user_can('level_7')){
		return;
	}else{
	include('kriesioptions.php');
	add_theme_page ('SleekTabs Options', 'SleekTabs Options', 7, 'kriesioptions.php', 'k_generate');
	}
}
add_action('admin_menu', 'kriesi_admin_panel');


function kriesi_no_generator() { return ''; }  
add_filter('the_generator','kriesi_no_generator');






// Widget Settings

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Right Sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">', 
	'after_widget' => '</li>', 
	'before_title' => '<h3 class="widgettitle">', 
	'after_title' => '</h3>', 
	));
?>