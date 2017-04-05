jQuery(document).ready(function() {
    jQuery('#portfolio_iso_filters li a.index').click(function() {
        var index = jQuery(this).parent().attr('index');
		var category = '#'+jQuery(this).parent().attr('category');
        var cate = jQuery(this).parent().attr('category');
       // console.log(category+' .list_tabs.tab_'+cate);
        // console.log(category+' .' + index+category);
        jQuery(category+' #portfolio_iso_filters li a.index').removeClass('current');
        jQuery(this).addClass('current');
        jQuery(category+' .list_tabs').hide();
        jQuery(category+' .' + index).show();
        return false;
    });
    //jQuery('.open_popup').showPopup({ 
//        top : 50, //kho?ng cách popup cách so v?i phía trên
//    	closeButton: ".close_popup" , //khai báo nút close cho popup
//		scroll : false, //cho phép scroll khi m? popup, m?c d?nh là không cho phép
//    	onClose:function(){            	
//    		//s? ki?n cho phép g?i sau khi dóng popup, cho phép chúng ta g?i 1 s? s? ki?n khi dóng popup, b?n có th? d? null ? dây
//    	}
//    });	
    
    jQuery('#composition li.minus').attr('style','display:none');

	jQuery('#composition li.first').attr('style','display:none');
	
    jQuery('#composition li a.index').click(function() {
		jQuery('#composition li a.index').removeClass('current');
		
        var index = jQuery(this).parent().attr('index');
        var totalR = jQuery('#composition').attr('totalR');
        var current_page = index.replace('page_','');
        var range = 9 ;
        var totalP = Math.ceil(totalR/25);
        var middle = Math.ceil(range/2);
		
        jQuery('#composition li').attr('style','display:none');
		jQuery('#composition li.first').attr('style','display:block');
		jQuery('#composition li.last').attr('style','display:block');
		jQuery('#composition li.minus').attr('style','display:block');
		
		
		if(parseInt(current_page-1) >= 0){
			jQuery('#composition li.minus').attr('index','page_'+parseInt(current_page-1));
			//if(jQuery(this).parent().attr('class') != 'number'){
				jQuery('#composition li[index="page_'+parseInt(current_page)+'"]').find('a').addClass('current');
			//}
			/*else{
				jQuery('#composition li[index="page_'+parseInt(current_page)+'"]').find('a').addClass('current');	
			}*/
		}
		jQuery('#composition li.add').attr('style','display:block');
		var next =parseInt(current_page)+1;
		if(next <= totalP +1){
			
			jQuery('#composition li.add').attr('index','page_'+next);
		}
		
		//jQuery("[index='page_"+parseInt(current_page-2)+"']").children().addClass('current');
		//jQuery('.first').append("<li index='page_1' class='minus'><a class='index current' href='#'><<</a></li>");
        if (totalP < range){
            from = 1;
            to = totalP;
            for (var i=from; i<=to; i++) {
    			if (i >= 1 && i <= totalP) {
    			     if (i == parseInt(current_page)){ jQuery('#composition li[index="page_'+i+'"]').attr('style','display:block');}
    			     else{
    			     jQuery('#composition li[index="page_'+i+'"]').attr('style','display:block');
                     }
    			}
    		}
        }
        else
        {
            //console.log('1111');
            from = parseInt(current_page) - middle + 1;
            to = parseInt(current_page) + middle - 1;
            if (from < 1){
                from = 1;
                to = range;
            }
            else if (to > totalP) 
            {
                to = totalP;
                from = totalP - range + 1;
            }
            for (var i=from; i<=to; i++) {
    			if (i >= 1 && i <= totalP) {
    			     if (i == parseInt(current_page)){ jQuery('#composition li[index="page_'+i+'"]').attr('style','display:block');}
    			     else{
    			     jQuery('#composition li[index="page_'+i+'"]').attr('style','display:block');
                     }
    			}
    		}
        }
      //  console.log(from);
//        console.log(to);
//		console.log(totalP);
		var end = totalP+1;
        if(jQuery('.minus').attr('index') == 'page_0'){	
			jQuery('#composition li.minus').attr('style','display:none');
		}
		if(jQuery('.minus').attr('index') == 'page_0'){	
			jQuery('#composition li.first').attr('style','display:none');
		}
		if(jQuery('.add').attr('index') == 'page_'+end){	
			jQuery('#composition li.add').attr('style','display:none');
		}
		if(jQuery('.add').attr('index') == 'page_'+end){	
			jQuery('#composition li.last').attr('style','display:none');
		}
        //jQuery(this).addClass('current');
		jQuery('#composition li.add').find('a').removeClass('current');
        jQuery('#composition .list_tabs').hide();
        jQuery('#composition .' + index).show();
        return false;
    });
    jQuery('#performance_fliter li a.index').click(function() {
        var index = jQuery(this).parent().attr('index');
        //console.log(index);
        jQuery('#performance_fliter li a.index').removeClass('current');
        jQuery(this).addClass('current');
        jQuery('#performance_section .list_tabs').hide();
        jQuery('#performance_section .' + index).show();
        return false;
    });

    jQuery("#performance_section a.sort-mtd").click(function() {
        jQuery("body").css('overflow', 'hidden');
        jQuery("#performance_section a").removeClass("active");
        var $this = jQuery(this);
        var $sort = $this.attr("sort");
        $this.addClass("active");
        if ($sort === 'asc') {
            jQuery.ajax({
                url: BASE_URL + 'ajax/sort_mtd',
                type: 'post',
                data: 'sort=asc',
                async: false,
                success: function() {
                    window.location.reload();
                }

            });
        } else {
            jQuery.ajax({
                url: BASE_URL + 'ajax/sort_mtd',
                type: 'post',
                data: 'sort=desc',
                async: false,
                success: function() {
                    window.location.reload();
                }

            });
        }

    });

    jQuery("#performance_section a.sort-ytd").click(function() {
        jQuery("body").css('overflow', 'hidden');
        jQuery("#performance_section a").removeClass("active");
        var $this = jQuery(this);
        var $sort = $this.attr("sort");
        $this.addClass("active");
        if ($sort === 'asc') {
            jQuery.ajax({
                url: BASE_URL + 'ajax/sort_ytd',
                type: 'post',
                data: 'sort=asc',
                async: false,
                success: function() {
                    window.location.reload();
                }

            });
        } else {
            jQuery.ajax({
                url: BASE_URL + 'ajax/sort_ytd',
                type: 'post',
                data: 'sort=desc',
                async: false,
                success: function() {
                    window.location.reload();
                }

            });
        }

    });
    jQuery("#provider a").click(function() {
        var provider = jQuery(this).attr('type');
        jQuery.ajax({
            url: BASE_URL + 'ajax/select_provider',
            type: 'post',
            data: 'provider=' + provider,
            async: false,
            success: function() {
                window.location.reload();
            }

        });
    });
    jQuery("#section_membership a.sort-index").click(function() {
        jQuery("body").css('overflow', 'hidden');
        jQuery("#section_membership a").removeClass("active");
        var $this = jQuery(this);
        var $sort = $this.attr("sort");
        $this.addClass("active");
        if ($sort === 'asc') {
            jQuery.ajax({
                url: BASE_URL + 'ajax/sort_membership',
                type: 'post',
                data: 'column=index&sort=asc',
                async: false,
                success: function() {
                    window.location.reload();
                }

            });
        } else {
            jQuery.ajax({
                url: BASE_URL + 'ajax/sort_membership',
                type: 'post',
                data: 'column=index&sort=desc',
                async: false,
                success: function() {
                    window.location.reload();
                }

            });
        }

    });

    jQuery("#section_membership a.sort-ytd").click(function() {
        jQuery("body").css('overflow', 'hidden');
        jQuery("#section_membership a").removeClass("active");
        var $this = jQuery(this);
        var $sort = $this.attr("sort");
        $this.addClass("active");
        if ($sort === 'asc') {
            jQuery.ajax({
                url: BASE_URL + 'ajax/sort_membership',
                type: 'post',
                data: 'column=ytd&sort=asc',
                async: false,
                success: function() {
                    window.location.reload();
                }

            });
        } else {
            jQuery.ajax({
                url: BASE_URL + 'ajax/sort_membership',
                type: 'post',
                data: 'column=ytd&sort=desc',
                async: false,
                success: function() {
                    window.location.reload();
                }

            });
        }

    });

    jQuery("#section_membership a.sort-wgt").click(function() {
        jQuery("body").css('overflow', 'hidden');
        jQuery("#section_membership a").removeClass("active");
        var $this = jQuery(this);
        var $sort = $this.attr("sort");
        $this.addClass("active");
        if ($sort === 'asc') {
            jQuery.ajax({
                url: BASE_URL + 'ajax/sort_membership',
                type: 'post',
                data: 'column=wgt&sort=asc',
                async: false,
                success: function() {
                    window.location.reload();
                }

            });
        } else {
            jQuery.ajax({
                url: BASE_URL + 'ajax/sort_membership',
                type: 'post',
                data: 'column=wgt&sort=desc',
                async: false,
                success: function() {
                    window.location.reload();
                }

            });
        }

    });

    jQuery("#provider > input[type=radio]").click(function() {
        var provider = jQuery(this).val();
        jQuery.ajax({
            url: BASE_URL + 'ajax/select_provider',
            type: 'post',
            data: 'provider=' + provider,
            async: false,
            success: function() {
                window.location.reload();
            }

        });
    });

    if (jQuery("#performance_section > div.section_header > h2").hasClass("current")) {
        window.location.href = "#performance_section";
    }

    if (jQuery("#section_membership > div.section_header > h2").hasClass("current")) {
        window.location.href = "#section_membership";
    }

    jQuery(window).load(function() {
        jQuery("#search-index, .quick-search-input, .input-search").css({
           right: '0px',
           'margin-right': '60px'
        });
        jQuery("#search-company").css({
           right: '0px',
           'margin-right': '200px'
        });
        jQuery("#search-index, #search-company, .quick-search-input, .input-search").fadeIn();
    });

    jQuery("#search-index").autocomplete({
        serviceUrl: BASE_URL + 'ajax/searchIndex',
        minChars: 2,
        type: 'POST',
        noCache: true,
        maxHeight: 200,
        autoSelectFirst: false,
        onSelect: function(suggestion) {
            window.location.href = BASE_URL + 'indice/code/' + suggestion.data;
        }
    });

    jQuery("#search-company").autocomplete({
        serviceUrl: BASE_URL + 'ajax/searchCompany',
        minChars: 2,
        type: 'POST',
        noCache: true,
        maxHeight: 200,
        autoSelectFirst: false,
        onSelect: function(suggestion) {
            window.location.href = BASE_URL + 'company/code/' + suggestion.data;
        }
    });

jQuery(".quick-search-input").each(function() {
		
        var $this = jQuery(this);
        var meta = $this.attr('meta');
		var category = $this.attr('category');
        $this.autocomplete({
            serviceUrl: BASE_URL + 'ajax/searchQuick',
            minChars: 2,
            type: 'POST',
            params: {meta: meta, category:category},
            noCache: true,
            maxHeight: 200,
            autoSelectFirst: false,
            onSelect: function(suggestion) {
                jQuery.ajax({
                    url: BASE_URL + 'ajax/getSearchQuick',
                    type: 'post',
                    data: 'meta=' + meta + '&title=' + suggestion.data + '&category='+category,
                    async: false,
                    success: function(response) {
						
                        var rs = JSON.parse(response);
                        //console.log(meta);
                        jQuery('#' + category).find('.content_' + category).html(rs[0]);
                        jQuery("#btn-"+category).fadeIn();
                        jQuery(".page_"+category).fadeOut();
                    }
                });
            }

        });
    });
    
jQuery('.btn-closep').click(function(i,elem){
        var $this = jQuery(this);
        //var id = $this.attr('id');
        var category = $this.attr('category');
    	//var where = $('#where_'+category).val();
    	//var sort_ = $('#sort_'+category).val();
        jQuery("#search-"+category).val("");
    	jQuery.ajax({
            url: BASE_URL + 'ajax/getSearchQuickReset',
            type: 'post',
            data: 'category='+category,
            async: false,
            success: function(response) {
                var rs = JSON.parse(response);
                jQuery('#' + category).find('.content_' + category).html(rs[0]);
                jQuery("#btn-"+category).fadeIn();
                jQuery(".page_"+category).fadeIn();
                $this.fadeOut();
            }
        });
    });

jQuery('.input-search').each(function(i,elem) {
	 var $this = jQuery(this);
     var id = $this.attr('id');
	 var category = $this.attr('category');
     jQuery("#"+id).autocomplete({
        serviceUrl: BASE_URL + 'ajax/searchGlossary',
        //minChars: 2,
		params:{'category':category},
        type: 'POST',
        noCache: true,
        autoFocus: true,
        maxHeight: 200,
        autoSelectFirst: false,
        onSelect: function(suggestion) {
            var selectedValue = suggestion.data;
            //console.log(suggestion.data);
            jQuery.ajax({
                url: BASE_URL + 'ajax/getSearchGlossary',
                type: 'post',
                data: 'title=' + suggestion.data+'&category='+category,
                async: false,
                success: function(response) {
                    var rs = JSON.parse(response);
                    //console.log(rs.0);
                    jQuery("ul.glossary#ul_"+category).html(rs[0]);
                    jQuery("#btn-"+category).fadeIn();
                    
                }
            });
			//$(this).val("");
        },
        focus: function() {
            // prevent value inserted on focus
            return false;
        }      
    });
});
jQuery('.btn-close').click(function(i,elem){
    var $this = jQuery(this);
    var id = $this.attr('id');
    var category = $this.attr('category');
	var where = $('#where_'+category).val();
	var sort_ = $('#sort_'+category).val();
    jQuery("#search-"+category).val("");
	jQuery.ajax({
		url: BASE_URL + 'ajax/getSearchGlossaryReset',
		type: 'post',
		data: 'category='+category+'&where='+where +'&sort_='+sort_,
		async: false,
		success: function(response) {
			var rs = JSON.parse(response);
			//console.log(rs.0);
			jQuery("ul.glossary#ul_"+category).html(rs[0]);
			jQuery("#btn-"+category).fadeIn();
            $this.fadeOut();
		}
	});
});


    /* anchor */
    var href = jQuery(location).attr('href');
    var arrHref = href.split('#');
    if (arrHref[1]) {
        var id = '#' + arrHref[1];
        if (jQuery(id).length > 0) {
            /* open section before href */
            jQuery('section' + id).addClass('open');
            jQuery('section' + id + ' > div > h2').addClass('current');
            jQuery('section' + id + ' > div.section_body').css('display', 'block');
            window.location.href = id;
        }
    }

    download_confirm();
	
	
	// New add
	 jQuery(".account a").click(function() {
        jQuery('body').css('overflow', 'hidden');
        var href = jQuery(location).attr('href');
        var action = jQuery(this).attr("action");
        var html = action;
        var width = height = 0;
        if(action != "logout" && action != "update-info") {
            switch(action) {
                case "login":
                    html = '<form id="account-form" method="post">'+
                        '<label style="float: left; width: 90px; margin-top: 10px; margin-left: 62px; color: black;">'+trans('Email')+'</label>'+
                        '<input type="text" name="username" style="margin-bottom: 10px; width: 250px" /><br />'+
                        '<label style="float: left; width: 90px; margin-top: 10px; margin-left: 62px; color: black;">'+trans('Password')+'</label>'+
                        '<input type="password" name="password" style="margin-bottom: 10px; width: 250px" /><br />'+
                        '<label id="account-message" style="color: red; display: none;"></label>'+
                        '<input type="hidden" name="domain" value="'+window.location.hostname+'" />'+
                        '</form>';
                    width = 500;
                    height = 'auto';
                    break;
                case "register":
                    html = '<form id="account-form" method="post">'+
                        '<table cellspacing="10">'+
                        '<tr>'+
                        '<td class="title">'+trans('Gender')+'</td>'+
                        '<td class="input">'+
                        '<input type="radio" name="gender" value="mr" checked tabindex="1">'+trans('Mr.')+
                        '&nbsp;<input type="radio" name="gender" value="ms" tabindex="2">'+trans('Ms.')+
                        '&nbsp;<input type="radio" name="gender" value="mrs" tabindex="3">'+trans('Mrs.')+
                        '</td>'+
                        '<td class="title"><span class="required">*</span>'+trans('Email')+'</td>'+
                        '<td class="input"><input type="text" name="username" tabindex="6" autocomplete="off" /></td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td class="title">'+trans('First Name')+'</td>'+
                        '<td class="input"><input type="text" name="first_name" tabindex="4" autocomplete="off" /></td>'+
                        '<td class="title"><span class="required">*</span>'+trans('Password')+'</td>'+
                        '<td class="input"><input type="password" id="password" name="password" tabindex="7" autocomplete="off" /></td>'+
                        '</tr>'+
                        '<tr>'+
                        '<td class="title">'+trans('Last Name')+'</td>'+
                        '<td class="input"><input type="text" name="last_name" tabindex="5" autocomplete="off" /></td>'+
                        '<td class="title"><span class="required">*</span>'+trans('Re-Password')+'</td>'+
                        '<td class="input"><input type="password" id="re-password" name="re-password" tabindex="8" autocomplete="off" /></td>'+
                        '</tr>'+
                        '</table>'+
                        '<label id="account-message" style="color: red; display: none;"></label>'+
                        '<input type="hidden" name="domain" value="'+window.location.hostname+'" />'+
                        '</form>';
                    width = 900;
                    height = 'auto';
                    break;
                default:
                    break;
            }
            var form = jQuery("#account-dialog").dialog({
                modal: true,
                title: trans(action),
                width: width,
                height: height,
                buttons: [
                    {
                        text: trans(action),
                        class: 'submit-button',
                        click: function() {
                            submit_form();
                        }
                    },
                    {
                        text: trans('bt_cancel'),
                        class: 'cancel-button',
                        click: function() {
                            jQuery(this).dialog("close");
                        }
                    }
                ],
                open: function(event, ui){
                    jQuery(this).html(html);
                    jQuery('.ui-widget-overlay').css('background', '#A9A9A9');
                    jQuery('.ui-dialog').css('z-index', '999');
                    jQuery('.ui-dialog-title').css('color', 'black');
                    jQuery('.submit-button').find('.ui-button-text').css('color', 'green');
                    jQuery('.cancel-button').find('.ui-button-text').css('color', 'red');
                },
                close: function(event, ui) {
                    jQuery(this).dialog("close");
                }
            });
            form.on("keypress", "input[type=password]", function(e) {
                if (e.keyCode == 13) {
                    submit_form();
                    e.preventDefault();
                }
            });
            function submit_form() {
                jQuery("#account-message").css({"display": "inline", "color": "red"});
                jQuery("#account-message").html(trans("Processing..")).fadeIn();
                jQuery.ajax({
                    url: BASE_URL + 'ajax/' + action,
                    type: 'POST',
                    async: false,
                    data: jQuery("#account-form").serialize(),
                    success: function(rs){
                        if(rs==1) {
                            jQuery("#account-message").css({"display": "inline", "color": "green"});
                            jQuery("#account-message").html(trans("Successful!")).fadeIn("fast", function() {
                              window.setTimeout(function(){location.reload()}, 1000);
                            });
                        } else if(rs==2){
                            jQuery("#account-message").css({"display": "inline", "color": "green"});
                            jQuery("#account-message").html(trans("Successful. Please check your email to activate account!")).fadeIn("fast", function() {
                              window.setTimeout(function(){location.reload()}, 2000);
                            });
                        } else {
                            jQuery("input[type='password']").val("");
                            jQuery("#account-message").css({"display": "inline", "color": "red"});
                            jQuery("#account-message").html(rs).fadeIn("fast", function() {
                              jQuery(this).delay(1000).fadeOut("slow");
                            });
                        }
                    }
                });
            }
        } else if (action == "logout") {
            jQuery.ajax({
                url: BASE_URL + 'ajax/' + action,
                type: 'POST',
                async: false,
                success: function(){
                    location.reload();
                }
            });
        }
    });
	//End new add
	
	
	
	
	
	
	

});

function loadpaging(page,cate,sub_cat)
{
	
	var page_number =page;
	var cate_code = cate;
	var sub_cate_code = sub_cat;
	var pagination = '';
	//var description = jQuery(this).parent().attr('description');
	//var _parent = ' #'+description+' ';
   
	//jQuery('.pagenumber li a').removeClass('current');
	//jQuery(this).addClass('current');

	//BASE_URL + 'ajax/contact'
	//console.log(page_number);
	jQuery.ajax({
		url: BASE_URL + 'ajax/getPublication',
		type: 'post',
		dataType: 'json',
		data: {page_number: page_number, cate_code:cate_code, sub_cate_code:sub_cate_code},
		success: function(data) {
			//var rs = JSON.parse(data);
		   // console.log(rs.paging);
					// Pagination system
		   //console.log(data);
			if (page_number == 1) pagination += '<li><a cate_code="'+cate_code+'" sub_cate_code ="" href="javascript:void(0)" onclick="loadpaging(1,\''+cate_code+'\',\''+sub_cate_code+'\');return false;" class="disabled" page="1"> First </a></li><li><a cate_code="'+cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)" class="disabled" onclick="loadpaging('+(page_number - 1)+',\''+cate_code+'\',\''+sub_cate_code+'\');return false;" page="'+(page_number - 1)+'"> < </a></li>'; //<li><a cate_code="'+cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)" page="'+data.numPage+'"> Last </a></li>
			else pagination += '<li><a cate_code="'+cate_code+'" sub_cate_code ="" href="javascript:void(0)" onclick="loadpaging(1,\''+cate_code+'\',\''+sub_cate_code+'\');return false;" page="1"> First </a></li><li><a cate_code="'+cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)" onclick="loadpaging('+(page_number - 1)+',\''+cate_code+'\',\''+sub_cate_code+'\');return false;" page="'+(page_number - 1)+'"> < </a></li>';//<div class="cell"><a href="#" id="' + (page_number - 1) + '">Previous</span></a></div>
            var range = 10;
            var middle = Math.ceil(range/2);
            if (data.totalP < range){
                from = 1;
                to = data.totalP;
            }
            // Tru?ng h?p t?ng s? trang mà l?n hon range
            else
            {
                // Ta s? gán min = current_page - (middle + 1)
                from = parseInt(page_number) - middle + 1;
                 
                // Ta s? gán max = current_page + (middle - 1)
                to = parseInt(page_number) + middle - 1;
                 
                // Sau khi tính min và max ta s? ki?m tra
                // n?u min < 1 thì ta s? gán min = 1  và max b?ng luôn range
                if (from < 1){
                    from = 1;
                    to = range;
                }
                 
                // Ngu?c l?i n?u min > t?ng s? trang
                // ta gán max = t?ng s? trang và min = (t?ng s? trang - range) + 1 
                else if (to > data.totalP) 
                {
                    to = data.totalP;
                    from = data.totalP - range + 1;
                }
            }
			for (var i=from; i<=to; i++) {
				if (i >= 1 && i <= data.totalP) {
					pagination += '<li><a cate_code="'+cate_code+'" sub_cate_code ="" href="javascript:void(0)" onclick="loadpaging('+i+',\''+cate_code+'\',\''+sub_cate_code+'\');return false;" ';
					if (i == page_number) pagination += ' class="current" class="disabled" page="'+i+'">' + i + '</a>';
					else pagination += ' page="' + i + '">' + i + '</a>';
					pagination += '</li>';
				}
			}
 
			if (page_number == data.totalP) pagination += '<li><a cate_code="'+cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)" class="disabled" onclick="loadpaging('+(page_number + 1)+',\''+cate_code+'\',\''+sub_cate_code+'\');return false;" page="'+(page_number + 1)+'"> > </a></li><li><a cate_code="'+ cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)"  onclick="loadpaging('+data.totalP+',\''+cate_code + '\',\'' +sub_cate_code+'\');return false;" class="disabled" page="'+ data.totalP +'"> Last </a></li>';//<div class="cell_disabled"><span>Next</span></div>
			else pagination += '<li><a cate_code="'+cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)" onclick="loadpaging('+(page_number + 1)+',\''+cate_code+'\',\''+sub_cate_code+'\');return false;" page="'+(page_number + 1)+'"> > </a></li><li><a cate_code="'+ cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)" onclick="loadpaging('+data.totalP+',\''+cate_code+'\',\''+sub_cate_code+'\');return false;" page="'+ data.totalP +'"> Last </a></li>';//<div class="cell"><a href="#" id="' + (parseInt(page_number) + 1) + '">Next</a></div><div class="cell"><a href="#" id="' + data.numPage + '">Last</span></a></div>
			
			//$('#pagination').html(pagination); // We update the pagination D
			var class_parent = sub_cate_code == '' ? "#research_publications .content_"+ cate_code: "#research_publications .content_"+ cate_code;
			var id_parent = sub_cate_code == '' ? "#"+ cate_code: "#"+sub_cate_code;
			var ul_pagrin = sub_cate_code == '' ? ' ul.page_'+cate_code : ' ul.page_'+cate_code+'_'+sub_cate_code;
			//console.log(cate_code+scate_code);
            console.log(class_parent); 
			jQuery(class_parent).html(data.content);
			jQuery("#research_publications" + ul_pagrin).html(pagination);
			
		}
	});
	return false;             

}

function MyFunction(page,cate,sub_cat)
{
	
	var page_number =page;
	var cate_code = cate;
	var sub_cate_code = sub_cat;
	var pagination = '';
	//var description = jQuery(this).parent().attr('description');
	//var _parent = ' #'+description+' ';
   
	//jQuery('.pagenumber li a').removeClass('current');
	//jQuery(this).addClass('current');

	//BASE_URL + 'ajax/contact'
	//console.log(page_number);
	jQuery.ajax({
		url: BASE_URL + 'ajax/getcatelog',
		type: 'post',
		dataType: 'json',
		data: {page_number: page_number, cate_code:cate_code, sub_cate_code:sub_cate_code},
		success: function(data) {
			//var rs = JSON.parse(data);
		   // console.log(rs.paging);
					// Pagination system
		   //console.log(data);
			if (page_number == 1) pagination += '<li><a cate_code="'+cate_code+'" sub_cate_code ="" href="javascript:void(0)" onclick="MyFunction(1,\''+cate_code+'\',\''+sub_cate_code+'\');return false;" class="disabled" page="1"> First </a></li><li><a cate_code="'+cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)" class="disabled" onclick="MyFunction('+(page_number - 1)+',\''+cate_code+'\',\''+sub_cate_code+'\');return false;" page="'+(page_number - 1)+'"> < </a></li>'; //<li><a cate_code="'+cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)" page="'+data.numPage+'"> Last </a></li>
			else pagination += '<li><a cate_code="'+cate_code+'" sub_cate_code ="" href="javascript:void(0)" onclick="MyFunction(1,\''+cate_code+'\',\''+sub_cate_code+'\');return false;" page="1"> First </a></li><li><a cate_code="'+cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)" onclick="MyFunction('+(page_number - 1)+',\''+cate_code+'\',\''+sub_cate_code+'\');return false;" page="'+(page_number - 1)+'"> < </a></li>';//<div class="cell"><a href="#" id="' + (page_number - 1) + '">Previous</span></a></div>
            var range = 10;
            var middle = Math.ceil(range/2);
            if (data.totalP < range){
                from = 1;
                to = data.totalP;
            }
            // Tru?ng h?p t?ng s? trang mà l?n hon range
            else
            {
                // Ta s? gán min = current_page - (middle + 1)
                from = parseInt(page_number) - middle + 1;
                 
                // Ta s? gán max = current_page + (middle - 1)
                to = parseInt(page_number) + middle - 1;
                 
                // Sau khi tính min và max ta s? ki?m tra
                // n?u min < 1 thì ta s? gán min = 1  và max b?ng luôn range
                if (from < 1){
                    from = 1;
                    to = range;
                }
                 
                // Ngu?c l?i n?u min > t?ng s? trang
                // ta gán max = t?ng s? trang và min = (t?ng s? trang - range) + 1 
                else if (to > data.totalP) 
                {
                    to = data.totalP;
                    from = data.totalP - range + 1;
                }
            }
			for (var i=from; i<=to; i++) {
				if (i >= 1 && i <= data.totalP) {
					pagination += '<li><a cate_code="'+cate_code+'" sub_cate_code ="" href="javascript:void(0)" onclick="MyFunction('+i+',\''+cate_code+'\',\''+sub_cate_code+'\');return false;" ';
					if (i == page_number) pagination += ' class="current" class="disabled" page="'+i+'">' + i + '</a>';
					else pagination += ' page="' + i + '">' + i + '</a>';
					pagination += '</li>';
				}
			}
 
			if (page_number == data.totalP) pagination += '<li><a cate_code="'+cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)" class="disabled" onclick="MyFunction('+(page_number + 1)+',\''+cate_code+'\',\''+sub_cate_code+'\');return false;" page="'+(page_number + 1)+'"> > </a></li><li><a cate_code="'+ cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)"  onclick="MyFunction('+data.totalP+',\''+cate_code + '\',\'' +sub_cate_code+'\');return false;" class="disabled" page="'+ data.totalP +'"> Last </a></li>';//<div class="cell_disabled"><span>Next</span></div>
			else pagination += '<li><a cate_code="'+cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)" onclick="MyFunction('+(page_number + 1)+',\''+cate_code+'\',\''+sub_cate_code+'\');return false;" page="'+(page_number + 1)+'"> > </a></li><li><a cate_code="'+ cate_code+'" sub_cate_code ="'+sub_cate_code+'" href="javascript:void(0)" onclick="MyFunction('+data.totalP+',\''+cate_code+'\',\''+sub_cate_code+'\');return false;" page="'+ data.totalP +'"> Last </a></li>';//<div class="cell"><a href="#" id="' + (parseInt(page_number) + 1) + '">Next</a></div><div class="cell"><a href="#" id="' + data.numPage + '">Last</span></a></div>
			
			//$('#pagination').html(pagination); // We update the pagination D
			var class_parent = sub_cate_code == '' ? "#"+cate_code+" .tab_all#tab_"+ cate_code: "#"+cate_code+" .tab_"+sub_cate_code+"#tab_"+sub_cate_code;
			var id_parent = sub_cate_code == '' ? "#"+ cate_code: "#"+sub_cate_code;
			var ul_pagrin = sub_cate_code == '' ? ' ul.page_'+cate_code : ' ul.page_'+cate_code+'_'+sub_cate_code;
			//console.log(cate_code+scate_code);
			jQuery(class_parent + ' ul.glossary').html(data.content);
			jQuery(class_parent + ul_pagrin).html(pagination);
			
		}
	});
	return false;             

}
function download_confirm()
{
    if (jQuery('#download-with-confirm').length > 0) {
        var href = '';
        jQuery.each(jQuery('#download-with-confirm').find('a'), function() {
            var $this = jQuery(this);
            href = $this.attr('href');
            if (href.slice(-4).toLowerCase() === '.pdf') {
                $this.attr('href', 'javascript:void(0);');
                $this.attr('link', href);
                $this.removeAttr('target');
            }
        });

        jQuery('#download-with-confirm').find('a').click(function(event) {
            var $this = jQuery(this);
            if ($this.is('[link]')) {
                if (jQuery(this).is('[link]')) {
                    jQuery('body').css('overflow', 'hidden');
                    var linkDown = jQuery(this).attr('link');
                    var html = "<div id='dialog-down-pdf'>";
                    html += "<form>";
                    html += "<fieldset>";
                    html += "<label for='name' style='color: black;'>" + trans('code') + "</label>&nbsp;&nbsp;";
                    html += "<input type='password' name='code-down-pdf' id='code-down-pdf' class='text ui-widget-content ui-corner-all'>&nbsp;";
                    html += "<label id='message-down-pdf' style='color: red; display: none;'>" + trans('code_is_incorrect') + "</label>";
                    html += "</fieldset>";
                    html += "</form>";
                    html += "</div>";
                    jQuery(html).appendTo('body');
                    event.preventDefault();
                    var form = jQuery("#dialog-down-pdf").dialog({
                        title: trans("Confirmation"),
                        width: 300,
                        modal: true,
                        buttons: [
                            {
                                text: trans('bt_download'),
                                class: 'download-button',
                                click: function() {
                                    download();
                                    return false;
                                }
                            },
                            {
                                text: trans('bt_cancel'),
                                class: 'cancel-button',
                                click: function() {
                                    jQuery(this).dialog("close");
                                }
                            }
                        ]
                        ,
                        open: function(event, ui) {
                            jQuery('.ui-widget-overlay').css('background', '#A9A9A9');
                            jQuery('.ui-dialog-title').css('color', 'black');
                            jQuery('.download-button').find('.ui-button-text').css('color', 'green');
                            jQuery('.cancel-button').find('.ui-button-text').css('color', 'red');
                        },
                        close: function(event, ui) {
                            jQuery("#dialog-down-pdf").remove();
                        }
                    });
                    form.on("keypress", "input[type=password]", function(e) {
                        if (e.keyCode == 13) {
                            download();
                            e.preventDefault();
                        }
                    });
                } else {
                    return;
                }
                function download() {
                    if (trans('gwc_password_download') === jQuery("#dialog-down-pdf").find("#code-down-pdf").val()) {
                        window.open(linkDown, '_blank');
                        jQuery("#dialog-down-pdf").remove();
                    } else {
                        jQuery("#message-down-pdf").show();
                    }
                }
            }
        });
    }
}

function changeLanguage(langcode)
{
    jQuery.ajax({
        url: BASE_URL + 'ajax/changeLanguage',
        type: 'post',
        data: {langcode: langcode},
        success: function() {
            window.location.reload();
            return false;
        }
    });
}

function trans(text)
{
    var translate = jQuery.ajax({
        url: BASE_URL + 'ajax/translate',
        type: 'post',
        async: false,
        data: 'str=' + text
    }).responseText;
    return translate;
}