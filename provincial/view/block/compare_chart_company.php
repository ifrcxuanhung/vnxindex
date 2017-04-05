<div id="compare-chart" style="margin-bottom: 20px;"></div>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var name = '', code = '';
        code = "<?= $data['icode'] ?>";
        var data = new Object;
        $.ajax({
            url: '<?= BASE_URL ?>' + 'block/compare_chart_company_2',
            data: 'code1=' + code,
            type: 'POST',
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
