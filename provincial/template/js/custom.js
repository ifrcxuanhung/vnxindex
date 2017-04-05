jQuery(document).ready(function() {
    jQuery('#portfolio_iso_filters li a.index').click(function() {
        var index = jQuery(this).parent().attr('index');
        jQuery('#portfolio_iso_filters li a.index').removeClass('current');
        jQuery(this).addClass('current');
        jQuery('#resume .list_tabs').hide();
        jQuery('#resume .' + index).show();
        return false;
    });

    jQuery('#performance_fliter li a.index').click(function() {
        var index = jQuery(this).parent().attr('index');
        jQuery('#performance_fliter li a.index').removeClass('current');
        jQuery(this).addClass('current');
        jQuery('#performance_section .list_tabs').hide();
        jQuery('#performance_section .' + index).show();
        return false;
    });
    
    jQuery('#listindexes_fliter li a.index').click(function() {
        var index = jQuery(this).parent().attr('index');
        jQuery('#listindexes_fliter li a.index').removeClass('current');
        jQuery(this).addClass('current');
        jQuery('#listindexes_section .list_tabs').hide();
        jQuery('#listindexes_section .' + index).show();
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
        jQuery("#listindexes_section #search-index, #resume #search-index, #search-company").css({
            right: '0px',
            'margin-right': '180px'
        });
        jQuery("#listindexes_section #search-index, #resume #search-index, #search-company").fadeIn();
    });

    jQuery("#search-index").autocomplete({
        serviceUrl: BASE_URL + 'ajax/searchIndex',
        minChars: 2,
        type: 'POST',
        noCache: true,
        maxHeight: 200,
        autoSelectFirst: false,
        onSelect: function(suggestion) {
            window.location.href = BASE_URL + 'index/code/' + suggestion.data;
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

});

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