// Filename: views/welcome
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var homeView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click #btn-compare": "getCode"
            },
            getCode: function(event){
                $("#compare-chart").html("<img src='"+$base_url+"assets/images/loading_1.gif' style='width:20px; height:20px; margin: auto; display: block' />");
                var code = $("select[name='code']").val();
                var name = $("select[name='code'] option[value='" + code + "']").html();
                homeView.compare(code, name);
            },
            index: function(){
                $(document).ready(function(){
                    var code = $("select[name='code']").val();
                    var name = $("select[name='code'] option[value='" + code + "']").html();
                    homeView.compare(code, name);                    
                });
            },
            drawCompare: function($data){
                var hnx = JSON.parse($("#hnx").val());
                var vni = JSON.parse($("#vni").val());
                var $data_date = new Array;
                var hnx_date = new Array;
                var vni_date = new Array;
                var hnx_tmp = new Array;
                var vni_tmp = new Array;
                var $data_tmp = new Array;
                $.each($data.data, function(key, item){
                    $data_date.push(item[0]);
                });
                $.each(hnx, function(key, item){
                    hnx_date.push(item[0]);
                });
                $.each(vni, function(key, item){
                    vni_date.push(item[0]);
                });
                var dates = _.intersection($data_date, hnx_date, vni_date);
                $.each(dates, function(key, item){
                    $.each($data.data, function(key2, item2){
                        if(item2[0] == item){
                            $data_tmp.push(item2);
                        }
                    });
                    $.each(hnx, function(key2, item2){
                        if(item2[0] == item){
                            hnx_tmp.push(item2);
                        }
                    });
                    $.each(vni, function(key2, item2){
                        if(item2[0] == item){
                            vni_tmp.push(item2);
                        }
                    });
                });
                var chartingOptions = {
                    chart: {
                        renderTo: "compare-chart",
                        events: {
                            load: function() {

                            }
                        },
                        zoomType: "x",
                        backgroundColor: {
                         linearGradient: [0, 0, 0, 400],
                         stops: [
                            [0, "rgb(54, 61, 62)"],
                            [1, "rgb(16, 16, 16)"]
                         ]
                        },
                        // width: 328
                    },
                    xAxis: {
                        ordinal: true,
                        type: "datetime",
                        labels: {
                            formatter: function() {
                                var monthStr = Highcharts.dateFormat("%m/%y", this.value);
                                return monthStr;
                            }
                        },
                        tickInterval: 30 * 24 * 3600 * 1000,
                    },
                    plotOptions: {
                        series: {
                            compare: "percent"
                        }
                    },

                    tooltip: {
                        xDateFormat: "%e/%B/%Y ",
                        pointFormat: "<span style='color:{series.color}'>{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>",
                        valueDecimals: 2
                    },
                    legend: {
                        enabled: true,
                        shadow: true
                    },
                    rangeSelector: {
                        enabled: false
                    },
                    scrollbar: {
                        enabled: false
                    },
                    navigator: {
                        enabled: false
                    },
                    title: {
                        text: $data.name,
                        style: {
                            color: "white",
                            fontWeight: "bold"
                        }
                    },
                    subtitle: {},
                    series: [
                    {
                        showInLegend: false,
                        name: $data.name,
                        color: "green",
                        dataGrouping: {
                            enabled: false
                        },
                        data: $data_tmp
                    },
                    {

                        name: "HNX",
                        color: "#e07211",
                        dataGrouping: {
                            enabled: false
                        },
                        data: hnx_tmp
                    },
                    {

                        name: "VNI",
                        color: "#9e1515",
                        dataGrouping: {
                            enabled: false
                        },
                        data: vni_tmp
                    }]
                };
                var chartst = new Highcharts.StockChart(chartingOptions);
            },
            compare: function(code, name){
                if(typeof name == 'undefined'){
                    name = code;
                }
                var data = new Object;
                $.ajax({
                    url: $base_url + 'block/compare_chart/' + code,
                    async: false,
                    success: function(rs){
                        data.data = JSON.parse(rs);
                        data.name = name;
                        homeView.drawCompare(data);
                    }
                });
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return homeView = new homeView;
});
