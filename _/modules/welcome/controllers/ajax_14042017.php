<?php

class Ajax extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
		//echo '<pre>';print_r($_POST);exit;
        switch (@$_POST['act']) {
            case 'updatePerfUserName' : $this->updatePerfUserName();
                break;
            case 'boxWorldIndexes' : $this->boxWorldIndexes();
                break;
            case 'saveSelectionToDB' : $this->saveSelectionToDB();
                break;
            case 'getDataChartHome' : $this->getDataChartHome();
                break;
            case 'getDateChartHome' : $this->getDateChartHome();
                break;
            case 'getCodeByNameFromTo' : $this->getCodeByNameFromTo();
                break;
            case 'getCodeByName' : $this->getCodeByName();
                break;
            case 'getNameHome' : $this->getNameHome();
                break;
            case 'getRankData' : $this->getRankData();
                break;
            case 'getRankData2' : $this->getRankData2();
                break;
            case 'getPerfData' : $this->getPerfData();
                break;
            case 'checkObsdate' : $this->checkObsdate();
                break;
            case 'getPerfData2' : $this->getPerfData2();
                break;
            case 'getPerfData3' : $this->getPerfData3();
                break;
            case 'loadFactsheet' : $this->loadFactsheet();
                break;
            case 'loadMonthCompare' : $this->loadMonthCompare();
                break;
            case 'loadMonthCompareMulti' : $this->loadMonthCompareMulti();
                break;
            case 'loadYearCompare' : $this->loadYearCompare();
                break;
            case 'loadYearCompareMulti' : $this->loadYearCompareMulti();
                break;
            case 'getListCode' : $this->getListCode();
                break;
            case 'getIdxSample' :$this->getIdxSample();
                break;
            case 'getBoxIndexesHome' : $this->getBoxIndexesHome();
                break;
            case 'getBoxdataObservatory' :$this->getBoxdataObservatory();
                break;
            case 'getdetailCompare' :$this->getdetailCompare();
                break;
            case 'getdetailCompareMulti' :$this->getdetailCompareMulti();
                break;
            case 'loadChartofMonth': $this->loadChartofMonth();
                break;
            case 'loadChartofYear': $this->loadChartofYear();
                break;
            case 'getdetailObservatory' :$this->getdetailObservatory();
                break;
            case 'getdetailCompo' :$this->getdetailCompo();
                break;
            case 'loadDayOb' :$this->loadDayOb();
                break;
            case 'loadMonthOb' :$this->loadMonthOb();
                break;
            case 'loadYearOb' :$this->loadYearOb();
                break;
            case 'loadRulesOb' :$this->loadRulesOb();
                break;
            case 'loadPublicOb' :$this->loadPublicOb();
                break;
            case 'loadDataCompare' :$this->loadDataCompare();
                break;
            case 'getarticle' :$this->getarticle();
                break;
            case 'getReport' :$this->getReport();
                break;
            case 'getDataGlobalBoxHome':$this->getDataGlobalBoxHome();
                break;
            case 'getDataGlobalBoxHomeObs':$this->getDataGlobalBoxHomeObs();
                break;
            case 'getDataGlobalBoxHomeVnx':$this->getDataGlobalBoxHomeVnx();
                break;
            case 'getDataIFRCBoxHome':$this->getDataIFRCBoxHome();
                break;
            case 'getDataIFRCBoxHomeObs':$this->getDataIFRCBoxHomeObs();
                break;
            case 'process_step':$this->process_step();
                break;
            case 'process_final':$this->process_final();
                break;
            case 'process_sort':$this->process_sort();
                break;
            case 'process_export':$this->process_export();
                break;
            case 'getBoxdataVnx' :$this->getBoxdataVnx();
                break;
            case 'getDetailAnnualPerformanceStatistics' :$this->getDetailAnnualPerformanceStatistics();
                break;
            case 'loadAnnual' :$this->loadAnnual();
                break;
            case 'getBoxdataDailyreport' :$this->getBoxdataDailyreport();
                break;
			case 'getSearchReport' :$this->getSearchReport();
                break;
			case 'getSearchReportStock' :$this->getSearchReportStock();
                break;
            case 'getBoxdataReportmarket' :$this->getBoxdataReportmarket();
                break;
            case 'getBoxdataReportmarket_new' :$this->getBoxdataReportmarket_new();
                break;
            case 'getDataGlobalBoxHomeObs1':$this->getDataGlobalBoxHomeObs1();
                break;
            case 'getDataGlobalBoxHomeObs2':$this->getDataGlobalBoxHomeObs2();
                break;
            case 'getBoxdataMonthlyreport':$this->getBoxdataMonthlyreport();
                break;
			 case 'getBoxdataReviewQuarter':$this->getBoxdataReviewQuarter();
                break;
            case 'getBoxdataMonthlyifrcpsi':$this->getBoxdataMonthlyifrcpsi();
                break;
            case 'getBoxdataReportmarketmonth' :$this->getBoxdataReportmarketmonth();
                break;
            case 'getBoxdataReportmarketmonth_new' :$this->getBoxdataReportmarketmonth_new();
            default :
                break;
        }
    }

    public function getDataGlobalBoxHome() {
        $this->load->model('midx_model');
        $return = $this->midx_model->getSampleKey(@$_POST['provider'], $_POST['name']);
        if ($return) {
            $array = array();
            foreach ($return as $value) {
                $array[] = $value['SHORTNAME'];
            }
            echo json_encode($array);
        }
    }

    public function getBoxIndexesHome() {
        $this->load->model('midx_model');

        $home_maxday = $this->db->query("select value from setting where `group` = 'setting' AND `key` = 'home_maxdays'")->row_array();
       // echo "<pre>";print_r($home_maxday);exit;

        $data = $this->midx_model->getDataTableIFRC(@$_POST['type'], @$_POST['place'], @$_POST['curr'], @$_POST['price'], @$_POST['provider'], @$_POST['search'], @$_POST['subtype'], @$_POST['page'], @$_POST['rp'],$home_maxday['value']);
        //echo "<pre>";print_r($_POST['provider']);exit;
        $dataCount = $this->midx_model->countDataTableIFRC(@$_POST['type'], @$_POST['place'], @$_POST['curr'], @$_POST['price'], @$_POST['provider'], @$_POST['search'], @$_POST['subtype'],$home_maxday['value']);


        $log = array();
        if ($data != NULL) {
            foreach ($data as $k => $vdata) {
                $short_name = $vdata['SHORTNAME'];
                $short_name = str_replace(' (VND)', '', $short_name);
                $entry = array('id' => $vdata['id'],
                    'cell' => array(
                        'shortname' => cut_str($short_name, 30),
                        'close' => check_zero($vdata['close']),
                        'varmonth' => check_zero($vdata['varmonth']*100),
                        'varyear' => check_zero($vdata['varyear']*100),
                        'dvar' => check_zero($vdata['dvar']*100),
                        'code' => check_zero($vdata['CODE']),
                        'action' => '<a href="' . base_url() . 'observatory/index/' . $vdata['CODE'] . '" style="cursor:pointer"><img src="' . base_url() . 'templates/images/more.png"></a>'
                    ),
                );
                $log[] = $entry;
            }
        }

        $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount['count'], 'rows' => $log);
		
        echo json_encode($result);
    }

    public function getBoxdataObservatory() {
        $this->load->model('midx_model');

        if ($_POST['q_search'] == trans('Quick search', 1)) {
            $_POST['q_search'] = '';
        }
        $q_search = $_POST['q_search'];
        $data = $this->midx_model->getDataTableSample($_POST['type'], $_POST['code'], $_POST['provider'], $_POST['coverage'], $_POST['currency'], $_POST['name'], $q_search, $_POST['price'], $_POST['page'], $_POST['rp']);
        $dataCount = $this->midx_model->countDataTableSample($_POST['type'], $_POST['code'], $_POST['provider'], $_POST['coverage'], $_POST['currency'], $_POST['name'], $q_search, $_POST['price']);
        $log = array();
        if ($data != NULL) {
            foreach ($data as $k => $vdata) {
                $entry = array('id' => $vdata['id'],
                    'cell' => array(
                        'TYPE' => $vdata['TYPE'],
                        'SUB_TYPE' => $vdata['SUB_TYPE'],
                        'SUB_TYPE' => $vdata['SUB_TYPE'],
                        'PROVIDER' => $vdata['PROVIDER'],
                        'PLACE' => $vdata['PLACE'],
                        'PRICE' => $vdata['PRICE'],
                        'CURR' => $vdata['CURR'],
                        'SHORTNAME' => $vdata['SHORTNAME'],
                        'HISTORY' => $vdata['HISTORY'],
                        'CODE' => $vdata['CODE'],
                        'action' => '<a href="#' . $vdata['CODE'] . '" style="cursor:pointer"><img src="' . base_url() . 'templates/images/more.png"></a>'
                    ),
                );
                if (isset($_POST['performance']) && $_POST['performance'] == 'yes') {
                    $entry['cell']['action'] = '<a id="' . $vdata['CODE'] . '" onclick="ifrc.copyToSelection(' . "'" . $vdata['CODE'] . "'" . ')" style="cursor:pointer"><img src="' . base_url() . 'templates/images/more.png"></a>';
                }
                $log[] = $entry;
            }
        }
		
        $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount['count'], 'rows' => $log);
        echo json_encode($result);
    }

    public function getdetailObservatory() {
        $this->load->model('midx_model');
        $data = array();
        $code = $_POST['code'];
        $data['data'] = $this->midx_model->getDataTableIdx_compo($code);
        $data['count'] = $this->midx_model->countDataTableIdx_compo($code);
        $data['name'] = $this->midx_model->getNameCode($code);
        $config['page_rows'] = 50;
        $config['page_total'] = $data['count'];
        $config["link"] = "#";
        $page = $this->load->library("helpers_paging", $config);
        $data['page'] = $page->create_ajax();
        $data['page_total'] = $data['count'];
        $data['code'] = $code;
        if (count($data) > 0) {
            $html = $this->load->view('observatory/detailObservatory', $data, false);
        } else {
            $html = "";
        }
        echo $html;
    }

    /* =====================================================================================
     * load data Ob theo day
     * ==================================================================================== */

    public function loadDayOb() {
        $this->load->model(array('midx_model', 'chart_model'));
		//echo "<pre>";print_r($_POST);exit;
        /* kiem tra xem co goi Flexigrid hay ko */
        if (isset($_POST['type']) && $_POST['type'] == 'Flexigrid') {
			
            /* xu ly khi co Flexigrid */
            $page = $_POST['page'];
            $rp = $_POST['rp'];
            if (isset($start)) {
                $start = $start == 1 ? 0 : ( $page - 1 ) * $rp;
            } else {
                $start = ( $page - 1 ) * $rp;
            }
            $limit = " LIMIT  $start,$rp";
            $data = $this->midx_model->loadDayOb($_POST['code'], NULL, NULL, $limit);
            $dataCount = $this->midx_model->loadDayObCount($_POST['code']);
            $dateBegin = $this->midx_model->loadDayObDateBegin($_POST['code']);
            if ($data != NULL) {
                foreach ($data as $vdata) {
                    $entry = array('id' => $vdata['id'],
                        'cell' => array(
                             'Date' => $vdata['date'],
                            'Close' => number_format($vdata['close'], 2),
                            'Perform' => number_format($vdata['rt']*100, 2),
                            'Volat' => ($vdata['volat1y'] != 0 &&  $vdata['volat1y'] != null)?number_format($vdata['volat1y']*100, 2):'-',
                            'Beta' => ($vdata['beta1y'] != 0 && $vdata['beta1y'] != null)?number_format($vdata['beta1y'], 2):'-',
                        ),
                    );
                    $log[] = $entry;
                }
                if ($log[count($log) - 1]['cell']['Date'] == $dateBegin) {
                    $log[count($log) - 1]['cell']['Perform'] = '-';
                }
            }
            $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount['count'], 'rows' => $log);
            echo json_encode($result);
        } else {
			
            /* xu ly khi khong co Flexigrid */
            $data['data'] = $this->midx_model->loadDayOb($_POST['code']);
			
            $min = $this->midx_model->LoadMinDay($_POST['code']);
			
            $min = @$min['min2'];
			
            $max = $this->midx_model->LoadMaxDay($_POST['code']);
            $name = $this->midx_model->getNameCode($_POST['code']);
            $shortname = $name['SHORTNAME'];
            $name = $name['NAME'];
            $data['nameChart'] = $name;
            $data['code'] = $_POST['code'];
            $data['Name'] = remove_emty_array($this->midx_model->getName2());
            $chart = "";
			
            if (count($data['data']) > 0) {
                $min = $this->getk($max) * round(0.5 * $min / $this->getk($max), 2);
                $data['data'] = array_reverse($data['data']);
				
                foreach ($data['data'] as $v) {
                    $date = strtotime($v['date']);
                    $date = date('Y/m/d', $date);
                    $tem = explode('/', $date);
                    $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                    unset($tem);
                    $chart.= '[' . $day . ',' . $v['close'] . '] ,';
                }
                $data_chart[0]['name'] = $shortname;
                $data_chart[0]['color'] = '#e07211';
                $data_chart[0]['data'] = $chart;
                $data['chart'] = $this->chart_model->load_chart($data_chart, $name, $min, 'Daily', 'chart-Day', 'close');
				
                $this->load->view('observatory/loadDayOb', $data, false);
            }
        }
    }

    /* =========================================================================
     * get perf data from code
     * ========================================================================= */

    public function getPerfData() {
        $this->load->model('midx_model');
        //$code = explode(',', trim($_POST['code']));
        //$code = implode('","', $code);
        $date = $_POST['date'];
        $data['year'] = substr( $date, 0, 4 );

        $sql = "SELECT pd.*,isa.SHORTNAME FROM perf_data pd, idx_sample isa WHERE pd.code = isa.CODE AND pd.yyyymm = '$date' ORDER BY " . $_POST['orderby'] . " LIMIT 0, 100";
        $dataSql = $this->db->query( $sql )->result_array();
        $data['perf_data'] = $dataSql;
        $this->load->view('performance/getPerfData', $data, false);
    }

    /* =====================================================================================
     * load data Ob theo month
     * ==================================================================================== */

    public function loadMonthOb() {
        $this->load->model(array('midx_model', 'chart_model'));
        /* kiem tra xem co goi Flexigrid hay ko */
        if (isset($_POST['type']) && $_POST['type'] == 'Flexigrid') {
            /* xu ly khi co Flexigrid */
            $page = $_POST['page'];
            $rp = $_POST['rp'];
            if (isset($start)) {
                $start = $start == 1 ? 0 : ( $page - 1 ) * $rp;
            } else {
                $start = ( $page - 1 ) * $rp;
            }
            $limit = " LIMIT  $start,$rp";
            $data = $this->midx_model->loadMonthOb($_POST['code'], NULL, NULL, NULL, $limit);
            $dataCount = $this->midx_model->loadMonthObCount($_POST['code']);
            $dateBegin = $this->midx_model->loadMonthObDateBegin($_POST['code']);
            if ($data != NULL) {
                foreach ($data as $vdata) {
                    $entry = array('id' => $vdata['id'],
                        'cell' => array(
                            'Date' => $vdata['date'],
                            'Close' => number_format($vdata['adjclose'], 2),
                            'Perform' => number_format($vdata['rt']*100, 2),
                            'Volat' => ($vdata['volat1y'] != null)?number_format($vdata['volat1y']*100, 2):'-',
                            'Beta' => ($vdata['beta1y'] != null)?number_format($vdata['beta1y'], 2):'-',

                        ),
                    );
                    $log[] = $entry;
                }
                if ($log[count($log) - 1]['cell']['Date'] == $dateBegin) {
                    $log[count($log) - 1]['cell']['Perform'] = '-';
                }
            }
            $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount['count'], 'rows' => $log);
        
            echo json_encode($result);
        } else {
            /* xu ly khi khong co Flexigrid */
            $data['data'] = $this->midx_model->loadMonthOb($_POST['code']);
            $min = $this->midx_model->LoadMinMonth($_POST['code']);
            $min = @$min['min2'];
            $max = $this->midx_model->LoadMaxMonth($_POST['code']);
            $name = $this->midx_model->getNameCode($_POST['code']);
            $shortname = $name['SHORTNAME'];
            $name = $name['NAME'];
            $data['nameChart'] = $name;
            $data['code'] = $_POST['code'];
            $data['Name'] = remove_emty_array($this->midx_model->getName2());
           // echo "<pre>";print_r($data);exit;
            $chart = "";
            if (count($data['data']) > 0) {
                $min = $this->getk($max) * round(0.5 * $min / $this->getk($max), 2);
                $data['data'] = array_reverse($data['data']);
                foreach ($data['data'] as $v) {
                    $date = strtotime($v['date']);
                    $date = date('Y/m/d', $date);
                    $tem = explode('/', $date);
                    $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                    unset($tem);
                    $chart.= '[' . $day . ',' . $v['adjclose'] . '] ,';
                }
				
                $data_chart[0]['name'] = $shortname;
                $data_chart[0]['color'] = '#e07211';
                $data_chart[0]['data'] = $chart;
                $data['chart'] = $this->chart_model->load_chart($data_chart, $name, $min, 'Monthly', 'chart-month', 'CLOSE');
//
                $this->load->view('observatory/loadMYOb', $data, false);
            }
        }
    }

    /* =====================================================================================
     * load data Ob theo year
     * ==================================================================================== */

    public function loadYearOb() {
        $this->load->model(array('midx_model', 'chart_model'));
        /* kiem tra xem co goi Flexigrid hay ko */
        if (isset($_POST['type']) && $_POST['type'] == 'Flexigrid') {
            /* xu ly khi co Flexigrid */
            $page = $_POST['page'];
            $rp = $_POST['rp'];
            if (isset($start)) {
                $start = $start == 1 ? 0 : ( $page - 1 ) * $rp;
            } else {
                $start = ( $page - 1 ) * $rp;
            }
            $limit = " LIMIT  $start,$rp";
            $data = $this->midx_model->loadYearOb($_POST['code'], NULL, NULL, $limit);
            $dataCount = $this->midx_model->loadYearObCount($_POST['code']);
            $dateBegin = $this->midx_model->loadYearObDateBegin($_POST['code']);
            if (count($data) > 0) {
                foreach ($data as $vdata) {
                    $entry = array('id' => $vdata['id'],
                        'cell' => array(
                            'Date' => $vdata['date'],
                            'Close' => number_format($vdata['adjclose'], 2),
                            'Perform' => number_format($vdata['rt']*100, 2),
                            'Volat' => ($vdata['volat1y'] != null)?number_format($vdata['volat1y']*100, 2):'-',
                            'Beta' => ($vdata['beta1y'] != null)?number_format($vdata['beta1y'], 2):'-',
                        ),
                    );
                    $log[] = $entry;
                }
                if ($log[count($log) - 1]['cell']['Date'] == $dateBegin) {
                    $log[count($log) - 1]['cell']['Perform'] = '-';
                }
            }
            $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount['count'], 'rows' => $log);
            echo json_encode($result);
        } else {
            /* xu ly khi khong co Flexigrid */
            $data['data'] = $this->midx_model->loadYearOb($_POST['code']);
            $min = $this->midx_model->LoadMinYear($_POST['code']);
            $min = @$min['min2'];
            $max = $this->midx_model->LoadMaxYear($_POST['code']);
            $name = $this->midx_model->getNameCode($_POST['code']);
            $shortname = $name['SHORTNAME'];
            $name = $name['NAME'];
            $data['nameChart'] = $name;
            $data['code'] = $_POST['code'];
            $data['Name'] = remove_emty_array($this->midx_model->getName2());
            $chart = "";
            if (count($data['data']) > 0) {
                $min = $this->getk($max) * round(0.5 * $min / $this->getk($max), 2);
                $data['data'] = array_reverse($data['data']);
                foreach ($data['data'] as $v) {
                    $date = strtotime($v['date']);
                    $date = date('Y/m/d', $date);
                    $tem = explode('/', $date);
                    $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                    unset($tem);
                    $chart.= '[' . $day . ',' . $v['adjclose'] . '] ,';
                }
                $data_chart[0]['name'] = $shortname;
                $data_chart[0]['color'] = '#e07211';
                $data_chart[0]['data'] = $chart;
                $data['chart'] = $this->chart_model->load_chart($data_chart, $name, $min, 'Yearly', 'chart-Year', 'adjclose');
                $this->load->view('observatory/loadYearOb', $data, false);
            }
        }
    }


	public function loadQuaterOb() {
        $this->load->model(array('midx_model', 'chart_model'));
        /* kiem tra xem co goi Flexigrid hay ko */
        if (isset($_POST['type']) && $_POST['type'] == 'Flexigrid') {
            /* xu ly khi co Flexigrid */
            $page = $_POST['page'];
            $rp = $_POST['rp'];
            if (isset($start)) {
                $start = $start == 1 ? 0 : ( $page - 1 ) * $rp;
            } else {
                $start = ( $page - 1 ) * $rp;
            }
            $limit = " LIMIT  $start,$rp";
            $data = $this->midx_model->loadQuaterOb($_POST['code'], NULL, NULL, $limit);
            $dataCount = $this->midx_model->loadQuaterObCount($_POST['code']);
            $dateBegin = $this->midx_model->loadQuaterObDateBegin($_POST['code']);
            if (count($data) > 0) {
                foreach ($data as $vdata) {
                    $entry = array('id' => $vdata['id'],
                        'cell' => array(
                            'Date' => $vdata['date'],
                            'Close' => number_format(round($vdata['adjclose'], 2), 2),
                            'Perform' => number_format(round($vdata['rt'], 2), 2)*100,
                            'Volat' => number_format(round($vdata['volat1y'], 2), 2)*100,
                            'Beta' => number_format(round($vdata['beta1y'], 2), 2),
                        ),
                    );
                    $log[] = $entry;
                }
                if ($log[count($log) - 1]['cell']['Date'] == $dateBegin) {
                    $log[count($log) - 1]['cell']['Perform'] = '-';
                }
            }
            $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount['count'], 'rows' => $log);
            echo json_encode($result);
        } else {
            /* xu ly khi khong co Flexigrid */
            $data['data'] = $this->midx_model->loadQuaterOb($_POST['code']);
            $min = $this->midx_model->LoadMinQuater($_POST['code']);
            $min = @$min['min2'];
            $max = $this->midx_model->LoadMaxQuater($_POST['code']);
            $name = $this->midx_model->getNameCode($_POST['code']);
            $shortname = $name['SHORTNAME'];
            $name = $name['NAME'];
            $data['nameChart'] = $name;
            $data['code'] = $_POST['code'];
            $data['Name'] = remove_emty_array($this->midx_model->getName2());
            $chart = "";
            if (count($data['data']) > 0) {
                $min = $this->getk($max) * round(0.5 * $min / $this->getk($max), 2);
                $data['data'] = array_reverse($data['data']);
                foreach ($data['data'] as $v) {
                    $date = strtotime($v['date']);
                    $date = date('Y/m/d', $date);
                    $tem = explode('/', $date);
                    $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                    unset($tem);
                    $chart.= '[' . $day . ',' . $v['adjclose'] . '] ,';
                }
                $data_chart[0]['name'] = $shortname;
                $data_chart[0]['color'] = '#e07211';
                $data_chart[0]['data'] = $chart;
                $data['chart'] = $this->chart_model->load_chart($data_chart, $name, $min, 'Quaterly', 'chart-Quater', 'adjclose');
                $this->load->view('observatory/loadQuaterOb', $data, false);
            }
        }
    }
    /* =====================================================================================
     * load rule
     * ==================================================================================== */

    public function loadRulesOb() {
        $this->load->model('midx_model');
        $data['data'] = $this->midx_model->loadRulesOb_sample($_POST['code']);
        if ($data['data']['INDEX_PARENT'] != '') {
            $data['data']['LINKED'] = $this->midx_model->getParent($data['data']['INDEX_PARENT']);
        } else {
            $data['data']['LINKED'] = '';
        }
        $data['config'] = $this->db->get('config')->row_array();
        if (count($data['data']) > 0) {
            $this->load->view('observatory/loadRulesOb', $data, false);
        }
    }

    /* =====================================================================================
     * load public
     * ==================================================================================== */

    public function loadPublicOb() {
        $this->load->model('midx_model');
        $data['data'] = $this->midx_model->getPublic($_POST['code']);
        $this->load->view('observatory/loadPublicOb', $data, false);
    }

    /* =========================================================================
     * get data box detail trang observatory
     * ========================================================================= */

    public function getdetailCompo() {
        $this->load->model('midx_model');
        $q = $_POST['page'] * 50;
		 
        $limit = " LIMIT $q,50";
        $data['page'] = $q;
        $data['data'] = $this->midx_model->getDataTableIdx_compo($_POST['code'], $limit);
        //echo "<pre>";print_r($data['data']);exit;
        if (count($data) > 0) {
            $this->load->view('observatory/detailCompo', $data, false);
        }
    }

    /**
     *
     *
     * @name getDataGlobalBoxHomeObs
     * @author NguyenTuanAnh
     * @param no
     * @return json
     * @description : dung model IDX l?y ra code v� short name idx_sample qua function getSampleKeyObs
     * ==================================================================================== */
    public function getDataGlobalBoxHomeObs() {
        $this->load->model('midx_model');
        $return = $this->midx_model->getSampleKeyObs('INTER', $_POST['name']);
        if ($return) {
            $array = array();
            foreach ($return as $value) {
                $array[] = $value['SHORTNAME'];
            }
            echo json_encode($array);
        }
    }

    public function getk($max) {
        if ($max >= 0 && $max <= 100) {
            return 100;
        } elseif ($max >= 100 && $max <= 1000) {
            return 1000;
        } elseif ($max >= 1000 && $max <= 10000) {
            return 10000;
        } else {
            return 100000;
        }
    }
 /* =====================================================================================
     * D?nh cho Trang Report - PHUONG 20150603
     * ==================================================================================== */

public function getDataGlobalBoxHomeObs1() {
        $this->load->model('midx_model');
        $return = $this->midx_model->getSampleKeyObs1('INTER', $_POST['name']);
        if ($return) {
            $array = array();
            foreach ($return as $value) {
                $array[] = $value['SHORTNAME'];
            }
            echo json_encode($array);
        }
    }

public function getDataGlobalBoxHomeObs2() {
        $this->load->model('midx_model');
        $return = $this->midx_model->getstk_ref($_POST['name']);
        if ($return) {
            $array = array();
            foreach ($return as $value) {
                $array[] = $value['SHORTNAME'];
            }
            echo json_encode($array);
        }
    }
    /* =====================================================================================
     * load data compare
     * ==================================================================================== */

    public function loadDataCompare() {
        $this->load->model(array('midx_model', 'chart_model'));
        if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && ($_POST['codeCompare']!='') ) {
            $_POST['codeCompare'] = base64_decode($_POST['codeCompare']);
            //$_POST['codeCompare'] = $this->midx_model->getCodeByShortName( $_POST['codeCompare'] );
            $_POST['codeCompare'] = $this->midx_model->getCodeByName($_POST['codeCompare']);
        }
		
        switch ($_POST['type']) {
            case 'day':
                $date = $this->midx_model->getdateIDXday('efrc_indvn_datas', $_POST['code'], 'ASC');
                 if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                    $datecompare = $this->midx_model->getdateIDXday('efrc_indvn_datas', $_POST['codeCompare'], 'ASC');
                    $datew = $date['date'];
                    if ($datecompare['date'] != '') {
                        if (strtotime($datecompare['date']) >= strtotime($date['date'])) {
                            $datew = $datecompare['date'];
                        }
                    }
                    /// date max
                    $date = $this->midx_model->getdateIDXday('efrc_indvn_datas', $_POST['code'], 'DESC');

                    $datecompare = $this->midx_model->getdateIDXday('efrc_indvn_datas', $_POST['codeCompare'], 'DESC');
                    $datemax = $date['date'];
                    if ($datecompare != NULL) {
                        if (( strtotime($datecompare['date']) <= strtotime($date['date']))) {
                            $datemax = $datecompare['date'];
                        }
                    }
                } else {
                    $datew = $date['date'];
                    $date = $this->midx_model->getdateIDXday('efrc_indvn_datas', $_POST['code'], 'DESC');
                    $datemax = $date['date'];
                }
                $min = $this->midx_model->LoadMinDay($_POST['code'], $datew);
                $min = $min['min2'];
                 if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                    $minc = $this->midx_model->LoadMinDay($_POST['codeCompare'], $datew);
                    $minc = $minc['min2'];
                    if ($min >= $minc) {
                        $min = $minc;
                    }
                }
                $name = $this->midx_model->getNameCode($_POST['code']);
                $shortname = $name['SHORTNAME'];
                //$name = $name['NAME'];
                $name = $name['SHORTNAME'];
                 if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                    $nameCompare = $this->midx_model->getNameCode($_POST['codeCompare']);
                    $shortnamecomp = $nameCompare['SHORTNAME'];
                    //$nameCompare = $nameCompare['NAME'];
                    $nameCompare = $nameCompare['SHORTNAME'];
                }
                $data = $this->midx_model->loadDayOb($_POST['code'], $datew, $datemax);
                 if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                    $datacompare = $this->midx_model->loadDayOb($_POST['codeCompare'], $datew, $datemax);
                    $name = $name . ' Vs ' . $nameCompare;
                }
                if ($data != NULL) {
                    $chart = '';
                    $chartcompare = '';
                    if (isset($_POST['rebase_']) && ( (int) $_POST['rebase_'] ) == 1) {
                        $min = 0;
                        $chart = '';
                        $data2 = $data;
                        foreach ($data2 as $key => $value) {
                            if ($key == 0)
                                $data2[$key]['close'] = 1000;
                            else
                                $data2[$key]['close'] = ( $data[$key]['close'] / $data[$key - 1]['close'] ) * $data2[$key - 1]['close'];
                        }
                        foreach ($data2 as $v) {
                            $date = strtotime($v['date']);
                            $date = date('Y/m/d', $date);
                            $tem = explode('/', $date);
                            $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                            unset($tem);
                            $chart.= '[' . $day . ',' . $v['close'] . '] ,';
                        }
                        if (isset($datacompare) && $datacompare != NULL) {

                            $datacompare2 = $datacompare;
                            foreach ($datacompare2 as $key => $value) {
                                if ($key == 0)
                                    $datacompare2[$key]['close'] = 1000;
                                else
                                    $datacompare2[$key]['close'] = ( $datacompare[$key]['close'] / $datacompare[$key - 1]['close'] ) * $datacompare2[$key - 1]['close'];
                            }
                            foreach ($datacompare2 as $v) {
                                $date = strtotime($v['date']);
                                $date = date('Y/m/d', $date);
                                $tem = explode('/', $date);
                                $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                                unset($tem);
                                $chartcompare.= '[' . $day . ',' . $v['close'] . '] ,';
                            }
                        }
                    } else {
                        foreach ($data as $v) {
                            $date = strtotime($v['date']);
                            $date = date('Y/m/d', $date);
                            $tem = explode('/', $date);
                            $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                            unset($tem);
                            $chart.= '[' . $day . ',' . $v['close'] . '] ,';
                        }

                        if (isset($datacompare) && $datacompare != NULL) {
                            foreach ($datacompare as $v) {
                                $date = strtotime($v['date']);
                                $date = date('Y/m/d', $date);
                                $tem = explode('/', $date);
                                $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                                unset($tem);
                                $chartcompare.= '[' . $day . ',' . $v['close'] . '] ,';
                            }
                        }
                    }
                    $min = 100 * round(0.5 * $min / 100, 0);
                    $data_chart[0]['name'] = $shortname;
                    $data_chart[0]['color'] = '#e07211';
                    $data_chart[0]['data'] = $chart;
                     if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                        $data_chart[1]['name'] = $shortnamecomp;
                        $data_chart[1]['color'] = '#9e1515';
                        $data_chart[1]['data'] = $chartcompare;
                    }
                    $chart = $this->chart_model->load_chart_compare($data_chart, $name, $min, 'Daily', 'chart-Day', 'close');
                    echo $chart;
                }
                break;
            ///////////////////////////////////////////////////////////////////////////////////////////
            case 'month':
                $date = $this->midx_model->getdate('efrc_indvn_stats', $_POST['code'], 'ASC');
				
				var_export($_POST['codeCompare']);
                if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                    $datecompare = $this->midx_model->getdate('efrc_indvn_stats', $_POST['codeCompare'], 'ASC');
					
                    $datew = $date['date'];
                    if ($datecompare['date'] != '') {
                        if ($datecompare['date'] >= $date['date']) {
                            $datew = $datecompare['date'];
                        }
                    }
                    $fulldate = $datew;
                    $datew = strtotime($fulldate);
                    $datew = date('Y/m', $datew);
                    /// date max
                    $date = $this->midx_model->getdate('efrc_indvn_stats', $_POST['code'], 'DESC');
                    $datecompare = $this->midx_model->getdate('efrc_indvn_stats', $_POST['codeCompare'], 'DESC');
                    $datemax = $date['date'];
                    if ($datecompare['date'] != '') {
                        if ($datecompare['date'] <= $date['date']) {
                            $datemax = $datecompare['date'];
                        }
                    }
                    $datemax = strtotime($datemax);
                    $datemax = date('Y/m', $datemax);
                } else {
                    $datew = $date['date'];
                    $date = $this->midx_model->getdate('efrc_indvn_stats', $_POST['code'], 'DESC');
                    $datemax = $date['date'];
                }
                $min = $this->midx_model->LoadMinMonth($_POST['code'], $datew);

                $min = $min['min2'];
                 if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                    $minc = $this->midx_model->LoadMinMonth($_POST['codeCompare'], $datew);
                    $minc = $minc['min2'];
                    if ($min >= $minc) {
                        $min = $minc;
                    }
                }
				
					
		
                $name = $this->midx_model->getNameCode($_POST['code']);
				
                $shortname = $name['SHORTNAME'];
                //$name = $name['NAME'];
                $name = $name['SHORTNAME'];
                if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                    $nameCompare = $this->midx_model->getNameCode($_POST['codeCompare']);
                    $shortnamecomp = $nameCompare['SHORTNAME'];
                    // $nameCompare = $nameCompare['NAME'];
                    $nameCompare = $nameCompare['SHORTNAME'];
                }
                $data = $this->midx_model->loadMonthOb($_POST['code'], $datew, $datemax);
				
                if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                    $datacompare = $this->midx_model->loadMonthOb($_POST['codeCompare'], $datew, $datemax, $fulldate);
                    $name = $name . ' Vs ' . $nameCompare;
                }
				
                if ($data != NULL) {
                    $chart = '';
                    $chartcompare = '';
                    if (isset($_POST['rebase_']) && ( (int) $_POST['rebase_'] ) == 1) {
                        $min = 0;
                        $chart = '';

                        $data2 = $data;
                        foreach ($data as $key => $value) {
                            if ($key == 0)
                                $data2[$key]['adjclose'] = 1000;
                            else
                                $data2[$key]['adjclose'] = ( $data[$key]['adjclose'] / $data[$key - 1]['adjclose'] ) * $data2[$key - 1]['adjclose'];
                        }

                        foreach ($data2 as $v) {
                            $tem = explode('-', $v['date']);
                            $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                            unset($tem);
                            $chart.= '[' . $day . ',' . $v['adjclose'] . '] ,';
                        }
                        if (isset($datacompare) && $datacompare != NULL) {

                            $datacompare2 = $datacompare;
                            foreach ($datacompare2 as $key => $value) {
                                if ($key == 0)
                                    $datacompare2[$key]['adjclose'] = 1000;
                                else
                                    $datacompare2[$key]['adjclose'] = ( $datacompare[$key]['adjclose'] / $datacompare[$key - 1]['adjclose'] ) * $datacompare2[$key - 1]['adjclose'];
                            }
                            foreach ($datacompare2 as $v) {
                                $tem = explode('-', $v['date']);
                                $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                                unset($tem);
                                $chartcompare.= '[' . $day . ',' . $v['adjclose'] . '] ,';
                            }
							
                        }
                    } else {
                        foreach ($data as $v) {
                            $tem = explode('-', $v['date']);
                            $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                            unset($tem);
                            $chart.= '[' . $day . ',' . $v['adjclose'] . '] ,';
                        }
                        if (isset($datacompare) && $datacompare != NULL) {
                            foreach ($datacompare as $v) {
                                $tem = explode('-', $v['date']);
                                $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                                unset($tem);
                                $chartcompare.= '[' . $day . ',' . $v['adjclose'] . '] ,';
                            }
                        }
                    }
					
					
                    $data_chart[0]['name'] = $shortname;
                    $data_chart[0]['color'] = '#e07211';
                    $data_chart[0]['data'] = $chart;
                     if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                        $data_chart[1]['name'] = $shortnamecomp;
                        $data_chart[1]['color'] = '#9e1515';
                        $data_chart[1]['data'] = $chartcompare;
                    }
                    $min = 100 * round(0.5 * $min / 100, 0);
                    $chart = $this->chart_model->load_chart_compare($data_chart, $name, $min, 'Monthly', 'chart-month', 'adjclose');
					 
					
					
                    echo $chart;
                }
                break;
            //////////////////////////////////////////////////////////////////////////
            case 'year':
                $date = $this->midx_model->getdate('efrc_indvn_stats', $_POST['code'], 'ASC');
                if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                    $datecompare = $this->midx_model->getdate('efrc_indvn_stats', $_POST['codeCompare'], 'ASC');
                    $datew = $date['date'];
                    if ($datecompare['date'] != '') {
                        if ($datecompare['date'] >= $date['date']) {
                            $datew = $datecompare['date'];
                        }
                    }
                    $datew = strtotime($datew);
                    $datew = date('Y', $datew);
                    /// date max
                    $date = $this->midx_model->getdate('efrc_indvn_stats', $_POST['code'], 'DESC');
                    $datecompare = $this->midx_model->getdate('efrc_indvn_stats', $_POST['codeCompare'], 'DESC');
                    $datemax = $date['date'];
                    if ($datecompare['date'] != '') {
                        if ($datecompare['date'] <= $date['date']) {
                            $datemax = $datecompare['date'];
                        }
                    }
                    $datemax = strtotime($datemax);
                    $datemax = date('Y', $datemax);
                } else {
                    $datew = $date['date'];
                    $date = $this->midx_model->getdate('efrc_indvn_stats', $_POST['code'], 'DESC');
                    $datemax = $date['date'];
                }
                $min = $this->midx_model->LoadMinYear($_POST['code'], $datew);
                $min = $min['min2'];
                 if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                    $minc = $this->midx_model->LoadMinYear($_POST['codeCompare'], $datew);
                    $minc = $minc['min2'];
                    if ($min >= $minc) {
                        $min = $minc;
                    }
                }
                $name = $this->midx_model->getNameCode($_POST['code']);
                $shortname = $name['SHORTNAME'];
                //$name = $name['NAME'];
                $name = $name['SHORTNAME'];
                 if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                    $nameCompare = $this->midx_model->getNameCode($_POST['codeCompare']);
                    $shortnamecomp = $nameCompare['SHORTNAME'];
                    // $nameCompare = $nameCompare['NAME'];
                    $nameCompare = $nameCompare['SHORTNAME'];
                }
                $data = $this->midx_model->loadYearOb($_POST['code'], $datew, $datemax);
                if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                    $datacompare = $this->midx_model->loadYearOb($_POST['codeCompare'], $datew, $datemax);
                    $name = $name . ' Vs ' . $nameCompare;
                }
                if ($data != NULL) {
                    $chart = '';
                    $chartcompare = '';
                    if (isset($_POST['rebase_']) && ( (int) $_POST['rebase_'] ) == 1) {
                        $min = 0;
                        $data2 = $data;
                        foreach ($data2 as $key => $value) {
                            if ($key == 0)
                                $data2[$key]['adjclose'] = 1000;
                            else
                                $data2[$key]['adjclose'] = ( $data[$key]['adjclose'] / $data[$key - 1]['adjclose'] ) * $data2[$key - 1]['adjclose'];
                        }
                        foreach ($data2 as $v) {
                            $tem = explode('-', $v['date']);
                            $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                            unset($tem);
                            $chart.= '[' . $day . ',' . $v['adjclose'] . '] ,';
                        }
                        if (isset($datacompare) && $datacompare != NULL) {
                            $datacompare2 = $datacompare;
                            foreach ($datacompare2 as $key => $value) {
                                if ($key == 0)
                                    $datacompare2[$key]['adjclose'] = 1000;
                                else
                                    $datacompare2[$key]['adjclose'] = ( $datacompare[$key]['adjclose'] / $datacompare[$key - 1]['adjclose'] ) * $datacompare2[$key - 1]['adjclose'];
                            }
                            foreach ($datacompare2 as $v) {
                                $tem = explode('-', $v['date']);
                                $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                                unset($tem);
                                $chartcompare.= '[' . $day . ',' . $v['adjclose'] . '] ,';
                            }
                        }
                    } else {
                        foreach ($data as $v) {
                            $tem = explode('-', $v['date']);
                            $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                            unset($tem);
                            $chart.= '[' . $day . ',' . $v['adjclose'] . '] ,';
                        }
                        if (isset($datacompare) && $datacompare != NULL) {
                            foreach ($datacompare as $v) {
                                $tem = explode('-', $v['date']);
                                $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                                unset($tem);
                                $chartcompare.= '[' . $day . ',' . $v['adjclose'] . '] ,';
                            }
                        }
                    }
                    $min = 100 * round(0.5 * $min / 100, 0);
                    $data_chart[0]['name'] = $shortname;
                    $data_chart[0]['color'] = '#e07211';
                    $data_chart[0]['data'] = $chart;
                     if (isset($_POST['codeCompare']) && ($_POST['codeCompare'] != '0') && $_POST['codeCompare'] != '' ) {
                        $data_chart[1]['name'] = $shortnamecomp;
                        $data_chart[1]['color'] = '#9e1515';
                        $data_chart[1]['data'] = $chartcompare;
                    }
                    $chart = $this->chart_model->load_chart_compare($data_chart, $name, $min, 'Yearly', 'chart-Year', 'adjclose');
                    echo $chart;
                }
                break;
            default :
                break;
        }
    }

    /////// t�m article d�ng trong rules trong obsevertory
    public function getarticle() {
        $title = $_POST['title'];
        $result = $this->_getarticle($title);
        if ($result) {
            echo base_url() . 'page/index/glossary.html#' . $result;
        }
    }

    /* =====================================================================================
     * get article theo title
     * tr? v? id_news
     * ==================================================================================== */

    private function _getarticle($name) {
        $result = array();
        $lang_current = isset($this->session->userdata['curent_language']['code']) ? $this->session->userdata['curent_language']['code'] :'us';
        $sql = "SELECT article_id FROM article_description WHERE title='{$name}' AND lang_code = '{$lang_current}';";
        $result = $this->db->query($sql)->row_array();
        if (count($result) > 0) {
            return $result['article_id'];
        } else {
            return false;
        }
    }

    public function getCodeByNameFromTo(){
        $name_from = $_POST['name_from'];
        $name_to = $_POST['name_to'];
        $sql = 'SELECT a.CODE as code_from, b.CODE as code_to FROM 
        (SELECT CODE FROM idx_sample WHERE SHORTNAME = "'.$name_from.'") a, 
        (SELECT CODE FROM idx_sample WHERE SHORTNAME = "'.$name_to.'") b';
        $data = $this->db->query($sql)->row_array();
        $response['code_from'] = isset($data['code_from']) ? $data['code_from'] :'' ;
        $response['code_to'] = isset($data['code_to']) ? $data['code_to'] : '';
        echo json_encode($response);
    }

    /* =========================================================================
     * get data box detail trang cpmapre
     * ========================================================================= */

    public function getdetailCompare() {
        $data['code_from'] = $_POST['code_from'];
        $data['code_to'] = $_POST['code_to'];
        $data['nn'] = isset($this->session->userdata['curent_language']['code']) ?  $this->session->userdata['curent_language']['code'] : 'us';
        $config["link"] = "#";
        if ( $data != NULL ) {
            $this->load->view('detailCompare', $data );
        }
    }

    /* =====================================================================================
     * load data Compare theo month
     * ==================================================================================== */

    public function loadMonthCompare() {
        $this->load->model(array('midx_model', 'chart_model'));
        /* kiem tra xem co goi Flexigrid hay ko */
        if (isset($_POST['type']) && $_POST['type'] == 'Flexigrid' ) {
            /* xu ly khi co Flexigrid */
            $page = $_POST['page'];
            $rp = $_POST['rp'];
            $start = 0;
            $start = $start == 1 ? 0 : ( $page - 1 ) * $rp;
            $limit = " LIMIT  $start,$rp";
            $data = $this->midx_model->loadMonthCompare( $_POST['code_from'], $_POST['code_to'], NULL, NULL, $limit );
            $dataCount = $this->midx_model->loadMonthCompareCount( $_POST['code_from'], $_POST['code_to']);
            $dateBegin = $this->midx_model->loadMonthCompareDateBegin( $_POST['code_from'], $_POST['code_to'] );
            if ( $data != NULL ) {
                foreach ( $data as $vdata ) {
                     $index_1 = number_format( round( $vdata['index_1'], 2 ), 2 );
                    $index_2 = number_format( round( $vdata['index_2'], 2 ), 2 );
                    $total = number_format( round( $vdata['total'], 2 ), 2 );
                    if($index_1 >= 0){
                        if($index_1 == 0){
                            $index_1 = '-';
                        }else{
                            $index_1 = '<span style="color:#02BB00">'.$index_1.'</span>';
                        }
                    }else{
                        $index_1 = '<span style="color:#FF0000">'.$index_1.'</span>';
                    }
                    if($index_2 >= 0){
                        if($index_2 == 0){
                            $index_2 = '-';
                        }else{
                            $index_2 = '<span style="color:#02BB00">'.$index_2.'</span>';
                        }
                    }else{
                        $index_2 = '<span style="color:#FF0000">'.$index_2.'</span>';
                    }
                    if($total >= 0){
                        if($total == 0){
                            $total = '-';
                        }else{
                            $total = '<span style="color:#02BB00">'.$total.'</span>';
                        }
                    }else{
                        $total = '<span style="color:#FF0000">'.$total.'</span>';
                    }
                    $entry = array( 'id' => $vdata['id'],
                        'cell' => array(
                           'Date' => $vdata['date'],
                            'Index_1' => $index_1,
                            'Index_2' => $index_2,
                            'Total' => $total,
                        ),
                    );
                    $log[] = $entry;
                }
                if ( $log[count( $log )-1]['cell']['Date']==$dateBegin ) {
                    $log[count( $log )-1]['cell']['Total']='-';
                }
            }
            $result = array( 'page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount['count'], 'rows' => $log );
            echo json_encode( $result );
        } else {
            /* xu ly khi khong co Flexigrid */
            $data['data'] = $this->midx_model->loadMonthCompareChart( $_POST['code_from'], $_POST['code_to'] );
            $name = $this->midx_model->getNameCodeCompare( $_POST['code_from'], $_POST['code_to'] );
            $shortname_from = $name['shortname_from'];
            $shortname_to = $name['shortname_to'];
            $name = $name['name_from'] .' vs '. $name['name_to'];
            $data['nameChart'] = $name;
            $data['code_from'] = $_POST['code_from'];
            $data['code_to'] = $_POST['code_to'];
            $data['Name'] = remove_emty_array( $this->midx_model->getName2() );
            if ( $data['data'] != NULL ) {

                //$data['data'] = array_reverse( $data['data'] );

                $min = $this->midx_model->LoadMinMonthCompareChart( $_POST['code_from'], $_POST['code_to'], $data['data'][0]['date']);
                $min = $min['min'];
                $max = $this->midx_model->LoadMaxMonthCompareChart( $_POST['code_from'], $_POST['code_to'], $data['data'][0]['date'] );
                $min = $this->getk( $max ) * round( 0.5 * $min / $this->getk( $max ), 2 );
                $chart_1 = '';
                $chart_2 = '';
                foreach ( $data['data'] as $v ) {
                    $tem = explode( '-', $v['date'] );
                    $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                    unset( $tem );
                    $chart_1.= '[' . $day . ',' . $v['index_1'] . '] ,';
                    $chart_2.= '[' . $day . ',' . $v['index_2'] . '] ,';
                }
                $data_chart[0]['name'] = $shortname_from;
                $data_chart[0]['color'] = '#00A0DE';
                $data_chart[0]['data'] = $chart_1;
                $data_chart[1]['name'] = $shortname_to;
                $data_chart[1]['color'] = '#f07211';
                $data_chart[1]['data'] = $chart_2;
                $data['chart'] = $this->chart_model->load_chart_compare_2( $data_chart, 'Monthly Performance', $min, 'Monthly', 'chart-month', 'CLOSE' );
                $this->load->view('loadMYCompare', $data );
            }
        }
    }

    /* =====================================================================================
     * load data Compare theo year
     * ==================================================================================== */

    public function loadYearCompare() {
        $this->load->model(array('midx_model', 'chart_model'));
        /* kiem tra xem co goi Flexigrid hay ko */
        if (isset($_POST['type']) && $_POST['type'] == 'Flexigrid' ) {
            /* xu ly khi co Flexigrid */
            $page = $_POST['page'];
            $rp = $_POST['rp'];
            $start = 0;
            $start = $start == 1 ? 0 : ( $page - 1 ) * $rp;
            $limit = " LIMIT $start,$rp";
            $data = $this->midx_model->loadYearCompare( $_POST['code_from'], $_POST['code_to']);
            $dataCount = $this->midx_model->loadYearCompareCount( $_POST['code_from'], $_POST['code_to'] );
            $dateBegin = $this->midx_model->loadYearCompareDateBegin( $_POST['code_from'], $_POST['code_to'] );
            if ( $data != NULL ) {
                foreach ( $data as $vdata ) {
                    $index_1 = number_format( round( $vdata['index_1'], 2 ), 2 );
                    $index_2 = number_format( round( $vdata['index_2'], 2 ), 2 );
                    $total = number_format( round( $vdata['total'], 2 ), 2 );
                    if($index_1 >= 0){
                        if($index_1 == 0){
                            $index_1 = '-';
                        }else{
                            $index_1 = '<span style="color:#02BB00">'.$index_1.'</span>';
                        }
                    }else{
                        $index_1 = '<span style="color:#FF0000">'.$index_1.'</span>';
                    }
                    if($index_2 >= 0){
                        if($index_2 == 0){
                            $index_2 = '-';
                        }else{
                            $index_2 = '<span style="color:#02BB00">'.$index_2.'</span>';
                        }
                    }else{
                        $index_2 = '<span style="color:#FF0000">'.$index_2.'</span>';
                    }
                    if($total >= 0){
                        if($total == 0){
                            $total = '-';
                        }else{
                            $total = '<span style="color:#02BB00">'.$total.'</span>';
                        }
                    }else{
                        $total = '<span style="color:#FF0000">'.$total.'</span>';
                    }
                    $entry = array( 'id' => $vdata['id'],
                        'cell' => array(
                           'Date' => $vdata['date'],
                            'Index_1' => $index_1,
                            'Index_2' => $index_2,
                            'Total' => $total,
                        ),
                    );
                    $log[] = $entry;
                }
                if ( $log[count( $log )-1]['cell']['Date']==$dateBegin ) {
                    $log[count( $log )-1]['cell']['Total']='-';
                }
            }
            $result = array( 'page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount['count'], 'rows' => $log );
            echo json_encode( $result );
        } else {
            /* xu ly khi khong co Flexigrid */
            $data = $this->midx_model->loadYearCompareChart( $_POST['code_from'], $_POST['code_to'] );
            $data['data'] = $data;//ko co data
            $min = $this->midx_model->LoadMinYearCompareChart( $_POST['code_from'], $_POST['code_to'],@$data['data'][0]['date']);
            $min = $min['min'];
            $max = $this->midx_model->LoadMaxYearCompareChart( $_POST['code_from'], $_POST['code_to'],@$data['data'][0]['date']);
            $name = $this->midx_model->getNameCodeCompare( $_POST['code_from'], $_POST['code_to'] );
            $shortname_from = $name['shortname_from'];
            $shortname_to = $name['shortname_to'];
            $name = $name['name_from'] .' vs '. $name['name_to'];
            $data['code_from'] = $_POST['code_from'];
            $data['code_to'] = $_POST['code_to'];
            $data['nameChart'] = $name;
            $data['Name'] = remove_emty_array( $this->midx_model->getName2() );
            if ( $data['data'] != NULL ) {
                $min = $this->getk( $max ) * round( 0.5 * $min / $this->getk( $max ), 2 );
                $chart_1 = '';
                $chart_2 = '';
                foreach ( $data['data'] as $v ) {
                    $tem = explode( '-', $v['date'] );
                    $day = "Date.UTC(" . $tem[0] . "," . ( $tem[1] - 1 ) . "," . $tem[2] . ")";
                    unset( $tem );
                    $chart_1.= '[' . $day . ',' . $v['index_1'] . '] ,';
                    $chart_2.= '[' . $day . ',' . $v['index_2'] . '] ,';
                }
                $data_chart[0]['name'] = $shortname_from;
                $data_chart[0]['color'] = '#00A0DE';
                $data_chart[0]['data'] = $chart_1;
                $data_chart[1]['name'] = $shortname_to;
                $data_chart[1]['color'] = '#f07211';
                $data_chart[1]['data'] = $chart_2;
                $data['chart'] = $this->chart_model->load_chart_compare_2( $data_chart, 'Yearly Performance', $min, 'Yearly', 'chart-Year', 'CLOSE');
                $this->load->view('loadYearCompare', $data );
            }
        }
    }
    public function getDetailAnnualPerformanceStatistics() {
        $this->load->model('midx_model');
        $sql = 'SELECT DISTINCT(YEAR(a.date)) as year FROM obs_year a, idx_sample b 
                                            WHERE 
                                            a.code = b.code AND 
                                            b.vnxi=1 AND
                                            b.place = "VIETNAM" AND
                                            YEAR(a.date) >= 2009
                                            ORDER BY YEAR(a.date) DESC';
        $data['year'] = $this->db->query($sql)->result_array();

        
        $sql = 'SELECT DISTINCT(price) as type FROM idx_sample WHERE vnxi = 1 and place="VIETNAM" and price <> "PR" and price <> ""';
        $data['type'] = $this->db->query($sql)->result_array();
        
        $sql = 'SELECT DISTINCT(curr) as curr FROM idx_sample WHERE vnxi = 1 and place="VIETNAM" and curr <> "VND" and curr <> ""';
        $data['curr'] = $this->db->query($sql)->result_array();
        
        $sql = 'SELECT DISTINCT(provider) as provider FROM idx_sample WHERE provider in("PVN","IFRC","IFRCLAB","IFRCRESEARCH","PROVINCIAL") and provider <> ""';
        $data['provider'] = $this->db->query($sql)->result_array();
        $data['provider'][] = array('provider' => 'OTHER');
        $data['nn'] = isset($this->session->userdata['curent_language']['code']) ? $this->session->userdata['curent_language']['code'] : 'us';
        $config["link"] = "#";
        if ( $data != NULL ) {
            $this->load->view('detailAnnualPerformanceStatistics', $data );
        }
    }
    public function loadAnnual() {
        $year = $this->input->post('year');
        if (isset($_POST['type']) && $_POST['type'] == 'Flexigrid' ) {
            $this->load->model(array('midx_model', 'chart_model'));

            $page = $_POST['page'];
            $rp = $_POST['rp'];
            $start = 0;
            $start = $start == 1 ? 0 : ( $page - 1 ) * $rp;
            $limit = " LIMIT $start,$rp";

            $option = array(
                'typeFilter' => $_POST['typeFilter'],
                'currencyFilter' => $_POST['currencyFilter'],
                'providerFilter' => $_POST['providerFilter'],
                'sortFilter' => $_POST['sortFilter']
            );
            //print_r($option);

            $data = $this->midx_model->loadAnnual( $_POST['year'], $option, $limit );

            $dataCount = $this->midx_model->loadAnnualCount( $_POST['year'], $option);
            $log = array();
            if ( $data != NULL ) {
                $no_start = ($page-1) * $rp;
                foreach ( $data as $vdata ) {
                    $no_start++;
                    $close = number_format($vdata['close'],2);
                    $perform = number_format($vdata['perform']*100,2);
                    /*if($close >= 0){
                        if($close == 0){
                            $close = '-';
                        }else{
                            $close = '<span style="color:#02BB00">'.$close.'</span>';
                        }
                    }else{
                        $close = '<span style="color:#FF0000">'.$close.'</span>';
                    }*/
                    if($perform >= 0){
                        if($perform == 0){
                            $perform = '-';
                        }else{
                            $perform = '<span style="color:#02BB00">'.$perform.'</span>';
                        }
                    }else{
                        $perform = '<span style="color:#FF0000">'.$perform.'</span>';
                    }
                    $entry = array( 'id' => $vdata['id'],
                        'cell' => array(
                            //'No' => $vdata['no'], 
                            'No' => $no_start,   
                            'Name' => '<a href="'.base_url().'observatory/index/'.$vdata['codeifrc'].'">'.$vdata['name'].'</a>',
                            'Provider' => $vdata['provider'],
                            'Type' => $vdata['type'],
                            'Currency' => $vdata['curr'],
                            'Date' => $vdata['date'],
                            'Close' => $close,
                            'Perform' => $perform,
                            'Action' => '<a href="'.base_url().'observatory/index/'.$vdata['codeifrc'].'"><img src="' . base_url() . 'templates/images/more.png"></a>'
                        ),
                    );
                    $log[] = $entry;
                }
            }
            $result = array( 'page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount['count'], 'rows' => $log );
            
            echo json_encode($result);
        }
    }
    
    
    public function getBoxdataDailyreport() {
        $this->load->model('report_daily_model','report_daily');
        if ($_POST['q_search'] == trans('Quick search', 1)) {
            $_POST['q_search'] = '';
        }
        $q_search = $_POST['q_search'];
        $data = $this->report_daily->getReport($_POST['date'],$_POST['provider'],$_POST['curr'],$_POST['prtr'], $q_search, $_POST['page'], $_POST['rp']);
        $dataCount = $this->report_daily->countGetreport($_POST['date'],$_POST['provider'],$_POST['curr'],$_POST['prtr'], $q_search, $_POST['page'], $_POST['rp']);
        $log = array();
        if ($data != NULL) {
            foreach ($data['listindexes'] as $k => $vdata) { 
                $entry = array('id' => $vdata->id,
                    'cell' => array(
                        'DATE' => $vdata->date,
                        'PROVIDER' => $vdata->provider,
                        'CODE' => $vdata->code,
                        'NAME' => $vdata->name,
                        'CLOSE' => $vdata->close,
                        'VAR' => $vdata->var,
                        'MTD' => $vdata->mtd,
                        'YTD' => $vdata->ytd,
                        'PCLOSE' => $vdata->pclose,
                        'action' => '<a href="'. base_url() .'observatory/index/' . $vdata->code . '" style="cursor:pointer"><img src="' . base_url() . 'templates/images/more.png"></a>'

                    ),
                );
                $log[] = $entry;
            }
        }
        $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount[0]->count, 'rows' => $log);
        echo json_encode($result);
    }
    
    public function getBoxdataReportmarket() {
        $this->load->model('report_market_day_model','report_daily');
        $date = (isset($_POST['date']) && $_POST['date']!='undefined') ? $_POST['date'] : '';
        $exchange = (isset($_POST['exchange']) && $_POST['exchange']!='undefined' ) ? $_POST['exchange'] : '';
        $data = $this->report_daily->getReport($date,$exchange, $_POST['page'], $_POST['rp']);
        //var_export($data);
        $dataCount = $this->report_daily->countGetreport($date,$exchange, $_POST['page'], $_POST['rp']);
        $log = array();
        if ($data != NULL) {
            foreach ($data['listindexes'] as $k => $vdata) { 
                $entry = array('id' => $vdata->id,
                'cell' => array(
                        'DATE' => $vdata->date,
                        'CODE' => $vdata->code,
                        'NAME' => $vdata->name,
                        'EXCHANGE' => $vdata->exchange,
                        'SHARES' => $vdata->shares,
                        'CLOSE' => $vdata->close,
                        'CAPI' => $vdata->capi,
                        'VOLUME' => $vdata->volume,
                        'TURNOVER' => $vdata->turnover,
                        'VAR' => $vdata->var,
                        'MTD' => $vdata->mtd,
                        'YTD' => $vdata->ytd,
                        'action' => '<a href="'. base_url() .'report_stock/' . $vdata->code . '" style="cursor:pointer"><img src="' . base_url() . 'templates/images/more.png"></a>'

                       
                    ),
                );
                $log[] = $entry;
                 //print_r($entry);
            }
        }
        $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount[0]->count, 'rows' => $log);
        echo json_encode($result);
    }
    
     public function getBoxdataReportmarket_new() {
        $this->load->model('report_market_day_model','report_daily');
        $date = (isset($_POST['date']) && $_POST['date']!='undefined') ? $_POST['date'] : '';
        $exchange = (isset($_POST['exchange']) && $_POST['exchange']!='undefined' ) ? $_POST['exchange'] : '';
        $data = $this->report_daily->getReport_new($date,$exchange, $_POST['page'], $_POST['rp']);
        $dataCount = $this->report_daily->countGetreport($date,$exchange, $_POST['page'], $_POST['rp']);
        //var_export($data);
        $log = array();
        if ($data != NULL) {
            foreach ($data['listindexes'] as $k => $vdata) { 
                $entry = array('id' => $vdata->id,
                'cell' => array(
                        'DATE' => $vdata->date,
                        'CODE' => $vdata->code,
                        'NAME' => $vdata->name,
                        'EXCHANGE' => $vdata->exchange,
                        'NBDAYS' => $vdata->nbdays,
                        'PERF' => $vdata->perf,
                        'VOLAT' => $vdata->volat,
                        'BETA' => $vdata->beta,
                        'VELOCITY' => $vdata->velocity,
                        'TRADING' => $vdata->trading,
                        'TURN' => $vdata->turn,
                        'action' => '<a href="'. base_url() .'report_stock/' . $vdata->code . '" style="cursor:pointer"><img src="' . base_url() . 'templates/images/more.png"></a>'


                    ),
                );
                $log[] = $entry;
                // print_r($entry);
            }
        }
        $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount[0]->count, 'rows' => $log);
        echo json_encode($result);
    }
	public function getSearchReport() {
        $this->load->model('midx_model','midx');
        $data = $this->midx->getCodebyName1($_POST['name']);        
        echo json_encode(isset($data["CODE"])?$data["CODE"]:'');
    }
	public function getSearchReportStock() {
        $this->load->model('midx_model','midx');
        $data = $this->midx->getCodebyName1Stock($_POST['name']);        
        echo json_encode(isset($data["CODE"])?$data["CODE"]:'');
    }
    
    public function getBoxdataMonthlyreport_backup_05042017() {
        $this->load->model('Report_monthly_model','report_monthly');
        if ($_POST['q_search'] == trans('Quick search', 1)) {
            $_POST['q_search'] = '';
        }

        $q_search = $_POST['q_search'];
        $data = $this->report_monthly->getReport($_POST['date'],$_POST['provider'],$_POST['type'],$_POST['curr'],$_POST['prtr'], $q_search, $_POST['page'], $_POST['rp']);
        $dataCount = $this->report_monthly->countGetreport($_POST['date'],$_POST['provider'],$_POST['type'],$_POST['curr'],$_POST['prtr'], $q_search, $_POST['page'], $_POST['rp']);
       // echo "<pre>";print_r($dataCount);exit;
//        select eit.id,eit.codeifrc, eit.date, eit.adjclose, eit.volat1y, eit.rt, isa.`name`, isa.provider,
//        isa.type from efrc_indvn_stats eit, idx_sample isa where eit.codeifrc = isa.`code` and eit.periodid = '201704' and eit.period = 'M';
        $log = array();
        if ($data != NULL) {
            foreach ($data['listindexes'] as $k => $vdata) { 
                $entry = array('id' => $vdata->id,
                    'cell' => array(
                        'DATE' => $vdata->date,
                        'PROVIDER' => $vdata->provider,
                        'CODE' => $vdata->code,
                        'NAME' => $vdata->name,
                        'CLOSE' => number_format($vdata->close,2),
                        'TYPE' => $vdata->type,
                        'YTD' => number_format(($vdata->ytd)*100,2),
                        'VAR' => number_format(($vdata->var)*100,2),
                        'YYYYMM' =>$vdata->yyyymm,
                        'idx_mother' =>$vdata->code,
                        'action' => '<a href="'. base_url() .'report/'.$vdata->yyyymm.'/' . $vdata->code . '" style="cursor:pointer"><img src="' . base_url() . 'templates/images/more.png"></a>'
                    ), 
                );
                $log[] = $entry;
            }
        }
        $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount[0]->count, 'rows' => $log);
        echo json_encode($result);
    }

    public function getBoxdataMonthlyreport() {
        $this->load->model('Report_monthly_model','report_monthly');
        if ($_POST['q_search'] == trans('Quick search', 1)) {
            $_POST['q_search'] = '';
        }
        $q_search = $_POST['q_search'];
        $data = $this->report_monthly->getReport($_POST['date'],$_POST['provider'],$_POST['type'],$_POST['curr'],$_POST['prtr'], $q_search, $_POST['page'], $_POST['rp']);


        $dataCount = $this->report_monthly->countGetreport($_POST['date'],$_POST['provider'],$_POST['type'],$_POST['curr'],$_POST['prtr'], $q_search, $_POST['page'], $_POST['rp']);
        $log = array();
        if ($data != NULL) {
            foreach ($data['listindexes'] as $k => $vdata) {
                $entry = array('id' => $vdata->id,
                    'cell' => array(
                        'DATE' => $vdata->date,
                        'PROVIDER' => $vdata->provider,
                        'CODE' => $vdata->code,
                        'NAME' => $vdata->name,
                        'CLOSE' => $vdata->close,
                        'TYPE' => $vdata->type,
                        'YTD' => $vdata->ytd,
                        'VAR' => number_format($vdata->var*100,2),
                        'YYYYMM' =>$vdata->yyyymm,
                        'idx_mother' =>$vdata->idx_mother,
                        'action' => '<a href="'. base_url() .'report/'.$vdata->yyyymm.'/' . $vdata->idx_mother . '" style="cursor:pointer"><img src="' . base_url() . 'templates/images/more.png"></a>'
                    ),
                );
                $log[] = $entry;
            }
        }
        $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount[0]->count, 'rows' => $log);
        echo json_encode($result);
    }
	
	  public function getBoxdataReviewQuarter() {
        $this->load->model('Review_quarter_model','review_quarter');
       
    
        $data = $this->review_quarter->getReport($_POST['date'], $_POST['page'], $_POST['rp']);
        $dataCount = $this->review_quarter->countGetreport($_POST['date'], $_POST['page'], $_POST['rp']);
        $log = array();
        if ($data != NULL) {
            foreach ($data['listindexes'] as $k => $vdata) { 
                $entry = array('id' => $vdata->id,
                    'cell' => array(
                        'STK_CODE' => $vdata->stk_code,
                        'IDX_CODE' => $vdata->idx_code,
                        'STK_NAME' => $vdata->stk_name,
                        'STK_SHARES' => $vdata->stk_shares,
                        'STK_FLOAT' => $vdata->stk_float,
                        'STK_CAPP' => $vdata->stk_capp,
                        'REFERENCE' => $vdata->reference,
                        'action' => '<a href="'. base_url().'" style="cursor:pointer"><img src="' . base_url() . 'templates/images/more.png"></a>'
                    ), 
                );
                $log[] = $entry;
            }
        }
        $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount[0]->count, 'rows' => $log);
        echo json_encode($result);
    }
    
    public function getBoxdataMonthlyifrcpsi() {
        $this->load->model('Report_IFRC_PSI_model','report_monthly');
        $data = $this->report_monthly->getReport($_POST['date'],$_POST['page'], $_POST['rp']);
        $dataCount = $this->report_monthly->countGetreport($_POST['date'],$_POST['page'], $_POST['rp']);
        $log = array();
        if ($data != NULL) {
            foreach ($data['listindexes'] as $k => $vdata) { 
                $entry = array('id' => $vdata->id,
                    'cell' => array(
                        'DATE' => $vdata->date,
                        'PROVIDER' => $vdata->provider,
                        'CODE' => $vdata->code,
                        'NAME' => $vdata->name,
                        'CLOSE' => $vdata->close,
                        'TYPE' => $vdata->type,
                        'YTD' => $vdata->ytd,
                        'VAR' => $vdata->var,
                        'YYYYMM' =>$vdata->yyyymm,
                        'idx_mother' =>$vdata->idx_mother,
                        'action' => '<a href="'. base_url() .'report/'.$vdata->yyyymm.'/' . $vdata->idx_mother . '" style="cursor:pointer"><img src="' . base_url() . 'templates/images/more.png"></a>'
                    ), 
                );
                $log[] = $entry;
            }
        }
        $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount[0]->count, 'rows' => $log);
        echo json_encode($result);
    }
    public function getBoxdataReportmarketmonth() {
        $this->load->model('report_market_month_model','report_daily');
        $date = (isset($_POST['date']) && $_POST['date']!='undefined') ? $_POST['date'] : '';
        $exchange = (isset($_POST['exchange']) && $_POST['exchange']!='undefined' ) ? $_POST['exchange'] : '';
        $data = $this->report_daily->getReport($date,$exchange, $_POST['page'], $_POST['rp']);
        //var_export($data);
        $dataCount = $this->report_daily->countGetreport($date,$exchange, $_POST['page'], $_POST['rp']);
        $log = array();
        if ($data != NULL) {
            foreach ($data['listindexes'] as $k => $vdata) { 
                $entry = array('id' => $vdata->id,
                'cell' => array(
                        'DATE' => $vdata->date,
                        'TICKER' => $vdata->code,
                        //'NAME' => $vdata->name,
                        'EXCHANGE' => $vdata->exchange,
                        'SVOLUME' => $vdata->svolume,
                        'STURNOVER' => $vdata->sturnover,
                        'SVELO' => $vdata->svelo,
                        'NB' => $vdata->nb,
                        'NBT' => $vdata->nbt,
                        'SHARES_LIS' => $vdata->shares_lis,
                        'PR_CLS' => $vdata->pr_cls,
                        'SSNB' => $vdata->ssnb,
                        'SSNBT' => $vdata->ssnbt,
                        'SSTURNOVER' => $vdata->ssturnover,
                        'SSVOLUME' => $vdata->ssvolume,
                        'SSVELO' => $vdata->ssvelo//,
                       // 'action' => '<a href="'. base_url() .'report_stock/' . $vdata->code . '" style="cursor:pointer"><img src="' . base_url() . 'templates/images/more.png"></a>'
          
                    ),
                );
                $log[] = $entry;
                 //print_r($entry);
            }
        }
        $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount[0]->count, 'rows' => $log);
        echo json_encode($result);
    }
    
     public function getBoxdataReportmarketmonth_new() {
        $this->load->model('report_market_month_model','report_daily');
        $date = (isset($_POST['date']) && $_POST['date']!='undefined') ? $_POST['date'] : '';
        $exchange = (isset($_POST['exchange']) && $_POST['exchange']!='undefined' ) ? $_POST['exchange'] : '';
        $data = $this->report_daily->getReport_new($date,$exchange, $_POST['page'], $_POST['rp']);
        $dataCount = $this->report_daily->countGetreport($date,$exchange, $_POST['page'], $_POST['rp']);
        //var_export($data);
        $log = array();
        if ($data != NULL) {
            foreach ($data['listindexes'] as $k => $vdata) { 
                $entry = array('id' => $vdata->id,
                'cell' => array(
                        'DATE' => $vdata->date,
                        'TICKER' => $vdata->code,
                        //'NAME' => $vdata->name,
                        'EXCHANGE' => $vdata->exchange,
                        'SVOLUME' => $vdata->svolume,
                        'STURNOVER' => $vdata->sturnover,
                        'SVELO' => $vdata->svelo,
                        'NB' => $vdata->nb,
                        'NBT' => $vdata->nbt,
                        'SHARES_LIS' => $vdata->shares_lis,
                        'PR_CLS' => $vdata->pr_cls,
                        'SSNB' => $vdata->ssnb,
                        'SSNBT' => $vdata->ssnbt,
                        'SSTURNOVER' => $vdata->ssturnover,
                        'SSVOLUME' => $vdata->ssvolume,
                        'SSVELO' => $vdata->ssvelo//,
                       // 'action' => '<a href="'. base_url() .'report_stock/' . $vdata->code . '" style="cursor:pointer"><img src="' . base_url() . 'templates/images/more.png"></a>'


                    ),
                );
                $log[] = $entry;
                // print_r($entry);
            }
        }
        $result = array('page' => $_POST['page'] ? $_POST['page'] : 1, 'total' => $dataCount[0]->count, 'rows' => $log);
        echo json_encode($result);
    }


}
?>