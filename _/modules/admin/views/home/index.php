<section class="grid_12" style="z-index: 0;">
    <div class="block-border no-margin">
        <form class="block-content form" id="manufacturers_list_form" name="f1" method="post" action="">
            <h1><?php trans('mn_summary'); ?></h1>
            
            <ul class="tabs js-tabs mini-tabs">                    
                <li class="current"><a href="#tabs-article"><span style="vertical-align: top"><?php trans('Recent articles'); ?></span></a></li>
                <li><a href="#tabs-users"><span style="vertical-align: top"><?php trans('Users'); ?></span></a></li>
            </ul>
            <div id="tabs-users">
                <table class="table sortable no-margin" cellspacing="0" style="width:100% !important; margin-top: -20px !important;"  id="mod_user" >
                    <thead>
                        <tr>
                            <th scope="col"><?php trans('Username'); ?></th>
                            <th scope="col"><?php trans('Registed on'); ?></th>
                            <th scope="col"><?php trans('Last login'); ?></th>
                            <th scope="col" width="5%" style="text-align: center;"><?php trans('Active'); ?></th>
                            <th scope="col" width="10%" style="text-align: center;"><?php trans('Actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (is_array($users))
                            foreach ($users as $key => $value) {
                                ?>
                                <tr id="<?php echo $value['username'] ?>">
                                    <td><?= $value['username']; ?></td>
                                    <td><?php echo date('d-m-Y', $value['created_on']); ?></td>
                                    <td><?php echo date('d-m-Y', $value['last_login']); ?></td>
                                    <td style="text-align: center;">
                                        <?php
                                        echo ($value['active'] == 1) ? '<input type="checkbox" checked="checked" class="action-active-user" value="' . $value['id'] . '" action="deactivate" />' : '<input type="checkbox" class="action-active-user" value="' . $value['id'] . '" action="activate" />';
                                        ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <ul style="text-align: center;" class="keywords">
                                            <li class="green-keyword">
                                                <a class="with-tip" href="<?= admin_url() . 'users/edit/' . $value['id'] ?>"><?php trans('bt_edit'); ?></a>
                                            </li>
                                            <li class="red_fx_keyword">
                                                <a class="with-tip action-delete " user_id="<?= $value['username'] ?>" href="#"><?php trans('bt_delete'); ?></a>
                                            </li>
                                        </ul>
                                    </td> 
                                </tr>
                            <?php } ?>       
                    </tbody>
                </table>
            </div>
            <div id="tabs-article">
                <table class="table sortable no-margin" cellspacing="0" style="width:100% !important; margin-top: -20px !important;"  id="mod_news">
                    <thead>
                        <tr>
                            <th scope="col" width="250px"><?php trans('Title'); ?></th>
                            <th scope="col" width="100px"><?php trans('Category'); ?></th>
                            <th scope="col" width="10px"><?php trans('Created on'); ?></th>
                            <th scope="col" width="5px" style="text-align: center;"><?php trans('status'); ?></th>
                            <th scope="col" width="10px" style="text-align: center;"><?php trans('Actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (is_array($articles))
                            foreach ($articles as $key => $value) {
                                ?>
                                <tr id="<?= $value['article_id'] ?>">
                                    <td><?= cut_str($value['title'], 70); ?></td> 
                                    <td><?php echo $value['name']; ?></td>
                                    <td><?php echo $value['date_added']; ?></td>
                                    <td style="text-align: center;">
                                        <?php
                                        echo ($value['status'] == 1) ? '<input type="checkbox" checked="checked" class="action-active-article" value="' . $value['article_id'] . '" />' : '<input type="checkbox" class="action-active-article" value="' . $value['article_id'] . '" />';
                                        ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <ul style="text-align: center;" class="keywords">
                                            <li class="green-keyword">
                                                <a href="<?= admin_url() . 'article/edit/' . $value['article_id'] ?>" class="with-tip"><?php trans('bt_edit'); ?></a>
                                            </li>
                                            <li class="red_fx_keyword">
                                                <a title="" class="with-tip action-delete ' . ($value['article_id'] == 0 ? 'is_admin' : '') . '" article_id="' . $value['article_id'] . '" href="#"><?php trans('bt_delete'); ?></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php } ?>       
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</section>