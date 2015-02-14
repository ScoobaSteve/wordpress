<?php
global $k_options; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php if (is_home()) { bloginfo('name'); ?><?php } elseif (is_category() || is_page() ||is_single()) { ?> <?php } ?><?php wp_title(''); ?></title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<?php if($k_options['general']['whichdesign'] == 5){ ?>
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/style5.css" type="text/css" media="screen" />
<?php } else if($k_options['general']['whichdesign'] == 4){ ?>
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/style4.css" type="text/css" media="screen" />
<?php } else if($k_options['general']['whichdesign'] == 3){ ?>
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/style3.css" type="text/css" media="screen" />
<?php } else if($k_options['general']['whichdesign'] == 2){ ?>
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/style2.css" type="text/css" media="screen" />
<?php } else {?> 
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/style1.css" type="text/css" media="screen" />
<?php } 

if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

if ( ( is_single() || is_page() || is_home() ) && ( !is_paged() ) ) {
        echo '<meta name="robots" content="index, follow" />' . "\n";
} else {
        echo '<meta name="robots" content="noindex, follow" />' . "\n";
}
wp_head(); ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<meta name="twicet1" content="<?php echo $k_options['mainpage']['autorotate'];?>" />
<meta name="twicet2" content="<?php echo $k_options['mainpage']['auto_duration']; ?>" />
<meta name="twicet3" content="<?php echo bloginfo('template_url'); ?>" />
<meta name="twicet4" content="<?php echo $k_options['general']['whichdesign']; ?>" />
<meta name="twicet5" content="<?php echo $k_options['mainpage']['ticker_auto_duration']; ?>" />
<!--[if IE 6]>
<script type='text/javascript' src='<?php echo get_bloginfo('template_url'); ?>/js/dd_belated_png.js'></script>
<script>DD_belatedPNG.fix('.ie6fix');</script>
<![endif]-->
<meta name="verify-v1" content="wTDK5Z/WgFKCtiBL7sQv9kg5hNB/pTod2b37hSIyDnQ=" />
<meta name="google-site-verification" content="re3T79tqhgX_dtrI8YPKOkDcPbBgFoGOm3CaBOQKduI" />
</head>

<?php $body_id = is_front_page() ? 'frontpage' : 'subpage'; ?>

<body id="<?php echo $body_id; ?>">
<div class="wrap_all">
    <div id="top">
	  <div id="head"> 
      
           <h1 class='logo'><a href="<?php echo get_settings('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
            <div class="navwrap">	
                <ul id="nav">
            <li <?php if (is_front_page()){echo 'class="current_page_item"';} ?> ><a href="<?php echo get_settings('home'); ?>">Home</a></li>
                <?php wp_list_pages('title_li=&sort_column=menu_order&'.$k_options['general']['com_page']);   ?>
                </ul> 
             </div><!--end navwrap-->
             
             <?php if(!is_front_page() && (class_exists('simple_breadcrumb'))){ $bc = new simple_breadcrumb; }?>
             
    	</div><!-- end head-->
        
        <div id="main">