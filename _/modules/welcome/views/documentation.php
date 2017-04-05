<?php
//echo'<pre>'; print_r($list_category);exit;
?>
<div id="main_resch">
    <!-- start list researchers  -->
    <div class="lst_resch">
        <div class="breadcrumb">
            <a href="#" class="lnk_home">Home</a>                           
            <span><?php trans('our_documentation') ?></span>
        </div>
        <h2><?php trans('our_documentation') ?></h2>
        <div class="filter_document">
            <select name="filter_doc">
                <?php
                $selected = "";
                if (@$code_cate == "")
                    $selected = "selected='selected'";
                ?>
                <option value=""><?php trans('select_all_type') ?></option>
                <?php
                foreach ($list_category as $k => $v) {
                    $selected = "";
                    if (@$code_cate == $v['category_code'])
                        $selected = "selected='selected'";
                    echo "<option $selected value='{$v['category_code']}'>{$v['name']}</option>";
                }
                ?>
            </select>
        </div>

        <table class="table-document" width="100%">
            <thead>
                <tr>
                    <th width="10%"><?php trans('date') ?></th>
                    <th width="20%"><?php trans('type') ?></th>
                    <th width="50%"><?php trans('title') ?></th>
                    <th align='center' width="10%"><?php trans('language') ?></th>
                    <th align='center' width="5%"><?php trans('file') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($list_document as $k => $document) {
                    ?>
                    <tr>
                        <td><?php echo substr($document['date_added'], 0, 10) ?></td>
                        <td><?php echo $document['catename'] ?></td>
                        <td><?php echo $document['title'] ?></td>
                        <td align='center'>
                            <?php
                            $lang_curent = $this->session->userdata('curent_language');
                            $lang_code_curent = $lang_curent['code'];
                            $article_id = $document['article_id'];
                            $sql = "SELECT lang_code,`file` FROM article_description WHERE article_id = $article_id AND `file` != ''";
                            $list_file = $this->db->query($sql)->result_array();
                            ?>
                            <ul class="lang_doc">
                            <?php
                            $a = 0;
                            foreach ($list_file as $key => $file) {
                                if($download_documents == 0)//Allow All User Download
                                {
                                    if(substr($file['file'],0,4) == 'http')
                                        $link_file = $file['file'];
                                    else
                                        $link_file = base_url() . $file['file'];
                                    $class_not_login = "";
                                    $target = "target='_blank'";
                                }
                                else
                                {
                                    if ($allow_download == 1) {
                                    
                                        if(substr($file['file'],0,4) == 'http')
                                            $link_file = $file['file'];
                                        else
                                            $link_file = base_url() . $file['file'];
                                        $class_not_login = "";
                                        $target = "target='_blank'";
                                    } else {
                                        $link_file = "javascript:void(0)";
                                        $class_not_login = " class='not_login_brochure' ";
                                        $target = "";
                                    }
                                }
                                

                                $lCode = ($file['lang_code'] == 'us') ? 'en' : $file['lang_code'];
                                echo "<li {$class_not_login} ><a lang_id='{$file['lang_code']}' {$target} href='$link_file'>$lCode</a></li>";
                                if ($a != (count($list_file) - 1))
                                    echo "<li> | </li>";
                                $a++;
                            }
                            //if($this->session->userdata('user_id') == "")
                            ?>

                            </ul>
                        </td>
                        <td>

                        <?php
                        $srcImg = $document['image'];
                        $srcImg = image_thumb($srcImg,'355','250');
                        $base_url = base_url();
                        $srcImg = str_replace($base_url,'',$srcImg);
                        if (file_exists($srcImg)) {
                            ?>
                                <a class="fancybox-show fancybox" title="" href="javascript:void(0)">
                                    <img height="35" alt="" src="<?php echo base_url() . $srcImg; ?>" class="thumbnails"/>
                                    <img class="brochure_loading" src="<?php echo base_url() . 'assets/images/loading.gif' ?>" />
                                </a>
                        <?php } ?>
                        </td>
                    </tr>
                            <?php
                        }
                        ?>

            </tbody>
        </table>
        <?php
        //function pagination($pageDisplay, $numPage, $link, $currentPage)
        $pageDisplay = 7;
        $code_cate = $code_cate != "" ? $code_cate . '/' : "";
        $link = base_url() . "our_documentation/{$code_cate}np";
        echo pagination($pageDisplay, $num_page, $link, $curent_page)
        ?>
    </div>
    <div class="clear"></div>

    <script>
        $('document').ready(function() {
            $("select[name='filter_doc']").change(function() {
                var link = $base_url + 'our_documentation/' + $(this).val();
                window.location = link;
            });

            $('.thumbnails').click(function() {
                return false;
            });
            /*
             $('.not_login_brochure').click(function(){
             alert('<?php trans('you_need_login_to_download') ?>');
             return false;
             });
             */
            $('.not_login_brochure').click(function() {
                $('.popup').show();
                $('.popup-background').show();
            });

            $('.popup-close').click(function() {
                $('.popup').hide();
                $('.popup-background').hide();
            });
            $(document).keyup(function(e) {
                if (e.keyCode == 27) {
                    $('.popup').hide();
                    $('.popup-background').hide();
                }
            });
            /*
             $('.lang_doc li a').click(function(){
             var w = $(this).parent().parent().parent().next('td').width();
             var h = $(this).parent().parent().parent().next('td').height();
             var left_img_loading = (w - 15)/2;
             var top_img_loading = (h - 15)/2;
             $(this).closest('td').next('td').find('img.brochure_loading').css({"left":left_img_loading});
             $(this).closest('td').next('td').find('img.brochure_loading').css({"top":top_img_loading});
             $(this).closest('td').next('td').find('img.brochure_loading').show();
             
             
             $(this).parent().parent().find('li').removeClass('lactive');
             $(this).parent().addClass('lactive');
             var lang_id = $(this).attr('lang_id');
             var file = $(this).attr('file');
             
             $(this).closest('td').next('td').find('a.fancybox-show').attr( 'href',file);
             setTimeout(function(){$('img.brochure_loading').fadeOut()},1000);
             //$(this).closest('td').next('td').find('img.brochure_loading').fadeOut();
             });
             */

            $(function() {
                test()
                $(window).resize(function() {
                    test()
                })//g?i hàm khi resize
                function test() {
                    var windowWidth = $(window).width();
                    var windowHeight = $(window).height();
                    var widthPopup = $('.popup').width();
                    var heightPopup = $('.popup').height();
                    var leftPopup = (windowWidth - widthPopup) / 2;
                    var topPopup = (windowHeight - heightPopup) / 3;
                    $('.popup').css({"left": leftPopup});
                    $('.popup').css({"top": topPopup});

                }
            });

        });


    </script>

</div>
<div class="popup">
    <div class="popup-header ui-dialog-titlebar ui-widget-header">
        <p><?php trans('message') ?></p>
        <span class="ui-icon ui-icon-closethick popup-close">close</span>
    </div>
    <div class="popup-content">
    <?php 
        if($download_documents == 1)
        {
            trans('you_need_login_to_download');
        }
        if($download_documents == 2)
        {
            trans('only_group_vip_and_admin_download');
        } 
    ?>
    </div>
</div>
<div class="popup-background"></div>
