// all coupons archive nav active
jQuery(document).ready(function($){
    $.each($('#upc_cat_ul > li'), function() {
        if ($(this).children('a').attr('href') === window.location.href) {
            $(this).children('a').addClass('active');
        }
    });
});

//for count down
jQuery(document).ready(function ($) {
    var count_down_span = $('[data-countdown_coupon]');
    count_down_span.each(function () {
        var $this = $(this), finalDate = $(this).data('countdown_coupon');
        $this.countdown(finalDate, function (event) {
            var format = '%M ' + upc_main_js.minutes + ' %S ' + upc_main_js.seconds;
            if (event.offset.hours > 0) {
                format = '%H ' + upc_main_js.hours + ' %M ' + upc_main_js.minutes + ' %S ' + upc_main_js.seconds;
            }
            if (event.offset.totalDays > 0) {
                format = '%-d ' + upc_main_js.day + '%!d ' + format;
            }
            if (event.offset.weeks > 0) {
                format = '%-w ' + upc_main_js.week + '%!w ' + format;
            }
            if (event.offset.weeks == 0 && event.offset.totalDays == 0 && event.offset.hours == 0 && event.offset.minutes == 0 && event.offset.seconds == 0) {
                jQuery(this).parent().addClass('upc-countdown-expired').html(upc_main_js.expired_text);
            } else {
                jQuery(this).html(event.strftime(format));
            }
        }).on('finish.countdown', function (event) {
            jQuery('.upc-coupon-two-countdown-text').hide();
            jQuery(this).html(upc_main_js.expired_text).parent().addClass('disabled');
        });
    });
});

jQuery(document).ready(function($){
    
    // For social share
    $('.fb-share,.tw-share,.go-share').click(function(e) {
        e.preventDefault();
        window.open($(this).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
        return false;
    });
    
    /*
     * Vote System
     */
    $('a[class^=upc-vote]').click(function(e){
        e.preventDefault();
        var $this = $(this), 
            coupon_id = $this.data('id'),
            meta = "up",
            el_sibling_percentage = $this.siblings(".upc-vote-percent"),
            el_percentage = $('.upc-vote-percent[data-id='+coupon_id+']');
        
        if($this.hasClass("upc-vote-down")){
            meta = "down";
        }
        var data = {
			'action': 'upc_vote',
			'meta' : meta, 
			'coupon_id' : coupon_id,
		};

        jQuery.post(upc_object.ajaxurl, data, function(response) {
                if(response === "Failed"){
                    displayMsg(upc_main_js.vote_failed,el_percentage,2000);
                }else if (response === "voted"){
                    displayMsg(upc_main_js.vote_already,el_sibling_percentage,2000);
                }else{
                    displayMsg(upc_main_js.vote_success,el_percentage,2000);
                    setTimeout(function(){
                        displayMsg(response,el_percentage,0);
                    },2000);
                    
                }
        });
        
        /*
         * This function dispaly msg in a specific element for a little time
         * 
         * @param string 'Msg' is the message that will be displayed in the element
         * @param object 'el' is the element
         * @param int 'Time' is the time in milliSecond or 0 if this will be the text for ever
         */
        function displayMsg(Msg,el,Time = 0){
            
            if(typeof(el) === "object"){
                if(Time === 0){
                    el.html(Msg);
                }else{
                    var old_text = el.html();
                    el.html(Msg);
                    setTimeout(function(){
                        el.html(old_text);
                    },Time);
                }
            }
        }
    });
});

jQuery(document).ready(function ($) {
    var num_words = Number(

upc_main_js.word_count);
    var full_description = $('.upc-full-description');
    var more = $('.upc-more-description');
    var less = $('.upc-less-description');
    full_description.each(function () {
        $this = $(this);

        var full_content = $this.html();
        var check = full_content.split(' ').length > num_words;
        if (check) {
            var short_content = full_content.split(' ').slice(0, num_words).join(' ');
            $this.siblings('.upc-short-description').html(short_content + '...');
            $this.hide();
            $this.siblings('.upc-less-description').hide();
        } else {
            $(this).siblings('.upc-more-description').hide();
            $(this).siblings('.upc-more-description');
            $(this).siblings('.upc-less-description').hide();
            $(this).siblings('.upc-short-description').hide();
        }
    });
    // more and less link
    more.click(function (e) {
        e.preventDefault();
        $(this).siblings('.upc-full-description').show();
        $(this).siblings('.upc-less-description').show();
        $(this).siblings('.upc-short-description').hide();
        $(this).hide();

    });
    less.click(function (e) {
        e.preventDefault();
        $(this).siblings('.upc-short-description').show();
        $(this).siblings('.upc-more-description').show();
        $(this).siblings('.upc-full-description').hide();
        $(this).hide();
    });
    /*var newUrl = "?page=" + $(this).val() + "&" + $.param(params);
     var newUrl = location.href.replace("page="+currentPageNum, "page="+newPageNum);*/
});

jQuery(document).ready(function ($) {
    $(document).ready(function () {
        $('.masterTooltip').hover(function () {
            var title = $(this).attr('title');
            $(this).data('tipText', title).removeAttr('title');
            $('<p class="tooltip"></p>')
                .text(title)
                .appendTo('body')
                .fadeIn('slow');
        }, function () {
            $(this).attr('title', $(this).data('tipText'));
            $('.tooltip').remove();
        }).mousemove(function (e) {
            var mousex = e.pageX + 20;
            var mousey = e.pageY + 10;
            $('.tooltip')
                .css({top: mousey, left: mousex})
        });
    });

    
/* Premium Code Stripped by Freemius */


    
/* Premium Code Stripped by Freemius */


});

jQuery(document).ready(function ($) {

    $(window).resize(updateCouponSixClass);

    function updateCouponSixClass() {
        $.each($('.upc-coupon-six'), function () {
            if ($(this).width() > 600)
                $(this).removeClass('upc-coupon-six-mobile');
            else
                $(this).addClass('upc-coupon-six-mobile');
        });
    }

    updateCouponSixClass();
});

jQuery(document).ready(function ($) {

    $(window).resize(updateCouponFiveClass);

    function updateCouponFiveClass() {
        $.each($('.upc-template-five'), function () {
            if ($(this).width() > 600)
                $(this).removeClass('upc-template-five-mobile');
            else
                $(this).addClass('upc-template-five-mobile');
        });
    }

    updateCouponFiveClass();
});

function wpcdCopyToClipboard(element) {
    var $temp = jQuery("<input>");
    jQuery("body").append($temp);
    $temp.val(jQuery(jQuery(element)[0]).text()).select();
    document.execCommand("copy");
    $temp.remove();
}

function wpcdOpenCouponAffLink(CoupenId) {
    var a = jQuery("#coupon-button-" + CoupenId);
    var oldLink = a.attr('href');


    if (window.location.href.indexOf('upc_coupon') > -1) {
		// check if there'upc_coupon in the url
        var upc_id = jQuery.urlParam('upc_coupon');
        oldLink = window.location.href.replace("upc_coupon=" + upc_id, "upc_coupon=" +CoupenId);

    }
    else if (window.location.href.indexOf('?') > -1 &&
	window.location.href.indexOf('?upc_coupon') === -1) {
		// check if there's paramater in the url   
        oldLink = window.location.href + oldLink.replace("?", "&");
    }
    a.attr('href', oldLink);

    //the affiliate link
    var theLink = a.attr("data-aff-url");
    window.open(a.attr('href'), '_blank');
    window.location = theLink;
    return false;
}
   


//my custom function
jQuery(document).ready(function ($) {
    $(document).ready(function () {
		
		//alert('main js hai');
		
		
		jQuery(".upc_copy_class").on("click",function()
		{
			//alert('upc copy class');
		
			
			
			var merchant_id=$(this).attr('merchant_id');
			var coupon_id=$(this).attr('coupon_id');
			//ajaxurl=jQuery(this).attr('ajax_url');
			//alert('coupon id'+coupon_id);
			var data={
				action:'upc_confirmation_form',
				merchant_id:merchant_id,
				coupon_id:coupon_id
				};
				$.ajax({
					type:"POST",
					 url: upc_object.ajaxurl,
					 data:data,
					 cache:false,
					 error:function(data)
					 {
						 alert("error");
						 console.log(data);
					 },
					 success:function(data)
					 {
						// alert(data);
						 console.log(data);
						 jQuery("body").append('<div id="myModal_'+coupon_id+'" class="modal fade" role="dialog"></div>');
						   jQuery("#myModal_"+coupon_id).html(data);
						  jQuery("#myModal_"+coupon_id).modal();
					 }
			
			
		});
		 
		
	});
	
	
	
		

	
});
});
   
   //copy code from input box
	
	
	function upc_myFunction() {
	
  var copyText = document.getElementById("upc_myInput");
  copyText.select();
  document.execCommand("copy");
  jQuery("#copied").show();
  //alert("Copied the text: " + copyText.value);
}

//my hide function
function upc_myhideFunction() {
	var redirection=jQuery("#hide_code").val();
 new Clipboard('#hide_code_click');
  window.location.href=redirection;
}

//my custom function
jQuery(document).ready(function ($) {
    $(document).ready(function () {
		
		//alert('admin js hai');
		
		$("#upc_add_refrresh_btn").on('click',function()
		{
			//alert('refresh ');
			window.location.reload();
		});
		
		
		
	
		
		//description
		
		$(".descriptioncontent").on('click',function()
	  {
		 // alert('hai');
		  var id=$(this).attr('data-id');
		 $('.content_'+id).toggleClass('hide');
	  });
		
		
	});
});
