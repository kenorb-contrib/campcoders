<?php global $asteria;?>
<?php if (!empty ($asteria['totop_id'])) { ?>
<!--To Top Button-->
<a class="to_top"><i class="fa-angle-up fa-2x"></i></a>
<?php } ?>
<!--To Top Button END-->

<!--Footer Start-->
<div class="fixed_site">
	<div class="fixed_wrap footefixed">

<?php if ( asteria_is_mobile() && (!empty($asteria['hide_mob_footwdgt'])) ) { ?>
<?php }else{ ?>
<div id="footer">
    <div class="center">
        <!--Footer Widgets START-->
        <div class="widgets"><ul><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(__('Footer Widgets', 'asteria')) ) : ?><?php endif; ?></ul></div>
        <!--Footer Widgets END-->
    </div>
    <div id="cpr">
        <div id="copyright-content">
            <span class="cpr-title">Campcoders</span>
            <span class="footer_linkedin"><a href="#facebook"><i class="fa fa-linkedin"></i></a></span>
            <span class="footer_facebook"><a href="#linkedin"><i class="fa fa-facebook"></i></a></span>
            
        </div>
    </div>
</div>
<?php } ?>
<!--Footer END-->

    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>