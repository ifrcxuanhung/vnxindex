<div id="main_resch">
    <!-- start detail researchers  -->
    <?php
        if($info_user != "")
        {
            //echo '<pre>'; print_r($info_user);
    ?>
    <div class="detail_resch">
        <div class="breadcrumb">
            <a href="#" class="lnk_home">Home</a>                           
            <a title="" href="<?php echo base_url(); ?>researchers">Researchers</a>
            <span><?php echo $info_user['first_name'] ?> <?php echo $info_user['last_name'] ?></span>
        </div>
        <h2><?php echo $info_user['first_name'] ?> <?php echo $info_user['last_name'] ?></h2>
        <a class="btn_add_research" href="javascript:void(0);">Add</a>
        <div class="left_over">
            <div class="pic_page_list"><img src="<?php echo base_url(); ?>assets/upload/files/research/<?php echo $info_user['image'] ?>" /></div>
            <p><strong><?php trans('profile') ?> : </strong><?php echo $info_user['profile'] ?></p>
            <p><strong><?php trans('experience') ?> : </strong><?php echo $info_user['experience'] ?></p>
            <p><strong><?php trans('specialities') ?> : </strong><?php echo $info_user['specialities'] ?></p>
        </div>
        <div class="right_over">
            
            <table width="100%">
                <thead>
                    <tr>
                      <th><?php trans('title') ?></th>
                      <th><?php trans('authors') ?></th>
                      <th><?php trans('journal_conference') ?></th>
                      <th><?php trans('date') ?></th>
                      <th><?php trans('file') ?></th>
                    </tr>
               </thead>
               <tbody>
               <?php
                    foreach($list_research as $key=>$value)
                    {
               ?>
                <tr>
                    <td><?php echo $value['title'] ?></td>
                    <td><?php echo $value['author'] ?></td>
                    <td><?php echo $value['journal_conference'] ?></td>
                    <td><?php echo $value['time_start'] ?></td>
                    <td align="center"><a href="http://www.vnfdb.com/assets/upload/images/pdf/2013_mhm1.pdf" class="pdf_file"></a></td>
                </tr>
                <?php
                    }
                ?>
                <!--
                <tr>
                    <td>Impact of US macroeconomic news announcements on Euronext exchanges trading</td>
                    <td>Stéphane Dubreuille and Huu Minh Mai</td>
                    <td>International Journal of Business, Vol.14, 2</td>
                    <td>2009</td>
                    <td></td>
                </tr>
                <tr>
                    <td>IPO indices: methodology and empirical results</td>
                    <td>Stéphane Dubreuille and Huu Minh Mai</td>
                    <td>IPO International Conference, Paris</td>
                    <td>2001</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Market microstructure and Market illiquidity: An Empirical Test</td>
                    <td>Huu Minh Mai, and Magali Zuanon</td>
                    <td>Conference of the Multinational Finance, Society, Italy</td>
                    <td>2001</td>
                    <td></td>
                </tr>
                <tr>
                    <td>A New Illiquidity measures – A speculative approach</td>
                    <td>Huu Minh Mai</td>
                    <td>Working paper, CEREG, Paris Dauphine University</td>
                    <td>2000</td>
                    <td><a href="http://www.vnfdb.com/assets/upload/images/pdf/2000_cahier200012.pdf" class="pdf_file"></a></td>
                </tr>
                <tr>
                    <td>Shares purchases on the French Stock Market</td>
                    <td>Huu Minh Mai</td>
                    <td>Working paper, CEREG, Paris Dauphine University</td>
                    <td>2000</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Money laundering and market impacts </td>
                    <td>Christophe Dangé and Huu Minh Mai</td>
                    <td>Working paper, CREFIGE, Paris Dauphine University</td>
                    <td>1999</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Market Anomalies on the Jamaican Stock Market </td>
                    <td>Huu Minh Mai and Marie Joseph Rigobert</td>
                    <td>Working paper, CEREG, Nr 9806, Paris Dauphine University</td>
                    <td>1998</td>
                    <td><a href="http://www.vnfdb.com/assets/upload/images/pdf/1998_previsiblejam.pdf" class="pdf_file"></a></td>
                </tr>
                <tr>
                    <td>Market Efficiency of the Jamaican Stock Market</td>
                    <td>Huu Minh Mai and Marie Joseph Rigobert</td>
                    <td>Working paper, CEREG, Nr 9805, Paris Dauphine University</td>
                    <td>1998</td>
                    <td><a href="http://www.vnfdb.com/assets/upload/images/pdf/1998_anomaliesjam.pdf" class="pdf_file"></a></td>
                </tr>
                <tr>
                    <td>Managers Earnings' Forecasts Impact on Stock Prices and Trading Volume</td>
                    <td>Huu Minh Mai and E. Tchemeni</td>
                    <td>Revue Economique, 1997, volume 48, 1</td>
                    <td>1997</td>
                    <td><a href="http://www.vnfdb.com/assets/upload/images/pdf/1997_hmm&eco.pdf" class="pdf_file"></a></td>
                </tr>
                <tr>
                    <td>Analysis of Forecast Results Published by Corporate Managers</td>
                    <td>Huu Minh Mai and E. Tchemeni</td>
                    <td>Economie et Société, 1996, volume 22,9</td>
                    <td>1996</td>
                    <td><a href="http://www.vnfdb.com/assets/upload/images/pdf/1996_hmm&dvl.pdf" class="pdf_file"></a></td>
                </tr>
                <tr>
                    <td>Analysis of Forecast Results Published by Corporate Managers</td>
                    <td>Huu Minh Mai and E. Tchemeni</td>
                    <td>Economie et Société, 1996, volume 22,9</td>
                    <td>1996</td>
                    <td><a href="http://www.vnfdb.com/assets/upload/images/pdf/1996_hmm&sev.pdf" class="pdf_file"></a></td>
                </tr>
                <tr>
                    <td>Over-reaction Strategies in the French R.M. Stock Market (1977 1990)</td>
                    <td>Huu Minh Mai</td>
                    <td>Finance, 1995, volume 16, 1</td>
                    <td>1995</td>
                    <td><a href="http://www.vnfdb.com/assets/upload/images/pdf/1995_hmm&sam.pdf" class="pdf_file"></a></td>
                </tr>
                <tr>
                    <td>Statistical Properties of Trading Volumes in the French Stock Market</td>
                    <td>Huu Minh Mai and E. Tchemeni</td>
                    <td>Working paper of CEREG, University of Paris Dauphine, Nr 9609</td>
                    <td>1995</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Event Studies by Trading Volume: Methodologies and Comparison</td>
                    <td>Huu Minh Mai and E. Tchemeni</td>
                    <td>Working paper of CEREG, University of Paris Dauphine, Nr 9610</td>
                    <td>1995</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Investments and Dividend Decreases: Market Reactions</td>
                    <td>Huu Minh Mai and J. F. Malécot</td>
                    <td>Finance, 1994, volume 15, 2</td>
                    <td>1994</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Return Distribution: Estimation Difficulties and Empirical Results</td>
                    <td>G. Essama and Huu Minh Mai</td>
                    <td>Economie Appliquée, 1994, volume 47,4</td>
                    <td>1994</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Informational Value of Managers Earnings' Forecasts (1984-1990, France)</td>
                    <td>Huu Minh Mai and E. Tchemeni</td>
                    <td>FinEco, 1994, volume 4,2</td>
                    <td>1994</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Sur-réaction sur le marché français des actions au règlement mensuel</td>
                    <td>Huu Minh Mai and E. Tchemeni</td>
                    <td>Cahier de recherche du CEREG 9309</td>
                    <td>1993</td>
                    <td><a href="http://www.vnfdb.com/assets/upload/images/pdf/1990_manager.pdf" class="pdf_file"></a></td>
                </tr>
                <tr>
                    <td>Over-reaction and the Contrarian Strategies in the French Stock Market (1977-1990)</td>
                    <td>Huu Minh Mai</td>
                    <td>published in «Le marché français des actions», Presses Universitaires de France</td>
                    <td>1992</td>
                    <td></td>
                </tr>
                <tr>
                    <td>The Treatment of Missing Data in Financial Analysis: the Case of the AFFI-SBF Database</td>
                    <td>Huu Minh Mai</td>
                    <td>published in « Recherches en Finance du CEREG », ed. Economica</td>
                    <td>1992</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Manager de l'année pour qui ?</td>
                    <td>B. Jacquillat and Huu Minh Mai</td>
                    <td>Cahier de recherche du CEREG</td>
                    <td>1990</td>
                    <td><a href="http://www.vnfdb.com/assets/upload/images/pdf/1993_hmm&sur.pdf" class="pdf_file"></a></td>
                </tr>
                -->
               </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
    <div class="clear"></div>
</div>
<div class="popup_research">
    <div class="header_popup">
        <span class="close_popup"></span>
    </div>
    <iframe src="<?php echo base_url(); ?>researchers/add" ></iframe>
</div>
