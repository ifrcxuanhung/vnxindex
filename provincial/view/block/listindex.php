<section class="section resume_section even open" id="listindexes_section">

    <div class="section_header resume_section_header">
        <input type="text" id="search-index" name="search-index" placeholder="<?php echo $data['trans']->getTranslate(CODE_CATE . '_quick_search_indexes'); ?>" />
        <h2 class="section_title resume_section_title current">
            <a href="#">
                <span class="icon icon-align-left"></span>
                <span class="section_name"><?php echo $title; ?></span>
            </a>
            <span class="section_icon"></span>
        </h2>
    </div>
    <div class="section_body resume_section_body" style="display: block;">
        <ul id="listindexes_fliter">
            <?php
            $pages = (int) (count($data['gwc']) / 10000);
            $pages += count($data['gwc']) % 10000 > 0 ? 1 : 0;
            //if($pages > 1)
            //{
                for ($i = 1; $i <= $pages; $i++)
                {
                    if ($i == 1)
                    {
                        echo "<li index='page_{$i}'><a class='index current' href='javascript: void(0);'>{$i}</a></li>";
                    }
                    else
                    {
                        echo "<li index='page_{$i}'><a class='index' href='javascript: void(0);'>{$i}</a></li>";
                    }
                }
            //}
            ?>
        </ul>

        <?php
        $listIndexes = array();
        $countIndexes = 0;

        foreach ($data['gwc'] as $indexes)
        {
            $listIndexes[$indexes['SUB_TYPE']][] = $indexes;
        }
        unset($data['gwc']);

        $limit = 10000;
        for ($i = 1; $i <= $pages; $i++)
        {
            ?>
            <div class="list_tabs page_<?php echo $i; ?> <?php echo $i == 1 ? 'tab_first' : ''; ?> wrapper resume_wrapper">
                <div class="category resume_category first even">
                    <div class="category_header resume_category_header">
                    <div class="last-update-margin2"><?php echo $getnumberlistindexes[0]['getnumberlistindexes']; ?> <?php echo $data['trans']->getTranslate('Indexes'); ?></div>               
                        <?php echo "<div class='last-update-margin'>" . $data['trans']->getTranslate('last_update') . ": <span>{$lastUpdate[0]['date']}</span></div>"; ?>
                        <table style="width: 100%;">
                            <tr>
                                <td width="60%" style="text-align: left;">
                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('index'); ?></h3>
                                </td>
                                <td width="20%" style="text-align: right;">
                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('close'); ?></h3>
                                </td>
                                <td style="text-align: right;">
                                    <h3 class="category_title"><?php echo $data['trans']->getTranslate('_var'); ?></h3></a>
                                </td>

                            </tr>
                        </table>
                    </div>
                    <?php
                    foreach ($listIndexes as $keyIndexes => $valueIndexes)
                    {
                        if ($countIndexes == $limit)
                        {
                            $countIndexes = 0;
                            break;
                        }
                        ?>
                        <div class="category_body resume_category_body">
                            <?php
                            if (count($valueIndexes) > 0)
                            {
                                ?>
                                <div class="category_header resume_category_header">
                                    <h3 class="category_title ctitle">
                                        <span class="category_title_icon aqua"></span><?php echo $data['trans']->getTranslate($keyIndexes); ?>
                                    </h3>
                                </div>
                                <?php
                            }
                            ?>

                            <?php
                            foreach ($valueIndexes as $subKeyIndexes => $subValueIndexes)
                            {
                                
                                ?>
                                <article class="post resume_post resume_post_1 <?php echo $countIndexes == 0 ? 'first' : ''; ?> <?php echo $countIndexes % 2 == 0 ? 'even' : 'odd'; ?>">
                                    <div class="post_header resume_post_header">
                                        <table style="width: 100%;">
                                            <tr>
                                                <td width="60%">
                                                    <h4 class="post_title">
                                                        <a href="<?php echo BASE_URL ?>index/code/<?php echo $subValueIndexes['CODE']; ?>"><?php echo $subValueIndexes['SHORTNAME']; ?></a>
                                                    </h4>
                                                </td>
                                                <td width="20%" style="text-align: right;">
                                                    <h4>
                                                        <font style="color: #fff;"><?php echo $subValueIndexes['close'] == 0 ? 'n.a.' : number_format($subValueIndexes['close'], 2, '.', ','); ?></font>
                                                    </h4>

                                                </td>
                                                <td style="text-align: right;">
                                                    <h4>
                                                        <font style="color: <?php echo $subValueIndexes['dvar'] < 0 ? '#ff492a' : '#92dd4b'; ?>"><?php echo $subValueIndexes['close'] == 0 ? 'n.a.' : number_format($subValueIndexes['dvar'], 2, '.', ',') . ' %'; ?></font>
                                                    </h4>

                                                </td>

                                            </tr>
                                        </table>
                                    </div>
                                </article>
                                <?php
                                unset($listIndexes[$keyIndexes][$subKeyIndexes]);
                                $countIndexes++;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>

            </div>
            <?php
        }
        
        ?>

    </div>

</section>