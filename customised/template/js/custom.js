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

    jQuery("a.sort-mtd").click(function() {
        jQuery("a.sort-ytd").removeClass("sort-desc").removeClass("sort-asc");
        var $this = jQuery(this);
        if ($this.hasClass("sort-desc")) {
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

    jQuery("a.sort-ytd").click(function() {
        jQuery("a.sort-mtd").removeClass("sort-desc").removeClass("sort-asc");
        var $this = jQuery(this);
        if ($this.hasClass("sort-desc")) {
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