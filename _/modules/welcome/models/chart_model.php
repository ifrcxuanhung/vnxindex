<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chart_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    function load_chart( $data_chart, $title, $min, $subtitle = 'Daily', $id, $titleyAxis ) {

        $content = '
        <script type="text/javascript">
        var chart;
        $(document).ready(function() {
            chart = new Highcharts.Chart({

                chart: {
                    renderTo: "'.$id.'",
                    margin: [80, 40, 60, 60],
                    zoomType: "x",
                     backgroundColor: {
                     linearGradient: [0, 0, 0, 400],
                     stops: [
                        [0, "rgb(54, 61, 62)"],
                        [1, "rgb(16, 16, 16)"]
                     ]
                      },
                    defaultSeriesType: "area",
                    ignoreHiddenSeries: false,
                    events: {
                        load: function() {
                            this.renderer.image($template_url+"images/logo_index.png", 10, 5, 35, 35)
                                .add();
                        }
                    }
                },
                title: {text: "'.$title.'",
                style: {
                    margin: "10px 0 0 0",
            color:"#3399cc",
            fontSize: "12px"
                }
            },
            subtitle: {
                text: "'.$subtitle.'",
                style: {
                    margin: "0 0 0 0",
            fontSize: "12px"
                }
            },
            xAxis: {
                type: "datetime"
            },
            yAxis: [{
                    title: {
                         text: "'.$titleyAxis.'",
                         rotation: 0,
                         x: 0,
                         y: -170,
                         style: {
                            color: "#4572A7"
                         },
                         margin: 0
                     },
                     labels: {
                        formatter: function() {
                            return this.value;
                        },
                        style: {
                            color: "#4572A7"
                        }
                    }';
        if ( $min != '' )
            $content .= ',min:'.$min.',startOnTick: false';
        $content .='

                }],
            tooltip: {
                formatter: function() {
                    return ""+
                        Highcharts.dateFormat(" %m/%e/%Y", this.x) + ":"+
                        "'.$titleyAxis.' = "+ Highcharts.numberFormat(this.y, 2) +"";
                }
            },
            legend: {
                align: "center",
                backgroundColor: null,
                borderColor:"#909090",
                borderRadius: 5,
                borderWidth: 1,
                enabled: true,
                itemWidth: null,
                layout: "horizontal",
                lineHeight: 16,
                reversed: false,
                shadow: false,
                symbolPadding: 2,
                symbolWidth: 20,
                verticalAlign: "bottom",
                width: null,
                x: -70,
                y: 5
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: [32, 38, 38, 300],
                        stops: [
                            [0, "#0a84ff"],
                            [1, "rgba(0,107,215,0)"]
                        ]
                    },
                    lineWidth: 2,
                    marker: {
                        enabled: false,
                        states: {
                            hover: {
                                enabled: true,
                                radius: 4
                            }
                        }
                    },
                    shadow: false,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    }
                }
            },
            series: [';
		//echo "<pre>";print_r($data_chart);exit;
        foreach ( $data_chart as $value ) {
            $content .= '
                {
                    type: "area",
                    name: "'.$value['name'].'",
                    color: "'.$value['color'].'",
                    ';
            $content .= 'data: ['.$value['data'].']
                },
                ';
        }
        $content .= ']
            });
                });
            </script>
            ';

        return $content;
    }

    function load_chart_compare( $data_chart, $title, $min, $subtitle = 'Daily', $id, $titleyAxis ) {
		
        $content = '<script type="text/javascript">';
        $content.='var chartingOptions = {
                chart: {
                    renderTo: "'.$id.'",
                    events: {
                        load: function() {
                            this.renderer.image($template_url+"images/logo_index.png", 10, 5, 35, 35)
                                .add();
                        }
                    },
                    zoomType: "x",
                    backgroundColor: {
                     linearGradient: [0, 0, 0, 400],
                     stops: [
                        [0, "rgb(54, 61, 62)"],
                        [1, "rgb(16, 16, 16)"]
                     ]
                    }
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
                    pointFormat: "<span style=\'color:{series.color}\'>{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>",
                    valueDecimals: 2
                },
                legend: {
                    enabled: true,
                    shadow: true,
                    itemStyle: {
                        color: "#FFFFFF"
                    },
                    itemHoverStyle: {
                        color: "#CCCCCC"
                    }
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
                    text:"'.$title.'",
                    style: {
                        color: "#FFFFFF",
                    }
                },
                subtitle: {},
                series: [';
				
        foreach ( $data_chart as $value ) {
            $content .= '
                {

                    name: "'.$value['name'].'",
                    color: "'.$value['color'].'",
                    dataGrouping: {
                        enabled: false
                    },';
            $content .= 'data: ['.$value['data'].']
                },';
        }
        $content.=']
            };
            var chartst = new Highcharts.StockChart(chartingOptions);';
        $content .= '</script>';
        return $content;
    }

    function load_chart_compare_2( $data_chart, $title, $min, $subtitle = 'Daily', $id, $titleyAxis ) {
        $content = '<script type="text/javascript">';
        $content.='var chartingOptions = {
                chart: {
                    renderTo: "'.$id.'",
                    events: {
                        load: function() {
                            this.renderer.image($template_url+"images/logo_index.png", 10, 5, 35, 35)
                                .add();
                        }
                    },
                    zoomType: "x",
                    backgroundColor: {
                     linearGradient: [0, 0, 0, 400],
                     stops: [
                        [0, "rgb(54, 61, 62)"],
                        [1, "rgb(16, 16, 16)"]
                     ]
                    }
                },
                xAxis: {
                    type: "datetime",
                    dateTimeLabelFormats: {
                        day: "%Y"
                    },
                },
                plotOptions: {
                    series: {
                        compare: "percent"
                    }
                },

                tooltip: {
                    //xDateFormat: "%e/%B/%Y ",
                    pointFormat: "<span style=\'color:{series.color}\'>{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>",
                    valueDecimals: 2
                },
                legend: {
                    enabled: true,
                    shadow: true,
                    itemStyle: {
                        color: "#FFFFFF"
                    },
                    itemHoverStyle: {
                        color: "#CCCCCC"
                    }
                },
                rangeSelector: {
                    enabled: false
                },
                scrollbar: {
                    enabled: false
                },
                navigator: {
                    enabled: true
                },
                title: {
                    text:"'.$title.'",
                    style: {
                        color: "#FFFFFF",
                    }
                },
                subtitle: {},
                series: [';
        foreach ( $data_chart as $value ) {
            $content .= '
                {

                    name: "'.$value['name'].'",
                    color: "'.$value['color'].'",
                    dataGrouping: {
                        enabled: false
                    },';
            $content .= 'data: ['.$value['data'].']
                },';
        }
        $content.=']
            };
            var chartst = new Highcharts.StockChart(chartingOptions);';
        $content .= '</script>';
        return $content;
    }
    public function getMarketCompany($code = '')
    {
        $sql = "select market
                from stk_month_chart
                where ticker = '{$code}'
                limit 1;";
        $rows = $this->db->query($sql)->result_array();
        return $rows[0]['market'];
    }
    public function getDateCompareChartCompany($companyCode = '', $market = '')
    {
        switch (strtolower($market))
        {
            case 'vnxhn':
                $sql = "select replace(stk_month_chart.date, '-', '/') date
                        from stk_month_chart, (select date_format(str_to_date(date, '%Y/%m/%d'), '%Y-%m-%d') date
                        from idx_month
                        where code = 'IFRCHNX') temp
                        where stk_month_chart.ticker = '{$companyCode}'
                        and stk_month_chart.date = temp.date
                        order by stk_month_chart.date asc
                        limit 1;";
                break;
            case 'vnxhm':
                $sql = "select replace(stk_month_chart.date, '-', '/') date
                        from stk_month_chart, (select date_format(str_to_date(date, '%Y/%m/%d'), '%Y-%m-%d') date
                        from idx_month
                        where code = 'IFRCVNI') temp
                        where stk_month_chart.ticker = '{$companyCode}'
                        and stk_month_chart.date = temp.date
                        order by stk_month_chart.date asc
                        limit 1;";
                break;
            default:
                $sql = "select replace(min(date), '-', '/') date
                        from stk_month_chart
                        where ticker = '{$companyCode}';";
                break;
        }
        $date = $this->db->query($sql)->result_array();
        return $date[0]['date'];
    }
    public function getAdjClose($code = '', $date = '')
    {
        $sql = "select adjclose, replace(date, '-', '/') date
                from stk_month_chart
                where ticker = '{$code}'
                and date >= replace('{$date}', '/', '-')
                order by date asc;";
        $rows = $this->db->query($sql)->result_array();
        $data = array();
        if (!empty($rows))
        {
            foreach ($rows as $key => $item)
            {
                $data[$key]['date'] = strtotime(date("Y/m/d", strtotime($item['date']))) * 1000;
                $data[$key]['value'] = $item['adjclose'] * 1;
            }
        }
        return $data;
    }
 public function getDetailCompany($code = '')
    {
        switch ($this->session->userdata('curent_language'))
        {
            case 'vn':
                $sql = "select upper(stk_name_sn_vn) as stk_name, stk_market, stk_curr, upper(b.sec_name_vn) as sec_name, c.country, d.mar_name,upper(e.curr_name) as curr_name
                        from stk_ref as a, sec_ref as b, gwc_country_ref as c, mar_ref as d, vndb_currency_ref as e
                        where a.ticker = '{$code}' and a.stk_sector=b.sec_code
                        and a.country=c.ccountry and a.stk_market=d.mar_code and a.stk_curr=e.curr_code
                        order by a.ipo desc                        
                        limit 1;";
                break;
            default:
                $sql = "select upper(stk_name_sn) as stk_name, stk_market, stk_curr, upper(b.sec_name) as sec_name,c.country, d.mar_name,upper(e.curr_name) as curr_name
                        from stk_ref as a, sec_ref as b, gwc_country_ref as c, mar_ref as d, vndb_currency_ref as e
                        where a.ticker = '{$code}' and a.stk_sector=b.sec_code
                        and a.country=c.ccountry and a.stk_market=d.mar_code and a.stk_curr=e.curr_code
                        order by a.ipo desc                        
                        limit 1;";
                break;
        }
        return $this->db->query($sql)->result_array();
    }
    public function getClose($code, $date)
    {
        $sql = 'SELECT close, date FROM idx_month WHERE code = "' . $code . '" AND date >= "' . $date . '" ORDER BY date ASC';
        $rows = $this->db->query($sql)->result_array();
        $data = array();
        if (!empty($rows))
        {
            foreach ($rows as $key => $item)
            {
                $data[$key]['date'] = strtotime(date("Y/m/d", strtotime($item['date']))) * 1000;
                $data[$key]['value'] = $item['close'] * 1;
            }
        }
        return $data;
    }
     public function getIndexName($code)
    {
        $idx_name = '';
        $sql = "select ref.idx_name_sn
                from idx_ref ref, idx_month mchart
                where ref.idx_code = mchart.code
                and mchart.code = '{$code}'
                limit 1;";
        $rows = $this->db->query($sql)->result_array();
        $idx_name = @$rows[0]['idx_name_sn'];
        return $idx_name;
    }
    public function getIndexSectorCompany($companyCode = '')
    {
        $sql = "select idx_compo.CODE
                from idx_compo, idx_ref
                where idx_compo.ISIN = '{$companyCode}'
                and idx_ref.idx_code = idx_compo.CODE
                and idx_ref.idx_bbs = 'Sector'
                -- and idx_compo.PROVIDER = 'IFRC'
                limit 1;";
        $data = $this->db->query($sql)->result_array();
        return $data[0]['CODE'];
    }
    
}

?>
