<?php
if (isset($article['current'][0]['title'])) {
    $title = $article['current'][0]['title'];
    $title_default = $article['current'][0]['title'];
    //print_R($show_img);exit;
    ?>
    <section class="section resume_section even" id="<?php echo utf8_convert_title($title_default); ?>">
        <div class="section_header resume_section_header">
            <h2 class="section_title resume_section_title<?php echo $open == true ? " current" : ""; ?>">
                <a href="#<?php echo utf8_convert_title($title_default); ?>">
                    <span class="icon icon-align-left" <?php echo $header_color == 'blue' ? 'style="background-color: #4ca5d0!important;"' : ''; ?>></span>
                    <span class="section_name"><?php echo $title; ?></span>
                </a>
                <span class="section_icon"></span>
            </h2>
        </div>
        <div class="section_body resume_section_body" <?php echo $open == true ? "style='display: block;'" : ""; ?>>
            <?php
           // print_R($article);
            $img = PARENT_URL . $article['current'][0]['images'];
            echo "<div id='description'>";
            if($article['current'][0]['images'] != 'assets/images/no-image.jpg' && $show_img == true) {
                echo "<img style='float: left; width: 25%; padding-right: 10px;' src='{$img}' />";
            }
            echo $show_img == true ? $article['current'][0]['description'] : "";
            echo "</div>";

            $start = htmlentities("[LOADTABLE:");
            $end = htmlentities("]");
            $content = $article['current'][0]['long_description'];
            $countTable = 0;
            while(strpos($content, $start) !== false) {
                $param = explode(";", get_between($content, $start, $end));
                foreach ($param as $item) {
                    $val = explode("=", $item);
                    switch (trim($val[0])) {
                        case 'FORM':
                            $form = isset($val[1]) ? trim($val[1]) : "";
                            break;
                        case 'CATEGORY':
                            $cate = isset($val[1]) ? trim($val[1]) : "";
                            break;
                        case 'PERIOD':
                            $period = isset($val[1]) ? trim($val[1]) : "";
                            break;
                        case 'TYPE':
                            $type = isset($val[1]) ? trim($val[1]) : "";
                            break;
                        default:
                            break;
                    }
                }
                unset($param);
                
                //get html table
                $htmlTable = '';
                $rsTables = $this->first_model->getRSTables($cate, $period, $type, $form);

                foreach ($rsTables as $keyTable => $valueTable) {
                    switch ($valueTable['form']) {
                        case '1':
                            $htmlTable .= '<p><font class="table-title">'.$data['trans']->getTranslate('Table').' '.++$countTable.': '.$valueTable['title'].($valueTable['subtitle'] != '' ? ' ('.$valueTable['subtitle'].')' : '').'</font></p><br />';
                            $htmlTable .= '<table class="article-company">';
                            $htmlTable .= '<thead>';
                            $htmlTable .= '    <tr>';
                            $htmlTable .= '        <th></th>';
                            $htmlTable .= '        <th width="30%" colspan="3">'.$data['trans']->getTranslate('Number of companies').'</th>';
                            $htmlTable .= '        <th width="40%" colspan="4">'.$data['trans']->getTranslate('Market Capitablisation ($Bn)').'</th>';
                            $htmlTable .= '        <th width="10%">'.$data['trans']->getTranslate('Excedent').'<span class="required">*</span></th>';
                            $htmlTable .= '    </tr>';
                            $htmlTable .= '</thead>';
                            $htmlTable .= '<tbody>';
                            $htmlTable .= '    <tr class="title">';
                            $htmlTable .= '        <td>'.$data['trans']->getTranslate($type).'</td>';
                            $htmlTable .= '        <td>'.$data['trans']->getTranslate('ALL').'</td>';
                            $htmlTable .= '        <td>'.$data['trans']->getTranslate('WOMEN CEO').'</td>';
                            $htmlTable .= '        <td>%</td>';
                            $htmlTable .= '        <td>'.$data['trans']->getTranslate('Nb').'</td>';
                            $htmlTable .= '        <td>'.$data['trans']->getTranslate('ALL').'</td>';
                            $htmlTable .= '        <td>'.$data['trans']->getTranslate('WOMEN CEO').'</td>';
                            $htmlTable .= '        <td>%</td>';
                            $htmlTable .= '        <td>'.$data['trans']->getTranslate('Performance').'</td>';
                            $htmlTable .= '    </tr>';

                            $rsContents = $this->first_model->getRSContents($cate, $period, $type, "rs_contents");
                            
                            $count=0;
                            $finalRow = count($rsContents)>0 ? count($rsContents)-1 : 0;
                            
                            //get avarage
                            if(is_numeric($rsContents[$finalRow]['nb']) && is_numeric($rsContents[$finalRow]['all_nb'])) {
                                $avgNb = number_format(($rsContents[$finalRow]['nb']/$rsContents[$finalRow]['all_nb'])*100, 2);
                            } else {
                                $avgNb = 'n/a';
                            }

                            if(is_numeric($rsContents[$finalRow]['capi']) && is_numeric($rsContents[$finalRow]['all_capi'])) {
                                $avgCapi = number_format(($rsContents[$finalRow]['capi']/$rsContents[$finalRow]['all_capi'])*100, 2);
                            } else {
                                $avgCapi = 'n/a';
                            }

                            if(is_numeric($rsContents[$finalRow]['all_perf'])) {
                                $avgPerf = number_format($rsContents[$finalRow]['all_perf'], 2);
                            } else {
                                $avgPerf = 'n/a';
                            }

                            foreach($rsContents as $item) {
                                //if final row
                                if($count==$finalRow) {
                                    $htmlTable .= '    <tr class="title bold">';
                                    $htmlTable .= '        <td>'.$item['code'].'</td>';
                                    $htmlTable .= '        <td>'.number_format($item['all_nb'], 0, '.', ',').'</td>';
                                    $htmlTable .= '        <td>'.number_format($item['nb'], 0, '.', ',').'</td>';
                                    $htmlTable .= '        <td>'.$avgNb.'%</td>';
                                    $htmlTable .= '        <td>'.number_format($item['all_nb'], 0, '.', ',').'</td>';
                                    $htmlTable .= '        <td>'.number_format($item['all_capi'], 2, '.', ',').'</td>';
                                    $htmlTable .= '        <td>'.number_format($item['capi'], 2, '.', ',').'</td>';
                                    $htmlTable .= '        <td>'.$avgCapi.'%</td>';
                                    $htmlTable .= '        <td>'.$avgPerf.'%</td>';
                                    $htmlTable .= '    </tr>';
                                } else {
                                    //set row class
                                    if($count%2==0) {
                                        $htmlTable .= '    <tr class="even">';
                                    } else {
                                        $htmlTable .= '    <tr class="odd">';
                                    }
                                    $htmlTable .= '        <td>'.$item['code'].'</td>';
                                    $htmlTable .= '        <td>'.number_format($item['all_nb'], 0, '.', ',').'</td>';
                                    $htmlTable .= '        <td>'.number_format($item['nb'], 0, '.', ',').'</td>';

                                    if(is_numeric($item['nb']) && is_numeric($item['all_nb'])) {
                                        $perCompany = number_format(($item['nb']/$item['all_nb'])*100, 2);
                                        $htmlTable .= '        <td><font style="color: '.($perCompany >= $avgNb ? 'green' : 'red').';">'.$perCompany.'%</font></td>';
                                    } else {
                                        $htmlTable .= '        <td>n/a</td>';
                                    }
                                    $htmlTable .= '        <td>'.$item['all_nb'].'</td>';
                                    $htmlTable .= '        <td>'.number_format($item['all_capi'], 2).'</td>';
                                    $htmlTable .= '        <td>'.number_format($item['capi'], 2).'</td>';

                                    if(is_numeric($item['capi']) && is_numeric($item['all_capi'])) {
                                        $perMarket = number_format(($item['capi']/$item['all_capi'])*100, 2);
                                        $htmlTable .= '        <td><font style="color: '.($perMarket > $avgCapi ? 'green' : 'red').';">'.$perMarket.'%</font></td>';
                                    } else {
                                        $htmlTable .= '        <td>n/a</td>';
                                    }

                                    if(is_numeric($item['all_perf'])) {
                                        $perExc = number_format($item['all_perf'], 2);
                                        $htmlTable .= '        <td><font style="color: '.($perExc > $avgPerf ? 'green' : 'red').';">'.$perExc.'%</font></td>';
                                    } else {
                                        $htmlTable .= '        <td>n/a</td>';
                                    }
                                    $htmlTable .= '    </tr>';
                                }

                                $count++;
                            }
                            unset($rsContents);

                            $htmlTable .= '</tbody>';
                            $htmlTable .= '</table>';
                            $htmlTable .= '<p><font class="table-source">'.$data['trans']->getTranslate('Source').': '.$valueTable['source'].'</font></p>';
                            break;
                        case '2':
                            $htmlTable .= '<p><font class="table-title">'.$data['trans']->getTranslate('Table').' '.++$countTable.': '.$valueTable['title'].($valueTable['subtitle'] != '' ? ' ('.$valueTable['subtitle'].')' : '').'</font></p><br />';
                            $htmlTable .= '<table class="article-company">';
                            $htmlTable .= '<tbody>';
                            $htmlTable .= '    <tr class="title">';
                            $htmlTable .= '        <td class="text-align-center" style="width: 20%;">'.$data['trans']->getTranslate($type).'</td>';
                            $htmlTable .= '        <td class="text-align-center" style="width: 10%;">%</td>';
                            $htmlTable .= '        <td class="text-align-center">'.$data['trans']->getTranslate($valueTable['column1']).'</td>';
                            $htmlTable .= '        <td class="text-align-center" style="width: 10%;">%</td>';
                            $htmlTable .= '        <td class="text-align-center" style="width: 10%;">'.$data['trans']->getTranslate('Diff').'</td>';
                            $htmlTable .= '        <td class="text-align-center" style="width: 20%;">'.$data['trans']->getTranslate($valueTable['column2']).'</td>';
                            $htmlTable .= '        <td class="text-align-center" style="width: 10%;">'.$data['trans']->getTranslate('Diff').'</td>';
                            $htmlTable .= '    </tr>';

                            $rsContents = $this->first_model->getRSContents($cate, $period, $type, "rs_contents2");
                            
                            $count=0;
                            $finalRow = count($rsContents)-1;

                            foreach($rsContents as $item) {
                                //if final row
                                if($count==$finalRow) {
                                    $htmlTable .= '    <tr class="title bold">';
                                    $htmlTable .= '        <td>'.$item['idxname'].'</td>';
                                    $htmlTable .= '        <td>'.(is_numeric($item['yearperf']) ? number_format($item['yearperf'], 2).'%' : 'n/a').'</td>';
                                    $htmlTable .= '        <td></td>';
                                    $htmlTable .= '        <td></td>';
                                    $htmlTable .= '        <td></td>';
                                    $htmlTable .= '        <td>'.(is_numeric($item['yearperf2']) ? number_format($item['yearperf2'], 2).'%' : 'n/a').'</td>';

                                    if(is_numeric($item['yearperf']) && is_numeric($item['yearperf2'])) {
                                        $htmlTable .= '        <td>'.number_format($item['yearperf']-$item['yearperf2'], 2).'%</td>';
                                    } else if (!is_numeric($item['yearperf']) && !is_numeric($item['yearperf2'])) {
                                        $htmlTable .= '        <td>n/a</td>';
                                    } else {
                                        if(is_numeric($item['yearperf'])) {
                                            $htmlTable .= '        <td>'.number_format($item['yearperf'], 2).'%</td>';
                                        }
                                        if(is_numeric($item['yearperf2'])) {
                                            $htmlTable .= '        <td>'.number_format($item['yearperf1'], 2).'%</td>';
                                        }
                                    }
                                    $htmlTable .= '    </tr>';
                                } else {
                                    //set row class
                                    if($count%2==0) {
                                        $htmlTable .= '    <tr class="even">';
                                    } else {
                                        $htmlTable .= '    <tr class="odd">';
                                    }
                                    $htmlTable .= '        <td>'.$item['idxname'].'</td>';
                                    $htmlTable .= '        <td>'.(is_numeric($item['yearperf']) ? $item['yearperf'].'%' : 'n/a').'</td>';
                                    $htmlTable .= '        <td class="text-align-left">'.$item['idxname1'].'</td>';
                                    $htmlTable .= '        <td>'.(is_numeric($item['yearperf1']) ? number_format($item['yearperf1'], 2).'%' : 'n/a').'</td>';

                                    if(is_numeric($item['yearperf']) && is_numeric($item['yearperf1'])) {
                                        $htmlTable .= '        <td>'.number_format($item['yearperf']-$item['yearperf1'], 2).'%</td>';
                                    } else if (!is_numeric($item['yearperf']) && !is_numeric($item['yearperf1'])) {
                                        $htmlTable .= '        <td>n/a</td>';
                                    } else {
                                        if(is_numeric($item['yearperf'])) {
                                            $htmlTable .= '        <td>'.number_format($item['yearperf'], 2).'%</td>';
                                        }
                                        if(is_numeric($item['yearperf1'])) {
                                            $htmlTable .= '        <td>'.number_format($item['yearperf1'], 2).'%</td>';
                                        }
                                    }
                                    
                                    $htmlTable .= '        <td>'.(is_numeric($item['yearperf2']) ? number_format($item['yearperf2'], 2).'%' : 'n/a').'</td>';

                                    if(is_numeric($item['yearperf']) && is_numeric($item['yearperf2'])) {
                                        $htmlTable .= '        <td>'.number_format($item['yearperf']-$item['yearperf2'], 2).'%</td>';
                                    } else if (!is_numeric($item['yearperf']) && !is_numeric($item['yearperf2'])) {
                                        $htmlTable .= '        <td>n/a</td>';
                                    } else {
                                        if(is_numeric($item['yearperf'])) {
                                            $htmlTable .= '        <td>'.number_format($item['yearperf'], 2).'%</td>';
                                        }
                                        if(is_numeric($item['yearperf2'])) {
                                            $htmlTable .= '        <td>'.number_format($item['yearperf1'], 2).'%</td>';
                                        }
                                    }
                                    $htmlTable .= '    </tr>';
                                }
                                
                                $count++;
                            }
                            unset($rsContents);
                            
                            $htmlTable .= '</tbody>';
                            $htmlTable .= '</table>';
                            $htmlTable .= '<p><font class="table-source">'.$data['trans']->getTranslate('Source').': '.$valueTable['source'].'</font></p>';
                            break;
                        case '3':
                            $showLongShort = $valueTable['show_long_short'];
                            $htmlTable .= '<p><font class="table-title">'.$data['trans']->getTranslate('Table').' '.++$countTable.': '.$valueTable['title'].($valueTable['subtitle'] != '' ? ' ('.$valueTable['subtitle'].')' : '').'</font></p><br />';
                            $htmlTable .= '<table class="article-company">';
                            $htmlTable .= '<thead>';
                            $htmlTable .= '    <tr>';
                            $htmlTable .= '        <th></th>';
                            $htmlTable .= '        <th width="20%" colspan="3">'.strtoupper($data['trans']->getTranslate('LOW')).'</th>';
                            $htmlTable .= '        <th width="20%" colspan="3">'.strtoupper($data['trans']->getTranslate('MEDIUM')).'</th>';
                            $htmlTable .= '        <th width="20%" colspan="3">'.strtoupper($data['trans']->getTranslate('HIGH')).'</th>';
                            if($showLongShort == 1) {
                                $htmlTable .= '        <th width="20%" colspan="3">'.strtoupper($data['trans']->getTranslate('LONG-SHORT STRATEGY')).'</th>';
                            }
                            $htmlTable .= '    </tr>';
                            $htmlTable .= '</thead>';
                            $htmlTable .= '<tbody>';
                            $htmlTable .= '    <tr class="title">';
                            $htmlTable .= '        <td>'.$data['trans']->getTranslate($type).'</td>';
                            $htmlTable .= '        <td>'.$data['trans']->getTranslate('Nb').'</td>';
                            $htmlTable .= '        <td class="text-align-center" colspan="2">'.$data['trans']->getTranslate('Perf_').'</td>';
                            $htmlTable .= '        <td>'.$data['trans']->getTranslate('Nb').'</td>';
                            $htmlTable .= '        <td class="text-align-center" colspan="2">'.$data['trans']->getTranslate('Perf_').'</td>';
                            $htmlTable .= '        <td>'.$data['trans']->getTranslate('Nb').'</td>';
                            $htmlTable .= '        <td class="text-align-center" colspan="2">'.$data['trans']->getTranslate('Perf_').'</td>';
                            if($showLongShort == 1) {
                                $htmlTable .= '        <td>'.$data['trans']->getTranslate('Nb').'</td>';
                                $htmlTable .= '        <td class="text-align-center" colspan="2">'.$data['trans']->getTranslate('Perf_').'</td>';
                            }
                            $htmlTable .= '    </tr>';

                            $rsContents = $this->first_model->getRSContents($cate, $period, $type, "rs_contents3");
                            
                            $count=0;
                            $finalRow = count($rsContents)>0 ? count($rsContents)-1 : 0;

                            //get avarage
                            $avgPerfLow = number_format($rsContents[$finalRow]['perf_crt1'], 2);
                            $avgPerfMedium = number_format($rsContents[$finalRow]['perf_crt2'], 2);
                            $avgPerfHigh = number_format($rsContents[$finalRow]['perf_crt3'], 2);
                            $avgPerfHighLow = number_format($rsContents[$finalRow]['perf_crt4'], 2);

                            foreach($rsContents as $item) {
                                //if final row
                                if($count==$finalRow) {
                                    $htmlTable .= '    <tr class="title bold">';
                                    $htmlTable .= '        <td>'.$data['trans']->getTranslate($item['code']).'</td>';
                                    $htmlTable .= '        <td>'.number_format($item['nb_crt1'], 0, '.', ',').'</td>';
                                    $htmlTable .= '        <td class="no-border-right">'.($item['nb_crt1'] == 0 ? "-" : number_format($item['perf_crt1'], 2)).'</td>';
                                    $htmlTable .= '        <td class="no-border-left text-align-left">'.$item['sgf_crt1'].'</td>';
                                    $htmlTable .= '        <td>'.number_format($item['nb_crt2'], 0, '.', ',').'</td>';
                                    $htmlTable .= '        <td class="no-border-right">'.($item['nb_crt2'] == 0 ? "-" : number_format($item['perf_crt2'], 2)).'</td>';
                                    $htmlTable .= '        <td class="no-border-left text-align-left">'.$item['sgf_crt2'].'</td>';
                                    $htmlTable .= '        <td>'.number_format($item['nb_crt3'], 0, '.', ',').'</td>';
                                    $htmlTable .= '        <td class="no-border-right">'.($item['nb_crt3'] == 0 ? "-" : number_format($item['perf_crt3'], 2)).'</td>';
                                    $htmlTable .= '        <td class="no-border-left text-align-left">'.$item['sgf_crt3'].'</td>';
                                    if($showLongShort == 1) {
                                        $htmlTable .= '        <td>'.($item['nb_crt4'] == 0 ? "-" : number_format($item['nb_crt4'], 0, '.', ',')).'</td>';
                                        $htmlTable .= '        <td class="no-border-right">'.($item['nb_crt4'] == 0 ? "-" : number_format($item['perf_crt4'], 2)).'</td>';
                                        $htmlTable .= '        <td class="text-align-left no-border-left">'.$item['sgf_crt4'].'</td>';
                                    }
                                    $htmlTable .= '    </tr>';
                                } else {
                                    //set row class
                                    if($count%2==0) {
                                        $htmlTable .= '    <tr class="even">';
                                    } else {
                                        $htmlTable .= '    <tr class="odd">';
                                    }
                                    $htmlTable .= '        <td>'.$item['code'].'</td>';
                                    $htmlTable .= '        <td>'.number_format($item['nb_crt1'], 0, '.', ',').'</td>';

                                    if(is_numeric($item['perf_crt1'])) {
                                        $perf_crt1 = number_format($item['perf_crt1'], 2);
                                        $htmlTable .= '        <td class="no-border-right"><font style="color: '.($perf_crt1 > $avgPerfLow ? 'green' : 'red').'; float: right;">'.($item['nb_crt1'] == 0 ? "-" : $perf_crt1).'</font></td>';
                                        $htmlTable .= '        <td class="no-border-left"><font style="color: '.($perf_crt1 > $avgPerfLow ? 'green' : 'red').'; float: left;">'.$item['sgf_crt1'].'</font></td>';
                                    } else {
                                        $htmlTable .= '        <td class="no-border-right">-</td><td class="no-border-left"></td>';
                                    }

                                    $htmlTable .= '        <td>'.number_format($item['nb_crt2'], 0, '.', ',').'</td>';

                                    if(is_numeric($item['perf_crt2'])) {
                                        $perf_crt2 = number_format($item['perf_crt2'], 2);
                                        $htmlTable .= '        <td class="no-border-right"><font style="color: '.($perf_crt2 > $avgPerfMedium ? 'green' : 'red').'; float: right;">'.($item['nb_crt2'] == 0 ? "-" : $perf_crt2).'</font></td>';
                                        $htmlTable .= '        <td class="no-border-left"><font style="color: '.($perf_crt2 > $avgPerfMedium ? 'green' : 'red').'; float: left;">'.$item['sgf_crt2'].'</font></td>';
                                    } else {
                                        $htmlTable .= '        <td class="no-border-right">-</td><td class="no-border-left"></td>';
                                    }

                                    $htmlTable .= '        <td>'.number_format($item['nb_crt3'], 0, '.', ',').'</td>';

                                    if(is_numeric($item['perf_crt3'])) {
                                        $perf_crt3 = number_format($item['perf_crt3'], 2);
                                        $htmlTable .= '        <td class="no-border-right"><font style="color: '.($perf_crt3 > $avgPerfHigh ? 'green' : 'red').'; float: right;">'.($item['nb_crt3'] == 0 ? "-" : $perf_crt3).'</font></td>';
                                        $htmlTable .= '        <td class="no-border-left"><font style="color: '.($perf_crt3 > $avgPerfHigh ? 'green' : 'red').'; float: left;">'.$item['sgf_crt3'].'</font></td>';
                                    } else {
                                        $htmlTable .= '        <td class="no-border-right">-</td><td class="no-border-left"></td>';
                                    }

                                    if($showLongShort == 1) {
                                        $htmlTable .= '        <td>'.($item['nb_crt4'] == 0 ? "-" : number_format($item['nb_crt4'], 0, '.', ',')).'</td>';

                                        if(is_numeric($item['perf_crt4'])) {
                                            $perf_crt4 = number_format($item['perf_crt4'], 2);
                                            $htmlTable .= '        <td class="no-border-right"><font style="color: '.($perf_crt4 > $avgPerfHighLow ? 'green' : 'red').'; float: right;">'.($item['nb_crt4'] == 0 ? "-" : $perf_crt4).'</font></td>';
                                            $htmlTable .= '        <td class="no-border-left"><font style="color: '.($perf_crt4 > $avgPerfHighLow ? 'green' : 'red').'; float: left;">'.$item['sgf_crt4'].'</font></td>';
                                        } else {
                                            $htmlTable .= '        <td class="no-border-right">-</td--><!--td class="no-border-left"></td>';
                                        }
                                    }

                                    $htmlTable .= '    </tr>';
                                }

                                $count++;
                            }
                            unset($rsContents);
                            
                            $htmlTable .= '</tbody>';
                            $htmlTable .= '</table>';
                            $htmlTable .= '<p><font class="table-source">'.$data['trans']->getTranslate('Source').': '.$valueTable['source'].'</font></p>';
                            break;
                        case '4':
                            $htmlTable .= '<p><font class="table-title">'.$data['trans']->getTranslate('Table').' '.++$countTable.': '.$valueTable['title'].($valueTable['subtitle'] != '' ? ' ('.$valueTable['subtitle'].')' : '').'</font></p><br />';
                            $htmlTable .= '<table class="article-company" style="width: 50%; margin-left: 25%;">';
                            $htmlTable .= '<tbody>';
                            $htmlTable .= '    <tr class="title">';
                            $htmlTable .= '        <td class="text-align-center">'.$data['trans']->getTranslate('Interval').'</td>';
                            $htmlTable .= '        <td class="text-align-center" style="width: 25%;">'.$data['trans']->getTranslate('Nb').'</td>';
                            $htmlTable .= '        <td class="text-align-center" style="width: 25%;">%</td>';
                            $htmlTable .= '        <td class="text-align-center" style="width: 25%;">'.$data['trans']->getTranslate('Cul_').'</td>';
                            $htmlTable .= '    </tr>';

                            $rsContents = $this->first_model->getRSContents($cate, $period, $type, "rs_contents4");
                            
                            $count=0;

                            foreach($rsContents as $item) {
                                //set row class
                                if($count%2==0) {
                                    $htmlTable .= '    <tr class="even">';
                                } else {
                                    $htmlTable .= '    <tr class="odd">';
                                }
                                $htmlTable .= '        <td class="text-align-center">'.$item['interval'].'</td>';
                                $htmlTable .= '        <td class="text-align-right">'.(is_numeric($item['nb']) ? number_format($item['nb'], 0, '.', ',') : 'n/a').'</td>';
                                $htmlTable .= '        <td class="text-align-right">'.$item['per'].'</td>';
                                $htmlTable .= '        <td class="text-align-right">'.$item['cul'].'</td>';
                                $htmlTable .= '    </tr>';
                                
                                $count++;
                            }
                            unset($rsContents);

                            $htmlTable .= '</tbody>';
                            $htmlTable .= '</table>';
                            $htmlTable .= '<p><font class="table-source">'.$data['trans']->getTranslate('Source').': '.$valueTable['source'].'</font></p>';
                            break;
                        case '5':
                            $htmlTable .= '<p><font class="table-title">'.$data['trans']->getTranslate('Table').' '.++$countTable.': '.$valueTable['title'].($valueTable['subtitle'] != '' ? ' ('.$valueTable['subtitle'].')' : '').'</font></p><br />';
                            $htmlTable .= '<table class="article-company tablesorter" style="font-size: 11px;">';
                            $htmlTable .= '<thead>';
                            $htmlTable .= '    <tr>';
                            $htmlTable .= '        <td colspan="2" class="border-none"></td>';
                            $htmlTable .= '        <td width="45%" colspan="9" class="text-align-center">'.$data['trans']->getTranslate(strtoupper($type.' by period')).'</td>';
                            $htmlTable .= '        <td width="30%" colspan="6" class="text-align-center">'.$data['trans']->getTranslate(strtoupper($type.' by calendar year')).'</td>';
                            $htmlTable .= '    </tr>';
                            $htmlTable .= '    <tr class="title">';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('Idx_name').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('Close').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('1M').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('2M').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('3M').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('6M').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('1Y').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('2Y').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('3Y').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('4Y').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('5Y').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('YTD').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('2012').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('2011').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('2010').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('2009').'</th>';
                            $htmlTable .= '        <th>'.$data['trans']->getTranslate('Since 2009').'</th>';
                            $htmlTable .= '    </tr>';
                            $htmlTable .= '</thead>';
                            $htmlTable .= '<tbody>';

                            $rsContents = $this->first_model->getRSContents($cate, $period, $type, "rs_contents5");
                            
                            $count=0;
                            
                            foreach($rsContents as $item) {
                                //set row class
                                if($count%2==0) {
                                    $htmlTable .= '    <tr class="even">';
                                } else {
                                    $htmlTable .= '    <tr class="odd">';
                                }

                                $htmlTable .= '        <td>'.$item['idx_name'].'</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['close'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['close']) ? number_format($item['close'], 0, '.', ',') : '-').'</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['1m'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['1m']) ? number_format($item['1m'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['2m'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['2m']) ? number_format($item['2m'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['3m'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['3m']) ? number_format($item['3m'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['6m'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['6m']) ? number_format($item['6m'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['1y'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['1y']) ? number_format($item['1y'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['2y'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['2y']) ? number_format($item['2y'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['3y'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['3y']) ? number_format($item['3y'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['4y'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['4y']) ? number_format($item['4y'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['5y'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['5y']) ? number_format($item['5y'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['ytd'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['ytd']) ? number_format($item['ytd'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['2012'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['2012']) ? number_format($item['2012'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['2011'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['2011']) ? number_format($item['2011'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['2010'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['2010']) ? number_format($item['2010'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['2009'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['2009']) ? number_format($item['2009'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '        <td><font style="color: '.($item['since2009'] >= 0 ? 'green' : 'red').';">'.(is_numeric($item['since2009']) ? number_format($item['since2009'], 2, '.', ',') : '-').'%</td>';
                                $htmlTable .= '    </tr>';

                                $count++;
                            }
                            unset($rsContents);

                            $htmlTable .= '</tbody>';
                            $htmlTable .= '</table>';
                            $htmlTable .= '<p><font class="table-source">'.$data['trans']->getTranslate('Source').': '.$valueTable['source'].'</font></p>';
                            break;
                        default:
                            break;
                    }
                }
                unset($listTables);
                
                //replace content
                $content = replace_string_between($content, $start, $end, $htmlTable);
            }
            echo "<div id='long_description' style='clear: both; padding-top: 10px;'>{$content}</div>";
            ?>
        </div>
    </section>
    <?php
}
?>