var heateorFblReferrer=null,heateorFblReferrerVal="",heateorFblReferrerTabId="";function heateorFblEmailPopupOptions(e){jQuery(e).is(":checked")?jQuery("#heateor_fbl_email_popup_options").css("display","block"):jQuery("#heateor_fbl_email_popup_options").css("display","none")}function heateorFblSetReferrer(e){jQuery(heateorFblReferrer).val(heateorFblReferrerVal.substring(0,0<heateorFblReferrerVal.indexOf("#")?heateorFblReferrerVal.indexOf("#"):heateorFblReferrerVal.length)+e)}jQuery(document).ready(function(){jQuery("#tabs").tabs(),heateorFblReferrer=jQuery("input[name=_wp_http_referer]"),heateorFblReferrerVal=jQuery("input[name=_wp_http_referer]").val(),(heateorFblReferrerTabId=0<location.href.indexOf("#")?location.href.substring(location.href.indexOf("#"),location.href.length):"")&&heateorFblSetReferrer(heateorFblReferrerTabId),jQuery("#tabs ul a").click(function(){heateorFblSetReferrer(jQuery(this).attr("href"))}),jQuery("#heateor_fbl_gdpr_enable").click(function(){jQuery(this).is(":checked")?jQuery("#heateor_fbl_gdpr_options").css("display","table-row-group"):jQuery("#heateor_fbl_gdpr_options").css("display","none")}),jQuery("#heateor_fbl_login_redirection_column").find("input[type=radio]").click(function(){jQuery(this).attr("id")&&"heateor_fbl_login_redirection_custom"==jQuery(this).attr("id")?jQuery("#heateor_fbl_login_redirection_url").css("display","block"):jQuery("#heateor_fbl_login_redirection_url").css("display","none")}),jQuery("#heateor_fbl_login_redirection_custom").is(":checked")?jQuery("#heateor_fbl_login_redirection_url").css("display","block"):jQuery("#heateor_fbl_login_redirection_url").css("display","none"),jQuery("#heateor_fbl_register_redirection_column").find("input[type=radio]").click(function(){jQuery(this).attr("id")&&"heateor_fbl_register_redirection_custom"==jQuery(this).attr("id")?jQuery("#heateor_fbl_register_redirection_url").css("display","block"):jQuery("#heateor_fbl_register_redirection_url").css("display","none")}),jQuery("#heateor_fbl_register_redirection_custom").is(":checked")?jQuery("#heateor_fbl_register_redirection_url").css("display","block"):jQuery("#heateor_fbl_register_redirection_url").css("display","none"),jQuery(".heateor_fbl_help_bubble").attr("title",heateorFblHelpBubbleTitle),jQuery(".heateor_fbl_help_bubble").click(function(){jQuery("#"+jQuery(this).attr("id")+"_cont").toggle(500)})}),jQuery("html, body").animate({scrollTop:0});