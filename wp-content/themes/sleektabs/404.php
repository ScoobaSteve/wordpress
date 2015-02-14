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

		<div class="entry"><h2>Error 404 - Not Found</h2>
		<p>Sorry, but you are looking for something that isn't here.</p>
		<?php if ($ajaxcall == false){
			include (TEMPLATEPATH . "/searchform.php");
			}?>
        </div>

	

<?php 
if ($ajaxcall == false){ get_sidebar(); get_footer(); }else{
	echo "</div>";
	}
?>
