<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* * ****************************************************************** */
/*     Client  Name  :  IFRC                                      */
/*     Project Name  :  cms v3.0                                     */
/*     Program Name  :  article.php                                      */
/*     Entry Server  :                                               */
/*     Called By     :  System                                       */
/*     Notice        :  File Code is utf-8                           */
/*     Copyright     :  IFRC                                         */
/* ------------------------------------------------------------------- */
/*     Comment       :  controller article                             */
/* ------------------------------------------------------------------- */
/*     History       :                                               */
/* ------------------------------------------------------------------- */
/*     Version V001  :  2012.08.14 (LongNguyen)        New Create      */
/* * ****************************************************************** */

class Article extends Admin {

    protected $data;

    function __construct()
    {
        parent::__construct();
        // load model category

        $this->load->model('Category_model', 'category');
        $this->load->model('Article_model', 'article');
        $this->load->helper(array('my_array_helper', 'form'));
    }

    /*     * ************************************************************** */
    /*    Name ： index                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ：  this function will be called automatically  */
    /*                   when the controller is called               */
    /* --------------------------------------------------------------- */
    /*    Params  ：  None                                             */
    /* --------------------------------------------------------------- */
    /*    Return  ：                                                 */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                  */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (LongNguyen)                            */
    /*     * ************************************************************** */

    function index()
    {
        $list_category = $this->category->list_category_fix();
        // data for dropdown list category
        $categories = array();
        if (isset($list_category) && is_array($list_category))
        {
            foreach ($list_category as $value)
            {
                $categories[$value->category_id] = $value->name;
            }
        }
        $this->data->title = 'List articles';
        $this->data->list_category = $categories;
        $this->template->write_view('content', 'article/article_list', $this->data);
        $this->template->write('title', 'Articles ');
        $this->template->render();
    }

    /*     * ************************************************************** */
    /*    Name ： listdata                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ：  data table ajax  */
    /* --------------------------------------------------------------- */
    /*    Params  ：  None                                             */
    /* --------------------------------------------------------------- */
    /*    Return  ：                                                 */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                  */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (LongNguyen)                            */
    /*     * ************************************************************** */

    function listData($id)
    {
        if ($this->input->is_ajax_request())
        {
            $data = array();
            if ($id == 0)
            {
                $id = '';
            }
            //declare lang default
            $lang_code_default = $this->session->userdata('default_language');
            if ($id != 0)
            {
                $list_article = $this->article->getAllArticleByCate($id);
                //get default article by cate
                $list_article_default = $this->article->getAllArticleByCate($id, $lang_code_default);
            }
            else
            {
                $list_article = $this->article->list_article();
                //get default article by cate
                $list_article_default = $this->article->list_article($id = '', $lang_code_default);
            }
            //replace all value null with languae default
            $list_article = replaceValueNull($list_article, $list_article_default);

            //set list_article = $list_article to show on view list
            $this->data->list_article = $list_article;
            if (isset($this->data->list_article) == TRUE && $this->data->list_article != '' && is_array($this->data->list_article) == TRUE)
            {
                foreach ($this->data->list_article as $key => $value)
                {
                    $value['thumb'] = $this->_thumb($value['image']);
                    $data[$key] = $value;
                }
            }
            $this->data->list_article = $data;
            unset($data);
            if ((isset($this->data->list_article) == TRUE) && ($this->data->list_article != '') && (is_array($this->data->list_article) == TRUE))
            {
                $aaData = array();
                foreach ($this->data->list_article as $key => $value)
                {
                    $group = isset($value['group']) ? explode(';', $value['group']) : array();
                    $checkNW = "";
                    $checkSP = "";
                    $checkIndex = "";
					$publications = "";
                    $progress = "";
                    $performance = "";
                    $our_website = "";
                    $home = "";
                    $company = "";
                    $ifrc_research_live = "";
                    $documentation = "";
                    $glossary = "";
                    foreach ($group as $k => $v)
                    {
                        if ($v == 'news')
                            $checkNW = "checked";
                        if ($v == 'services_product')
                            $checkSP = "checked";
                        if ($v == 'index')
                            $checkIndex = "checked";
						if ($v == 'publications')
                            $publications = "checked";
                        if ($v == 'progress')
                            $progress = "checked";
                        if ($v == 'performance')
                            $performance = "checked";
                        if ($v == 'our_website')
                            $our_website = "checked";
                        if ($v == 'home')
                            $home = "checked";
                        if ($v == 'company')
                            $company = "checked";
                        if ($v == 'ifrc_research_live')
                            $ifrc_research_live = "checked";
                        if ($v == 'documentation')
                            $documentation = "checked";
                        if ($v == 'glossary')
                            $glossary = "checked";
                    }

                    $aaData[$key][] = $value['title'];
                    $aaData[$key][] = $value['name'];
                    $aaData[$key][] = "<ul>"
                            . "<li style='float:left'>"
                            . "<label style='padding-right:5px'><input class='changeGroup' type='checkbox' {$checkNW}  article_id={$value['article_id']} name='group_nw_{$value['article_id']}' value='news' /> NW</label>"
                            . "</li>"
                            . "<li style='float:left'>"
                            . "<label style='padding-right:5px'><input class='changeGroup' type='checkbox' {$checkSP}  article_id={$value['article_id']} name='group_sp_{$value['article_id']}' value='services_product' /> SP</label>"
                            . "</li>"
                            . "<li style='float:left'>"
                            . "<label style='padding-right:5px'><input class='changeGroup' type='checkbox' {$checkIndex}  article_id={$value['article_id']} name='group_index_{$value['article_id']}' value='index' /> Index</label>"
                            . "</li>"
							. "<li style='float:left'>"
                            . "<label style='padding-right:5px'><input class='changeGroup' type='checkbox' {$publications}  article_id={$value['article_id']} name='group_publications_{$value['article_id']}' value='publications' /> Publications</label>"
                            . "</li>"
                            . "<li style='float:left'>"
                            . "<label style='padding-right:5px'><input class='changeGroup' type='checkbox' {$progress}  article_id={$value['article_id']} name='group_progress_{$value['article_id']}' value='progress' /> Progress</label>"
                            . "</li>"
                            . "<li style='float:left'>"
                            . "<label style='padding-right:5px'><input class='changeGroup' type='checkbox' {$performance}  article_id={$value['article_id']} name='group_performance_{$value['article_id']}' value='performance' /> Performance</label>"
                            . "</li>"
                            . "<li style='float:left'>"
                            . "<label style='padding-right:5px'><input class='changeGroup' type='checkbox' {$our_website}  article_id={$value['article_id']} name='group_our_website_{$value['article_id']}' value='our_website' /> Our_website</label>"
                            . "</li>"
                            . "<li style='float:left'>"
                            . "<label style='padding-right:5px'><input class='changeGroup' type='checkbox' {$home}  article_id={$value['article_id']} name='group_home_{$value['article_id']}' value='home' /> Home</label>"
                            . "</li>"
                            . "<li style='float:left'>"
                            . "<label style='padding-right:5px'><input class='changeGroup' type='checkbox' {$company}  article_id={$value['article_id']} name='group_company_{$value['article_id']}' value='company' /> Company</label>"
                            . "</li>"
                            . "<li style='float:left'>"
                            . "<label style='padding-right:5px'><input class='changeGroup' type='checkbox' {$ifrc_research_live}  article_id={$value['article_id']} name='group_ifrc_research_live_{$value['article_id']}' value='ifrc_research_live' /> IFRC Research Live</label>"
                            . "</li>"
                            . "<li style='float:left'>"
                            . "<label style='padding-right:5px'><input class='changeGroup' type='checkbox' {$documentation}  article_id={$value['article_id']} name='group_documentation_{$value['article_id']}' value='documentation' /> Documentation</label>"
                            . "</li>"
                            . "<li style='float:left'>"
                            . "<label style='padding-right:5px'><input class='changeGroup' type='checkbox' {$glossary}  article_id={$value['article_id']} name='group_glossary_{$value['article_id']}' value='glossary' /> Glossary</label>"
                            . "</li>"
                            . "</ul>";
                    //$aaData[$key][] = "<fieldset id='groupArray'><input type='checkbox' {$checkNW} name='group[]' value='news' /> NW <input type='checkbox' {$checkSP} name='group[]' value='services_product' /> SP</fieldset>";
                    $aaData[$key][] = $value['sort_order'];
                    if ($value['status'] == '1')
                    {
                        $aaData[$key][] = '<a style="color: green;" class="article-active" article_id="' . $value['article_id'] . '" href="javascript: void(0);">Enable</a>';
                    }
                    else
                    {
                        $aaData[$key][] = '<a style="color: red;" class="article-active" article_id="' . $value['article_id'] . '" href="javascript: void(0);">Disable</a>';
                    }
                    $aaData[$key][] = '<a class="fancybox" style="display: block;width: 35px" href="' . (isset($value['image']) ? base_url() . $value['image'] : base_url() . 'assets/images/no-image.jpg') . '" title="' . $value['name'] . '">
                                        <img class="thumbnails " src="' . (isset($value['thumb']) ? base_url() . $value['thumb'] : base_url() . 'assets/images/no-image.jpg') . '" alt="" /></a>';
                    $aaData[$key][] = '<ul class="keywords" style="text-align: center;"><li class="green-keyword"><a title="" class="with-tip" href="' . admin_url() . 'article/edit/' . $value['article_id'] . '">' . trans('bt_edit', 1) . '</a></li>
                                   <li class="red_fx_keyword"><a title="" class="with-tip action-delete ' . ($value['article_id'] == 0 ? 'is_admin' : '') . '" article_id="' . $value['article_id'] . '" href="#">' . trans('bt_delete', 1) . '</a></li>
                                   <li class="keywords"><a title="" class="with-tip action-copy ' . ($value['article_id'] == 0 ? 'is_admin' : '') . '" article_id="' . $value['article_id'] . '" href="#">' . trans('bt_copy', 1) . '</a></li></ul>';
                }
                $output = array(
                    "aaData" => $aaData
                );
                $this->output->set_output(json_encode($output));
            }
        }
    }

    /*     * ************************************************************** */
    /*    Name ： add                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ： add new article                             */
    /* --------------------------------------------------------------- */
    /*    Params  ：  None                                             */
    /* --------------------------------------------------------------- */
    /*    Return  ：   redirect backend/article when add article success  */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                     */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (LongNguyen)                             */
    /*     * ************************************************************** */

    function add()
    {
        //Load Helper
        $this->load->helper('form');
        $categories = NULL;
        $this->data->title = 'Articles Add new';
        // nếu người dùng muốn add hoặc edit
        if ($this->input->post('ok', TRUE))
        {
            //call function insert data
            $this->_insert();
        }
        //get all category
        $list_category = $this->category->list_category_fix(NULL, NULL, NULL, NULL, 'sort_order');
        // data for dropdown list parent category
        if ($list_category != '' && is_array($list_category))
        {
            foreach ($list_category as $value)
            {
                $categories[$value->category_id] = $value->name;
            }
        }
        // set data for list_category
        $this->data->list_category = $categories;
        // set data for list_category
        // load view and set data
        $this->template->write_view('content', 'article/article_form', $this->data);
        // set data for title
        $this->template->write('title', trans('Add', 1));
        //render template
        $this->template->render();
    }

    /*     * ************************************************************** */
    /*    Name ： edit                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ： edit 1 category                             */
    /* --------------------------------------------------------------- */
    /*    Params  ：  $id category_id                                             */
    /* --------------------------------------------------------------- */
    /*    Return  ：   redirect backend/category when edit category success  */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                     */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (LongNguyen)                             */
    /*     * ************************************************************** */

    function edit($id)
    {
        //Load Helper
        $this->load->helper('form');
        $categories = NULL;
        $this->data->title = 'Articles - Edit new';
        // nếu người dùng muốn add hoặc edit
        //get all category
        $list_category = $this->category->list_category_fix();
        // data for dropdown list parent category
        if ($list_category != '' && is_array($list_category))
        {
            foreach ($list_category as $value)
            {
                $categories[$value->category_id] = $value->name;
            }
        }
        // set data for list_category
        $this->data->list_category = $categories;
        //Load info Article
        $info = $this->article->get_one($id);
        if ($info != FALSE)
        {
            $this->data->input = $info[0];
            $this->data->input['thumb'] = $this->_thumb($this->data->input['image']);
            if (isset($info['article_description']) && is_array($info['article_description']))
            {
                foreach ($info['article_description'] as $value)
                {
                    $this->data->input['title_' . $value['lang_code']] = $value['title'];
                    $this->data->input['file_' . $value['lang_code']] = $value['file'];
                    $this->data->input['description_' . $value['lang_code']] = $value['description'];
                    $this->data->input['long_description_' . $value['lang_code']] = $value['long_description'];
                    $this->data->input['meta_description_' . $value['lang_code']] = $value['meta_description'];
                    $this->data->input['meta_keyword_' . $value['lang_code']] = $value['meta_keyword'];
                }
            }
        }
        if ($this->input->post('ok', TRUE))
        {
            //call function insert data
            $this->_insert($id);
        }
        // load view and set data
        $this->template->write_view('content', 'article/article_form', $this->data);
        // set data for title
        $this->template->write('title', trans('Edit', 1));
        //render template
        $this->template->render();
    }

    /**     * ************************************************************* */
    /*    Name ： delete                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ： delete 1 category   call by ajax               */
    /* --------------------------------------------------------------- */
    /*    Params  ：  $_POST id                                             */
    /* --------------------------------------------------------------- */
    /*    Return  ：   return 0 when delete false return 1 when delete success  */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                     */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (LongNguyen)                             */
    /*     * ************************************************************** */

    function delete()
    {
        $this->output->enable_profiler(FALSE);
        if ($this->input->is_ajax_request())
        {
            $response = $this->article->delete($this->input->post('id'));
            $this->output->set_output($response);
        }
    }

    /*     * ************************************************************** */
    /*    Name ： _insert                                                 */
    /* --------------------------------------------------------------- */
    /*    Description  ：  this function will be called by method
     *                   add, edit                                   */
    /* --------------------------------------------------------------- */
    /*    Params  ：  mixed(int) $id (id of advertise)                 */
    /* --------------------------------------------------------------- */
    /*    Return  ： TRUE of FALSE                                    */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                     */
    /* --------------------------------------------------------------- */
    /*    Copyright : W3Team                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (LongNguyen)                       */
    /*     * ************************************************************** */

    private function _insert($id = null)
    {
        //Load Class Validation
        $this->load->library('form_validation');
        $arrArticle = array();

        //$this->form_validation->set_rules('sort_order', 'Sort Order', 'required|is_natural');
        //$this->form_validation->set_rules('status', 'Status', 'required|is_natural');
        if (isset($this->data->list_language) && is_array($this->data->list_language)):
            foreach ($this->data->list_language as $language_code) :
                if ($language_code['code'] == $this->data->default_language['code']):
                    $this->form_validation->set_rules('title_' . $language_code['code'], 'Title', 'required');
                endif;
            endforeach;
        endif;

        $this->data->input['image'] = $this->input->post('image');
        $this->data->input['category_id'] = $this->input->post('category_id');
        $this->data->input['thumb'] = self::_thumb($this->data->input['image']);
        if ($this->form_validation->run())
        {
            $group = $this->input->post('group');
            $g = "";
            if ($group != null)
            {
                foreach ($group as $value)
                {
                    if ($g == "")
                        $g .= $value;
                    else
                        $g .= ';' . $value;
                }
            }

            if ($this->input->post('image') != '')
            {
                $image_url = str_replace(base_url(), '', $this->input->post('image'));
            }
            else
            {
                $image_url = 'assets/images/no-image.jpg';
            }
            $arrArticle['article'] = array(
                'category_id' => (int) $this->input->post('category_id'),
                'status' => (int) $this->input->post('status'),
                'image' => $image_url,
                'sort_order' => (int) $this->input->post('sort_order'),
                'date_added' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s'),
                'url' => $this->input->post('url'),
                'group' => $g
            );
            if (isset($this->data->list_language) && is_array($this->data->list_language)):
                foreach ($this->data->list_language as $language_code) :
                    $arrArticle['articledes'][$language_code['code']] = array(
                        'lang_code' => $language_code['code'],
                        'title' => strip_tags($this->input->post('title_' . $language_code['code'])),
                        'file' => strip_tags($this->input->post('file_' . $language_code['code'])),
                        'description' => $this->input->post('description_' . $language_code['code']),
                        'long_description' => $this->input->post('long_description_' . $language_code['code']),
                        'meta_description' => strip_tags($this->input->post('meta_description_' . $language_code['code'])),
                        'meta_keyword' => strip_tags($this->input->post('meta_keyword_' . $language_code['code']))
                    );
                endforeach;
            endif;
            //add action call here
            if ($id == NULL)
            {
                if ($this->article->add($arrArticle, $this->data->list_language))
                {
                    redirect(admin_url() . 'article');
                }
                else
                {
                    $this->data->error = 'insert error';
                }
            }
            //edit action call here
            else
            {
                if ($this->article->edit($arrArticle, $id, $this->data->list_language))
                {
                    redirect(admin_url() . 'article');
                }
                else
                {
                    $this->data->error = 'edit error';
                }
            }
        }
        else
        {
            // set error message
            $this->data->error = validation_errors();
        }
    }

    function chang_active()
    {
        $this->output->enable_profiler(FALSE);
        if ($this->input->is_ajax_request())
        {
            echo $this->article->change_active($this->input->post('id'), $this->input->post('text'));
        }
    }

    function chang_group()
    {
        $this->output->enable_profiler(FALSE);
        if ($this->input->is_ajax_request())
        {
            echo $this->article->change_group($this->input->post('id'), $this->input->post('group'));
        }
    }

    function copy()
    {
        $this->output->enable_profiler(FALSE);
        if ($this->input->is_ajax_request())
        {
            $data = $this->article->copy($this->input->post('id'));
            $this->output->set_output($data);
        }
    }

}
