// Shows or hides fields according to user inputs.
jQuery(document).ready(function ($) {

    //variables
    var templates = {
        ONE: 'Template One',
        TWO: 'Template Two',
        THREE: 'Template Three',
        FOUR: 'Template Four',
        FIVE: 'Template Five',
        SIX: 'Template Six'
    };
    var couponTypes = {
        COUPON: 'Coupon',
        DEAL: 'Deal',
        IMAGE: 'Image'
    };
    var button_text = $('#buttontext');
    var all_button_text = $('[id$=buttontext]');
    var deal_text = $('#dealtext');
    var show_expiration = $('#show-expiration');
    var expiration = $('#expiredate');
    var time_expiration = $('#expiretime');
    var never_expire = $('#neverexpire-checkbox'); // the wrraper of the checkbox
    var never_expire_check = $('#never-expire-check');//the checkbox itself
    var coupon_template = $('#coupon-template');
    var hide_coupon = $('#hide-coupon');
    var coupon_hidden = $('.upc-coupon-hidden');
    var coupon_not_hidden = $('.upc-coupon-not-hidden');
    var hide_coupon_parent = hide_coupon.closest('tr');
    var fields_temp4 = $('[id^=temp4]');
    var allexpiration = $('[id$=expiredate]');
    var featuredImage = $('#_thumbnail_id');
    var templateFiveThemeField = $('.template-five-theme-field');
    var templateFiveTheme = $('#template-five-theme');
    var templateSixThemeField = $('.template-six-theme-field');
    var templateSixTheme = $('#template-six-theme');
 
    //initializations
    initCouponTemplate();

    initExpirationSelectField();

    coupon_deal_change();

    initHideCouponField();

    //events
    $('[name="show-expiration"]').on('change', onExpirationSelectFieldChange);

    coupon_template.on('change', onCouponTemplateFieldChange);

    //on coupon type change
    $('[name="coupon-type"]').on('change', coupon_deal_change);


    hide_coupon.on('change', onHideCouponFieldChange);
    
    //on neverexpire checkbox change
    $(never_expire_check).on('change', onNeverExpireCheckboxChange);
    
    //on featured image set
    wp.media.featuredImage.frame().on('select', function () {
        var frame = wp.media.featuredImage.frame();
        var attachment = frame.state().get('selection').first().toJSON();
        $('.upc-template-five-pro-img')
            .children('img')
            .attr('src', attachment.url);
        $('.upc-coupon-six-img-and-btn')
            .find('img')
            .attr('src', attachment.url);
        //on featured image remove
        setTimeout(function () {
            removeFeaturedImage();
        }, 1000);
    });

    removeFeaturedImage();

    jQuery("#upc_import_form").submit(function () {
        jQuery(".upc_import_form_loader").fadeIn();
    });

    jQuery("#upc_import_form_final").submit(function () {
        var status = 'no';
        jQuery(".upc_import_field_select").each(function () {
            var import_key = jQuery(this).val();
            if (import_key == 'coupon_title') {
                status = 'yes';
            }
        });
        if (status == 'yes') {
            jQuery(".upc_import_form_final_loader").fadeIn();
            return true;
        } else {
            jQuery(".upc_import_notes").show();
            jQuery(".upc_import_form_final_loader").fadeOut();
            return false;
        }
    });


    $(document).on('change', 'input[name="template-five-theme"]', function () {
        updateTemplateFiveTheme($(this).val());
    });

    $(document).on('change', 'input[name="template-six-theme"]', function () {
        updateTemplateSixTheme($(this).val());
    });

    //functions 
    function coupon_deal_change() {
        var ctype = $('[name="coupon-type"]').val();

        $('#coupon-type').closest('tr').nextAll().removeClass('hide');
        $('.coupon-image-field').addClass('hide');
        $('.only-coupon-code').removeClass('hide');

        if (ctype === couponTypes.COUPON) {

            if (coupon_template.val() === templates.FOUR)
                all_button_text.show();
            else
                button_text.show();

            deal_text.hide();
            hide_coupon_parent.show();

        } else if (ctype === couponTypes.DEAL) {

            all_button_text.hide();
            deal_text.show();
            hide_coupon_parent.hide();
            hide_coupon.val('No');
            coupon_not_hidden.show();
            coupon_hidden.hide();

        } else if (ctype === couponTypes.IMAGE) {
            $('.only-coupon-code').addClass('hide');
            $('#coupon-type').closest('tr').nextAll().addClass('hide');
            $('.coupon-image-field').removeClass('hide');
            $('#text').removeClass('hide');

        }
    }

    function initCouponTemplate() {
        var currentTemplate = coupon_template.val();
         
        if (
            currentTemplate === templates.TWO ||
            currentTemplate === templates.SIX
        ) {
            time_expiration.show();
            expiration.show();
            show_expiration.hide();
            never_expire.show();
        } else {
            time_expiration.hide();
            never_expire.hide();
        }

        if (currentTemplate === templates.FOUR) {
            fields_temp4.show();
        } else {
            fields_temp4.hide();
        }

        if (currentTemplate === templates.FIVE) {
            templateFiveThemeField.show();
        } else {
            templateFiveThemeField.hide();
        }

        if (currentTemplate === templates.SIX) {
            templateSixThemeField.show();
        } else {
            templateSixThemeField.hide();
        }

        coupon_deal_change();
    }

    function initExpirationSelectField() {
        /*if ($('#show-expiration').val() === 'Show') {
            expiration.show("slow");
            if (coupon_template.val() === templates.FOUR)
                $('[id$=expiredate]').show('slow');
        } else {
            allexpiration.hide();
        }*/
        updateExpirationSelectField($('#show-expiration').val());
    }

    function initHideCouponField() {
        if (hide_coupon.val() === 'Yes') {
            coupon_hidden.show();
            coupon_not_hidden.hide();
        } else {
            coupon_hidden.hide();
            coupon_not_hidden.show();
        }
        
        if(never_expire_check.prop('checked')){
            $('b.expires-on').toggle();
            $('b.never-expire').toggle();
        }
    }
    function onExpirationSelectFieldChange() {
        updateExpirationSelectField($(this).val());
    }

    function updateExpirationSelectField(val) {
        if (val === 'Show') {
            expiration.show("slow");
            $('.with-expiration1').removeClass('hide-expire-preview');
            $('.without-expiration1').removeClass('hide-expire-preview');
            if (coupon_template.val() === templates.FOUR) {
                $('[id$=expiredate]').show('slow');
                $('.with-expiration-4-2').removeClass('hide-expire-preview');
                $('.without-expiration-4-2').removeClass('hide-expire-preview');
                $('.with-expiration-4-3').removeClass('hide-expire-preview');
                $('.without-expiration-4-3').removeClass('hide-expire-preview');
            }
        } else {
            $('.with-expiration1').addClass('hide-expire-preview');
            $('.without-expiration1').addClass('hide-expire-preview');
            $('.with-expiration-4-2').addClass('hide-expire-preview');
            $('.without-expiration-4-2').addClass('hide-expire-preview');
            $('.with-expiration-4-3').addClass('hide-expire-preview');
            $('.without-expiration-4-3').addClass('hide-expire-preview');
            allexpiration.hide();
        }
    }

    function onCouponTemplateFieldChange() {
        var currentTemplate = $(this).val();

        if (
            currentTemplate === templates.TWO ||
            currentTemplate === templates.SIX
        ) {
            time_expiration.show("slow");
            expiration.show("slow");
            show_expiration.hide();
            never_expire.show();
        } else {
            time_expiration.hide();
            show_expiration.show();
            never_expire.hide();
        }

        if (currentTemplate === templates.FOUR) {
            fields_temp4.show();
        } else {
            fields_temp4.hide();
        }

        if (currentTemplate === templates.FIVE) {
            templateFiveThemeField.show();
        } else {
            templateFiveThemeField.hide();
        }

        if (currentTemplate === templates.SIX) {
            templateSixThemeField.show();
        } else {
            templateSixThemeField.hide();
        }

        coupon_deal_change();
    }

    function onHideCouponFieldChange() {
        if ($(this).val() === 'Yes') {
            coupon_hidden.show();
            coupon_not_hidden.hide();
        } else {
            coupon_hidden.hide();
            coupon_not_hidden.show();
        }
    }
    
    function onNeverExpireCheckboxChange(){
        var checked = $(this).prop('checked');
        $('b.expires-on').toggle();
        $('b.never-expire').toggle();
        
    }

    function updateTemplateFiveTheme(color) {
        $('.upc-template-five') .css('border-color', color);

        $('.upc-template-five-exp') .css('background-color', color);

        $('.upc-template-five-btn').css('border-color', color);

        $('.upc-template-five-btn p')
            .css('color', color);
        $('.upc-template-five .get-code-wpcd')
            .css('background-color', color);
        $('.upc-template-five .get-code-wpcd > div')
            .css('border-left-color', color);

    }

    function updateTemplateSixTheme(color) {
        var couponSix = $('.upc-coupon-six');

        couponSix.css('border-color', color);

        couponSix.find('.upc-ribbon')
            .css('background-color', color);

        couponSix
            .find('.coupon-code-button')
            .css('border-color', color)
            .css('color', color);

        couponSix
            .find('.upc-coupon-six-texts .exp')
            .css('border-color', color);

        couponSix
            .find('.get-code-wpcd')
            .css('background-color', color);

        couponSix
            .find('.get-code-wpcd > div')
            .css('border-left-color', color);

        couponSix
            .find('.upc-ribbon-before')
            .css('border-left-color', color);

        couponSix
            .find('.upc-ribbon-after')
            .css('border-right-color', color);

        couponSix
            .find('.upc-coupon-hidden .coupon-button')
            .css('border-color', color);

    }

    function removeFeaturedImage() {
        $('#remove-post-thumbnail').on('click', function () {
            var dummySrc = $('.upc-template-five-pro-img')
                .children('img')
                .data('src');
            $('.upc-template-five-pro-img')
                .children('img')
                .attr('src', dummySrc);

            dummySrc = $('.upc-coupon-six-img-and-btn')
                .find('img')
                .data('src');
            $('.upc-coupon-six-img-and-btn')
                .find('img')
                .attr('src', dummySrc);
        });
    }

});

// For tabs , colorpicker and choosing of type of shortcode
jQuery(document).ready(function ($) {

    /**
     * Function tabs
     * used in tabs of setting page
     * @returns void
     */
    window.tabs = function () {
        //$('form').append($('.tabs .form-table'));
        $($('.upc_settings_section .nav-tab-wrapper .form-table').get().reverse()).each(function () {
            $(this).insertAfter('.nav-tab-wrapper');
        });
        var tabs = $('.upc_settings_section button.nav-tab'),
            active = $('.upc_settings_section .nav-tab.active'),
            index_active = tabs.index(active),
            tabs_contents = $('.upc_settings_section .nav-tab-wrapper').siblings('.form-table'),
            active_content = tabs_contents.eq(index_active);
        if (!tabs) {
            retutn;
        }

        /**
         * hide all tabs
         * except the active one
         */
        tabs_contents.each(function () {
            $(this).hide();
        });
        active_content.show();

        /**
         * change the tab content when click
         * by giving the button active class
         */
        tabs.each(function () {
            $(this).click(function (e) {
                // check if the active and the clicked button is not the same
                if ($(this)[0] !== active[0]) {
                    $(this).addClass('active');
                    active.removeClass('active');

                    //call the function to show the active content
                    window.tabs();
                }
            });
        });
    };
    window.tabs();

    /**
     * For color pickers
     */

    var upc_colorSelectors = $('.upc_colorSelectors');
    if ($.isFunction($(upc_colorSelectors[0]).ColorPicker))
        for ($i = 0; $i < upc_colorSelectors.length; $i++) {
            $(upc_colorSelectors[$i]).ColorPicker({
                onShow: function (colpkr) {
                    $(colpkr).fadeIn(500);
                    return false;
                },
                onHide: function (colpkr) {
                    $(colpkr).fadeOut(500);
                    return false;
                },
                onChange: function (hsb, hex, rgb) {
                    $this = $('#' + this.data('targetid'));
                    
                    $this.children('div').css('backgroundColor', '#' + hex);
                    $this.children('input').val('#' + hex);
                    $this.children('input').trigger('change');
                }
            });
        }
    
    /**
     *  color Picker for import Page
     */
    var select_temp_import = $('select[name="upc_default_template"]');
    if(select_temp_import.length){
        function is_temp_has_color(){
            var selected_theme = $('select[name="upc_default_template"]').val();
            
            // Template Five and Six has color picker
            if(selected_theme == 'Template Five' || 
                    selected_theme == 'Template Six'){
                $('#upc_import_color_parent').show();
            }else{
                $('#upc_import_color_parent').hide();
            }
        }
        is_temp_has_color();
        
        select_temp_import.change(function(){
           is_temp_has_color();
        });
    }
    /**
     * for widget category filter
     */
    window.widget;

    function categoryFilterWidget() {
        var category_filter_select_widget = $('.coupon_category_filter_select_widget');

        category_filter_select_widget.each(function () {
            //you are in widget page
            window.widget = 1;

            //hide all coupons
            $(this).parent().next().children('datalist').children('option[category-title]').prop('disabled', true);

            //show the coupony of the selected category
            $(this).parent().next().children('datalist').children('option[category-title="' + $(this).val() + '"]').prop('disabled', false);

            $(this).change(function () {
                $(this).parent().next().children('input').val('');
                //hide all coupons
                $(this).parent().next().children('datalist').children('option[category-title]').prop('disabled', true);

                //show the coupony of the selected category
                $(this).parent().next().children('datalist').children('option[category-title="' + $(this).val() + '"]').prop('disabled', false);
            });
        });
    }

    categoryFilterWidget();
    //a trigger when adding a new widget
    $('body').bind('upc_add_widget', function () {
        categoryFilterWidget();
    });


    //Feature of choosing Archive , category or Single shortcode
    window.coupons_shortcode_type = $('#coupons_shortcode_type');

    //for archive
    window.coupons_style_select = $('#coupons_style_select');
    window.coupons_template_select = $('#coupons_template_select');
    window.coupons_count = $('#upc_coupon_count');

    //for category
    window.coupons_style_category_select = $('#coupons_style_category_select');
    window.coupons_template_category_select = $('#coupons_template_category_select');
    
    //for vendor
    window.coupons_style_vendor_select = $('#coupons_style_vendor_select');
    window.coupons_template_vendor_select = $('#coupons_template_vendor_select');

    function WpcdCouponChoosingInsert() {
        function displayNoneforAll() {
            $('.shortcode_inserter_select').not('.upc_types_select').hide();
        }

        displayNoneforAll();
        if (coupons_shortcode_type.val() === 'archive') {
            $('.shortcode_inserter_select.upc_style_select, .shortcode_inserter_select.upc_coupon_count').show();

            //check if horizontal style chosen
            if ($('#coupons_style_select').val() === 'horizontal')
                $('.shortcode_inserter_select.upc_template_select').show();
            else
                $('.shortcode_inserter_select.upc_template_select').hide();


            $('#coupons_style_select').change(function () {
                WpcdCouponChoosingInsert();
            });

        } else if (coupons_shortcode_type.val() === 'category') {
            $('.shortcode_inserter_select.upc_categories_selec.shortcode_inserter_select.upc_coupon_count').show();
            $('.shortcode_inserter_select.upc_style_category_select').show();
            //check if horizontal style chosen
            if ($('#coupons_style_category_select').val() === 'horizontal')
                $('.shortcode_inserter_select.upc_template_category_select').show();
            else
                $('.shortcode_inserter_select.upc_template_category_select').hide();

            $('#coupons_style_category_select').change(function () {
                WpcdCouponChoosingInsert();
            });

        } else if (coupons_shortcode_type.val() === 'vendor') {
            $('.shortcode_inserter_select.upc_vendors_select, .shortcode_inserter_select.upc_coupon_count').show();
            $('.shortcode_inserter_select.upc_style_vendor_select').show();
            //check if horizontal style chosen
            if ($('#coupons_style_vendor_select').val() === 'horizontal')
                $('.shortcode_inserter_select.upc_template_vendor_select').show();
            else
                $('.shortcode_inserter_select.upc_template_vendor_select').hide();

            $('#coupons_style_vendor_select').change(function () {
                WpcdCouponChoosingInsert();
            });

        } else if (coupons_shortcode_type.val() === 'single') {
            if (window.widget === 1)
                return;
            $('.shortcode_inserter_select.upc_coupons_select').show();
            $('.shortcode_inserter_select.upc_type_select').show();
            //filter Category select
            $('.shortcode_inserter_select.upc_category_filter_select').show();

            //The datalist element
            var coupon_select = $('#coupon_list');

            //hide all option that have category
            coupon_select.children('option[category-title]').prop('disabled', true);

            //show the coupony of the selected category
            $('option[category-title="' + $('#select_category_filter').val() + '"]').prop('disabled', false);
            $('#select_category_filter').change(function () {
                $('#coupon_select').val("");
                WpcdCouponChoosingInsert();
            });

        } else { // free version
            $('.shortcode_inserter_select.upc_coupons_select').show();
            $('.shortcode_inserter_select.upc_type_select').show();
        }

    }

    WpcdCouponChoosingInsert();
    coupons_shortcode_type.change(function () {
        WpcdCouponChoosingInsert();

        //resize the window
        thickbox_resize();
    });
    
});



/* Premium Code Stripped by Freemius */


//Inserts coupon shortcode.
function UpcCouponInsertFree() {
    var $coupon_select = jQuery('option[value="' + jQuery('#coupon_select').val() + '"]');
    var coupon_shortcode_type = jQuery("#coupon_shortcode_type");
    var coupon_id = $coupon_select.attr('coupon-id');
    if (coupon_shortcode_type.val() === 'coupon') {
        window.send_to_editor("[upc_coupon id=" + coupon_id + "]");
    } else if (coupon_shortcode_type.val() === 'code') {
        window.send_to_editor("[upc_code id=" + coupon_id + "]");
    }else if (coupon_shortcode_type.val() === 'vertical') {
        window.send_to_editor("[upc_coupon_vertical id=" + coupon_id + "]"); 
	   }

}

//Update Counter on date Change
function update_two_counter_date(data) {
    jQuery('[id^=clock_two_').show();
    var coup_date = data;
    if (coup_date.indexOf("-") >= 0) {
        var dateAr = coup_date.split('-');
        coup_date = dateAr[1] + '/' + dateAr[0] + '/' + dateAr[2];
    }
    selectedDate = coup_date + ' ' + jQuery("#expire-time").val();
   // $clock.countdown(selectedDate.toString());
}

function update_six_counter_date(data) {
    jQuery('[id^=clock_six_').show();
    var coup_date = data;
    if (coup_date.indexOf("-") >= 0) {
        var dateAr = coup_date.split('-');
        coup_date = dateAr[1] + '/' + dateAr[0] + '/' + dateAr[2];
    }
    selectedDate = coup_date + ' ' + jQuery("#expire-time").val();
    //$clock2.countdown(selectedDate.toString());
}

//Adding the tooltip to show when hovered.
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
});

//Resizes the coupon inserter popup.
function thickbox_resize() {
    jQuery(function ($) {
        var $thickbox = $("#TB_window");
        if ($thickbox.find(".upc_shortcode_insert").length > 0) {
            var coupon_inserter_height = $('.upc_shortcode_insert').outerHeight() + $('.upc_shortcode_insert-bt').outerHeight() + $('#TB_title').outerHeight();
            var $ajax_content = $("#TB_ajaxContent");
            $thickbox.height((coupon_inserter_height - 20));
            $ajax_content.height((coupon_inserter_height));
            $ajax_content.css({'width': '100%', 'padding': '0'});
        }
    });
}

jQuery(function ($) {
    $('#upc_add_shortcode').on('click', function () {
        setTimeout(function () {
            thickbox_resize();
        }, 10);
    });
    $(window).on('resize load', function () {
        thickbox_resize();
    });
});

//Default preview metabox.
jQuery(document).ready(function ($) {

    $(function () {

        //change title dynamically
        $('#title').keyup(function () {
            var title = $(this).val();
            $('.upc-coupon-title').text(title);
            $('.upc-coupon-one-title').text(title);
            $('.upc-coupon-three-title').text(title);
            $('.upc-coupon-four-title').text(title);
            $('.upc-coupon-five-title').text(title);
            $('.upc-coupon-six-title').text(title);
        });

        //change description dynamically (this works only with text editor)
        $('#description').keyup(function () {
            var description = $(this).val();
            $('.upc-coupon-description').html(description);
        });

        //if the user used one of the button instead of writing the code
        $('#description').change(function () {
            var description = $(this).val();
            $('.upc-coupon-description').html(description);
        });

        $('#discount-text').keyup(function () {
            var discount_text = $(this).val();
            $('.upc-coupon-discount-text').text(discount_text);
            $('.upc-coupon-one-discount-text').text(discount_text);
            $('.upc-coupon-two-discount-text').text(discount_text);
            $('.upc-four-discount-text').eq(0).text(discount_text);
            $('.upc-coupon-five-discount-text').text(discount_text);
            $('.upc-coupon-six-discount-text').text(discount_text);
        });

        $('#second-discount-text').keyup(function () {
            var discount_text = $(this).val();
            $('.upc-four-discount-text').eq(1).text(discount_text);
        });

        $('#third-discount-text').keyup(function () {
            var discount_text = $(this).val();
            $('.upc-four-discount-text').eq(2).text(discount_text);
        });

        $('#coupon-code-text').keyup(function () {
            var coupon_code_text = $(this).val();
            $.each($('.upc-coupon-preview'), function () {
                $(this).find('.coupon-code-button:eq(0)').text(coupon_code_text)
            });
        });

        $('#second-coupon-code-text').keyup(function () {
            var coupon_code_text = $(this).val();
            $('.upc-coupon-four')
                .find('.coupon-code-button:eq(1)')
                .text(coupon_code_text)
        });

        $('#third-coupon-code-text').keyup(function () {
            var coupon_code_text = $(this).val();
            $('.upc-coupon-four')
                .find('.coupon-code-button:eq(2)')
                .text(coupon_code_text)
        });


        $('#deal-button-text').keyup(function () {
            var deal_code_text = $(this).val();
            $('.deal-code-button').text(deal_code_text);
            $('.upc-coupon-one-btn').text(deal_code_text);
        });

        var coupon_code_div = $('.upc-coupon-code');
        var deal_code_div = $('.upc-deal-code');
        var coupon_one_coupon = $('.upc-coupon-one-coupon');
        var coupon_one_deal = $('.upc-coupon-one-deal');
        var coupon_two_coupon = $('.upc-coupon-two-coupon-code');
        var coupon_two_deal = $('.upc-coupon-two-deal');
        var coupon_three_coupon = $('.upc-coupon-three-coupon-code');
        var coupon_three_deal = $('.upc-coupon-three-deal');


        if ($('#coupon-type').val() === 'Coupon') {
            coupon_code_div.show();
            coupon_one_coupon.show();
            coupon_two_coupon.show();
            coupon_three_coupon.show();
            deal_code_div.hide();
            coupon_one_deal.hide();
            coupon_two_deal.hide();
            coupon_three_deal.hide();
        } else {
            coupon_code_div.hide();
            coupon_one_coupon.hide();
            coupon_two_coupon.hide();
            coupon_three_coupon.hide();
            deal_code_div.show();
            coupon_one_deal.show();
            coupon_two_deal.show();
            coupon_three_deal.show();
        }

        $('[name="coupon-type"]').on('change', function () {
            if ($(this).val() === 'Coupon') {
                $('.coupon-type').text('Coupon');
                coupon_code_div.show("slow");
                coupon_one_coupon.show();
                deal_code_div.hide("slow");
                coupon_one_deal.hide();
            } else {
                $('.coupon-type').text('Deal');
                coupon_code_div.hide("slow");
                coupon_one_coupon.hide();
                deal_code_div.show("slow");
                coupon_one_deal.show();
            }
        });

    });

});

//Changing templates.
jQuery(document).ready(function ($) {
    var templates = {
        DEFAULT: 'Default',
        ONE: 'Template One',
        TWO: 'Template Two',
        THREE: 'Template Three',
        FOUR: 'Template Four',
        FIVE: 'Template Five',
        SIX: 'Template Six'
    };
    var couponTypes = {
        COUPON: 'Coupon',
        DEAL: 'Deal',
        IMAGE: 'Image'
    }
    var previewWrap = $('#coupon_preview');
    var couponPreview = previewWrap.find('.upc-coupon-preview');
    var couponDefault = $('.upc-coupon');
    var couponOne = $('.upc-coupon-one');
    var couponTwo = $('.upc-coupon-two');
    var couponThree = $('.upc-coupon-three');
    var couponFour = $('.upc-coupon-four');
    var couponFive = $('.upc-coupon-five');
    var couponSix = $('.upc-coupon-six');
    var couponImage = $('.upc-coupon-image');
    var couponTemplate = $('#coupon-template');
    var couponType = $('[name="coupon-type"]');

    showTemplatePreview(couponType.val(), couponTemplate.val());

    couponType.on('change', function () {
        showTemplatePreview($(this).val(), couponTemplate.val());
    });

    couponTemplate.on('change', function () {
        showTemplatePreview(couponType.val(), $(this).val());
    });

    function showTemplatePreview(ctype, currentTemplate) {
        couponPreview.hide();
        if (ctype === couponTypes.IMAGE) {
            couponImage.show("slow");
        } else if (currentTemplate === templates.DEFAULT) {
            couponDefault.show('slow');
        } else if (currentTemplate === templates.ONE) {
            couponOne.show("slow");
        } else if (currentTemplate === templates.TWO) {
            couponTwo.show("slow");
        } else if (currentTemplate === templates.THREE) {
            couponThree.show("slow");
        } else if (currentTemplate === templates.FOUR) {
            couponFour.show("slow");
        } else if (currentTemplate === templates.FIVE) {
            couponFive.show("slow");
        } else if (currentTemplate === templates.SIX) {
            couponSix.show("slow");
        }
    }

});

// upload coupon image
jQuery(function ($) {

    // Set all variables to be used in scope
    var frame,
        metaBox = $('#coupon-details.postbox'), // Your meta box id here
        addImgLink = metaBox.find('.upload-coupon-img'),
        delImgLink = metaBox.find('.delete-coupon-img'),
        imgContainer = metaBox.find('.coupon-img-container'),
        imgIdInput = metaBox.find('#coupon-image-input');

    // ADD IMAGE LINK
    addImgLink.on('click', function (event) {

        event.preventDefault();

        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Media Of Your Chosen Persuasion',
            button: {
                text: 'Use this media'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });


        // When an image is selected in the media frame...
        frame.on('select', function () {

            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();

            // Send the attachment URL to our custom image input field.
            imgContainer.append('<img src="' + attachment.url + '" alt="" style="max-width:100%;"/>');
            //update coupon preview
            $('.upc-coupon-image img').attr('src', attachment.url);
            // Send the attachment id to our hidden input
            imgIdInput.val(attachment.id);

            // Hide the add image link
            addImgLink.addClass('hidden');

            // Unhide the remove image link
            delImgLink.removeClass('hidden');
        });

        // Finally, open the modal on click
        frame.open();
    });


    // DELETE IMAGE LINK
    delImgLink.on('click', function (event) {

        event.preventDefault();

        // Clear out the preview image
        imgContainer.html('');

        // Un-hide the add image link
        addImgLink.removeClass('hidden');

        // Hide the delete image link
        delImgLink.addClass('hidden');

        // Delete the image id from the hidden input
        imgIdInput.val('');

        $('.upc-coupon-image img').attr('src', '');

    });

});


//expire date changes
jQuery(function ($) {
    var couponPreview = $('.upc-coupon-preview');
    var coupon4preview = $('.upc-coupon-four');

    //update manually
    $('[id$=expire-date]').on('change', function () {
        var val = $(this).val();
        var withExpireBlock, withoutExpireBlock;

        if ($(this).attr('id').search('third') !== -1) {
            withExpireBlock = couponPreview.find('.with-expiration-4-3');
            withoutExpireBlock = couponPreview.find('.without-expiration-4-3');
        } else if ($(this).attr('id').search('second') !== -1) {
            withExpireBlock = couponPreview.find('.with-expiration-4-2');
            withoutExpireBlock = couponPreview.find('.without-expiration-4-2');
        } else {
            withExpireBlock = couponPreview.find('.with-expiration1');
            withoutExpireBlock = couponPreview.find('.without-expiration1');
        }

        if (val || val.trim().length > 0) {
            withExpireBlock.removeClass('hidden');
            withoutExpireBlock.addClass('hidden');
        } else {
            withExpireBlock.addClass('hidden');
            withoutExpireBlock.removeClass('hidden');
        }
    });

    //update through widget
    $('[id$=expire-date]').datepicker({
        dateFormat: $('[id$=expire-date]').data('expiredate-format'),
        showOtherMonths: true,
        onSelect: function (dateText) {

            $(this).trigger('change');

            var today = (new Date()).setHours(0, 0, 0, 0);
            var isExpired = Date.parse(dateText) < today;
            var expireBlock, expiredBlock;

            if ($(this).attr('id').search('third') !== -1) {

                coupon4preview.find('.expiration-date').eq(4).text(dateText);
                coupon4preview.find('.expiration-date').eq(5).text(dateText);
                expireBlock = couponPreview.find('.expire-text-block3');
                expiredBlock = couponPreview.find('.expired-text-block3');

            } else if ($(this).attr('id').search('second') !== -1) {

                coupon4preview.find('.expiration-date').eq(2).text(dateText);
                coupon4preview.find('.expiration-date').eq(3).text(dateText);
                expireBlock = couponPreview.find('.expire-text-block2');
                expiredBlock = couponPreview.find('.expired-text-block2');

            } else {

                $.each(couponPreview, function () {
                    $(this).find('.expiration-date:eq(0)').text(dateText)
                })
                $.each(couponPreview, function () {
                    $(this).find('.expiration-date:eq(1)').text(dateText)
                })
                expireBlock = couponPreview.find('.expire-text-block1');
                expiredBlock = couponPreview.find('.expired-text-block1');
            }

            if (isExpired) {
                expireBlock.addClass('hidden');
                expiredBlock.removeClass('hidden');
            } else {
                expireBlock.removeClass('hidden');
                expiredBlock.addClass('hidden');
            }

            update_two_counter_date(dateText);
            update_six_counter_date(dateText);
        }
    });
});


function upc_featured_img_func() {
    var imgSrc = jQuery("#set-post-thumbnail img").attr("src");
    var imgDef = jQuery(".upc-default-img").attr("default-img");
    if (typeof imgDef !== "undefined") {
        if (typeof imgSrc !== "undefined") {
            jQuery(".upc-get-fetured-img").attr("src", imgSrc);
        } else {
            jQuery(".upc-get-fetured-img").attr("src", imgDef);
        }
    }
}

function upc_checkDuplicateField(field_key) {
    var data = jQuery("#upc_import_select_" + field_key).val();
    jQuery(".upc_import_field_select").not(document.getElementById("upc_import_select_" + field_key)).each(function () {
        var newdata = jQuery(this).val();
        if (data == newdata) {
            jQuery(this).val("");
        }
    });
}



//my custom function
jQuery(document).ready(function ($) {
    $(document).ready(function () {
		
		//alert('hai');
		
          $("#upc_add_refrresh_btn").on('click',function()
		{
			//alert('refresh ');
			window.location.reload();
		});
		
		
		//get subscriber details
		$("#subscibers").on('click',function()
		{
			//alert('hai');
			var data={action:'get_subscriber_info'};
			$.ajax({
				  type:"POST",
				  data:data,
				  url:ajaxurl,
				  cache:false,
				  error:function(data)
				  {
					  alert('error');
					  console.log(data);
				  },
				  success:function(data)
				  {
					 // alert(data);
					  console.log(data);
					  $("#subscriber_result").html(data);
					  
				
				  }
				  
			});
		});
		
		$("#clear_dashboard").on('click',function()
		{
			window.location.reload();
		});
		
		
		
	});
});