// Filename: views/welcome
define([
    'jquery',
    'underscore',
    'backbone'
], function($, _, Backbone) {
    var reportStockView = Backbone.View.extend({
        el: $(".main-container"),
        initialize: function() {
        },
        events: {
        },
        
        index: function() {
            $(document).ready(function() {
                reportStockView.compare($("#stock_code").val());
            });
        },
        drawCompare: function($data) {
			
            var dataColor = [];
            dataColor.push("#1C89B3");
            dataColor.push("#e07211");
            dataColor.push("#9e1515");
            var seriesArr = [];
            var i = 0;
            var title = '';
            $.each($data.data, function(key, data) {
                if (i == 0) {
                    var lineWidth = 5;
                    var showInLegend = false;
                    title = $data.name[key];
                } else {
                    var lineWidth = 2;
                    var showInLegend = true;
                }
                var series = {
                    name: $data.name[key],
                    showInLegend: showInLegend,
                    color: dataColor[i],
                    lineWidth: lineWidth,
                    dataGrouping: {enabled: false},
                    data: []
                };
                $.each(data, function(index, value) {
                    var arrTest = [];
                    arrTest.push(value.date);
                    series.data.push(arrTest);
                });
                $.each(data, function(index, value) {
                    series.data[index].push(value.value);
                });
                seriesArr.push(series);
                i++;
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
                    events: {
                        load: function() {
                            this.renderer.image('<?= BASE_URL ?>template/images/logo_index.png', 10, 5, 35, 35)
                                .add();
                        }
                    }
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
                    tickInterval: 30 * 24 * 3600 * 1000
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
                    text: title,
                    style: {
                        color: "#1C89B3",
                        fontWeight: "bold"
                    }
                },
                subtitle: {},
                series: seriesArr
            };
            var chartst = new Highcharts.StockChart(chartingOptions);
        },
        compare: function(code) {
            var data = new Object;
            $.ajax({
                url: $base_url + 'block/compare_chart_company_2/' + code,
                async: false,
                success: function(rs) {
					 data = JSON.parse(rs);
                    reportStockView.drawCompare(data);
                }
            });
        },
        render: function() {
            if (typeof this[$app.action] != 'undefined') {
                new this[$app.action];
            }
        }
    });
    return reportStockView = new reportStockView;
});
