<div id="compare-chart" style="margin-bottom: 20px;"></div>
<script src="<?php echo TEMPLATE_URL ?>js/jquery-1.10.1.min.js"></script>
<script src="<?php echo TEMPLATE_URL ?>js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL ?>js/lodash.min.js"></script>
<script type="text/javascript">
//     $(document).ready(function(){
//         var name = '', code = '';
//         code = "<?= $data['icode'] ?>"
//         var data = new Object;
//         $.ajax({
//             url: '<?= BASE_URL ?>' + 'block/compare_chart_2',
//             type: "POST",
//             data: 'code='+code,
//             async: false,
//             success: function(rs) {
//                 data.data = JSON.parse(rs);
//                 data.name = name;
//                 var hnx = JSON.parse($("#hnx").val());
//                 var vni = JSON.parse($("#vni").val());
//                 var $data_date = new Array;
//                 var hnx_date = new Array;
//                 var vni_date = new Array;
//                 var hnx_tmp = new Array;
//                 var vni_tmp = new Array;
//                 var $data_tmp = new Array;
//                 $.each(data.data, function(key, item) {
//                     $data_date.push(item[0]);
//                 });
//                 $.each(hnx, function(key, item) {
//                     hnx_date.push(item[0]);
//                 });
//                 $.each(vni, function(key, item) {
//                     vni_date.push(item[0]);
//                 });
//                 var dates = _.intersection($data_date, hnx_date, vni_date);
//                 $.each(dates, function(key, item) {
//                     $.each(data.data, function(key2, item2) {
//                         if (item2[0] == item) {
//                             $data_tmp.push(item2);
//                         }
//                     });
//                     $.each(hnx, function(key2, item2) {
//                         if (item2[0] == item) {
//                             hnx_tmp.push(item2);
//                         }
//                     });
//                     $.each(vni, function(key2, item2) {
//                         if (item2[0] == item) {
//                             vni_tmp.push(item2);
//                         }
//                     });
//                 });
//                 var chartingOptions = {
//                     chart: {
//                         renderTo: "compare-chart",
//                         events: {
//                             load: function() {

//                             }
//                         },
//                         zoomType: "x",
//                         backgroundColor: {
//                             linearGradient: [0, 0, 0, 400],
//                             stops: [
//                                 [0, "rgb(54, 61, 62)"],
//                                 [1, "rgb(16, 16, 16)"]
//                             ]
//                         }
//                         // width: 328
//                     },
//                     xAxis: {
//                         ordinal: true,
//                         type: "datetime",
//                         labels: {
//                             formatter: function() {
//                                 var monthStr = Highcharts.dateFormat("%m/%y", this.value);
//                                 return monthStr;
//                             }
//                         },
//                         tickInterval: 30 * 24 * 3600 * 1000
//                     },
//                     plotOptions: {
//                         series: {
//                             compare: "percent"
//                         }
//                     },
//                     tooltip: {
//                         xDateFormat: "%e/%B/%Y ",
//                         pointFormat: "<span style='color:{series.color}'>{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>",
//                         valueDecimals: 2
//                     },
//                     legend: {
//                         enabled: true,
//                         shadow: true
//                     },
//                     rangeSelector: {
//                         enabled: false
//                     },
//                     scrollbar: {
//                         enabled: false
//                     },
//                     navigator: {
//                         enabled: false
//                     },
//                     title: {
//                         text: data.name,
//                         style: {
//                             color: "#1C89B3",
//                             fontWeight: "bold"
//                         }
//                     },
//                     subtitle: {},
//                     series: [
//                         {
//                             showInLegend: false,
//                             name: data.name,
//                             color: "#1C89B3",
//                             lineWidth: 5,
//                             dataGrouping: {
//                                 enabled: false
//                             },
//                             data: $data_tmp
//                         },
//                         {
//                             name: "HNX",
//                             color: "#e07211",
//                             dataGrouping: {
//                                 enabled: false
//                             },
//                             data: hnx_tmp
//                         },
//                         {
//                             name: "VNI",
//                             color: "#9e1515",
//                             dataGrouping: {
//                                 enabled: false
//                             },
//                             data: vni_tmp
//                         }]
//                 };
//                 var chartst = new Highcharts.StockChart(chartingOptions);
//             }
//         });
//     });
    $(document).ready(function() {
        var name = '', code = '';
        code = "<?= $data['icode'] ?>";
        var data = new Object;
        $.ajax({
            url: '<?= BASE_URL ?>' + 'block/compare_chart_2',
            data: 'code1=' + code + '&code2=IFRCHNX&code3=IFRCVNI',
            type: "POST",
            async: false,
            success: function(rs) {
                data = JSON.parse(rs);
                drawCompare(data);
            }
        });
        function drawCompare($data) {
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
        }
    });
</script>
