<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Indexlist extends Admin {

    protected $data;

    function __construct() {
        parent::__construct();
        $this->load->model('indexlist_model');
    }

    function index() {
        $lang_code = $this->session->userdata('curent_language');
        $this->data->indexes = $this->indexlist_model->getAllIndex();
        $this->data->performances = $this->indexlist_model->getAllIndex();
        
        $this->template->write_view('content', 'indexlist/list', $this->data);
        $this->template->write('title', 'Index List ');
        $this->template->render();
    }
    
    function detail($code = "")
    {
        if($code == "")
        {
            $link = admin_url() . 'indexlist';
            echo "<script>window.location = '$link'</script>";
            exit;
        }
        $this->data->code = $code;
        $this->data->dataPerformance = $this->indexlist_model->getPerformance($code);
        $this->data->dataPerformanceYear = $this->indexlist_model->getPerformanceYearButNewest($code);
        $this->data->dataComposition = $this->indexlist_model->getComposition($code);

        $this->template->write_view('content', 'indexlist/detail', $this->data);
        $this->template->write('title', 'Index Detail ');
        $this->template->render();
    }
    
    function runquery()
    {
        $query = $_POST['query'];
        $indexes = $this->db->query($query)->result_array();
        $data['indexes'] = $html_indexes = $this->queryIndexes($indexes);
        $data['performances'] = $html_performances = $this->queryPerformances($indexes);
        echo json_encode($data);
    }
    
    
    function queryIndexes($data)
    {
        $html = "";
            $html .= '<table id="table-indexes" class="table sortable no-margin" cellspacing="0" style="width:100% !important; margin-top: -20px !important;">';
            $html .= '<thead><tr>';
                $html .= '<th style="width:300px"  scope="col" bSortable="true"><span class="column-sort"><a href="#" class="sort-up"></a><a href="#" class="sort-down"></a></span>Index</th>';
                $html .= '<th scope="col" bSortable="true" style="text-align: right;"><span class="column-sort"><a href="#" class="sort-up"></a><a href="#" class="sort-down"></a></span>Close</th>';
                $html .= '<th scope="col" bSortable="true" style="text-align: right;"><span class="column-sort"><a href="#" class="sort-up"></a><a href="#" class="sort-down"></a></span>Perf%</th>';
            $html .= '</tr></thead>';
            $html .= '<tbody>';
                $i = 1;
                foreach($data as $index)
                {
                    $col = $i++ % 2 == 0 ? "class='odd'" : "class='even'";
                    $html .= "<tr $col>";
                    $html .= "<td style='text-align: left;'>".$index['SHORTNAME']."</td>";
                    $html .= "<td style='text-align: right;'>". number_format($index['close'], 2,'.', ',') ."</td>";
                    $col_text = $index['dvar'] < 0 ? "style='color:#ff492a'" : "style='color:#3399CC'";
                    $perf = $index['close'] == 0 ? "n.a." : number_format($index['dvar'], 2);
                    $html .= "<td style='text-align: right;'><span $col_text>". $perf . "% </span></td>";
                    $html .= "</tr>";
                }
            $html .= '</tbody>';
         $html .= '</table>';
         return $html;
    }
    
    
    
    function queryPerformances($data)
    {
        $html = "";
            $html .= '<table class="table sortable no-margin" cellspacing="0" style="width:100% !important; margin-top: -20px !important;">';
            $html .= '<thead><tr>';
                $html .= '<th scope="col" bSortable="true"><span class="column-sort"><a href="#" class="sort-up"></a><a href="#" class="sort-down"></a></span>NR</th>';
                $html .= '<th scope="col" width="300px" bSortable="true"><span class="column-sort"><a href="#" class="sort-up"></a><a href="#" class="sort-down"></a></span>Index</th>';
                $html .= '<th scope="col" bSortable="true" style="text-align: right;"><span class="column-sort"><a href="#" class="sort-up"></a><a href="#" class="sort-down"></a></span>Close</th>';
                $html .= '<th scope="col" bSortable="true" style="text-align: right;"><span class="column-sort"><a href="#" class="sort-up"></a><a href="#" class="sort-down"></a></span>Month%</th>';
                $html .= '<th scope="col" bSortable="true" style="text-align: right;"><span class="column-sort"><a href="#" class="sort-up"></a><a href="#" class="sort-down"></a></span>Year%</th>';
            $html .= '</tr></thead>';
            $html .= '<tbody>';
                $i = 1;
                foreach($data as $performance)
                {
                    $col = $i % 2 == 0 ? "class='odd'" : "class='even'";
                    $html .= "<tr $col>";
                    $html .= "<td style='text-align: center;'>$i</td>";
                    $html .= "<td style='text-align: left;'>".$performance['SHORTNAME']."</td>";
                    $html .= "<td style='text-align: right;'>". number_format($performance['close'], 2,'.', ',') ."</td>";
                    
                    $col_text = $performance['varmonth'] < 0 ? "style='color:#ff492a'" : "style='color:#3399CC'";
                    $month = number_format($performance['varmonth'], 2, '.', ',');
                    $html .= "<td style='text-align: right;'><span $col_text>$month %</span></td>";
                    
                    $col_text = $performance['varyear'] < 0 ? "style='color:#ff492a'" : "style='color:#3399CC'";
                    $year = number_format($performance['varyear'], 2, '.', ',');
                    $html .= "<td style='text-align: right;'><span $col_text>$year %</span></td>";
                    
                    $html .= "</tr>";
                    $i++;
                }
            $html .= '</tbody>';
         $html .= '</table>';
         return $html;
    }
    
    
    
    
    function queryIndexes2($data)
    {
    ?>
        <table id="table-indexes" class="table sortable no-margin" cellspacing="0" style="width:100% !important; margin-top: -20px !important;">
            <thead>
                <tr>
                    <th style="width:300px"  scope="col" bSortable="true">
                        <span class="column-sort">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                        </span>
                        <?php trans('index'); ?>
                    </th>
                    <th scope="col" bSortable="true" style="text-align: right;">
                        <span class="column-sort">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                        </span>
                        <?php trans('close'); ?>
                    </th>
                    <th scope="col" bSortable="true" style="text-align: right;">
                        <span class="column-sort">
                            <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                            <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                        </span>
                        <?php trans('perf%'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i = 1;
                    foreach($data as $index)
                    {
                ?>
                    <tr <?php echo $i++ % 2 == 0 ? "class='odd'" : "class='even'" ?>>
                        <td><?php echo $index['SHORTNAME'] ?></td> 
                        <td style="text-align: right;"><?php echo number_format($index['close'], 2,'.', ',') ?></td>
                        <td style="text-align: right;"><span style="color: <?php echo $index['dvar'] < 0 ? "#ff492a" : "#3399CC"; ?>"><?php echo $index['close'] == 0 ? "n.a." : number_format($index['dvar'], 2) . " %"; ?></span></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
         </table>
    <?php
    }
    
    function queryPerformances2($data)
    {
    ?>
        <table class="table sortable no-margin" cellspacing="0" style="width:100% !important; margin-top: -20px !important;"  id="mod_news">
        <thead>
            <tr>
                <th scope="col" width="" bSortable="true">
                    <span class="column-sort">
                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                    </span>
                    <?php trans('nr'); ?>
                </th>
                <th scope="col" width="300px" bSortable="true">
                    <span class="column-sort">
                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                    </span>
                    <?php trans('index'); ?>
                </th>
                <th scope="col" width="" bSortable="true" style="text-align: right;">
                    <span class="column-sort">
                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                    </span>
                    <?php trans('close'); ?>
                </th>
                <th scope="col" width="" bSortable="true" style="text-align: right;">
                    <span class="column-sort">
                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                    </span>
                    <?php trans('month%'); ?>
                </th>
                <th scope="col" width="" bSortable="true" style="text-align: right;">
                    <span class="column-sort">
                        <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a>
                        <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a>
                    </span>
                    <?php trans('year%'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                foreach($data as $performance)
                {
            ?>
                <tr <?php echo $i % 2 == 0 ? "class='odd'" : "class='even'" ?>>
                    <td style="text-align: center;"><?php echo $i ?></td>
                    <td><?php echo $performance['SHORTNAME'] ?></td>
                    <td style="text-align: right;"><?php echo number_format($performance['close'], 2,'.', ',') ?></td>
                    <td style="text-align: right;"><span style="color: <?php echo $performance['varmonth'] < 0 ? "#790000" : "#3399CC"; ?>"><?php echo number_format($performance['varmonth'], 2, '.', ','); ?> %</span></td>
                    <td style="text-align: right;"><span style="color: <?php echo $performance['varyear'] < 0 ? "#790000" : "#3399CC"; ?>"><?php echo number_format($performance['varyear'], 2, '.', ','); ?> %</span></td> 
                </tr>
            <?php
                $i++;
                }
            ?>
        </tbody>
    </table>
    <?php
    }
}