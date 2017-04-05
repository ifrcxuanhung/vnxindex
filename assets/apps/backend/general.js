/*---------------------------------------------------------------------------------------------------------------------
 *name        : openModal
 *description : open modal box
 *Params      :
 *Warning     :
 *author      : LongNguyen
 *Copyright   : IFRC
 *date        : 30/08/2012
 ---------------------------------------------------------------------------------------------------------------------*/
function openModal($title, $content, $width)
{
    $.modal({
        content: $content,
        title: $title,
        maxWidth: 2500,
        width: $width,
        buttons: {
            'Close': function(win) {
                win.closeModal();
            }
        }
    });
}
function openModalTest($title, $content)
{
    $.modal({
        content: $content,
        title: $title,
        maxWidth: 2500,
        width: $width,
        buttons: {
            'Accept': function(win) {

            },
            'Close': function(win) {
                win.closeModal();
            }
        }
    });
}
/*---------------------------------------------------------------------------------------------------------------------*/
// Replaces all instances of the given substring.
String.prototype.replaceAll = function(
        strTarget, // The substring you want to replace
        strSubString // The string you want to replace in.
        ) {
    var strText = this;
    var intIndexOfMatch = strText.indexOf(strTarget);

    // Keep looping while an instance of the target string
    // still exists in the string.
    while (intIndexOfMatch != -1) {
        // Relace out the current instance.
        strText = strText.replace(strTarget, strSubString)

        // Get the index of any next matching substring.
        intIndexOfMatch = strText.indexOf(strTarget);
    }

    // Return the updated string with ALL the target strings
    // replaced out with the new substring.
    return(strText);
}
/* start menu admin ---------------------------------------------------------------------------------------------------*/
$GKMenu = {
    height: true,
    width: true,
    duration: 250
};
/*---------------------------------------------------------------------------------------------------------------------
 *name        : file_manager
 *description : open file manager modal box
 *Params      : require jquery ui first
 *Warning     :
 *author      : LongNguyen
 *Copyright   : IFRC
 *date        : 30/08/2012
 ---------------------------------------------------------------------------------------------------------------------*/
function file_manager() {
    $('#dialog').remove();
    $('.main-container').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="' + $base_url + 'assets/bundles/kcfinder/browse.php?type=images" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
    $('#dialog').dialog({
        title: 'Image Manager',
        close: function(event, ui) {

        },
        bgiframe: false,
        width: 1000,
        height: 500,
        resizable: false,
        modal: false
    });
}
/*---------------------------------------------------------------------------------------------------------------------
 *name        : image_upload
 *description : open file manager modal box and select 1 file for thumb image
 *Params      : require jquery ui first
 *Warning     :
 *author      : LongNguyen
 *Copyright   : IFRC
 *date        : 30/08/2012
 ---------------------------------------------------------------------------------------------------------------------*/

function image_upload(field, thumb) {
    window.KCFinder = {};
    window.KCFinder.callBack = function(url) {
        $('#dialog').dialog('close');
        $url = url;
        $thumb = url.replace('assets/upload', 'assets/upload/thumbs');
        $('#image').val($url);
        $('#' + thumb).replaceWith('<img src="' + $thumb + '" alt="" id="' + thumb + '" />');
        window.KCFinder = null;
    };

    $('#dialog').remove();
    $('#complex_form').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="' + $base_url + 'assets/bundles/kcfinder/browse.php?type=images&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
    $('#dialog').dialog({
        title: 'Image Manager',
        close: function(event, ui) {

        },
        bgiframe: false,
        width: 800,
        height: 400,
        resizable: false,
        modal: false
    });
}
;
function confirmUpload() {
    if (!window.confirm("Do you want to upload the new sample?")) {
        return false;
    }
}
/*--------------------------------------------------------------------------------------------------------------------*/
$(document).ready(function()
{
    generalApply();
});

function generalApply() {
    $('.main-container').fadeIn('fast');
    if ((typeof $userid != 'undefined') && $userid != 1) {
        $('.is_admin').remove();
    }
    $('form').sisyphus();
    /*-thumbnails table list --------------------------------------------------------------------------------------------*/
    $('.thumbnails').live("mouseenter", function() {
        var html = '<img class="show-thumb-hover" src="' + $(this).attr('src') + '" />';
        $(this).parent().append(html);
        $('.show-thumb-hover').fadeIn('slow');
        $(this).parent().addClass('relative');
    }).live("mouseleave", function() {
        $('.show-thumb-hover').fadeOut('slow').remove();
        $(this).parent().removeClass('relative');
    });
    /*-----------------------------------------------------------------------------------------------------------------
     *description : auto generator table
     *Warning     :
     *author      : LongNguyen
     *Copyright   : IFRC
     *date        : 30/08/2012
     ---------------------------------------------------------------------------------------------------------------------*/
    $('.sortable').each(function(i)
    {
        var $this = this;
        var $data = [];
        $(this).find('th').each(function(e) {
            var $e = {
                sType: $(this).attr('sType'),
                bSortable: $(this).attr('bSortable') == 'true' ? true : false,
                sClass: $(this).attr('sClass'),
                sName: $(this).attr('sName')
            };
            $data.push($e);
        });
        var table = $(this);
        if ($($this).attr('footer') == 'false') {
            if ($($this).attr('search') == 'true') {
                dom = '<"block-controls"<"controls-buttons"> <"filter"f>>rti';
            } else {
                if($($this).attr('block') == 'false'){
                    dom = 'rti';
                }else{
                    dom = '<"block-controls"<"controls-buttons">> rti';
                }
            }
        }
        else {
            dom = '<"block-controls"<"controls-buttons"p> <"filter"f>>rti<"block-footer clearfix"l>';
        }

        var sScrollY = '150px';

        if ($($this).attr('page') == 'group') {
            dom = '<"block-controls"<"controls-buttons">f>rti';
        }
        else if ($($this).attr('page') == 'setting') {
            sScrollY = '340px';
        }
        else if ($($this).attr('page') == 'translate') {
            sScrollY = '340px';
        }
        else if ($($this).attr('page') == 'sysformat_showview') {
            sScrollY = '340px';
        }

        $obj_table = {
            "sScrollY": $($this).attr('pagination') == 'false' ? sScrollY : '',
            "aoColumns": $data,
            "aaSorting": [],
            "iDisplayLength": 11,
            "iDisplayStart": 0,
            "bAutoWidth": true,
            "bPaginate": $($this).attr('pagination') == 'false' ? false : true,
            "sPaginationType": "full_numbers",
            "bProcessing": $($this).attr('processing') == 'false' ? false : true,
            "bRetrieve": true,
            /*
             * Set DOM structure for table controls
             * @url http://www.datatables.net/examples/basic_init/dom.html
             */
            sDom: dom,
            /*
             * Callback to apply template setup
             */
            fnDrawCallback: function()
            {
                // this.parent().applyTemplateSetup();
                $($this).slideDown(200);
            },
            fnInitComplete: function()
            {
                // this.parent().applyTemplateSetup();
                $($this).slideDown(200);
                if ($($this).attr('search') == 'true') {
                    $('.filter').css({
                        'float': 'right',
                        'margin-right': '20px'
                    });
                }
                div_id = "#" + $(this).attr("id") + "_wrapper";
                if ($(this).attr("scroll") == "scrollable") {
                    $(div_id + " .dataTables_scrollHeadInner").css({
                        "background": "-moz-linear-gradient(center top , #CCCCCC, #A4A4A4) repeat scroll 0 0 transparent",
                        "border-top": "1px solid white"
                    });
                    $(div_id + " .dataTables_scroll th").css("border-top", "none");
                    $("section").css("margin-bottom", 0);
                }

            }
        };
        if ($(this).attr("scroll") == "scrollable") {
            $obj_table.bPaginate = false;
            $obj_table.sScrollY = "350px";
        }
        var oTable = table.dataTable($obj_table);

        // Sorting arrows behaviour
        table.find('thead .sort-up').click(function(event)
        {
            // Stop link behaviour
            event.preventDefault();

            // Find column index
            var column = $(this).closest('th'),
                    columnIndex = column.parent().children().index(column.get(0));

            // Send command
            oTable.fnSort([[columnIndex, 'asc']]);

            // Prevent bubbling
            return false;
        });
        table.find('thead .sort-down').click(function(event)
        {
            // Stop link behaviour
            event.preventDefault();

            // Find column index
            var column = $(this).closest('th'),
                    columnIndex = column.parent().children().index(column.get(0));

            // Send command
            oTable.fnSort([[columnIndex, 'desc']]);

            // Prevent bubbling
            return false;
        });
        /* make custom btn append to block-controls */
    });


    $('.sortable2').each(function(i)
    {
        var $this = this;
        var $data = [];
        $(this).css("display", "table");
        $(this).find('th').each(function(e) {
            var $e = {
                sType: $(this).attr('sType'),
                bSortable: $(this).attr('bSortable') == 'true' ? true : false,
                sClass: $(this).attr('sClass'),
                sName: $(this).attr('sName')
            };
            $data.push($e);
        });
        var table = $(this);

        var dom = '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>';
        var sScrollY = '200px';

        if ($($this).attr('page') == 'vndb_page') {
            if ($($this).attr('tab') == 'vndb_cpaction') {
                dom = '<"block-controls"<"controls-buttons">f>rti';
                sScrollY = '300px';
            }
        }

        $obj_table = {
            "sScrollX": "100%",
            "ScrollXInner": "110%",
            "sScrollY": $($this).attr('pagination') == 'false' ? sScrollY : '',
            "bScrollCollapse": true,
            "aoColumns": $data,
            "aaSorting": [],
            "iDisplayLength": 11,
            "iDisplayStart": 0,
            "bAutoWidth": true,
            "bPaginate": $($this).attr('pagination') == 'false' ? false : true,
            "sPaginationType": "full_numbers",
            "bProcessing": true,
            "bRetrieve": true,
            /*
             * Set DOM structure for table controls
             * @url http://www.datatables.net/examples/basic_init/dom.html
             */
            sDom: dom,
            /*
             * Callback to apply template setup
             */
            fnDrawCallback: function()
            {
                // this.parent().applyTemplateSetup();
                $($this).slideDown(200);
            },
            fnInitComplete: function()
            {
                // this.parent().applyTemplateSetup();
                $($this).slideDown(200);
                div_id = "#" + $(this).attr("id") + "_wrapper";
                if ($(this).attr("scroll") == "scrollable") {
                    $(div_id + " .dataTables_scrollHeadInner").css({
                        "background": "-moz-linear-gradient(center top , #CCCCCC, #A4A4A4) repeat scroll 0 0 transparent",
                        "border-top": "1px solid white"
                    });
                    $(div_id + " .dataTables_scroll th").css("border-top", "none");
                    $("section").css("margin-bottom", 0);
                }
                $(div_id + " .dataTables_scrollHead").css("height", $(div_id + " .dataTables_scrollHeadInner").height());
            }
        };
        if ($(this).attr("scroll") == "scrollable") {
            $obj_table.bPaginate = false;
            $obj_table.sScrollY = "350px";
        }
        oTable = table.dataTable($obj_table);

        // Sorting arrows behaviour
        table.find('thead .sort-up').click(function(event)
        {
            // Stop link behaviour
            event.preventDefault();

            // Find column index
            var column = $(this).closest('th'),
                    columnIndex = column.parent().children().index(column.get(0));

            // Send command
            oTable.fnSort([[columnIndex, 'asc']]);

            // Prevent bubbling
            return false;
        });
        table.find('thead .sort-down').click(function(event)
        {
            // Stop link behaviour
            event.preventDefault();

            // Find column index
            var column = $(this).closest('th'),
                    columnIndex = column.parent().children().index(column.get(0));

            // Send command
            oTable.fnSort([[columnIndex, 'desc']]);

            // Prevent bubbling
            return false;
        });
        /* make custom btn append to block-controls */
    });


    /*-----------------------------------------------------------------------------------------------------------------
     *description : datepicker
     *Warning     :
     *author      : LongNguyen
     *Copyright   : IFRC
     *date        : 30/08/2012
     ---------------------------------------------------------------------------------------------------------------------*/
    $('.datepicker').datepick({
        alignment: 'bottom',
        showOtherMonths: true,
        selectOtherMonths: true,
        dateFormat: 'yyyy-mm-dd',
        renderer: {
            picker: '<div class="datepick block-border clearfix form"><div class="mini-calendar clearfix">' +
                    '{months}</div></div>',
            monthRow: '{months}',
            month: '<div class="calendar-controls" style="white-space: nowrap">' +
                    '{monthHeader:M yyyy}' +
                    '</div>' +
                    '<table cellspacing="0">' +
                    '<thead>{weekHeader}</thead>' +
                    '<tbody>{weeks}</tbody></table>',
            weekHeader: '<tr>{days}</tr>',
            dayHeader: '<th>{day}</th>',
            week: '<tr>{days}</tr>',
            day: '<td>{day}</td>',
            monthSelector: '.month',
            daySelector: 'td',
            rtlClass: 'rtl',
            multiClass: 'multi',
            defaultClass: 'default',
            selectedClass: 'selected',
            highlightedClass: 'highlight',
            todayClass: 'today',
            otherMonthClass: 'other-month',
            weekendClass: 'week-end',
            commandClass: 'calendar',
            commandLinkClass: 'button',
            disabledClass: 'unavailable'
        }
    });
    /*-----------------------------------------------------------------------------------------------------------------
     *description : fancybox
     *Warning     :
     *author      : LongNguyen
     *Copyright   : IFRC
     *date        : 31/08/2012
     ---------------------------------------------------------------------------------------------------------------------*/
    $(".fancybox").fancybox({
        openEffect: 'elastic',
        closeEffect: 'elastic',
        helpers: {
            title: {
                type: 'inside'
            },
            overlay: {
                opacity: 0.1,
                css: {
                    'background-color': '#000'
                }
            }
        }
    });
    /* active languagge*/
    $('.list-language a').click(function() {
        var $lang = $(this).attr('langcode');
        $.ajax({
            type: "POST",
            url: $admin_url + "language/active/" + $lang,
            data: '',
            success: function() {
                window.location.reload();
            }
        });
    });
}

function loadCss(url) {
    var link = document.createElement("link");
    link.type = "text/css";
    link.rel = "stylesheet";
    link.href = url;
    document.getElementsByTagName("head")[0].appendChild(link);
}

function showHidden(div1, div2) {
    $(div1).focus(function() {
        $(div2).slideDown();
    });
}

function trans(word) {
    var translate;
    $.ajax({
        url: $admin_url + 'translate/getTrans',
        type: 'post',
        data: 'word=' + word,
        async: false,
        success: function(rs) {
            translate = rs;
        }
    });
    return translate;
}
function sorttable() {
    $(document).ready(function()
    {
        $('.sortable').each(function(i)
        {
            var $this = this;
            var $data = [];
            $(this).find('th').each(function(e) {
                var $e = {
                    sType: $(this).attr('sType'),
                    bSortable: $(this).attr('bSortable') == 'true' ? true : false
                };
                $data.push($e);
            });
            var table = $(this),
                    oTable = table.dataTable({
                aoColumns: $data,
                "iDisplayLength": 15,
                "iDisplayStart": 0,
                "sPaginationType": "full_numbers",
                /*
                 * Set DOM structure for table controls
                 * @url http://www.datatables.net/examples/basic_init/dom.html
                 */
                sDom: '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>',
                /*
                 * Callback to apply template setup
                 */
                fnDrawCallback: function()
                {
                    this.parent().applyTemplateSetup();
                    $($this).slideDown(200);
                },
                fnInitComplete: function()
                {
                    this.parent().applyTemplateSetup();
                    $($this).slideDown(200);
                }
            });

            // Sorting arrows behaviour
            table.find('thead .sort-up').click(function(event)
            {
                // Stop link behaviour
                event.preventDefault();

                // Find column index
                var column = $(this).closest('th'),
                        columnIndex = column.parent().children().index(column.get(0));

                // Send command
                oTable.fnSort([[columnIndex, 'asc']]);

                // Prevent bubbling
                return false;
            });
            table.find('thead .sort-down').click(function(event)
            {
                // Stop link behaviour
                event.preventDefault();

                // Find column index
                var column = $(this).closest('th'),
                        columnIndex = column.parent().children().index(column.get(0));

                // Send command
                oTable.fnSort([[columnIndex, 'desc']]);

                // Prevent bubbling
                return false;
            });
            /* make custom btn append to block-controls */
        });
        $('.sortable').show();
        $('.modal-content *').removeClass('no-margin');
        $('.modal-content *').removeClass('block-controls');
        $('.modal-content').find('.block-footer').remove();
    });
}

function check_file_exists($file) {
    var check;
    $.ajax({
        url: $file,
        async: false,
        type: "HEAD",
        success: function(data) {
            check = true;
        },
        error: function(request, status) {
            check = false;
        }
    });
    return check;
}

function get_html_translation_table(table, quote_style) {
    // http://kevin.vanzonneveld.net
    // +   original by: Philip Peterson
    // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: noname
    // +   bugfixed by: Alex
    // +   bugfixed by: Marco
    // +   bugfixed by: madipta
    // +   improved by: KELAN
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Frank Forte
    // +   bugfixed by: T.Wild
    // +      input by: Ratheous
    // %          note: It has been decided that we're not going to add global
    // %          note: dependencies to php.js, meaning the constants are not
    // %          note: real constants, but strings instead. Integers are also supported if someone
    // %          note: chooses to create the constants themselves.
    // *     example 1: get_html_translation_table('HTML_SPECIALCHARS');
    // *     returns 1: {'"': '&quot;', '&': '&amp;', '<': '&lt;', '>': '&gt;'}
    var entities = {},
            hash_map = {},
            decimal;
    var constMappingTable = {},
            constMappingQuoteStyle = {};
    var useTable = {},
            useQuoteStyle = {};

    // Translate arguments
    constMappingTable[0] = 'HTML_SPECIALCHARS';
    constMappingTable[1] = 'HTML_ENTITIES';
    constMappingQuoteStyle[0] = 'ENT_NOQUOTES';
    constMappingQuoteStyle[2] = 'ENT_COMPAT';
    constMappingQuoteStyle[3] = 'ENT_QUOTES';

    useTable = !isNaN(table) ? constMappingTable[table] : table ? table.toUpperCase() : 'HTML_SPECIALCHARS';
    useQuoteStyle = !isNaN(quote_style) ? constMappingQuoteStyle[quote_style] : quote_style ? quote_style.toUpperCase() : 'ENT_COMPAT';

    if (useTable !== 'HTML_SPECIALCHARS' && useTable !== 'HTML_ENTITIES') {
        throw new Error("Table: " + useTable + ' not supported');
        // return false;
    }

    entities['38'] = '&amp;';
    if (useTable === 'HTML_ENTITIES') {
        entities['160'] = '&nbsp;';
        entities['161'] = '&iexcl;';
        entities['162'] = '&cent;';
        entities['163'] = '&pound;';
        entities['164'] = '&curren;';
        entities['165'] = '&yen;';
        entities['166'] = '&brvbar;';
        entities['167'] = '&sect;';
        entities['168'] = '&uml;';
        entities['169'] = '&copy;';
        entities['170'] = '&ordf;';
        entities['171'] = '&laquo;';
        entities['172'] = '&not;';
        entities['173'] = '&shy;';
        entities['174'] = '&reg;';
        entities['175'] = '&macr;';
        entities['176'] = '&deg;';
        entities['177'] = '&plusmn;';
        entities['178'] = '&sup2;';
        entities['179'] = '&sup3;';
        entities['180'] = '&acute;';
        entities['181'] = '&micro;';
        entities['182'] = '&para;';
        entities['183'] = '&middot;';
        entities['184'] = '&cedil;';
        entities['185'] = '&sup1;';
        entities['186'] = '&ordm;';
        entities['187'] = '&raquo;';
        entities['188'] = '&frac14;';
        entities['189'] = '&frac12;';
        entities['190'] = '&frac34;';
        entities['191'] = '&iquest;';
        entities['192'] = '&Agrave;';
        entities['193'] = '&Aacute;';
        entities['194'] = '&Acirc;';
        entities['195'] = '&Atilde;';
        entities['196'] = '&Auml;';
        entities['197'] = '&Aring;';
        entities['198'] = '&AElig;';
        entities['199'] = '&Ccedil;';
        entities['200'] = '&Egrave;';
        entities['201'] = '&Eacute;';
        entities['202'] = '&Ecirc;';
        entities['203'] = '&Euml;';
        entities['204'] = '&Igrave;';
        entities['205'] = '&Iacute;';
        entities['206'] = '&Icirc;';
        entities['207'] = '&Iuml;';
        entities['208'] = '&ETH;';
        entities['209'] = '&Ntilde;';
        entities['210'] = '&Ograve;';
        entities['211'] = '&Oacute;';
        entities['212'] = '&Ocirc;';
        entities['213'] = '&Otilde;';
        entities['214'] = '&Ouml;';
        entities['215'] = '&times;';
        entities['216'] = '&Oslash;';
        entities['217'] = '&Ugrave;';
        entities['218'] = '&Uacute;';
        entities['219'] = '&Ucirc;';
        entities['220'] = '&Uuml;';
        entities['221'] = '&Yacute;';
        entities['222'] = '&THORN;';
        entities['223'] = '&szlig;';
        entities['224'] = '&agrave;';
        entities['225'] = '&aacute;';
        entities['226'] = '&acirc;';
        entities['227'] = '&atilde;';
        entities['228'] = '&auml;';
        entities['229'] = '&aring;';
        entities['230'] = '&aelig;';
        entities['231'] = '&ccedil;';
        entities['232'] = '&egrave;';
        entities['233'] = '&eacute;';
        entities['234'] = '&ecirc;';
        entities['235'] = '&euml;';
        entities['236'] = '&igrave;';
        entities['237'] = '&iacute;';
        entities['238'] = '&icirc;';
        entities['239'] = '&iuml;';
        entities['240'] = '&eth;';
        entities['241'] = '&ntilde;';
        entities['242'] = '&ograve;';
        entities['243'] = '&oacute;';
        entities['244'] = '&ocirc;';
        entities['245'] = '&otilde;';
        entities['246'] = '&ouml;';
        entities['247'] = '&divide;';
        entities['248'] = '&oslash;';
        entities['249'] = '&ugrave;';
        entities['250'] = '&uacute;';
        entities['251'] = '&ucirc;';
        entities['252'] = '&uuml;';
        entities['253'] = '&yacute;';
        entities['254'] = '&thorn;';
        entities['255'] = '&yuml;';
    }

    if (useQuoteStyle !== 'ENT_NOQUOTES') {
        entities['34'] = '&quot;';
    }
    if (useQuoteStyle === 'ENT_QUOTES') {
        entities['39'] = '&#39;';
    }
    entities['60'] = '&lt;';
    entities['62'] = '&gt;';


    // ascii decimals to real symbols
    for (decimal in entities) {
        if (entities.hasOwnProperty(decimal)) {
            hash_map[String.fromCharCode(decimal)] = entities[decimal];
        }
    }

    return hash_map;
}

function html_entity_decode(string, quote_style) {
    // http://kevin.vanzonneveld.net
    // +   original by: john (http://www.jd-tech.net)
    // +      input by: ger
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Onno Marsman
    // +   improved by: marc andreu
    // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Ratheous
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Nick Kolosov (http://sammy.ru)
    // +   bugfixed by: Fox
    // -    depends on: get_html_translation_table
    // *     example 1: html_entity_decode('Kevin &amp; van Zonneveld');
    // *     returns 1: 'Kevin & van Zonneveld'
    // *     example 2: html_entity_decode('&amp;lt;');
    // *     returns 2: '&lt;'
    var hash_map = {},
            symbol = '',
            tmp_str = '',
            entity = '';
    tmp_str = string.toString();

    if (false === (hash_map = get_html_translation_table('HTML_ENTITIES', quote_style))) {
        return false;
    }

    // fix &amp; problem
    // http://phpjs.org/functions/get_html_translation_table:416#comment_97660
    delete(hash_map['&']);
    hash_map['&'] = '&amp;';

    for (symbol in hash_map) {
        entity = hash_map[symbol];
        tmp_str = tmp_str.split(entity).join(symbol);
    }
    tmp_str = tmp_str.split('&#039;').join("'");

    return tmp_str;
}

function exportTable(table, ids, exceptions) {
    if (typeof exceptions == 'undefined') {
        exceptions = '';
    }
    exceptions = JSON.stringify(exceptions);
    filename = table + ".txt";
    $.ajax({
        url: $admin_url + 'export',
        type: 'post',
        data: {
            ids: ids,
            name: filename,
            table: table,
            exceptions: exceptions
        },
        async: false,
        success: function(rs) {
            rs = JSON.parse(rs);
            if (rs.error == '') {
                window.location.href = $admin_url + 'sysformat/download_file?file=' + rs.file + '&path=' + rs.path;
            } else {
                alert(rs.error);
            }
        }
    })
}

function exportTable2(table, where, order, exceptions) {
    where = JSON.stringify(where);
    exceptions = JSON.stringify(exceptions);
    order = JSON.stringify(order);
    $.ajax({
        url: $admin_url + 'export',
        type: 'post',
        data: {
            table: table,
            where: where,
            exceptions: exceptions,
            order: order
        },
        async: false,
        success: function(rs) {
            rs = JSON.parse(rs);
            if (rs.error == '') {
                window.location.href = $admin_url + 'sysformat/download_file?file=' + rs.file + '&path=' + rs.path;
            } else {
                alert(rs.error);
            }
            $("#lean_overlay").hide();
        }
    })
}

function exportTable3(table, url) {
    if ($('#' + table).length == 1) {
        var oSettings = $('#' + table).dataTable().fnSettings();
    } else {
        if ($('.' + table).length == 1) {
            var oSettings = $('.' + table).dataTable().fnSettings();
        }
    }
    if (typeof oSettings != 'undefined') {
        filter = oSettings.oPreviousSearch.sSearch;
    }
    var iTotal = oSettings._iRecordsDisplay;
    console.log(oSettings);
    var start = 0;
    if (iTotal != 0) {
        var i = 0;
        while (start < iTotal) {
            i++;
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    sEcho: i,
                    iDisplayStart: start,
                    iDisplayLength: oSettings._iDisplayLength,
                    sSearch: filter,
                    bSearchable_0: true,
                    bSearchable_1: true,
                    bSearchable_2: true,
                    bSearchable_3: true,
                    bSearchable_4: true,
                    bSearchable_5: true,
                    bSearchable_6: true,
                    bSearchable_7: true,
                    bSearchable_8: true,
                    bSearchable_9: true,
                    bSearchable_10: true,
                    bSearchable_11: true,
                    bSearchable_12: true,
                    action: 'export',
                },
                async: false,
                success: function(rs) {
                    if (start == 0) {
                        method = 'w';
                    } else {
                        method = 'a';
                    }
                    rs = JSON.parse(rs);
                    start += oSettings._iDisplayLength;
                    $.ajax({
                        url: $admin_url + 'export/makeFile',
                        type: 'post',
                        data: {
                            filename: table + '.txt',
                            data: rs.aaData,
                            method: method
                        },
                        async: false,
                        success: function(rs2) {
                            rs2 = JSON.parse(rs2);
                            if (rs2.error == '') {
                                file = rs2.file;
                                path = rs2.path;
                            } else {
                                console.log(rs2.error);
                            }
                        }
                    });
                }
            });
        }
        window.location.href = $admin_url + 'sysformat/download_file?file=' + file + '&path=' + path;
    } else {
        alert("No data");
    }
    $("#lean_overlay").hide();
}

function exportTable4(table, where, order, exceptions) {
    where = JSON.stringify(where);
    exceptions = JSON.stringify(exceptions);
    order = JSON.stringify(order);
    $.ajax({
        url: $admin_url + 'export/export_data',
        type: 'post',
        data: {
            table: table,
            where: where,
            exceptions: exceptions,
            order: order
        },
        async: false,
        success: function(rs) {
            rs = JSON.parse(rs);
            if (rs.error == '') {
                window.location.href = $admin_url + 'sysformat/download_file?file=' + rs.file + '&path=' + rs.path;
            } else {
                alert(rs.error);
            }
            $("#lean_overlay").hide();
        }
    })
}

function exportTable5(table, where, order, exceptions) {
    where = JSON.stringify(where);
    exceptions = JSON.stringify(exceptions);
    order = JSON.stringify(order);
    $.ajax({
        url: $admin_url + 'export/export_data_2',
        type: 'post',
        data: {
            table: table,
            where: where,
            exceptions: exceptions,
            order: order
        },
        async: false,
        success: function(rs) {
            rs = JSON.parse(rs);
            if (rs.error == '') {
                window.location.href = $admin_url + 'sysformat/download_file?file=' + rs.file + '&path=' + rs.path;
            } else {
                alert(rs.error);
            }
            $("#lean_overlay").hide();
        }
    })
}

function utf8_convert_url(Text)
{
    return Text
            .toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-')
            ;
}