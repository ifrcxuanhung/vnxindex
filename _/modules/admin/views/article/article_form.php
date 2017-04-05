<form name="formLanguage" class="form" id="complex_form" method="post" action="">
    <section class="grid_12">
        <div class="block-border">
            <div class="block-content">
                <h1><?php trans('mn_article'); ?></h1>
                <div class="columns">
                    <div class="block-controls">
                        <ul class="controls-buttons">
                            <li></li>
                        </ul>
                        <div style="float: right; margin-right: 20px;" class="custom-btn">
                            <button type="submit" name="ok" value="ok"><?php trans('bt_save'); ?></button>
                            <button class="red" class="" onclick="$(location).attr('href', '<?php echo admin_url() . 'article' ?>');" type="button"><?php trans('bt_back'); ?></button>
                            <div style="clear: left;"></div>
                        </div>
                    </div>
                    <?php if (isset($error) && $error != '') : ?>
                        <ul class="message warning no-margin">
                            <li>
                                <?php
                                if (is_array($error)):
                                    foreach ($error as $value):
                                        echo '<p>' . trans($value) . '</p>';
                                    endforeach;
                                else:
                                    echo trans($error);
                                endif;
                                ?>
                            </li>
                            <li class="close-bt"></li>
                        </ul>
                    <?php endif; ?>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('group'); ?></span>
                            <span class="relative">
                                <?php
                                @$group = explode(';', $input['group']);
                                ?>
                                <label style="margin:0px 5px; width:auto">
                                    <input <?php if (in_array('news', $group)) echo 'checked'; ?> type="checkbox" name="group[]" value="news" />
                                    <?php trans('news') ?>
                                </label>
                                <label style="margin:0px 5px; width:auto">
                                    <input <?php if (in_array('services_product', $group)) echo 'checked'; ?> type="checkbox" name="group[]" value="services_product" />
                                    <?php trans('services_product') ?>
                                </label>
                                <label style="margin:0px 5px; width:auto">
                                    <input <?php if (in_array('index', $group)) echo 'checked'; ?> type="checkbox" name="group[]" value="index" />
                                    <?php trans('index') ?>
                                </label>
								<label style="margin:0px 5px; width:auto">
                                    <input <?php if (in_array('publications', $group)) echo 'checked'; ?> type="checkbox" name="group[]" value="publications" />
                                    <?php trans('publications') ?>
                                </label>
                                <label style="margin:0px 5px; width:auto">
                                    <input <?php if (in_array('progress', $group)) echo 'checked'; ?> type="checkbox" name="group[]" value="progress" />
                                    <?php trans('progress') ?>
                                </label>
                                <label style="margin:0px 5px; width:auto">
                                    <input <?php if (in_array('performance', $group)) echo 'checked'; ?> type="checkbox" name="group[]" value="performance" />
                                    <?php trans('performance') ?>
                                </label>
                                <label style="margin:0px 5px; width:auto">
                                    <input <?php if (in_array('our_website', $group)) echo 'checked'; ?> type="checkbox" name="group[]" value="our_website" />
                                    <?php trans('our_website') ?>
                                </label>
                                <label style="margin:0px 5px; width:auto">
                                    <input <?php if (in_array('home', $group)) echo 'checked'; ?> type="checkbox" name="group[]" value="home" />
                                    <?php trans('home') ?>
                                </label>
                                <label style="margin:0px 5px; width:auto">
                                    <input <?php if (in_array('company', $group)) echo 'checked'; ?> type="checkbox" name="group[]" value="company" />
                                    <?php trans('company') ?>
                                </label>
                                <label style="margin:0px 5px; width:auto">
                                    <input <?php if (in_array('ifrc_research_live', $group)) echo 'checked'; ?> type="checkbox" name="group[]" value="ifrc_research_live" />
                                    <?php trans('IFRC Research Live') ?>
                                </label>
                                <label style="margin:0px 5px; width:auto">
                                    <input <?php if (in_array('documentation', $group)) echo 'checked'; ?> type="checkbox" name="group[]" value="documentation" />
                                    <?php trans('Documentation') ?>
                                </label>
                                <label style="margin:0px 5px; width:auto">
                                    <input <?php if (in_array('glossary', $group)) echo 'checked'; ?> type="checkbox" name="group[]" value="glossary" />
                                    <?php trans('Glossary') ?>
                                </label>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('category'); ?></span>
                            <span class="relative">
                                <?php
                                if (isset($input['category_id']) == FALSE) : $input['category_id'] = '';
                                endif;
                                if (isset($list_category) && is_array($list_category)):
                                    echo form_dropdown('category_id', $list_category, set_value('category_id', $input['category_id']), 'class =full-width');
                                endif;
                                ?>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('sort_order'); ?></span>
                            <span class="relative">
                                <?php
                                if (isset($input['sort_order']) == FALSE) : $input['sort_order'] = '';
                                endif;
                                echo form_input('sort_order', set_value('sort_order', $input['sort_order']));
                                ?>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('status'); ?></span>
                            <span class="relative ">
                                <?php
                                $options = array(
                                    '1' => 'Enable',
                                    '0' => 'Disable',
                                );
                                if (isset($input['status']) == FALSE) : $input['status'] = '';
                                endif;
                                echo form_dropdown('status', $options, set_value('status', $input['status']), 'class="full-width"');
                                ?>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('url'); ?></span>
                            <span class="relative">
                                <?php
                                if (isset($input['url']) == FALSE) : $input['url'] = '';
                                endif;
                                echo form_input('url', set_value('url', $input['url']), 'class="full-width"');
                                ?>
                            </span>
                        </p>
                    </div>
                    <div class="columns">
                        <p class="colx3-left inline-label">
                            <span class="label"><?php trans('image'); ?></span>
                        <div class="relative ">

                            <div class="image" style="display: block; clear: both; padding-left: 20em; ">
                                <img style="padding-bottom: 1em;" src="<?php
                                echo base_url();
                                echo (isset($input['thumb']) && $input['thumb'] != '') ? $input['thumb'] : 'assets/images/no-image.jpg';
                                ?>" alt="" id="thumb" />
                                <br />
                                <a class="pointer" onclick="image_upload('image', 'thumb');"><?php trans('browse_files'); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="pointer" onclick="$('#thumb').attr('src', '<?php echo base_url(); ?>assets/images/no-image.jpg');
                                        $('#image').attr('value', '');"><?php trans('clear_image'); ?></a></div>
                            <?php
                            echo form_input('image', set_value('image', isset($input['image']) ? $input['image'] : ''), 'id="image" style="display:none"');
                            ?>
                        </div>
                        </p>
                    </div>


                    <div class="columns">
                        <div class="tabs-content" style="height:900px">
                            <?php if (isset($list_language) && is_array($list_language)): ?>
                                <ul class="mini-tabs no-margin js-tabs same-height">
                                    <?php foreach ($list_language as $value) : ?>
                                        <li><a href="#tab-<?php echo $value['code'] ?>"><img src="<?php echo template_url() ?>images/icons/flags/<?php echo $value['code']; ?>.png" width="16" height="11" alt="<?php echo trans($value['name'], 1); ?>" title="<?php echo trans($value['name'], 1); ?>"> <?php echo trans($value['name'], 1); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php foreach ($list_language as $value) : ?>
                                    <div id="tab-<?php echo $value['code'] ?>" class="tabs-content-info">
                                        <label class="float-left margin-right width150 required"><?php trans('title'); ?></label>
                                        <input type="text" value="<?php echo isset($input['title_' . $value['code']]) ? $input['title_' . $value['code']] : set_value('title_' . $value['code']); ?>" name="title_<?php echo $value['code'] ?>" id="title-<?php echo $value['code'] ?>" class="full-width">
                                        <div class="clear height10" style="margin-bottom: 20px"></div>

                                        <label class="float-left margin-right width150"><?php trans('file'); ?></label>
                                        <input type="text" value="<?php echo isset($input['file_' . $value['code']]) ? $input['file_' . $value['code']] : set_value('file_' . $value['code']); ?>" name="file_<?php echo $value['code'] ?>" id="file-<?php echo $value['code'] ?>" class="full-width">
                                        <div class="clear height10" style="margin-bottom: 20px"></div>

                                        <label class="float-left margin-right width150"><?php trans('description'); ?></label>
                                        <div class="clear height10" style="margin-bottom: 20px"></div>
                                        <textarea name="description_<?php echo $value['code'] ?>" id="description-<?php echo $value['code'] ?>" class="full-width"><?php echo isset($input['description_' . $value['code']]) ? $input['description_' . $value['code']] : set_value('description_' . $value['code']); ?></textarea>
                                        <div class="clear height10" style="margin-bottom: 20px"></div>

                                        <label class="float-left margin-right width150"><?php trans('long_description'); ?></label>
                                        <div class="clear height10" style="margin-bottom: 20px"></div>
                                        <textarea name="long_description_<?php echo $value['code'] ?>" id="long_description_<?php echo $value['code'] ?>" class="full-width"><?php echo isset($input['long_description_' . $value['code']]) ? $input['long_description_' . $value['code']] : set_value('long_description_' . $value['code']); ?></textarea>

                                        <div class="clear height10" style="margin-bottom: 20px"></div>

                                        <label class="float-left margin-right width150"><?php trans('meta_keywords'); ?></label>
                                        <textarea rows="15" name="meta_keyword_<?php echo $value['code'] ?>" id="meta-keyword<?php echo $value['code'] ?>" class="full-width"><?php echo isset($input['meta_keyword_' . $value['code']]) ? $input['meta_keyword_' . $value['code']] : set_value('meta_keyword_' . $value['code']); ?></textarea>
                                        <div class="clear height10" style="margin-bottom: 20px"></div>

                                        <label class="float-left margin-right width150"><?php trans('meta_description'); ?></label>
                                        <textarea rows="15" name="meta_description_<?php echo $value['code'] ?>" id="meta-description<?php echo $value['code'] ?>" class="full-width"><?php echo isset($input['meta_description_' . $value['code']]) ? $input['meta_description_' . $value['code']] : set_value('meta_description_' . $value['code']); ?></textarea>
                                        <div class="clear height10" style="margin-bottom: 20px"></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bundles/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
                                    //<![CDATA[
<?php
if (isset($list_language) && is_array($list_language))
{
    foreach ($list_language as $value)
    {
        ?>
                                            CKEDITOR.replace('long_description_<?php echo $value['code'] ?>');
                                            CKEDITOR.replace('description_<?php echo $value['code'] ?>');
        <?php
    }
}
?>
                                    //]]>
</script>