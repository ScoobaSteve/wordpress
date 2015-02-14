</div><!--end main-->
        
        <div id="footer">
         <span class="copyright"><strong>Copyright &copy;AllFarm NZ</strong>  - <a href="mailto:info@allfarmnz.co.nz"><strong>Email Us</strong></a> - <a href="http://imagication.co.nz"><strong>Web Design</strong></a></span>
        <span class="scroll-top"><a href="#top">top</a></span>
        </div><!--end footer-->
        
    </div><!--end top-->
</div><!--end wrapp_all-->
<?php wp_footer();
global $k_options; 

if($k_options['general']['google_analytics'])
echo $k_options['general']['google_analytics'];
?>
</body>
</html>
