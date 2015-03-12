	$(document).ready(function(){
	    resize();
	    $(window).resize(function(){
		resize();
	    })
	    $('#menu-item-213').click(function(){
		$('#cntctfrm_contact_name').focus();
	    })
	    $('#cntctfrm_contact_form').attr('action','http://campcoders.com/#cpr');
	    $('.slider-wrapper').css('height',$(window).height()-85);
	    var current_cate  = <?php echo json_encode(get_the_category()[0]->slug); ?>;
	    console.log(current_cate);
	    if(current_cate == 'portfolio'){
	    	gtTop('rpjc_widget_cat_recent_posts-4');
	    }
	    if(current_cate == 'blog'){
	    	gtTop('rpjc_widget_cat_recent_posts-3');
	    }
	    function resize(){
		if(findBootstrapEnvironment()=='xs'){
		    $('.widget').css('width','95%');
	        }else{
		    $('.widget').removeAttr('style');
	        }
	    }
	    function gtTop(id){
	    	var e = $('#'+id);
	    	e.addClass('notCl');
	    	$(e).prependTo('#sidebar .widgets');
	    	e.find('.menu').addClass('collapse');
	    	e.find('.menu').collapse('toggle');
	    	e.find('.widgettitle').attr('onclick',"showCollapse('"+e.attr('id')+"')");
	    	var notClTitle = e.find('.widgettitle').text();
	    		notClTitle += '<span class="caret" style="margin-left: 10px"></span>';
	    	e.find('.widgettitle').html(notClTitle);
	    	var collapse = $('#sidebar .widgets > div:not(.notCl)');
	    		collapse.addClass('cl');
	    		collapse.find('ul').addClass('collapse');
	    		collapse.find('.widgettitle').each(function(){
	    			$(this).attr('onclick',"showCollapse('"+$(this).parent().parent().attr('id')+"')");
	    			var title = $(this).text();
	    			title += '<span class="caret" style="margin-left: 10px"></span>';
	    			$(this).html(title);
	    		})
	    }
		function findBootstrapEnvironment() {
	    	    var envs = ['xs', 'sm', 'md', 'lg'];
		    $el = $('<div>');
		    $el.appendTo($('body'));

		    for (var i = envs.length - 1; i >= 0; i--) {
	            var env = envs[i];

	            $el.addClass('hidden-'+env);
	            if ($el.is(':hidden')) {
	                $el.remove();
	                return env
	            }
	    	    };
		}

		function showCollapse(id){
		    $('#'+id).find('ul').collapse('toggle');
		}
		$('.page-numbers').click(function(){
			document.location.href = $(this).attr(href);
			return false;
		})
	})

	
