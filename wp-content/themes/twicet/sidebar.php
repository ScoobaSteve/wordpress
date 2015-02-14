<?php 
global $kriesi_options;
$themeurl = get_bloginfo('template_url');
function kriesi_small_description($themeurl) 
{
	echo'
	<div class="small_box">
            	<span class="meta">This theme is ready...</span>
            	<h3>Widget Ready</h3>
                <p>The text you are currently reading can be added either through sidebar widgets or directly in the sidebar.php file. </p>
                <p>If you add a widget to the predefined widget area this text will be removed automatically.</p>
                <img class="ie6fix" alt="" src="'.$themeurl.'/files/front5.png"/>
            </div><!--end small_box-->';
}

function kriesi_small_description2($themeurl) 
{
	echo'
	<div class="small_box">
            	<span class="meta">writ a mail or letter</span>
            	<h3><a href="#">Contact Us</a></h3>
                <p>If you are interested in using our service feel free to contact us.</p><p>Either by sending a mail to office[at]twicet[dot]com, or by using our jQuery improved ajax contact form ;D</p><img class="ie6fix" alt="" src="'.$themeurl.'/files/front4.png"/>
            </div><!--end small_box-->';
}

function kriesi_small_description3($themeurl) 
{
	echo'
	<div class="small_box box1">
            	<span class="meta">more for your money</span>
            	<h3><a href="#">Multiple Skins</a></h3>
                <p>Twicet comes with multiple Skins to choose from. To make cusomization of existing skins easier the color informations are stored in separated stylesheets.</p><p>Additionally all PSD files that where used to create this theme are included.
</p><img class="ie6fix" alt="" src="'.$themeurl.'/files/front1.png"/>
            </div>';
}
?>

<div id="sidebar">
<?php 
if($post->post_parent)
  $children = wp_list_pages("title_li=&sort_column=menu_order&child_of=".$post->post_parent."&echo=0");
  else
  $children = wp_list_pages("title_li=&sort_column=menu_order&child_of=".$post->ID."&echo=0");
  if ($children) { ?>
  <div class="small_box widget_pages">
  <h3>Pages</h3>
  <ul>
  <?php echo $children; ?>
  </ul>
  </div>
  <?php } 
  
  
  
  if (is_page()){ #sidebar used for  pages
  if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Pages') ) : else: ?>
                        <?php 
                        
                        kriesi_small_description($themeurl); 
                        kriesi_small_description2($themeurl);
                        ?>
                        <div class="widget">
                        <?php get_search_form(); ?>
						</div>
                        
                        
  <?php endif; 
  
  }else{ #sidebar used for blog & archives (category, tag, date, etc)
  
  if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Blog') ) :else: ?>
                        
                        <?php 
                        
                        kriesi_small_description($themeurl);
                        kriesi_small_description3($themeurl); 
                        kriesi_small_description2($themeurl); ?>
                          
                        <div class="widget small_box">
                        <?php get_search_form(); ?>
                        </div>
                        
                        
<?php endif; }

if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Everywhere') ) : endif;?> 
</div><!-- end sidebar -->
         