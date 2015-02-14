<?php

global $kriesi_options;
$kriesi_options  = get_option('kriesi_options');

add_action('wp_print_scripts', 'addjquery');

function addjquery() {
	if(!is_admin())
	{
	$my_jquery = get_bloginfo('template_url'). "/js/jquery.js";
	#wp_deregister_script( 'jquery' ); 
    #wp_register_script( 'jquery', $my_jquery, false, '' ); 
	#wp_enqueue_script('jquery');
	
	$my_customJs = get_bloginfo('template_url')."/js/custom.js";
	wp_enqueue_script('my_customJs',$my_customJs,array('jquery'));
	
	$my_prettyphoto = get_bloginfo('template_url')."/prettyPhoto/js/jquery.prettyPhoto.js";
	wp_enqueue_script('prettyphoto',$my_prettyphoto,array('jquery'));
	}
}

include(TEMPLATEPATH.'/options/import_options_no_auto_include.php');


function kriesi_no_generator() { return ''; }  
add_filter('the_generator','kriesi_no_generator');

// Widget Settings

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar Pages',
		'before_widget' => '<div id="%1$s" class="small_box widget %2$s">', 
	'after_widget' => '</div>', 
	'before_title' => '<h3 class="widgettitle">', 
	'after_title' => '</h3>', 
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar Blog',
		'before_widget' => '<div id="%1$s" class="small_box widget %2$s">', 
	'after_widget' => '</div>', 
	'before_title' => '<h3 class="widgettitle">', 
	'after_title' => '</h3>', 
	));
	
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar Everywhere',
		'before_widget' => '<div id="%1$s" class="small_box widget %2$s">', 
	'after_widget' => '</div>', 
	'before_title' => '<h3 class="widgettitle">', 
	'after_title' => '</h3>', 
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Frontpage Box1',
		'before_widget' => '<div id="%1$s" class="small_box box1 widget %2$s"><span class="meta"></span>', 
	'after_widget' => '</div>', 
	'before_title' => '<h3 class="widgettitle">', 
	'after_title' => '</h3>', 
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Frontpage Box2',
		'before_widget' => '<div id="%1$s" class="small_box box2 widget %2$s"><span class="meta"></span>', 
	'after_widget' => '</div>', 
	'before_title' => '<h3 class="widgettitle">', 
	'after_title' => '</h3>', 
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Frontpage Box3',
		'before_widget' => '<div id="%1$s" class="small_box box3 widget %2$s"><span class="meta"></span>', 
	'after_widget' => '</div>', 
	'before_title' => '<h3 class="widgettitle">', 
	'after_title' => '</h3>', 
	));
	
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Portfolio Box1',
		'before_widget' => '<div id="%1$s" class="small_box box1 widget %2$s"><span class="meta"></span>', 
	'after_widget' => '</div>', 
	'before_title' => '<h3 class="widgettitle">', 
	'after_title' => '</h3>', 
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Portfolio Box2',
		'before_widget' => '<div id="%1$s" class="small_box box2 widget %2$s"><span class="meta"></span>', 
	'after_widget' => '</div>', 
	'before_title' => '<h3 class="widgettitle">', 
	'after_title' => '</h3>', 
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Portfolio Box3',
		'before_widget' => '<div id="%1$s" class="small_box box3 widget %2$s"><span class="meta"></span>', 
	'after_widget' => '</div>', 
	'before_title' => '<h3 class="widgettitle">', 
	'after_title' => '</h3>', 
	));

?>