<section class="section resume_section even" id="section_summary">
    <div class="section_body resume_section_body">
        <div class="wrapper resume_wrapper">
            <div class="category resume_category resume_category_1 first even">
                <div class="category_header resume_category_header">
                    <table style="width: 100%;">
                        <tr>
                            <td colspan="4">
                               <h3 class="category_title" style="background: none;"><?php echo $data['trans']->getTranslate('summary'); ?></h3>
                            </td>                           
                        </tr>
                        <tr>
                            <td width="15%" style="text-align: center;">
                               <h3 style="color: #373737;" class="category_title"> - </h3>
                            </td>
                            <?php
                            $head1=$head2=$head3="";
                            foreach ($datasummary as $sum) {
                                foreach ($sum as $subSum) {
                                    if($subSum['ord'] == 1) {
                                        $head1 = $subSum['title'];
                                    } else if($subSum['ord'] == 2) {
                                        $head2 = $subSum['title'];
                                    } else {
                                        $head3 = $subSum['title'];
                                    }
                                }
                            }
                            ?>
                            <td width="30%" style="text-align: center;">
                                <h3 class="category_title">
                                    <font style="margin-left: 15px; color: #FFFFFF;"><?php echo $data['trans']->getTranslate($head1); ?></font>
                                </h3>
                            </td>
                            <td width="27.5%" style="text-align: center;">
                                <h3 class="category_title">
                                    <font style="margin-left: 15px; color: #FFFFFF;"><?php echo $data['trans']->getTranslate($head2); ?></font>
                                </h3>
                            </td>
                            <td width="27.5%" style="text-align: center;">
                                <h3 class="category_title">
                                    <font style="margin-left: 15px; color: #FFFFFF;"><?php echo $data['trans']->getTranslate($head3); ?></font>
                                </h3>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="category_body resume_category_body">
                    <article class="post resume_post resume_post_1">
                        <div class="post_header resume_post_header">
                            <table style="width: 100%;">
                                <?php
                                foreach ($datasummary as $keySum => $valueSum) {
                                    ?>
                                    <!-- begin type -->
                                    <tr>
                                        <td width="15%" valign="middle" rowspan="<?php echo $valueSum[0]['maxrows']; ?>" style="text-align:center; display: table-cell;text-align: center; vertical-align: middle;">
                                            <h3 style="color: #FFFFFF;" class="post_title" >
                                                <?php echo $data['trans']->getTranslate($keySum); ?>
                                            </h3>
                                        </td>
                                        <td width="30%" style="text-align: right; border-bottom: 1px dashed #3b3b3b; padding-bottom:10px">
                                            <aside class="widget widget_skills">
                                                  <div class="widget_inner style_3">
                                                        <div class="skills_row odd first">
                                                            <span class="caption">
                                                                <?php echo $valueSum[0]['ord'] == 1 ? $data['trans']->getTranslate($valueSum[0]['translate']) : ""; ?>
                                                            </span>
                                                            <span class="progressbar">
                                                                <span class="progress aqua" data-process="<?php echo $valueSum[0]['ord'] == 1 ? $valueSum[0]['ranking'] : 0; ?>%" style="width: <?php echo $valueSum[0]['ord'] == 1 ? $valueSum[0]['ranking'] : 0; ?>%;"></span>
                                                            </span>
                                                            <span class="caption1" style="float: right;"><?php echo $valueSum[0]['ord'] == 1 ? $valueSum[0]['field'] : 'n/a'; ?></span>
                                                        </div>
                                                  </div>
                                            </aside>
                                        </td>
                                        <td width="27.5%" style="text-align: right; border-bottom: 1px dashed #3b3b3b;">
                                            <aside class="widget widget_skills">
                                                  <div class="widget_inner style_3">
                                                        <div class="skills_row odd first">
                                                            <span class="caption">
                                                                <?php echo $valueSum[1]['ord'] == 2 ? $data['trans']->getTranslate($valueSum[1]['translate']) : ""; ?>
                                                            </span>
                                                            <span class="progressbar">
                                                                <span class="progress aqua" data-process="<?php echo $valueSum[1]['ord'] == 2 ? $valueSum[1]['ranking'] : 0; ?>%" style="width: <?php echo $valueSum[1]['ord'] == 2 ? $valueSum[1]['ranking'] : 0; ?>%;"></span>
                                                            </span>
                                                            <span class="caption1" style="float: right;"><?php echo $valueSum[1]['ord'] == 2 ? $valueSum[1]['field'] : 'n/a'; ?></span>
                                                        </div>
                                                  </div>
                                            </aside>
                                        </td>
                                        <td width="27.5%" style="text-align: right; border-bottom: 1px dashed #3b3b3b;">
                                            <aside class="widget widget_skills">
                                                  <div class="widget_inner style_3">
                                                        <div class="skills_row odd first">
                                                            <span class="caption">
                                                                <?php echo $valueSum[2]['ord'] == 3 ? $data['trans']->getTranslate($valueSum[2]['translate']) : ""; ?>
                                                            </span>
                                                            <span class="progressbar">
                                                                <span class="progress aqua" data-process="<?php echo $valueSum[2]['ord'] == 3 ? $valueSum[2]['ranking'] : 0; ?>%" style="width: <?php echo $valueSum[2]['ord'] == 3 ? $valueSum[2]['ranking'] : 0; ?>%;"></span>
                                                            </span>
                                                            <span class="caption1" style="float: right;"><?php echo $valueSum[2]['ord'] == 3 ? $valueSum[2]['field'] : 'n/a'; ?></span>
                                                        </div>
                                                  </div>
                                            </aside>
                                        </td>
                                    </tr>
                                    <!-- end type -->
                                    <?php
                                    $maxrows = $valueSum[0]['maxrows'];
                                    for ($i = 2; $i <= $maxrows; $i++) {
                                        ?>
                                        <!-- begin next row -->
                                        <tr>
                                        <?php
                                        $checkCol1=$checkCol2=$checkCol3=0;
                                        $col1=$col2=$col3="";
                                        foreach ($valueSum as $subKeySum => $subValueSum) {
                                            if($subValueSum['order'] == $i) {
                                                if($i < $maxrows) {
                                                    switch ($subValueSum['ord']) {
                                                        case '2':
                                                            $col2 = '<td width="27.5%" style="text-align: right; border-bottom: 1px dashed #3b3b3b;">
                                                                <aside class="widget widget_skills">
                                                                      <div class="widget_inner style_3">
                                                                            <div class="skills_row odd first">
                                                                                <span class="caption" width="20%">'.$data['trans']->getTranslate($subValueSum['translate']).'</span>
                                                                                <span class="progressbar">
                                                                                    <span class="progress aqua" data-process="'.$subValueSum['ranking'].'%" style="width: '.$subValueSum['ranking'].'%;"></span>
                                                                                </span>
                                                                                <span class="caption1" style="float: right;">'.$subValueSum['field'].'</span>
                                                                            </div>
                                                                      </div>
                                                                </aside>
                                                            </td>';
                                                            $checkCol2 = 1;
                                                            break;
                                                        case '3':
                                                            $col3 = '<td width="27.5%" style="text-align: right; border-bottom: 1px dashed #3b3b3b;">
                                                                <aside class="widget widget_skills">
                                                                      <div class="widget_inner style_3">
                                                                            <div class="skills_row odd first">
                                                                                <span class="caption" width="20%">'.$data['trans']->getTranslate($subValueSum['translate']).'</span>
                                                                                <span class="progressbar">
                                                                                    <span class="progress aqua" data-process="'.$subValueSum['ranking'].'%" style="width: '.$subValueSum['ranking'].'%;"></span>
                                                                                </span>
                                                                                <span class="caption1" style="float: right;">'.$subValueSum['field'].'</span>
                                                                            </div>
                                                                      </div>
                                                                </aside>
                                                            </td>';
                                                            $checkCol3 = 1;
                                                            break;
                                                        default:
                                                            $col1 = '<td width="30%" style="text-align: right; border-bottom: 1px dashed #3b3b3b; padding-bottom: 10px;">
                                                                <aside class="widget widget_skills">
                                                                      <div class="widget_inner style_3">
                                                                            <div class="skills_row odd first">
                                                                                <span class="caption" width="20%">'.$data['trans']->getTranslate($subValueSum['translate']).'</span>
                                                                                <span class="progressbar">
                                                                                    <span class="progress aqua" data-process="'.$subValueSum['ranking'].'%" style="width: '.$subValueSum['ranking'].'%;"></span>
                                                                                </span>
                                                                                <span class="caption1" style="float: right;">'.$subValueSum['field'].'</span>
                                                                            </div>
                                                                      </div>
                                                                </aside>
                                                            </td>';
                                                            $checkCol1 = 1;
                                                            break;
                                                    }
                                                    if($checkCol1 == 0) {
                                                        $col1 = '<td width="30%" style="text-align: right; border-bottom: 1px dashed #3b3b3b; padding-bottom: 10px;">
                                                                <aside class="widget widget_skills">
                                                                      <div class="widget_inner style_3">
                                                                            <div class="skills_row odd first">
                                                                                <span class="caption" width="20%"></span>
                                                                                <span class="caption1" style="float: right;"></span>
                                                                            </div>
                                                                      </div>
                                                                </aside>
                                                            </td>';
                                                    }
                                                    if($checkCol2 == 0) {
                                                        $col2 = '<td width="27.5%" style="text-align: right; border-bottom: 1px dashed #3b3b3b;">
                                                                <aside class="widget widget_skills">
                                                                      <div class="widget_inner style_3">
                                                                            <div class="skills_row odd first">
                                                                                <span class="caption" width="20%"></span>
                                                                                <span class="caption1" style="float: right;"></span>
                                                                            </div>
                                                                      </div>
                                                                </aside>
                                                            </td>';
                                                    }
                                                    if($checkCol3 == 0) {
                                                        $col3 = '<td width="27.5%" style="text-align: right; border-bottom: 1px dashed #3b3b3b;">
                                                                <aside class="widget widget_skills">
                                                                      <div class="widget_inner style_3">
                                                                            <div class="skills_row odd first">
                                                                                <span class="caption" width="20%"></span>
                                                                                <span class="caption1" style="float: right;"></span>
                                                                            </div>
                                                                      </div>
                                                                </aside>
                                                            </td>';
                                                    }
                                                } else {
                                                    switch ($subValueSum['ord']) {
                                                        case '2':
                                                            $col2 = '<td width="27.5%" style="text-align: right;">
                                                                <aside class="widget widget_skills">
                                                                      <div class="widget_inner style_3">
                                                                            <div class="skills_row odd first">
                                                                                <span class="caption" width="20%">'.$data['trans']->getTranslate($subValueSum['translate']).'</span>
                                                                                <span class="progressbar">
                                                                                    <span class="progress aqua" data-process="'.$subValueSum['ranking'].'%" style="width: '.$subValueSum['ranking'].'%;"></span>
                                                                                </span>
                                                                                <span class="caption1" style="float: right;">'.$subValueSum['field'].'</span>
                                                                            </div>
                                                                      </div>
                                                                </aside>
                                                            </td>';
                                                            $checkCol2 = 1;
                                                            break;
                                                        case '3':
                                                            $col3 = '<td width="27.5%" style="text-align: right;">
                                                                <aside class="widget widget_skills">
                                                                      <div class="widget_inner style_3">
                                                                            <div class="skills_row odd first">
                                                                                <span class="caption" width="20%">'.$data['trans']->getTranslate($subValueSum['translate']).'</span>
                                                                                <span class="progressbar">
                                                                                    <span class="progress aqua" data-process="'.$subValueSum['ranking'].'%" style="width: '.$subValueSum['ranking'].'%;"></span>
                                                                                </span>
                                                                                <span class="caption1" style="float: right;">'.$subValueSum['field'].'</span>
                                                                            </div>
                                                                      </div>
                                                                </aside>
                                                            </td>';
                                                            $checkCol3 = 1;
                                                            break;
                                                        default:
                                                            $col1 = '<td width="30%" style="text-align: right; padding-bottom: 10px;">
                                                                <aside class="widget widget_skills">
                                                                      <div class="widget_inner style_3">
                                                                            <div class="skills_row odd first">
                                                                                <span class="caption" width="20%">'.$data['trans']->getTranslate($subValueSum['translate']).'</span>
                                                                                <span class="progressbar">
                                                                                    <span class="progress aqua" data-process="'.$subValueSum['ranking'].'%" style="width: '.$subValueSum['ranking'].'%;"></span>
                                                                                </span>
                                                                                <span class="caption1" style="float: right;">'.$subValueSum['field'].'</span>
                                                                            </div>
                                                                      </div>
                                                                </aside>
                                                            </td>';
                                                            $checkCol1 = 1;
                                                            break;
                                                    }
                                                    if($checkCol1 == 0) {
                                                        $col1 = '<td width="30%" style="text-align: right; padding-bottom: 10px;">
                                                                <aside class="widget widget_skills">
                                                                      <div class="widget_inner style_3">
                                                                            <div class="skills_row odd first">
                                                                                <span class="caption" width="20%"></span>
                                                                                <span class="caption1" style="float: right;"></span>
                                                                            </div>
                                                                      </div>
                                                                </aside>
                                                            </td>';
                                                    }
                                                    if($checkCol2 == 0) {
                                                        $col2 = '<td width="27.5%" style="text-align: right;">
                                                                <aside class="widget widget_skills">
                                                                      <div class="widget_inner style_3">
                                                                            <div class="skills_row odd first">
                                                                                <span class="caption" width="20%"></span>
                                                                                <span class="caption1" style="float: right;"></span>
                                                                            </div>
                                                                      </div>
                                                                </aside>
                                                            </td>';
                                                    }
                                                    if($checkCol3 == 0) {
                                                        $col3 = '<td width="27.5%" style="text-align: right;">
                                                                <aside class="widget widget_skills">
                                                                      <div class="widget_inner style_3">
                                                                            <div class="skills_row odd first">
                                                                                <span class="caption" width="20%"></span>
                                                                                <span class="caption1" style="float: right;"></span>
                                                                            </div>
                                                                      </div>
                                                                </aside>
                                                            </td>';
                                                    }
                                                }
                                                
                                            }
                                        }
                                        echo $col1,$col2,$col3;
                                        ?>
                                        </tr>
                                        <!-- end next row -->
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="4" style="border-top: 1px solid #3b3b3b; padding: 5px 0px;"></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>