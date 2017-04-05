var $url = $base_url;
function getCookie(c_name) {
    var i, x, y, ARRcookies = document.cookie.split(";");
    for (i = 0; i < ARRcookies.length; i++) {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name) {
            return unescape(y);
        }
    }
}
var $ = jQuery;
var dataTrans = null;
if (dataTrans == null) {
    $.getJSON($url + 'Public/trans.json?' + new Date().getTime(), function(data) {
        dataTrans = data;
    });
}
var ifrc = (function() {
    return {
        /**********************************************************************
         *d�ng cho trang home load ajax when change select box return table
         **********************************************************************/
        language: 'fr',
        chuyendoi: function(name, type, provider) {
            var $name = name;
            var $type = type;
            var $provider = provider;
            var $loading = '<div class="loading">Loading...</div>';
            $($name).find('.ifrc_index').html($loading);
            var $selectPlace = $($name).find('.selectPlace').val();
            var $selectPrice = $($name).find('.selectPrice').val();
            var $selectCurr = $($name).find('.selectCurr').val();
            var idtable = $name.substring(2) + 'flexigrid';
            var table = '<table id="' + idtable + '"></table>';

            $($name).find('.ifrc_index').html(table);
            $("#" + idtable).flexigrid({
                url: $url + 'ajax',
                method: 'POST',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Name'),
                        name: 'shortname',
                        width: 400,
                        sortable: false,
                        align: 'left',
                        hide: false
                    }, {
                        display: ifrc.trans('Last'),
                        name: 'close',
                        width: 100,
                        sortable: false,
                        align: 'right',
                        hide: false
                    },
                    {
                        display: ifrc.trans('% Var'),
                        name: 'dvar',
                        width: 80,
                        sortable: true,
                        align: 'right',
                        hide: false
                    },
                    {
                        display: ifrc.trans('% Month'),
                        name: 'varmonth',
                        width: 80,
                        sortable: true,
                        align: 'right',
                        hide: false
                    },
                    {
                        display: ifrc.trans('% Year'),
                        name: 'varyear',
                        width: 80,
                        sortable: true,
                        align: 'right',
                        hide: false
                    },
                    {
                        display: ' ',
                        name: 'action',
                        width: 58,
                        sortable: true,
                        align: 'center',
                        hide: false
                    }],
                usepager: true,
                title: false,
                useRp: false,
                rp: 10,
                autoload: true,
                showTableToggleBtn: false,
                params: [{
                        name: 'act',
                        value: 'getBoxIndexesHome'
                    }, {
                        name: 'type',
                        value: $type
                    }, {
                        name: 'place',
                        value: $selectPlace
                    }, {
                        name: 'price',
                        value: $selectPrice
                    }, {
                        name: 'curr',
                        value: $selectCurr
                    }, {
                        name: 'provider',
                        value: $provider
                    }],
                onSubmit: '',
                resizable: false,
                height: 'auto',
                width: 860,
                onSuccess: function() {
                    $('#' + idtable + ' td[abbr="varmonth"],#' + idtable + ' td[abbr="varyear"],#' + idtable + ' td[abbr="dvar"]').each(function(index) {
                        var $value = $(this).text();
                        if ($value.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                }
            });
        },
        chuyendoiSub: function($boxResult, $type, $provider, $subType) {
            var $loading = '<div class="loading">Loading...</div>';
            $($boxResult).find('.ifrc_index').html($loading);
            var $selectPlace = $($boxResult).find('.selectPlace').val();
            var $selectPrice = $($boxResult).find('.selectPrice').val();
            var $selectCurr = $($boxResult).find('.selectCurr').val();
            var idtable = $boxResult.substring(2) + 'flexigrid';
            var table = '<table id="' + idtable + '"></table>';
            $($boxResult).find('.ifrc_index').html(table);
            $("#" + idtable).flexigrid({
                url: $url + 'ajax',
                method: 'POST',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Name'),
                        name: 'shortname',
                        width: 380,
                        sortable: false,
                        align: 'left',
                        hide: false
                    }, {
                        display: ifrc.trans('Last'),
                        name: 'close',
                        width: 80,
                        sortable: false,
                        align: 'right',
                        hide: false
                    },
                    {
                        display: ifrc.trans('% Var'),
                        name: 'dvar',
                        width: 100,
                        sortable: true,
                        align: 'right',
                        hide: false
                    },
                    {
                        display: ifrc.trans('% Month'),
                        name: 'varmonth',
                        width: 80,
                        sortable: true,
                        align: 'right',
                        hide: false
                    },
                    {
                        display: ifrc.trans('% Year'),
                        name: 'varyear',
                        width: 70,
                        sortable: true,
                        align: 'right',
                        hide: false
                    },
                    {
                        display: ' ',
                        name: 'action',
                        width: 75,
                        sortable: true,
                        align: 'center',
                        hide: false
                    }],
                usepager: true,
                title: false,
                useRp: false,
                rp: 10,
                autoload: true,
                showTableToggleBtn: false,
                params: [{
                        name: 'act',
                        value: 'getBoxIndexesHome'
                    }, {
                        name: 'type',
                        value: $type
                    }, {
                        name: 'place',
                        value: $selectPlace
                    }, {
                        name: 'price',
                        value: $selectPrice
                    }, {
                        name: 'curr',
                        value: $selectCurr
                    }, {
                        name: 'provider',
                        value: $provider
                    }, {
                        name: 'subtype',
                        value: $subType
                    }],
                onSubmit: '',
                resizable: false,
                height: 'auto',
                width: 860,
                onSuccess: function() {
                    $('#' + idtable + ' td[abbr="varmonth"],#' + idtable + ' td[abbr="varyear"],#' + idtable + ' td[abbr="dvar"]').each(function(index) {
                        var $value = $(this).text();
                        if ($value.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                }
            });
        },
        /**********************************************************************
         *d�ng cho trang home load ajax chay box search
         **********************************************************************/
        seachhome: function($name, $provider, $type) {
            var $loading = '<div class="loading">Loading...</div>';
            $($name).find('.ifrc_index').html($loading);
            var $search = $($name).find('.txtsearch').val();
            var idtable = $name.substring(2) + 'flexigrid';
            var table = '<table id="' + idtable + '"></table>';
            $($name).find('.ifrc_index').html(table);
            $("#" + idtable).flexigrid({
                url: $url + 'ajax',
                method: 'POST',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Name'),
                        name: 'shortname',
                        width: 180,
                        sortable: false,
                        align: 'left',
                        hide: false
                    }, {
                        display: ifrc.trans('Last'),
                        name: 'close',
                        width: 80,
                        sortable: false,
                        align: 'right',
                        hide: false
                    },
                    {
                        display: ifrc.trans('% Var'),
                        name: 'dvar',
                        width: 70,
                        sortable: true,
                        align: 'right',
                        hide: false
                    },
                    {
                        display: ifrc.trans('% Month'),
                        name: 'varmonth',
                        width: 70,
                        sortable: true,
                        align: 'right',
                        hide: false
                    },
                    {
                        display: ifrc.trans('% Year'),
                        name: 'varyear',
                        width: 70,
                        sortable: true,
                        align: 'right',
                        hide: false
                    },
                    {
                        display: ' ',
                        name: 'action',
                        width: 40,
                        sortable: true,
                        align: 'center',
                        hide: false
                    }],
                usepager: true,
                title: false,
                useRp: false,
                rp: 10,
                autoload: true,
                showTableToggleBtn: false,
                params: [{
                        name: 'act',
                        value: 'getBoxIndexesHome'
                    }, {
                        name: 'type',
                        value: $type
                    }, {
                        name: 'search',
                        value: $search
                    }, {
                        name: 'provider',
                        value: $provider
                    }],
                onSubmit: '',
                resizable: false,
                height: 'auto',
                width: 860,
                onSuccess: function() {
                    $('#' + idtable + ' td[abbr="varmonth"],#' + idtable + ' td[abbr="varyear"],#' + idtable + ' td[abbr="dvar"]').each(function(index) {
                        var $value = $(this).text();
                        if ($value.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                }
            });
        },
        /**********************************************************************
         * d�ng cho box search trang perf screener
         **********************************************************************/
        searchObPerf: function() {
            var $loading = '<div class="loading">Loading...</div>';
            $('.idxSample').html($loading);
            var $selectType = $('.box_search_obs').find('.selectType').val();
            var $selectCode = $('.box_search_obs').find('.selectCode').val();
            var $selectProvider = $('.box_search_obs').find('.selectProvider').val();
            var $selectCoverage = $('.box_search_obs').find('.selectCoverage').val();
            var $selectPrice = $('.box_search_obs').find('.selectPrice').val();
            var $selectCurrency = $('.box_search_obs').find('.selectCurrency').val();
            var $selectName = $('.box_search_obs').find('.selectName').val();
            var $q_search = $('.box_search_obs').find('.q_search').val();
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=getIdxSampleObs&type=' + this.base64_encode($selectType) + '&code=' + this.base64_encode($selectCode) + '&provider=' + this.base64_encode($selectProvider) + '&coverage=' + this.base64_encode($selectCoverage) + '&currency=' + this.base64_encode($selectCurrency) + '&name=' + this.base64_encode($selectName) + '&q_search=' + this.base64_encode($q_search) + '&price=' + this.base64_encode($selectPrice),
                success: function($html) {
                    $('.idxSample').html($html);
                }
            });
        },
        /**********************************************************************
         * d�ng cho box search trang observatoire
         **********************************************************************/
        searchObnull: function($search) {
            $('.observatory').html('<table id="observatoryTable"></table>');
            var $selectType = $('.box_search_obs').find('.selectType').val();
            var $selectCode = $('.box_search_obs').find('.selectCode').val();
            var $selectProvider = $('.box_search_obs').find('.selectProvider').val();
            var $selectCoverage = $('.box_search_obs').find('.selectCoverage').val();
            var $selectPrice = $('.box_search_obs').find('.selectPrice').val();
            var $selectCurrency = $('.box_search_obs').find('.selectCurrency').val();
            var $selectName = $('.box_search_obs').find('.selectName').val();
            var $q_search = $('.box_search_obs').find('.q_search').val();
            $("#observatoryTable").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Type'),
                        name: 'TYPE',
                        width: 135,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Category'),
                        name: 'SUB_TYPE',
                        width: 190,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Provider'),
                        name: 'PROVIDER',
                        width: 180,
                        sortable: false,
                        align: 'left'
                    },
                    {
                        display: ifrc.trans('Coverage'),
                        name: 'PLACE',
                        width: 130,
                        sortable: false,
                        align: 'left'
                    },
                    {
                        display: ifrc.trans('Price'),
                        name: 'PRICE',
                        width: 50,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Currency'),
                        name: 'CURR',
                        width: 80,
                        sortable: false,
                        align: 'center'
                    }, {
                        display: ifrc.trans('Name'),
                        name: 'SHORTNAME',
                        width: 248,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('History'),
                        name: 'HISTORY',
                        width: 100,
                        sortable: false,
                        align: 'right'
                    }, {
                        display: ifrc.trans('Info'),
                        name: 'action',
                        width: 40,
                        sortable: false,
                        align: 'center'
                    }],
                sortname: "iso",
                usepager: true,
                title: ifrc.trans('Result'),
                useRp: false,
                rp: 10,
                showTableToggleBtn: false,
                //width: 950,
                autoload: true,
                height: 'auto',
                resizable: false,
                singleSelect: true,
                onSubmit: ParamData,
                onSuccess: function() {

                }
            });

            function ParamData() {
                $("#observatoryTable").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'getBoxdataObservatory'
                        }, {
                            name: 'type',
                            value: $selectType
                        }, {
                            name: 'code',
                            value: $selectCode
                        }, {
                            name: 'provider',
                            value: $selectProvider
                        }, {
                            name: 'coverage',
                            value: $selectCoverage
                        }, {
                            name: 'currency',
                            value: $selectCurrency
                        }, {
                            name: 'name',
                            value: $selectName
                        }, {
                            name: 'q_search',
                            value: $q_search
                        }, {
                            name: 'price',
                            value: $selectPrice
                        }]
                });
                return true;
            }
        },
        /**********************************************************************
         * d�ng cho box search trang observatoire
         **********************************************************************/
        searchVnxnull: function($search) {
            $('.observatory').html('<table id="observatoryTable"></table>');
            var $selectType = $('.box_search_obs').find('.selectType').val();
            var $selectCode = $('.box_search_obs').find('.selectCode').val();
            var $selectProvider = $('.box_search_obs').find('.selectProvider').val();
            var $selectCoverage = $('.box_search_obs').find('.selectCoverage').val();
            var $selectPrice = $('.box_search_obs').find('.selectPrice').val();
            var $selectCurrency = $('.box_search_obs').find('.selectCurrency').val();
            var $selectName = $('.box_search_obs').find('.selectName').val();
            var $q_search = $('.box_search_obs').find('.q_search').val();
            $("#observatoryTable").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Type'),
                        name: 'TYPE',
                        width: 70,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Category'),
                        name: 'SUB_TYPE',
                        width: 110,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Provider'),
                        name: 'PROVIDER',
                        width: 120,
                        sortable: false,
                        align: 'left'
                    },
                    {
                        display: ifrc.trans('Coverage'),
                        name: 'PLACE',
                        width: 110,
                        sortable: false,
                        align: 'left'
                    },
                    {
                        display: ifrc.trans('Price'),
                        name: 'PRICE',
                        width: 40,
                        sortable: false,
                        align: 'right'
                    }, {
                        display: ifrc.trans('Currency'),
                        name: 'CURR',
                        width: 80,
                        sortable: false,
                        align: 'center'
                    }, {
                        display: ifrc.trans('Name'),
                        name: 'SHORTNAME',
                        width: 198,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('History'),
                        name: 'HISTORY',
                        width: 87,
                        sortable: false,
                        align: 'right'
                    }, {
                        display: ifrc.trans('Info'),
                        name: 'action',
                        width: 40,
                        sortable: false,
                        align: 'center'
                    }],
                sortname: "iso",
                usepager: true,
                title: ifrc.trans('Result'),
                useRp: false,
                rp: 10,
                showTableToggleBtn: false,
                width: 950,
                autoload: true,
                height: 'auto',
                resizable: false,
                singleSelect: true,
                onSubmit: ParamData,
                onSuccess: function() {

                }
            });

            function ParamData() {
                $("#observatoryTable").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'getBoxdataVnx'
                        }, {
                            name: 'type',
                            value: $selectType
                        }, {
                            name: 'code',
                            value: $selectCode
                        }, {
                            name: 'provider',
                            value: $selectProvider
                        }, {
                            name: 'coverage',
                            value: $selectCoverage
                        }, {
                            name: 'currency',
                            value: $selectCurrency
                        }, {
                            name: 'name',
                            value: $selectName
                        }, {
                            name: 'q_search',
                            value: $q_search
                        }, {
                            name: 'price',
                            value: $selectPrice
                        }]
                });
                return true;
            }
        },
        /**********************************************************************
         * load overview of current month and 12-month-period ending
         **********************************************************************/
        getOverviewReport: function(date, type, baseURL) {
            $(type).html("<img src='" + baseURL + "/templates/images/loading_1.gif' style='width:20px; height:20px;' />");
            $.ajax({
                url: baseURL + "ajax",
                type: "post",
                data: "act=getReport&date=" + date + "&type=" + type,
                async: false,
                success: function(html) {
                    $(type).html(html);
                }
            });
        },
        /**********************************************************************
         * load companies and its information in ifrc_report
         **********************************************************************/
        getCompanyReport: function(date, type, baseURL, dateChange) {
            if (dateChange != 0) {
                var type1 = type.substr("1");
                $(type).html("<table id='" + type1 + "_table' style='display:none'></table>");
            }
            $(type + "_table").flexigrid({
                url: baseURL + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Nr'),
                        name: 'num',
                        width: 10,
                        sortable: false,
                        align: 'center'
                    },
                    {
                        display: ifrc.trans('Company name'),
                        name: 'company',
                        width: 170,
                        sortable: false,
                        align: 'left'
                    },
                    {
                        display: ifrc.trans('Ticker'),
                        name: 'ticker',
                        width: 30,
                        sortable: false,
                        align: 'center'
                    },
                    {
                        display: ifrc.trans('Market').replace(" ", "<br />"),
                        name: 'market',
                        width: 30,
                        sortable: false,
                        align: 'center'
                    },
                    {
                        display: ifrc.trans('Sector'),
                        name: 'sector',
                        width: 100,
                        sortable: false,
                        align: 'left'
                    },
                    {
                        display: ifrc.trans('Shares'),
                        name: 'shares',
                        width: 60,
                        sortable: false,
                        align: 'right'
                    },
                    {
                        display: ifrc.trans('Last price').replace(" m", "<br />m"),
                        name: 'last',
                        width: 40,
                        sortable: false,
                        align: 'right'
                    },
                    {
                        display: ifrc.trans('Market<br />Capi') + '.*',
                        name: 'capi',
                        width: 30,
                        sortable: false,
                        align: 'right'
                    },
                    {
                        display: '%',
                        name: 'capi_per',
                        width: 23,
                        sortable: false,
                        align: 'right'
                    },
                    {
                        display: ifrc.trans('Turnover') + '<br />(Mn VND)',
                        name: 'turn',
                        width: 55,
                        sortable: false,
                        align: 'right'
                    },
                    {
                        display: '%' + ifrc.trans('Turnover'),
                        name: 'turn_per',
                        width: 60,
                        sortable: false,
                        align: 'right'
                    },
                    {
                        display: '%' + ifrc.trans('Velocity'),
                        name: 'velo_per',
                        width: 50,
                        sortable: false,
                        align: 'right'
                    },
                    {
                        display: '%' + ifrc.trans('Cotation'),
                        name: 'cot',
                        width: 50,
                        sortable: false,
                        align: 'right'
                    }, ],
                sortorder: "asc",
                usepager: true,
                useRp: false,
                rp: 50,
                resizable: false,
                showToggleBtn: false,
                singleSelect: true,
                onSubmit: addData,
                width: 932,
                height: 1305
            });

            function format() {
                var gridContainer = this.Grid.closest('.flexigrid');
                var headers = gridContainer.find('div.hDiv table tr:first th:not(:hidden)');
                var drags = gridContainer.find('div.cDrag div');
                var offset = 0;
                var firstDataRow = this.Grid.find('tr:first td:not(:hidden)');
                var columnWidths = new Array(firstDataRow.length);
                this.Grid.find('tr').each(function() {
                    $(this).find('td:not(:hidden)').each(function(i) {
                        var colWidth = $(this).outerWidth();
                        if (!columnWidths[i] || columnWidths[i] < colWidth) {
                            columnWidths[i] = colWidth;
                        }
                    });
                });
                for (var i = 0; i < columnWidths.length; ++i) {
                    var bodyWidth = columnWidths[i];

                    var header = headers.eq(i);
                    var headerWidth = header.outerWidth();

                    var realWidth = bodyWidth > headerWidth ? bodyWidth : headerWidth;

                    firstDataRow.eq(i).css('width', realWidth);
                    header.css('width', realWidth);
                    drags.eq(i).css('left', offset + realWidth);
                    offset += realWidth;
                }
            }



            function addData() {
                $(type + "_table").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'getReport'
                        }, {
                            name: 'type',
                            value: type
                        }, {
                            name: 'date',
                            value: date
                        }]
                });
                return true;
            }
        },
        /**********************************************************************
         * load idx sample
         **********************************************************************/
        loadIdxSample: function() {
            var $loading = '<div class="loading">Loading...</div>';
            $('.idxSample').html($loading);
            var $selectType = $('.box_search_obs').find('.selectType').val();
            var $selectCode = $('.box_search_obs').find('.selectCode').val();
            var $selectProvider = $('.box_search_obs').find('.selectProvider').val();
            var $selectCoverage = $('.box_search_obs').find('.selectCoverage').val();
            var $selectPrice = $('.box_search_obs').find('.selectPrice').val();
            var $selectCurrency = $('.box_search_obs').find('.selectCurrency').val();
            var $selectName = $('.box_search_obs').find('.selectName').val();
            var $q_search = $('.box_search_obs').find('.q_search').val();
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=getIdxSample&type=' + $selectType + '&code=' + $selectCode + '&provider=' + $selectProvider + '&coverage=' + $selectCoverage + '&currency=' + $selectCurrency + '&name=' + $selectName + '&q_search=0' + '&price=' + $selectPrice,
                success: function($html) {
                    $('.idxSample').html($html);
                }
            });
        },
        /**********************************************************************
         * d�ng cho reset select
         **********************************************************************/
        resetselect: function() {
            $('.box_search_obs').find('.selectType').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectCode').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectProvider').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectCoverage').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectPrice').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectCurrency').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectName').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.q_search').val(null);
        },
        /**********************************************************************
         * show detail observatoire
         **********************************************************************/
        showDetailOb: function($code) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.detail-observatoire').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=getdetailObservatory&code=' + $code,
                success: function($html) {
                    $('.detail-observatoire').html($html);
                    $(".detail-ob-yearly").bind("click", function() {
                        $temp = getCookie('codeCompare');
                        $('.selectNameCompareYear').val($temp);
                        $('.btn-compare-year').click();
                    });

                    $(".detail-ob-monthly").bind("click", function() {
                        $temp = getCookie('codeCompare');
                        $('.selectNameCompareMonth').val($temp);
                        $('.btn-compare-month').click();
                    });
                }
            });
        },
        /**********************************************************************
         * show detail observatoire
         **********************************************************************/
        showDetailCompare: function($name_from, $name_to) {
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=getCodeByNameFromTo&name_from=' + encodeURIComponent($name_from) + '&name_to=' + encodeURIComponent($name_to),
                success: function(rs) {
                    rs = JSON.parse(rs);
                    var code_from = rs.code_from;
                    var code_to = rs.code_to;
                    var $loading = '<div class="loading">Loading...</div>';
                    $('.detail-observatoire').html($loading);
                    $.ajax({
                        type: "POST",
                        url: $url + 'ajax',
                        data: 'act=getdetailCompare&code_from=' + code_from + '&code_to=' + code_to,
                        success: function($html) {
                            $('.detail-observatoire').html($html);
                            $(".detail-ob-yearly").bind("click", function() {
                                $temp = getCookie('codeCompare');
                                $('.selectNameCompareYear').val($temp);
                                $('.btn-compare-year').click();
                            });

                            $(".detail-ob-monthly").bind("click", function() {
                                $temp = getCookie('codeCompare');
                                $('.selectNameCompareMonth').val($temp);
                                $('.btn-compare-month').click();
                            });
                        }
                    });
                }
            });
        },
        /**********************************************************************
         * copy clicked idx sample to selection table
         **********************************************************************/
        copyAllSampleIdxToSelection: function() {
            var codeJson = '';
            $('.idxSample a').hide();
            $('.idxSample a').each(function() {
                codeJson = (codeJson != '') ? codeJson + ',' + $(this).attr('id') : codeJson + $(this).attr('id');
            });
            document.cookie = 'codeJsonCookie=' + codeJson;
            //console.log(codeJson);
            //
            $('#idxSampleSelection tbody').append($('.idxSample').html());

            $('#idxSampleSelection tbody a').each(function() {
                $(this).show();
                $(this).removeAttr('href');
                $(this).find('img').attr('src', $(this).find('img').attr('src').replace('more.png', 'delbtn.png'));

                $(this).attr('id', 'selection_' + $(this).attr('id'));
                $(this).prop('onclick', null);
                $(this).click(function() {
                    ifrc.deleteFromSelection($(this).attr('id'))
                });
            });

            $('#idxSampleSelection').show();
        },
        /**********************************************************************
         * copy clicked idx sample to selection table
         **********************************************************************/
        copyToSelection: function($code) {

            var codeJson = '';
            var codeJsonCookie = getCookie("codeJsonCookie");
            if (codeJsonCookie != null && codeJsonCookie != "") {
                codeJson += codeJsonCookie + ',' + $code;
                document.cookie = 'codeJsonCookie=' + codeJson;
            } else {
                codeJson = $code;
                document.cookie = 'codeJsonCookie=' + codeJson;
            }
            // console.log(document.cookie);
            var tr_html = $('<div>').append($('#' + $code).parents('tr').clone()).remove().html();
            tr_html = tr_html.replace('more.png', 'delbtn.png');
            var tbody = $('#idxSampleSelection tbody');
            var tr_bg = '';
            if (tbody.find('tr').length <= 0) {
                tr_bg = 'odd';
            } else {
                tr_bg = (tbody.find('tr:first').attr('class') == 'odd') ? '' : 'odd';
            }
            $('#idxSampleSelection tbody').prepend(tr_html);
            $('#idxSampleSelection tbody tr div').removeAttr('style');
            $('#idxSampleSelection tbody tr:first a').removeAttr('href');
            $('#idxSampleSelection tbody tr:first a').attr('id', 'selection_' + $code);
            $('#idxSampleSelection tbody tr:first a').prop('onclick', null);
            $('#idxSampleSelection tbody tr:first a').click(function() {
                ifrc.deleteFromSelection('selection_' + $code)
            });
            tbody.find('tr:first').attr('class', tr_bg);
            $('#idxSampleSelection').fadeIn();
            $('#' + $code).hide();
            for (var i = 1; i <= 3; i++) {
                $('#idxSampleSelection tbody tr:first').fadeOut();
                $('#idxSampleSelection tbody tr:first').fadeIn();
            }
        },
        /**********************************************************************
         * delete idx sample from selection table
         **********************************************************************/
        deleteFromSelection: function($selection_code) {
            $('#' + $selection_code).parents('tr').remove();
            var $code = $selection_code.replace('selection_', '');
            $('#' + $code).show();
            if ($('#idxSampleSelection tbody tr').length <= 0) {
                $('#idxSampleSelection').hide();
            }
            var codeJsonCookie = getCookie("codeJsonCookie");
            var codeJson = '';
            //console.log(codeJsonCookie.indexOf($code));
            if (codeJsonCookie.indexOf($code) == 0) {

                codeJson = codeJsonCookie.replace($code, '');
            } else {
                codeJson = codeJsonCookie.replace(',' + $code, '');
            }
            document.cookie = 'codeJsonCookie=' + codeJson;
        },
        /**********************************************************************
         * delete idx sample from selection table
         **********************************************************************/
        getPerfData: function($code, $obj, $type) {
            //$('#tabs_perf_ex tbody').hide();
            $year = $code.substr(0, 4);
            $("#pre-year1 div:first").html($year - 1);
            $("#pre-year2 div:first").html($year - 2);
            $("#pre-year3 div:first").html($year - 3);
            $("#pre-year4 div:first").html($year - 4);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=getPerfData&date=' + $code + '&orderby=' + $obj.attr('name'),
                success: function(response) {
                    console.log(response);
                    $('#tabs_perf_ex tbody').html(response);
                    $('#tabs_perf_ex tbody').show();
                    if ($type == 'manual') {
                        var currentNameSort = $obj.attr('name');
                        var nextSort = (currentNameSort.indexOf('ASC') == -1) ? 'ASC' : 'DESC';
                        if (nextSort == 'ASC') {
                            $obj.attr('name', currentNameSort.replace('DESC', 'ASC'));
                            $('#tabs_perf_ex thead .ascSort').css('marginTop', 0);
                            $('#tabs_perf_ex thead .descSort').css('marginTop', 0);
                            $('#tabs_perf_ex thead .ascSort').show();
                            $('#tabs_perf_ex thead .descSort').show();
                            $obj.find('.descSort').show();
                            $obj.find('.ascSort').hide();
                            $obj.find('.descSort').css('marginTop', '4px');
                        } else {
                            //console.log($obj.attr('name')+'aaa');
                            $obj.attr('name', currentNameSort.replace('ASC', 'DESC'));
                            $('#tabs_perf_ex thead .ascSort').css('marginTop', 0);
                            $('#tabs_perf_ex thead .descSort').css('marginTop', 0);
                            $('#tabs_perf_ex thead .ascSort').show();
                            $('#tabs_perf_ex thead .descSort').show();
                            $obj.find('.ascSort').show();
                            $obj.find('.descSort').hide();
                            $obj.find('.ascSort').css('marginTop', '4px');
                        }
                    }
                    $("tr.content td").each(function() {
                        var rs = $(this).attr("rs");
                        //alert(rs);
                        rs = eval(rs);
                        if (rs > 0) {
                            //alert(rs);
                            $(this).css({
                                "color": "green",
                                "font-weight": "bold"
                            });
                        }
                        if (rs < 0) {
                            $(this).css({
                                "color": "red",
                                "font-weight": "bold"
                            });
                        }
                    });
                }
            });

            /*$("table tr.content").each(function(){
             $("tr.content td").each(function(){
             var rs = $(this).html();
             alert(rs);
             rs = eval(rs);
             /*if(rs > 0){
             $(this).addClass("posistive");
             }else{
             $(this).addClass("negative");
             }*/
            //	});
            //});

        },
        /**********************************************************************
         * Save selection to database
         **********************************************************************/
        saveSelectionToDB: function(msg) {
            var name = prompt(msg, "");
            if (name != '' && name != null) {
                $.ajax({
                    type: "POST",
                    url: $url + 'ajax',
                    data: 'act=saveSelectionToDB&name=' + name + '&code=' + getCookie("codeJsonCookie"),
                    success: function(response) {
                        jsonOBJ = $.parseJSON(response);
                        if (jsonOBJ.err != undefined) {
                            $('#err_save_selection').fadeOut();
                            $('#err_save_selection').empty();
                            $('#err_save_selection').text(jsonOBJ.err);
                            $('#err_save_selection').fadeIn();
                        } else {
                            $.ajax({
                                type: "POST",
                                url: $url + 'ajax',
                                data: 'act=updatePerfUserName',
                                success: function(response) {
                                    $('#perfUserName').html(response);
                                    ifrc.getPerfData($('#perfUserName').val(), $('#perfUserName'));
                                }
                            });
                            document.cookie = "codeJsonCookie=''";
                            $('#idxSampleSelection').fadeOut();
                            $('#idxSampleSelection tbody').empty();
                            var $bgcolor = ($('#userPerf tbody tr:first').attr('bgcolor') == '#3f4b4d') ? '#202626' : '#3f4b4d';
                            var html = '';
                            html += '<tr bgcolor="' + $bgcolor + '" align="left" style=" font-size:11px; height:18px;">';
                            html += '<td width="30%" align="center">&nbsp;' + jsonOBJ.user + '</td>';
                            html += '<td width="60%" align="center"><div>&nbsp;' + jsonOBJ.name + '</div></td>';
                            var publish = (jsonOBJ.publish == 1) ? 'Yes' : 'No';
                            html += '<td width="10%" align="center"><div>&nbsp;' + publish + '</div></td>';
                            html += '</tr>';
                            $('#userPerf tbody').prepend(html);
                            $('#userPerf').show();
                            $('#success_save_selection').fadeOut();
                            $('#success_save_selection').text(jsonOBJ.success_msg);
                            $('#success_save_selection').fadeIn();
                            for (var i = 1; i <= 3; i++) {
                                $('#userPerf tbody tr:first').fadeOut();
                                $('#userPerf tbody tr:first').fadeIn();
                            }
                            window.location = '#userPerf';
                        }
                    }
                });
            }
        },
        /**********************************************************************
         * show compo
         **********************************************************************/
        loadcompo: function($code, $page) {
            var $loading = '<div class="loading">Loading...</div>';
            $('#laptrinh').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=getdetailCompo&code=' + $code + '&page=' + $page,
                success: function($html) {
                    $('#laptrinh').html($html);
                }
            });
        },
        /**********************************************************************
         * load data theo day cua observatoire
         **********************************************************************/
        loadDayOb: function($code) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.loadDayOb').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadDayOb&code=' + $code,
                cache: false,
                success: function($html) {
                    $('.loadDayOb').html($html);
                }
            });
        },
        /**********************************************************************
         * load data theo day cua observatoire show loadDayObFlexigrid
         **********************************************************************/
        loadDayObFlexigrid: function($code) {
            $("#loadDayObFlexigrid").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Date'),
                        name: 'Date',
                        width: 110,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('High'),
                        name: 'High',
                        width: 90,
                        sortable: false,
                        align: 'right'
                    }, {
                        display: ifrc.trans('Low'),
                        name: 'Low',
                        width: 130,
                        sortable: false,
                        align: 'center'
                    },
                    {
                        display: ifrc.trans('Close'),
                        name: 'Close',
                        width: 115,
                        sortable: true,
                        align: 'center'
                    },
                    {
                        display: ifrc.trans('Perform'),
                        name: 'Perform',
                        width: 70,
                        sortable: true,
                        align: 'right'
                    }],
                autoload: true,
                usepager: true,
                useRp: false,
                rp: 20,
                resizable: false,
                width: 590,
                showToggleBtn: false,
                singleSelect: true,
                onSubmit: ParamData,
                height: 410,
                onSuccess: function() {
                    /* color text performance */
                    $('#loadDayObFlexigrid td[abbr="Perform"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });

                    /* bold text close */
                    $('#loadDayObFlexigrid td[abbr="Close"]').each(function(index) {
                        $(this).css('font-weight', 'bold');
                    });
                }
            });

            function ParamData() {
                $("#loadDayObFlexigrid").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'loadDayOb'
                        }, {
                            name: 'code',
                            value: $code
                        }, {
                            name: 'type',
                            value: 'Flexigrid'
                        }]
                });
                return true;
            }
        },
        /**********************************************************************
         * load data theo month cua observatoire
         **********************************************************************/
        loadMonthOb: function($code) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.loadMonthOb').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadMonthOb&code=' + $code,
                success: function($html) {
                    $('.loadMonthOb').html($html);
                    $temp = getCookie('codeCompare');
                    $('.selectNameCompareMonth').val($temp);
                }
            });
        },
        /**********************************************************************
         * load data theo month cua observatoire show loadDayObFlexigrid
         **********************************************************************/
        loadMonthObFlexigrid: function($code) {
            $("#loadMonthObFlexigrid").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Date'),
                        name: 'Date',
                        width: 120,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('High'),
                        name: 'High',
                        width: 120,
                        sortable: false,
                        align: 'right'
                    }, {
                        display: ifrc.trans('Low'),
                        name: 'Low',
                        width: 90,
                        sortable: false,
                        align: 'right'
                    },
                    {
                        display: ifrc.trans('Close'),
                        name: 'Close',
                        width: 105,
                        sortable: true,
                        align: 'right'
                    },
                    {
                        display: ifrc.trans('Perform'),
                        name: 'Perform',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    }],
                autoload: true,
                usepager: true,
                useRp: false,
                rp: 20,
                resizable: false,
                width: 590,
                showToggleBtn: false,
                singleSelect: true,
                onSubmit: ParamData,
                height: 410,
                onSuccess: function() {
                    /* color text performance */
                    $('#loadMonthObFlexigrid td[abbr="Perform"]').each(function(index) {
                        var $varmonth = $(this).text();
                        if ($varmonth.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });

                    /* bold text close */
                    $('#loadMonthObFlexigrid td[abbr="Close"]').each(function(index) {
                        $(this).css('font-weight', 'bold');
                    });
                }
            });

            function ParamData() {
                $("#loadMonthObFlexigrid").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'loadMonthOb'
                        }, {
                            name: 'code',
                            value: $code
                        }, {
                            name: 'type',
                            value: 'Flexigrid'
                        }]
                });
                return true;
            }
        },
        /**********************************************************************
         * load data theo year cua observatoire
         **********************************************************************/
        loadYearOb: function($code) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.loadYearOb').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadYearOb&code=' + $code,
                success: function($html) {
                    $('.loadYearOb').html($html);
                    $temp = getCookie('codeCompare');
                    $('.selectNameCompareYear').val($temp);
                }
            });
        },
        /**********************************************************************
         * load data theo year cua observatoire show loadDayObFlexigrid
         **********************************************************************/
        loadYearObFlexigrid: function($code) {
            $("#loadYearObFlexigrid").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Date'),
                        name: 'Date',
                        width: 110,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('High'),
                        name: 'High',
                        width: 90,
                        sortable: false,
                        align: 'right'
                    }, {
                        display: ifrc.trans('Low'),
                        name: 'Low',
                        width: 100,
                        sortable: false,
                        align: 'right'
                    },
                    {
                        display: ifrc.trans('Close'),
                        name: 'Close',
                        width: 105,
                        sortable: true,
                        align: 'right'
                    },
                    {
                        display: ifrc.trans('Perform'),
                        name: 'Perform',
                        width: 120,
                        sortable: true,
                        align: 'right'
                    }],
                autoload: true,
                usepager: true,
                useRp: false,
                rp: 20,
                resizable: false,
                width: 590,
                showToggleBtn: false,
                singleSelect: true,
                onSubmit: ParamData,
                height: 410,
                onSuccess: function() {
                    $('#loadYearObFlexigrid td[abbr="Perform"]').each(function(index) {
                        var $varyear = $(this).text();
                        if ($varyear.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });

                    /* bold text close */
                    $('#loadYearObFlexigrid td[abbr="Close"]').each(function(index) {
                        $(this).css('font-weight', 'bold');
                    });
                }
            });

            function ParamData() {
                $("#loadYearObFlexigrid").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'loadYearOb'
                        }, {
                            name: 'code',
                            value: $code
                        }, {
                            name: 'type',
                            value: 'Flexigrid'
                        }]
                });
                return true;
            }
        },
        /**********************************************************************
         * load public cua observatoire
         **********************************************************************/
        loadPublicOb: function($code) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.loadPublicOb').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadPublicOb&code=' + $code,
                success: function($html) {
                    $('.loadPublicOb').html($html);
                }
            });
        },
        /**********************************************************************
         * load data theo year cua observatoire
         **********************************************************************/
        loadRulesOb: function($code) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.loadRulesOb').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadRulesOb&code=' + $code,
                success: function($html) {
                    $('.loadRulesOb').html($html);
                }
            });
        },
        /**********************************************************************
         * load compare chart
         **********************************************************************/
        chartcompare: function($nameChart, $code, $id, $type, $classSelect, $idrebase) {
            /*
            alert($nameChart);
            alert($code);
            alert($id);
            alert($type);
            alert($classSelect);
            alert($idrebase);
            */
            var $loading = '<div class="loading">Loading...</div>';
            $id2 = '#' + $id;
            $classSelect = '.' + $classSelect;
            $idrebase = '#' + $idrebase;
            $($id2).html($loading);
            var $temp = $($classSelect).val();
            if ($temp == '') {
                $temp = getCookie('codeCompare');
                if(typeof $temp === "undefined")
                    $temp = ""
                $($classSelect).val($temp);
            } else {
                document.cookie = 'codeCompare=' + $temp;
            }
            var $codeCompare = ifrc.base64_encode($temp);
            $idrebase = $($idrebase).val();
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadDataCompare&nameChart=' + $nameChart + '&code=' + $code + '&id=' + $id + '&type=' + $type + '&rebase=' + $idrebase + '&codeCompare=' + $codeCompare,
                success: function($html) {
                    $($classSelect).parent().find('.jschart').html($html);
                }
            });
        },
        resetselect2: function($classSelect) {
            $classSelect = '.' + $classSelect;
            $($classSelect).find('select').find('option:first').attr('selected', 'selected').parent('select');
            $($classSelect).find('.txtsearch').val('');
        },
        /**********************************************************************
         * Get article ? trang observatory
         **********************************************************************/
        getarticle: function($title) {
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=getarticle&title=' + $title,
                success: function(url) {
                    if (url !== false) {
                        window.open(url, '_blank');
                    }
                }
            });
        },
        /////////////////////////////////////////////////////////////////////////////////
        explode: function(delimiter, string, limit) {
            // *     example 1: explode(' ', 'Kevin van Zonneveld');
            // *     returns 1: {0: 'Kevin', 1: 'van', 2: 'Zonneveld'}
            // *     example 2: explode('=', 'a=bc=d', 2);
            // *     returns 2: ['a', 'bc=d']
            var emptyArray = {
                0: ''
            };
            // third argument is not required
            if (arguments.length < 2 || typeof arguments[0] == 'undefined' || typeof arguments[1] == 'undefined') {
                return null;
            }
            if (delimiter === '' || delimiter === false || delimiter === null) {
                return false;
            }
            if (typeof delimiter == 'function' || typeof delimiter == 'object' || typeof string == 'function' || typeof string == 'object') {
                return emptyArray;
            }
            if (delimiter === true) {
                delimiter = '1';
            }
            if (!limit) {
                return string.toString().split(delimiter.toString());
            } else {
                // support for limit argument
                var splitted = string.toString().split(delimiter.toString());
                var partA = splitted.splice(0, limit - 1);
                var partB = splitted.join(delimiter.toString());
                partA.push(partB);
                return partA;
            }
        },
        /**********************************************************************
         * base64_encode
         **********************************************************************/
        base64_encode: function(data) {
            var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
            var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
                    ac = 0,
                    enc = "",
                    tmp_arr = [];

            if (!data) {
                return data;
            }

            data = this.utf8_encode(data + '');

            do { // pack three octets into four hexets
                o1 = data.charCodeAt(i++);
                o2 = data.charCodeAt(i++);
                o3 = data.charCodeAt(i++);

                bits = o1 << 16 | o2 << 8 | o3;

                h1 = bits >> 18 & 0x3f;
                h2 = bits >> 12 & 0x3f;
                h3 = bits >> 6 & 0x3f;
                h4 = bits & 0x3f;

                // use hexets to index into b64, and append result to encoded string
                tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
            } while (i < data.length);

            enc = tmp_arr.join('');

            switch (data.length % 3) {
                case 1:
                    enc = enc.slice(0, -2) + '==';
                    break;
                case 2:
                    enc = enc.slice(0, -1) + '=';
                    break;
            }
            return enc;
        },
        /**********************************************************************
         * utf8_encode
         **********************************************************************/
        utf8_encode: function(argString) {
            if (argString === null || typeof argString === "undefined") {
                return "";
            }

            var string = (argString + ''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
            var utftext = "",
                    start, end, stringl = 0;

            start = end = 0;
            stringl = string.length;
            for (var n = 0; n < stringl; n++) {
                var c1 = string.charCodeAt(n);
                var enc = null;

                if (c1 < 128) {
                    end++;
                } else if (c1 > 127 && c1 < 2048) {
                    enc = String.fromCharCode((c1 >> 6) | 192) + String.fromCharCode((c1 & 63) | 128);
                } else {
                    enc = String.fromCharCode((c1 >> 12) | 224) + String.fromCharCode(((c1 >> 6) & 63) | 128) + String.fromCharCode((c1 & 63) | 128);
                }
                if (enc !== null) {
                    if (end > start) {
                        utftext += string.slice(start, end);
                    }
                    utftext += enc;
                    start = end = n + 1;
                }
            }

            if (end > start) {
                utftext += string.slice(start, stringl);
            }

            return utftext;
        },
        /**********************************************************************
         * d�ng cho box search trang Performance selection
         **********************************************************************/
        searchPerformance: function($search) {
            $('.observatory').html('<table id="observatoryTable"></table>');
            var $selectType = $('.box_search_obs').find('.selectType').val();
            var $selectCode = $('.box_search_obs').find('.selectCode').val();
            var $selectProvider = $('.box_search_obs').find('.selectProvider').val();
            var $selectCoverage = $('.box_search_obs').find('.selectCoverage').val();
            var $selectPrice = $('.box_search_obs').find('.selectPrice').val();
            var $selectCurrency = $('.box_search_obs').find('.selectCurrency').val();
            var $selectName = $('.box_search_obs').find('.selectName').val();
            var $q_search = $('.box_search_obs').find('.q_search').val();
            $("#observatoryTable").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Type'),
                        name: 'TYPE',
                        width: 70,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Category'),
                        name: 'SUB_TYPE',
                        width: 100,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Provider'),
                        name: 'PROVIDER',
                        width: 110,
                        sortable: false,
                        align: 'left'
                    },
                    {
                        display: ifrc.trans('Coverage'),
                        name: 'PLACE',
                        width: 100,
                        sortable: false,
                        align: 'left'
                    },
                    {
                        display: ifrc.trans('Price'),
                        name: 'PRICE',
                        width: 40,
                        sortable: false,
                        align: 'right'
                    }, {
                        display: ifrc.trans('Currency'),
                        name: 'CURR',
                        width: 80,
                        sortable: false,
                        align: 'center'
                    }, {
                        display: ifrc.trans('Name'),
                        name: 'SHORTNAME',
                        width: 198,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('History'),
                        name: 'HISTORY',
                        width: 87,
                        sortable: false,
                        align: 'right'
                    }, {
                        display: ifrc.trans('Info'),
                        name: 'action',
                        width: 52,
                        sortable: false,
                        align: 'center'
                    }],
                sortname: "iso",
                usepager: true,
                title: ifrc.trans('Result'),
                useRp: false,
                rp: 10,
                showTableToggleBtn: false,
                width: 950,
                autoload: true,
                height: 'auto',
                resizable: false,
                singleSelect: true,
                onSubmit: ParamData,
                onSuccess: function() {

                }
            });

            function ParamData() {
                $("#observatoryTable").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'getBoxdataObservatory'
                        }, {
                            name: 'type',
                            value: $selectType
                        }, {
                            name: 'code',
                            value: $selectCode
                        }, {
                            name: 'provider',
                            value: $selectProvider
                        }, {
                            name: 'coverage',
                            value: $selectCoverage
                        }, {
                            name: 'currency',
                            value: $selectCurrency
                        }, {
                            name: 'name',
                            value: $selectName
                        }, {
                            name: 'q_search',
                            value: $q_search
                        }, {
                            name: 'price',
                            value: $selectPrice
                        }, {
                            name: 'performance',
                            value: 'yes'
                        }]
                });
                return true;
            }
        },
        trans: function($key) {
            if (dataTrans != null) {
                var $key64 = $key;
                if (dataTrans[$key64]) {
                    if (dataTrans[$key64][ifrc.lang]) {
                        return dataTrans[$key64][ifrc.lang];
                    } else {
                        return $key;
                    }
                } else {
                    return $key;
                }
            } else {
                return $key;
            }
        },
        drawChart: function($title, $id, $data) {
            // var chart = new Highcharts.Chart({
            //     chart: {
            //         renderTo: $id
            //     },
            //     xAxis: {
            //         categories: numbs
            //     },

            //     series: [{
            //         data: $data
            //     }]
            // });

            var chart = new Highcharts.StockChart({
                chart: {
                    renderTo: $id
                },
                rangeSelector: {
                    selected: 1,
                    enabled: false
                },
                title: {
                    text: $title
                },
                scrollbar: {
                    barBackgroundColor: 'gray',
                    barBorderRadius: 7,
                    barBorderWidth: 0,
                    buttonBackgroundColor: 'gray',
                    buttonBorderWidth: 0,
                    buttonBorderRadius: 7,
                    trackBackgroundColor: 'none',
                    trackBorderWidth: 1,
                    trackBorderRadius: 8,
                    trackBorderColor: '#CCC'
                },
                series: [{
                        name: $title,
                        data: $data,
                        threshold: null,
                        dataLabels: {
                            enabled: true,
                            align: 'left',
                            x: -10,
                            y: 4,
                            style: {
                                fontWeight: 'bold'
                            },
                            formatter: function() {
                                return '<span class="abc" style="color:#fff" >' + Highcharts.numberFormat(this.y, 2) + '</span>';
                            }
                        },
                        tooltip: {
                            valueDecimals: 2
                        },
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, 'rgba(0,0,0,0)']
                            ]
                        },
                        marker: {
                            enabled: true,
                            radius: 3
                        },
                        type: 'area',
                        shadow: true,
                    }]
            });
        },
        drawChart2: function($title, $id, $data, $data_name) {
            // var chart = new Highcharts.Chart({
            //     chart: {
            //         renderTo: $id
            //     },
            //     xAxis: {
            //         categories: numbs
            //     },

            //     series: [{
            //         data: $data
            //     }]
            // });

            var chart = new Highcharts.StockChart({
                chart: {
                    renderTo: $id
                },
                rangeSelector: {
                    selected: 1,
                    enabled: false
                },
                title: {
                    text: $title
                },
                scrollbar: {
                    barBackgroundColor: 'gray',
                    barBorderRadius: 7,
                    barBorderWidth: 0,
                    buttonBackgroundColor: 'gray',
                    buttonBorderWidth: 0,
                    buttonBorderRadius: 7,
                    trackBackgroundColor: 'none',
                    trackBorderWidth: 1,
                    trackBorderRadius: 8,
                    trackBorderColor: '#CCC'
                },
                series: [{
                        name: 'RANK CHART',
                        data: $data,
                        threshold: null,
                        tooltip: {
                            //valueDecimals: 0,
                        },
                        dataLabels: {
                            enabled: true,
                            align: 'left',
                            x: -10,
                            y: 4,
                            style: {
                                fontWeight: 'bold'
                            },
                            formatter: function() {
                                return '<span class="abc" style="color:#fff" >' + this.y + '</span>';
                            }
                        },
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, 'rgba(0,0,0,0)']
                            ]
                        },
                        marker: {
                            enabled: true,
                            radius: 3
                        },
                        type: 'area',
                        shadow: true,
                    }]
            });
        },
        /**********************************************************************
         * load data theo month cua compare
         **********************************************************************/
        loadMonthCompare: function($code_from, $code_to) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.loadMonthCompare').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadMonthCompare&code_from=' + $code_from + '&code_to=' + $code_to,
                success: function($html) {
                    $('.loadMonthCompare').html($html);
                    $temp = getCookie('codeCompare');
                    $('.selectNameCompareMonth').val($temp);
                }
            });
        },
        /**********************************************************************
         * load data theo month cua compare show loadDayCompareFlexigrid
         **********************************************************************/
        loadMonthCompareFlexigrid: function($code_from, $code_to) {
            $("#loadMonthCompareFlexigrid").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Date'),
                        name: 'Date',
                        width: 160,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Index 1'),
                        name: 'Index_1',
                        width: 110,
                        sortable: false,
                        align: 'right'
                    }, {
                        display: ifrc.trans('Index 2'),
                        name: 'Index_2',
                        width: 140,
                        sortable: false,
                        align: 'right'
                    }, {
                        display: ifrc.trans('Index 1-2'),
                        name: 'Total',
                        width: 130,
                        sortable: false,
                        align: 'right'
                    }],
                autoload: true,
                usepager: false,
                useRp: false,
                rp: 20,
                resizable: false,
                width: 600,
                showToggleBtn: false,
                singleSelect: true,
                onSubmit: ParamData,
                height: 415,
                onSuccess: function() {
                    $('#loadMonthCompareFlexigrid td[abbr="Perform"]').each(function(index) {
                        var $varmonth = parseInt($(this).text());
                        if ($varmonth > 0) {
                            $(this).addClass('green');
                        } else {
                            $(this).addClass('red');
                        }
                    });
                }
            });

            function ParamData() {
                $("#loadMonthCompareFlexigrid").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'loadMonthCompare'
                        }, {
                            name: 'code_from',
                            value: $code_from
                        }, {
                            name: 'code_to',
                            value: $code_to
                        }, {
                            name: 'type',
                            value: 'Flexigrid'
                        }]
                });
                return true;
            }
        },
        /**********************************************************************
         * show detail compare multi
         **********************************************************************/
        showDetailCompareMulti: function($data, $data_chart) {
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=getdetailCompareMulti&data=' + $data + '&data_chart=' + $data_chart,
                success: function($html) {
                    $('.box_tab ').html($html);
                }
            });
        },
        /**********************************************************************
         * load data theo year cua observatoire
         **********************************************************************/
        loadYearCompare: function($code_from, $code_to) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.loadYearCompare').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadYearCompare&code_from=' + $code_from + '&code_to=' + $code_to,
                success: function($html) {
                    $('.loadYearCompare').html($html);
                    $temp = getCookie('codeCompare');
                    $('.selectNameCompareYear').val($temp);
                }
            });
        },
        /**********************************************************************
         * load data theo year cua observatoire show loadDayObFlexigrid
         **********************************************************************/
        loadYearCompareFlexigrid: function($code_from, $code_to) {
            $("#loadYearCompareFlexigrid").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Date'),
                        name: 'Date',
                        width: 160,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Index 1'),
                        name: 'Index_1',
                        width: 110,
                        sortable: false,
                        align: 'right'
                    }, {
                        display: ifrc.trans('Index 2'),
                        name: 'Index_2',
                        width: 140,
                        sortable: false,
                        align: 'right'
                    }, {
                        display: ifrc.trans('Index 1-2'),
                        name: 'Total',
                        width: 130,
                        sortable: false,
                        align: 'right'
                    }],
                autoload: true,
                usepager: false,
                useRp: false,
                rp: 20,
                resizable: false,
                width: 600,
                showToggleBtn: false,
                singleSelect: true,
                onSubmit: ParamData,
                height: 415,
                onSuccess: function() {
                    $('#loadYearCompareFlexigrid td[abbr="Perform"]').each(function(index) {
                        var $varmonth = parseInt($(this).text());
                        if ($varmonth > 0) {
                            $(this).addClass('green');
                        } else {
                            $(this).addClass('red');
                        }
                    });
                }
            });

            function ParamData() {
                $("#loadYearCompareFlexigrid").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'loadYearCompare'
                        }, {
                            name: 'code_from',
                            value: $code_from
                        }, {
                            name: 'code_to',
                            value: $code_to
                        }, {
                            name: 'type',
                            value: 'Flexigrid'
                        }]
                });
                return true;
            }
        },
        /**********************************************************************
         * load data theo month cua compare multi
         **********************************************************************/
        loadMonthCompareMulti: function($data) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.loadMonthCompareMulti').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadMonthCompareMulti&data=' + $data,
                success: function($html) {
                    $('.loadMonthCompareMulti').html($html);
                    $temp = getCookie('codeCompare');
                    $('.selectNameCompareMonthMulti').val($temp);
                }
            });
        },
        /**********************************************************************
         * load data theo month cua compare show loadDayCompareFlexigrid
         **********************************************************************/
        loadMonthCompareMultiFlexigrid: function($data) {
            var width_flexigrid = 685;
            var arr_data = $data.split(',');
            var total_data = arr_data.length + 1;
            var width_col = (width_flexigrid - 80) / total_data;
            var queryArr = [];

            var locations = {
                "display": ifrc.trans("Date"),
                "name": 'Date',
                "width": width_col,
                "sortable": false,
                "align": "left"
            };

            queryArr.push(locations);

            for (var i = 0; i < arr_data.length; i++) {
                var display_name = i + 1;
                var display = ifrc.trans("Index " + display_name);
                var name = i;
                var width = width_col;
                var sortable = false;
                var align = 'left';

                var locations = {
                    "display": display,
                    "name": "c" + name,
                    "width": width,
                    "sortable": sortable,
                    "align": align
                };
                queryArr.push(locations);

            }
            ;

            $("#loadMonthCompareMultiFlexigrid").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: queryArr,
                autoload: true,
                usepager: false,
                useRp: false,
                rp: 20,
                resizable: false,
                width: width_flexigrid,
                showToggleBtn: false,
                singleSelect: true,
                onSubmit: ParamData,
                height: 415,
                onSuccess: function() {
                    $('#loadMonthCompareMultiFlexigrid td[abbr="Perform"]').each(function(index) {
                        var $varmonth = parseInt($(this).text());
                        if ($varmonth > 0) {
                            $(this).addClass('green');
                        } else {
                            $(this).addClass('red');
                        }
                    });
                }
            });

            function ParamData() {
                $("#loadMonthCompareMultiFlexigrid").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'loadMonthCompareMulti'
                        }, {
                            name: 'data',
                            value: $data
                        }, {
                            name: 'type',
                            value: 'Flexigrid'
                        }]
                });
                return true;
            }
        },
        /**********************************************************************
         * load data theo year cua compare multi
         **********************************************************************/
        loadYearCompareMulti: function($data) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.loadYearCompareMulti').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadYearCompareMulti&data=' + $data,
                success: function($html) {
                    $('.loadYearCompareMulti').html($html);
                    $temp = getCookie('codeCompare');
                    $('.selectNameCompareYearMulti').val($temp);
                }
            });
        },
        /**********************************************************************
         * load data theo year cua observatoire show loadDayObFlexigrid
         **********************************************************************/
        loadYearCompareMultiFlexigrid: function($data) {
            var width_flexigrid = 685;
            var arr_data = $data.split(',');
            var total_data = arr_data.length + 1;
            var width_col = width_flexigrid / total_data;
            var queryArr = [];

            var locations = {
                "display": ifrc.trans("Date"),
                "name": 'Date',
                "width": width_col - 80,
                "sortable": false,
                "align": "left"
            };

            queryArr.push(locations);

            for (var i = 0; i < arr_data.length; i++) {
                var display_name = i + 1;
                var display = ifrc.trans("Index " + display_name);
                var name = i;
                var width = width_col;
                var sortable = false;
                var align = 'left';

                var locations = {
                    "display": display,
                    "name": "c" + name,
                    "width": width,
                    "sortable": sortable,
                    "align": align
                };
                queryArr.push(locations);

            }
            ;

            $("#loadYearCompareMultiFlexigrid").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: queryArr,
                autoload: true,
                usepager: false,
                useRp: false,
                rp: 20,
                resizable: false,
                width: width_flexigrid,
                showToggleBtn: false,
                singleSelect: true,
                onSubmit: ParamData,
                height: 415,
                onSuccess: function() {
                    $('#loadYearCompareMultiFlexigrid td[abbr="Perform"]').each(function(index) {
                        var $varmonth = parseInt($(this).text());
                        if ($varmonth > 0) {
                            $(this).addClass('green');
                        } else {
                            $(this).addClass('red');
                        }
                    });
                }
            });

            function ParamData() {
                $("#loadYearCompareMultiFlexigrid").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'loadYearCompareMulti'
                        }, {
                            name: 'data',
                            value: $data
                        }, {
                            name: 'type',
                            value: 'Flexigrid'
                        }]
                });
                return true;
            }
        },
        /**********************************************************************
         * load data chart month compare multi
         **********************************************************************/
        loadChartofMonth: function($data) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.loadChartofMonth').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadChartofMonth&data=' + $data,
                success: function($html) {
                    $('.loadChartofMonth').html($html);
                    $temp = getCookie('codeCompare');
                    $('.selectNameCompareYearMulti').val($temp);
                }
            });
        },
        /**********************************************************************
         * load data chart year compare multi
         **********************************************************************/
        loadChartofYear: function($data) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.loadChartofYear').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadChartofYear&data=' + $data,
                success: function($html) {
                    $('.loadChartofYear').html($html);
                    $temp = getCookie('codeCompare');
                    $('.selectNameCompareYearMulti').val($temp);
                }
            });
        },
        /**********************************************************************
         * load data chart year compare multi
         **********************************************************************/
        loadFactsheet: function($data) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.loadFactsheet').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadFactsheet&data=' + $data,
                success: function($html) {
                    $('.loadFactsheet').html($html);
                    $temp = getCookie('codeCompare');
                    $('.selectNameCompareYearMulti').val($temp);
                }
            });
        },
        /**********************************************************************
         * load data theo year cua observatoire show loadDayObFlexigrid
         **********************************************************************/
        loadFactsheetFlexigrid: function($data) {
            var width_flexigrid = 685;
            var arr_data = $data.split(',');
            var total_data = arr_data.length + 1;
            var queryArr = [];

            var locations = {
                "display": ifrc.trans("Description"),
                "name": 'column',
                "width": 200,
                "sortable": false,
                "align": "left"
            };

            queryArr.push(locations);

            for (var i = 0; i < arr_data.length; i++) {
                var display_name = i + 1;
                var display = ifrc.trans("Index " + display_name);
                var name = i;
                var sortable = false;
                var align = 'left';

                var locations = {
                    "display": display,
                    "name": "c" + name,
                    "width": 200,
                    "sortable": sortable,
                    "align": align
                };
                queryArr.push(locations);

            }
            ;
            $("#loadFactsheetFlexigrid").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: queryArr,
                autoload: true,
                usepager: false,
                useRp: false,
                rp: 20,
                resizable: false,
                width: width_flexigrid,
                showToggleBtn: false,
                singleSelect: true,
                onSubmit: ParamData,
                height: 415,
                onSuccess: function() {
                    $('#loadFactsheetFlexigrid td[abbr="Perform"]').each(function(index) {
                        var $varmonth = parseInt($(this).text());
                        if ($varmonth > 0) {
                            $(this).addClass('green');
                        } else {
                            $(this).addClass('red');
                        }
                    });
                }
            });

            function ParamData() {
                $("#loadFactsheetFlexigrid").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'loadFactsheet'
                        }, {
                            name: 'data',
                            value: $data
                        }, {
                            name: 'type',
                            value: 'Flexigrid'
                        }]
                });
                return true;
            }
        },
        showDetailAnnualPerformanceStatistics: function() {
            
            var $loading = '<div class="loading">Loading...</div>';
            $('.detail-observatoire').html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=getDetailAnnualPerformanceStatistics',
                success: function($html) {
                    $('.detail-observatoire').html($html);
                }
            });
        },
        loadAnnualPerformance: function($year) {
            var $loading = '<div class="loading">Loading...</div>';
            $('.loadAnnual'+$year).html($loading);
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=loadAnnual&year='+$year,
                success: function($html) {
                    $('.loadAnnual'+$year).html($html);
                }
            });
        },
        loadAnnualFlexigrid: function($year) {
            $("#loadAnnualFlexigrid"+$year).flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('No'),
                        name: 'No',
                        width: 40,
                        sortable: true,
                        align: 'center'
                    },{
                        display: ifrc.trans('Name'),
                        name: 'Name',
                        width: 460,
                        sortable: true,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Provider'),
                        name: 'Provider',
                        width: 160,
                        sortable: true,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Type'),
                        name: 'Type',
                        width: 75,
                        sortable: true,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Currency'),
                        name: 'Currency',
                        width: 100,
                        sortable: true,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Date'),
                        name: 'Date',
                        width: 100,
                        sortable: true,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Close'),
                        name: 'Close',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    }, {
                        display: ifrc.trans('Perf %'),
                        name: 'Perform',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    } ],
                autoload: true,
                usepager: true,
                useRp: false,
                rp: 20,
                resizable: false,
                showToggleBtn: false,
                singleSelect: true,
                onSubmit: ParamData,
                height: 415,
            });

            function ParamData() {
                $("#loadAnnualFlexigrid"+$year).flexOptions({
                    params: [{
                            name: 'act',
                            value: 'loadAnnual'
                        }, {
                            name: 'year',
                            value: $year
                        }, {
                            name: 'type',
                            value: 'Flexigrid'
                        }].concat($('#sform').serializeArray())
                });
                return true;
            }
        },
        
        
        
        /**********************************************************************
         * d�ng cho box search trang Daily report
         **********************************************************************/
        searchRpnull: function($search) {
            $('.observatory').html('<table id="observatoryTable"></table>');
            var $selectDate = $('.box_search_obs').find('.selectDate').val();
            var $selectProvider = $('.box_search_obs').find('.selectProvider').val();
            var $selectCurr = $('.box_search_obs').find('.selectCurr').val();
            var $selectPrtr = $('.box_search_obs').find('.selectPrtr').val();
            var $q_search = $('.box_search_obs').find('.q_search').val();
            $("#observatoryTable").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Date'),
                        name: 'DATE',
                        width: 80,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Provider'),
                        name: 'PROVIDER',
                        width: 150,
                        sortable: true,
                        align: 'left'
                    },/*{
                        display: ifrc.trans('Code'),
                        name: 'CODE',
                        width: 100,
                        sortable: true,
                        align: 'left'
                    },*/{
                        display: ifrc.trans('Name'),
                        name: 'NAME',
                        width: 400,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Close'),
                        name: 'CLOSE',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Pclose'),
                        name: 'PCLOSE',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Var %'),
                        name: 'VAR',
                        width: 80,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('MTD %'),
                        name: 'MTD',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('YTD %'),
                        name: 'YTD',
                        width: 80,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Info'),
                        name: 'action',
                        width: 40,
                        sortable: false,
                        align: 'center'
                    }],
                    
                sortname: "iso",
                usepager: true,
               // title: ifrc.trans('Result'),
                useRp: false,
                rp: 20,
                showTableToggleBtn: false,
                width: '100%',
                autoload: true,
                height: 'auto',
                resizable: false,
                singleSelect: true,
                onSubmit: ParamData,
                onSuccess: function() {  
                    
                    /* color text performance */
                    $('#observatoryTable td[abbr="VAR"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                    $('#observatoryTable td[abbr="MTD"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                    $('#observatoryTable td[abbr="YTD"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });

                    /* bold text close */
                    $('#observatoryTable td[abbr="Close"]').each(function(index) {
                        $(this).css('font-weight', 'bold');
                    });
                },
                 preProcess: function(responsedata){
                     $("#total_count").html(responsedata.total +" indexes");
                      return responsedata;
                }
                      
            });

            function ParamData() {
                $("#observatoryTable").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'getBoxdataDailyreport'
                        }, {
                            name: 'date',
                            value: $selectDate
                        }, {
                            name: 'provider',
                            value: $selectProvider
                        }, {
                            name: 'curr',
                            value: $selectCurr
                        }, {
                            name: 'prtr',
                            value: $selectPrtr
                        }, {
                            name: 'q_search',
                            value: $q_search
                        }]
                });
                return true;
            }
        },
 
        /**********************************************************************
         * d�ng cho reset select
         **********************************************************************/
        resetselect1: function() {
            $('.box_search_obs').find('.selectDate').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectProvider').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectCurr').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectPrtr').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.q_search').val(null);
        },
        
        
        /**********************************************************************
         * dung cho box search trang Report Market Day
         **********************************************************************/
		searchRpmarketserch: function($search) {
			if($('#tabs_detail_ob .ui-tabs-selected a').attr('href')=='#tabs_ob_Daily2')
			this.searchRpmarketnull_new($search);
			else 
			this.searchRpmarketnull($search);
			
		},
        searchRpmarketnull: function($search) {
            //console.log("test");
            $('.observatory').html('<table id="observatoryTable"></table>');
            var $selectDate = $('.box_search_obs').find('.selectDate').val();   
            var $selectExchange = $('.box_search_obs').find('.selectProvider').val();
            $("#observatoryTable").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Date'),
                        name: 'DATE',
                        width: 90,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Code'),
                        name: 'CODE',
                        width: 50,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Name'),
                        name: 'NAME',
                        width: 255,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Market'),
                        name: 'EXCHANGE',
                        width: 60,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Shares'),
                        name: 'SHARES',
                        width: 90,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Close'),
                        name: 'CLOSE',
                        width: 80,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Capi.(Bn)'),
                        name: 'CAPI',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Volume'),
                        name: 'VOLUME',
                        width: 62,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Turn')+ ' (K)',
                        name: 'TURNOVER',
                        width: 80,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Var %'),
                        name: 'VAR',
                        width: 50,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('MTD %'),
                        name: 'MTD',
                        width: 70,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('YTD %'),
                        name: 'YTD',
                        width: 70,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Info'),
                        name: 'action',
                        width: 40,
                        sortable: true,
                        align: 'right'
                    }],
                sortname: "iso",
                usepager: true,
               // title: ifrc.trans('Result'),
                useRp: false,
                rp: 20,
                showTableToggleBtn: false,
                width: '100%',
                autoload: true,
                height: 'auto',
                resizable: false,
                singleSelect: true,
                onSubmit: ParamData,
                onSuccess: function() {  
                    
                    /* color text performance */
                    $('#observatoryTable td[abbr="VAR"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                    $('#observatoryTable td[abbr="MTD"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                    $('#observatoryTable td[abbr="YTD"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                },
                preProcess: function(responsedata){
                 $("#total_count").html(responsedata.total + " companies");
                  return responsedata;
                }
            });

            function ParamData() {
                $("#observatoryTable").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'getBoxdataReportmarket'
                        }, {
                            name: 'date',
                            value: $selectDate
                        }, {
                            name: 'exchange',
                            value: $selectExchange
                        }]
                });
                return true;
            }
        },
 
        /**********************************************************************
         * d�ng cho reset select
         **********************************************************************/
        resetselect2: function() {
            $('.box_search_obs').find('.selectDate').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectExchange').find('option:first').attr('selected', 'selected').parent('select');
           // $('.box_search_obs').find('.q_search').val(null);
        },
        
        
        /**********************************************************************
         * d�ng cho box search trang Report Market Day 2
         **********************************************************************/
        searchRpmarketnull_new: function($search) {
            $('.observatory_new').html('<table id="observatoryTable_new"></table>');
            var $selectDate = $('.box_search_obs').find('.selectDate').val();   
            var $selectExchange = $('.box_search_obs').find('.selectProvider').val();
            $("#observatoryTable_new").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Date'),
                        name: 'DATE',
                        width: 100,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Code'),
                        name: 'CODE',
                        width: 80,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Name'),
                        name: 'NAME',
                        width: 255,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Market'),
                        name: 'EXCHANGE',
                        width: 60,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Nbdays'),
                        name: 'NBDAYS',
                        width: 70,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Perf %'),
                        name: 'PERF',
                        width: 90,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Volat %'),
                        name: 'VOLAT',
                        width: 80,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Beta %'),
                        name: 'BETA',
                        width: 70,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Velo %'),
                        name: 'VELOCITY',
                        width: 70,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Trading %'),
                        name: 'TRADING',
                        width: 90,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Turn'),
                        name: 'TURN',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Info'),
                        name: 'action',
                        width: 40,
                        sortable: true,
                        align: 'right'
                    }],
                sortname: "iso",
                usepager: true,
               // title: ifrc.trans('Result'),
                useRp: false,
                rp: 20,
                showTableToggleBtn: false,
                width: '100%',
                autoload: true,
                height: 'auto',
                resizable: false,
                singleSelect: true,
                onSubmit: ParamData,
                onSuccess: function() {  
                    
                    /* color text performance */
                    $('#observatoryTable_new td[abbr="PERF"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });  
                },
                preProcess: function(responsedata){
                 $("#total_count").html(responsedata.total + " companies");
                  return responsedata;
                }                
            });

            function ParamData() {
                $("#observatoryTable_new").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'getBoxdataReportmarket_new'
                        }, {
                            name: 'date',
                            value: $selectDate
                        }, {
                            name: 'exchange',
                            value: $selectExchange
                        }]
                });
                return true;
            }
        },
 
        /**********************************************************************
         * d�ng cho reset select
         **********************************************************************/
        resetselect2: function() {
            $('.box_search_obs').find('.selectDate').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectExchange').find('option:first').attr('selected', 'selected').parent('select');
           // $('.box_search_obs').find('.q_search').val(null);
        },
        searchReport: function($search) {
			if($('.q_search').val()!='')
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
                data: 'act=getSearchReport&name='+$('.q_search').val(),
                success: function($response) {
                    $href = $(location).attr('href');					
					$local = $href.substring(0,$href.lastIndexOf("/")-1) ;
					$local = $local.substring(0,$local.lastIndexOf("/")) ;
					$local =  $local.concat('/');
					$local =  $local.concat($('#selectMonth').val());
					$local =  $local.concat('/');
					$local =  $local.concat($response);
					$local = $local.replace('"', '');
					$local = $local.substring(0,$local.length - 1) ;
				   $(location).attr('href',$local);
                }
            }); 
			else {
				$href = $(location).attr('href');					
					$local = $href.substring(0,$href.lastIndexOf("/")-1) ;
					$str_index = $href.substring ($href.lastIndexOf("/"), $href.length);
					$local = $local.substring(0,$local.lastIndexOf("/")) ;
					$local =  $local.concat('/');
					$local =  $local.concat($('#selectMonth').val());
					$local =  $local.concat($str_index);
					//$local = $local.substring(0,$local.length - 1) ;
				   $(location).attr('href',$local);
			}
        },
         resetselectrepoprt: function() {
            //$('.box_search_obs').find('.selectDate').find('option:first').attr('selected', 'selected').parent('select');
           // $('.box_search_obs').find('.selectExchange').find('option:first').attr('selected', 'selected').parent('select');
           $('.q_search').val(null);
        },
        
        /**********************************************************************
         * d�ng cho box search trang MONTHLY report
         **********************************************************************/
        searchMonthlyrpnull: function($search) {
            $('.observatory').html('<table id="observatoryTable"></table>');
            var $selectDate = $('.box_search_obs').find('.selectDate').val();
            var $selectProvider = $('.box_search_obs').find('.selectProvider').val();
            var $selectType = $('.box_search_obs').find('.selectType').val();
            var $selectCurr = $('.box_search_obs').find('.selectCurr').val();
            var $selectPrtr = $('.box_search_obs').find('.selectPrtr').val();
            var $q_search = $('.box_search_obs').find('.q_search').val();
            $("#observatoryTable").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Date'),
                        name: 'DATE',
                        width: 100,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Provider'),
                        name: 'PROVIDER',
                        width: 150,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Type'),
                        name: 'TYPE',
                        width: 120,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Name'),
                        name: 'NAME',
                        width: 400,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Close'),
                        name: 'CLOSE',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Month %'),
                        name: 'VAR',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('YTD %'),
                        name: 'YTD',
                        width: 120,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Info'),
                        name: 'action',
                        width: 85,
                        sortable: false,
                        align: 'center'
                    }],
                    
                sortname: "iso",
                usepager: true,
               // title: ifrc.trans('Result'),
                useRp: false,
                rp: 20,
                showTableToggleBtn: false,
                width: '100%',
                autoload: true,
                height: 'auto',
                resizable: false,
                singleSelect: true,
                onSubmit: ParamData,
                onSuccess: function() {  
                    
                    /* color text performance */
                    $('#observatoryTable td[abbr="VAR"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                    $('#observatoryTable td[abbr="YTD"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                    
                    /* bold text close */
                    $('#observatoryTable td[abbr="Close"]').each(function(index) {
                        $(this).css('font-weight', 'bold');
                    });
                },
                preProcess: function(responsedata){
                 $("#total_count").html(responsedata.total + " indexes");
                  return responsedata;
                }
            });

            function ParamData() {
                $("#observatoryTable").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'getBoxdataMonthlyreport'
                        }, {
                            name: 'date',
                            value: $selectDate
                        }, {
                            name: 'provider',
                            value: $selectProvider
                        }, {
                            name: 'type',
                            value: $selectType
                        }, {
                            name: 'curr',
                            value: $selectCurr
                        }, {
                            name: 'prtr',
                            value: $selectPrtr
                        }, {
                            name: 'q_search',
                            value: $q_search
                        }]
                });
                return true;
            }
        },
 
        /**********************************************************************
         * d�ng cho reset select
         **********************************************************************/
        resetselectMonthlyrp: function() {
            $('.box_search_obs').find('.selectDate').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectProvider').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectType').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectCurr').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectPrtr').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.q_search').val(null);
        },
        /**********************************************************************
         * d�ng cho box search trang MONTHLY REPORT IFRC-PSI
         **********************************************************************/
        searchMonthlyrpifrcpsi: function($search) {
            $('.observatory').html('<table id="observatoryTable"></table>');
            var $selectDate = $('.box_search_obs').find('.selectDate').val();
            $("#observatoryTable").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Date'),
                        name: 'DATE',
                        width: 100,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Provider'),
                        name: 'PROVIDER',
                        width: 150,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Type'),
                        name: 'TYPE',
                        width: 120,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Name'),
                        name: 'NAME',
                        width: 400,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Close'),
                        name: 'CLOSE',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Month %'),
                        name: 'VAR',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Year %'),
                        name: 'YTD',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Info'),
                        name: 'action',
                        width: 85,
                        sortable: false,
                        align: 'center'
                    }],
                    
                sortname: "iso",
                usepager: true,
               // title: ifrc.trans('Result'),
                useRp: false,
                rp: 20,
                showTableToggleBtn: false,
                width: '100%',
                autoload: true,
                height: 'auto',
                resizable: false,
                singleSelect: true,
                onSubmit: ParamData,
                onSuccess: function() {  
                    
                    /* color text performance */
                    $('#observatoryTable td[abbr="VAR"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                    $('#observatoryTable td[abbr="YTD"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                    
                    /* bold text close */
                    $('#observatoryTable td[abbr="Close"]').each(function(index) {
                        $(this).css('font-weight', 'bold');
                    });
                    
                    

                }
            });

            function ParamData() {
                $("#observatoryTable").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'getBoxdataMonthlyifrcpsi'
                        }, {
                            name: 'date',
                            value: $selectDate
                        }]
                });
                return true;
            }
        },
		
         searchStockReport: function($search) {
			if($('.q_search').val()!='')
            $.ajax({
                type: "POST",
                url: $url + 'ajax',
			    data: 'act=getSearchReportStock&name='+$('.q_search').val(),
                success: function($response) {
                    $href = $(location).attr('href');					
					$local = $href.substring(0,$href.lastIndexOf("/")) ;
					$local =  $local.concat('/');
					$local =  $local.concat($response);
					$local = $local.replace('"', '');
					$local = $local.substring(0,$local.length - 1) ;
				   $(location).attr('href',$local);
                }
            }); 
            else {
                $('.observatory-content').html('<h4 style="line-height: 20px!important;">Chưa nhập mã cần tìm!!</h4>'); 
                }
			
        },
    
    /**********************************************************************
         * dung cho box search trang Report Market month
         **********************************************************************/
		searchRpmarketmonthserch: function($search) {
			if($('#tabs_detail_ob .ui-tabs-selected a').attr('href')=='#tabs_ob_Daily2')
			this.searchRpmarketnull_new($search);
			else 
			this.searchRpmarketnull($search);
			
		},
        searchRpmarketmonthnull: function($search) {
            //console.log("test");
            $('.observatory').html('<table id="observatoryTable"></table>');
            var $selectDate = $('.box_search_obs').find('.selectDate').val();   
            var $selectExchange = $('.box_search_obs').find('.selectProvider').val();
            $("#observatoryTable").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Date'),
                        name: 'DATE',
                        width: 90,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Code'),
                        name: 'CODE',
                        width: 50,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Name'),
                        name: 'NAME',
                        width: 255,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Market'),
                        name: 'EXCHANGE',
                        width: 60,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Shares'),
                        name: 'SHARES',
                        width: 90,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Close'),
                        name: 'CLOSE',
                        width: 80,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Capi.(Bn)'),
                        name: 'CAPI',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Volume'),
                        name: 'VOLUME',
                        width: 62,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Turn')+ ' (K)',
                        name: 'TURNOVER',
                        width: 80,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Var %'),
                        name: 'VAR',
                        width: 50,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('MTD %'),
                        name: 'MTD',
                        width: 70,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('YTD %'),
                        name: 'YTD',
                        width: 70,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Info'),
                        name: 'action',
                        width: 40,
                        sortable: true,
                        align: 'right'
                    }],
                sortname: "iso",
                usepager: true,
               // title: ifrc.trans('Result'),
                useRp: false,
                rp: 20,
                showTableToggleBtn: false,
                width: '100%',
                autoload: true,
                height: 'auto',
                resizable: false,
                singleSelect: true,
                onSubmit: ParamData,
                onSuccess: function() {  
                    
                    /* color text performance */
                    $('#observatoryTable td[abbr="VAR"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                    $('#observatoryTable td[abbr="MTD"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                    $('#observatoryTable td[abbr="YTD"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });

                }
            });

            function ParamData() {
                $("#observatoryTable").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'getBoxdataReportmarket'
                        }, {
                            name: 'date',
                            value: $selectDate
                        }, {
                            name: 'exchange',
                            value: $selectExchange
                        }]
                });
                return true;
            }
        },
 
        /**********************************************************************
         * d�ng cho reset select
         **********************************************************************/
        resetselectmkmonth: function() {
            $('.box_search_obs').find('.selectDate').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectExchange').find('option:first').attr('selected', 'selected').parent('select');
           // $('.box_search_obs').find('.q_search').val(null);
        },
        
        
        /**********************************************************************
         * d�ng cho box search trang Report Market Day 2
         **********************************************************************/
        searchRpmarketmonthnull_new: function($search) {
            $('.observatory_new').html('<table id="observatoryTable_new"></table>');
            var $selectDate = $('.box_search_obs').find('.selectDate').val();   
            var $selectExchange = $('.box_search_obs').find('.selectProvider').val();
            $("#observatoryTable_new").flexigrid({
                url: $url + 'ajax',
                dataType: 'json',
                colModel: [{
                        display: ifrc.trans('Date'),
                        name: 'DATE',
                        width: 100,
                        sortable: false,
                        align: 'left'
                    }, {
                        display: ifrc.trans('Code'),
                        name: 'CODE',
                        width: 80,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Name'),
                        name: 'NAME',
                        width: 255,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Market'),
                        name: 'EXCHANGE',
                        width: 60,
                        sortable: true,
                        align: 'left'
                    },{
                        display: ifrc.trans('Nbdays'),
                        name: 'NBDAYS',
                        width: 70,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Perf %'),
                        name: 'PERF',
                        width: 90,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Volat %'),
                        name: 'VOLAT',
                        width: 80,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Beta %'),
                        name: 'BETA',
                        width: 70,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Velo %'),
                        name: 'VELOCITY',
                        width: 70,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Trading %'),
                        name: 'TRADING',
                        width: 90,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Turn'),
                        name: 'TURN',
                        width: 100,
                        sortable: true,
                        align: 'right'
                    },{
                        display: ifrc.trans('Info'),
                        name: 'action',
                        width: 40,
                        sortable: true,
                        align: 'right'
                    }],
                sortname: "iso",
                usepager: true,
               // title: ifrc.trans('Result'),
                useRp: false,
                rp: 20,
                showTableToggleBtn: false,
                width: '100%',
                autoload: true,
                height: 'auto',
                resizable: false,
                singleSelect: true,
                onSubmit: ParamData,
                onSuccess: function() {  
                    
                    /* color text performance */
                    $('#observatoryTable_new td[abbr="PERF"]').each(function(index) {
                        var $varday = $(this).text();
                        if ($varday.match("-")) {
                            $(this).addClass('red');
                        } else {
                            $(this).addClass('green');
                        }
                    });
                    
                }
            });

            function ParamData() {
                $("#observatoryTable_new").flexOptions({
                    params: [{
                            name: 'act',
                            value: 'getBoxdataReportmarket_new'
                        }, {
                            name: 'date',
                            value: $selectDate
                        }, {
                            name: 'exchange',
                            value: $selectExchange
                        }]
                });
                return true;
            }
        },
 
        /**********************************************************************
         * d�ng cho reset select
         **********************************************************************/
        resetselect2: function() {
            $('.box_search_obs').find('.selectDate').find('option:first').attr('selected', 'selected').parent('select');
            $('.box_search_obs').find('.selectExchange').find('option:first').attr('selected', 'selected').parent('select');
           // $('.box_search_obs').find('.q_search').val(null);
        },
    
    
    
    
    
    
    
    
    };
}(ifrc));