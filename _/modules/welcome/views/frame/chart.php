<div id="compare-chart" style="width: 100%; margin-top: 20px"></div>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/bundles/jquery-1.7.2.min.js'></script>
<script src="<?php echo template_url(); ?>js/highstock.js" type="text/javascript"></script>        
<script src="<?php echo template_url(); ?>js/exporting.js"></script>
<script type="text/javascript">
	var $base_url = '<?= base_url() ?>';
    $(document).ready(function() {
    	var vars = [], hash, code = [], key;
	    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	    for(var i = 0; i < hashes.length; i++)
	    {
	        hash = hashes[i].split('=');
	        

	        key = hash[0];
	        var isFound = key.search(/code/i);
	        if(isFound == 0){
	        	code.push(hash[1]);
	        }else{
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
	    }
	    if(code.length <= 3){
	    	if(vars.frequency != undefined){
	    		if(vars.frequency.length != 0){
                    if(vars.line == 'simple' || vars.line == 'double'){
                        if(vars.save == 'on' || vars.save == 'off'){
                            if(vars.background == 'light' || vars.background == 'dark'){
                                compare(code, vars.frequency, vars.line, vars.save, vars.background);
                            }else{
                                document.write('<p>Error: Background "'+vars.background+'"" is not define</p>');
                            }
                        }else{
                            document.write('<p>Error: Save "'+vars.save+'"" is not define</p>');
                        }
                    }else{
                        document.write('<p>Error: Line "'+vars.line+'"" is not define</p>');
                    }
	    		}else{
					document.write('<p>Error: Frequency is not null</p>');
	    		}
	    	}else{
	    		document.write('<p>Error: Where is frequency?</p>');
	    	}
	    }else{
	    	document.write('<p>Error: Maximum is 3 code</p>');
	    }
    });
    function drawCompare($data, $line, $save, $background){
        var dataColor = [];
        dataColor.push("#1C89B3");
        dataColor.push("#e07211");
        dataColor.push("#9e1515");

        var seriesArr = [];
        var i = 0;
        var save = false;
        if($save == "on"){
            save = true;
        }
        var background = [];
        if($background == 'light'){
            background.push(new Array( 0, "rgb(255, 255, 255)" ));
            background.push(new Array( 0, "rgb(240, 240, 255)" ));
        }else{
            background.push(new Array( 0, "rgb(54, 61, 62)" ));
            background.push(new Array( 0, "rgb(16, 16, 16)" ));
        }
        $.each($data.data, function (key, data) {
            if(i == 0){
                if($line == 'simple'){
                    var lineWidth = 2;
                }else{
                    var lineWidth = 5;
                }
            }else{
                var lineWidth = 2;
            }
            var series = {
                name: key,
                showInLegend: true,
                color: dataColor[i],
                lineWidth: lineWidth,
                dataGrouping: {enabled: false},
                data: []
            };

            $.each(data, function (index, value) {
                var arrTest = [];
                arrTest.push(value.date);
                series.data.push(arrTest);
            });

            $.each(data, function (index, value) {
                series.data[index].push(value.value);
            });
            
            seriesArr.push(series);
            i++;
        });

        var chartingOptions = {
            chart: {
                renderTo: "compare-chart",
                events: {
                    load: function() {}
                },
                zoomType: "x",
                backgroundColor: {
                    linearGradient: [0, 0, 0, 400],
                    stops: background
                },
            },
            xAxis: {
                ordinal: true,
                type: "datetime",
                labels: {
                    formatter: function() {
                        return Highcharts.dateFormat("%Y", this.value);
                    }
                },
                tickInterval: 365 * 24 * 3600 * 1000
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
            navigation: {
                buttonOptions: {
                    enabled: save
                }
            },
            title: {
                text: $data.name,
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

    function compare(dataCode, frequency, line, save, background){
        var dataType = '';
        var i = 0;
    	$.each(dataCode, function( index, value ) {
            index = index + 1;
            if(i == 0){
                dataType += 'code'+index+'='+value;
            }else{
                dataType += '&code'+index+'='+value;
            }
            i++;
        });
        dataType = dataType + '&frequency='+frequency;
        var data = new Object;
        $.ajax({
            url: $base_url + 'block/compare_chart_2',
            data: dataType,
            type: "POST",
            async: false,
            success: function(rs) {
                data = JSON.parse(rs);
                drawCompare(data, line, save, background);
            }
        });
    }
</script>