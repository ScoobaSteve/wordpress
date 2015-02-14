<?php global $kriesi_options; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<meta name="Sleek_option" content="<?php echo get_option('siteurl'); ?>" />
<meta name="Sleek_option0" content="<?php echo get_option('home'); ?>" />
<meta name="Sleek_option1" content="<?php echo bloginfo('template_url'); ?>" />
<meta name="Sleek_option2" content="<?php echo $kriesi_options['pagenav'] ?>" />

<title><?php if (is_home()) { bloginfo('name'); ?><?php } elseif (is_category() || is_page() ||is_single()) { ?> <?php } ?><?php wp_title(''); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" />



<?php if($kriesi_options['whichdesign'] == 3){ ?>
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/style3.css" type="text/css" media="screen" />
<?php } else if($kriesi_options['whichdesign'] == 2){ ?>
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/style2.css" type="text/css" media="screen" />
<?php } else {?> 
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/style1.css" type="text/css" media="screen" />
<?php }


$my_customJs = get_bloginfo('template_url')."/js/custom.js";
$my_customlightbox = get_bloginfo('template_url')."/prettyPhoto/js/jquery.prettyPhoto.js";

wp_enqueue_script('jquery');
wp_enqueue_script('my_customlightbox',$my_customlightbox,array('jquery'),'1.2.6' );
wp_enqueue_script('my_customJs',$my_customJs,array('jquery'),'1.2.6' );

wp_head(); 

if ( ( is_single() || is_page() || is_home() ) && ( !is_paged() ) ) {
        echo '<meta name="robots" content="index, follow" />' . "\n";
} else {
        echo '<meta name="robots" content="noindex, follow" />' . "\n";
}
?>
</head>

<body>
<div id="wrapper-bgonly">
<div id="wrapper"><h1 id="logo"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?>/</a></h1>
<ul id="nav">
        <li <?php echo is_front_page() ? "class='current_page_item'" : "" ?>><a href="<?php echo get_settings('home'); ?>/">Home</a></li>
		<?php
		
		if($kriesi_options['com_page'] != ""){
		$include = "&include=".$kriesi_options['com_page'];
		}else{
		$include = "";	
		}
		wp_list_pages('orderby=menu_order&title_li='.$include);
		?>
        </ul>
<div id="top">
<div id="main">
	<div class="content">
    	<div class="current_content ajaxbox content_relative">