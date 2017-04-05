<section class="section resume_section even open" id="resume">

    <div class="section_header resume_section_header">
        <h2 class="section_title resume_section_title current">
            <a href="#">
                <span class="icon icon-align-left"></span>
                <span class="section_name"><?php echo $data['trans']->getTranslate('list_of_indexes'); ?></span>
            </a>
            <span class="section_icon"></span>
        </h2>
    </div>
    <div class="section_body resume_section_body" style="display: block;">
        <div class="list_tabs tab_first wrapper resume_wrapper">
            <div class="category_header resume_category_header">
                <?php echo "<div class='last-update'>" . $data['trans']->getTranslate('last_update') . ": <span>{$lastUpdate[0]['date']}</span></div>"; ?>
                <table style="width: 100%; margin-top: 35px;">
                    <tr>
                        <td width="60%" style="text-align: left;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('index'); ?></h3>
                        <td>
                        <td width="20%" style="text-align: right;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('close'); ?></h3>
                        </td>
                        <td style="text-align: right;">
                            <h3 class="category_title"><?php echo $data['trans']->getTranslate('_var'); ?></h3></a>
                        </td>

                    </tr>
                </table>
            </div>

            <div class="category_body resume_category_body">
                <?php
                foreach ($data['logistics'] as $key => $value)
                {
                    ?>
                    <article class="post resume_post resume_post_1 first even">
                        <div class="post_header resume_post_header">
                            <table style="width: 100%;">
                                <tr>
                                    <td width="60%">
                                        <h4 class="post_title">
                                            <a href="<?php echo BASE_URL ?>index/code/<?php echo $value['CODE']; ?>"><?php echo $value['SHORTNAME']; ?></a>
                                        </h4>
                                    </td>
                                    <td width="20%" style="text-align: right;">
                                        <div class="resume_period">
                                            <font style="color: #fff;"><?php echo $value['close'] == 0 ? "n.a." : number_format($value['close'], 2, '.', ','); ?></font>
                                        </div>

                                    </td>
                                    <td style="text-align: right;">
                                        <div class="resume_period">
                                            <font style="color: <?php echo $value['dvar'] < 0 ? "#ff492a" : "#92dd4b"; ?>"><?php echo $value['close'] == 0 ? "n.a." : number_format($value['dvar'], 2, '.', ',') . " %"; ?></font>
                                        </div>

                                    </td>

                                </tr>
                            </table>
                        </div>
                    </article>
                    <?php
                }
                ?>
            </div>

        </div>

    </div>

</section>