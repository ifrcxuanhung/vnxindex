<?php

Class Article_Model {

    private $db;
    protected $_table_category = 'category';
    protected $_table_description = 'category_description';

    public function Article_Model()
    {
        $this->db = new DB();
    }

    public function getCategoryByCodeParent($code_parent)
    {
        $sql = "SELECT c.category_id, c.category_code, c.image, c.parent_id, cd.`name`, cd.description 
                FROM category c, category_description cd, (SELECT category_id FROM category WHERE category_code = '$code_parent') cp
                WHERE c.category_id = cd.category_id AND c.parent_id = cp.category_id
                AND cd.lang_code = '{$_SESSION['LANG_CURRENT']}' AND c.status = 1 
                ORDER BY sort_order";
        $sqlDF = "SELECT c.category_id, c.category_code, c.image, c.parent_id, cd.`name`, cd.description 
                FROM category c, category_description cd, (SELECT category_id FROM category WHERE category_code = '$code_parent') cp
                WHERE c.category_id = cd.category_id AND c.parent_id = cp.category_id
                AND cd.lang_code = '{$_SESSION['LANG_DEFAULT']}' AND c.status = 1 
                ORDER BY sort_order";

        $data['curent'] = $this->db->selectQuery($sql);
        $data['default'] = $this->db->selectQuery($sqlDF);
        if ($data['curent'])
        {
            $data['curent'] = replaceValueNull($data['curent'], $data['default']);
        }
        return $data;
    }

    public function list_article_cate($codeCate, $limit = null)
    {
        $data = '';
        if ($limit)
        {
            $limit = "LIMIT $limit";
        }

        $sql = "select category_id from category where category_code = '$codeCate'";
        $rows = $this->db->selectQuery($sql);

        if (!empty($rows))
        {
            $listcodeCate = $this->ds_code_cate_news($rows[0]['category_id']);
            $cate = $rows[0]['category_id'];
            foreach ($listcodeCate as $key => $value)
            {
                $cate .= "," . $value['category_id'];
            }
            $sql = 'SELECT d.article_id,d.title,d.file,d.description,d.long_description,n.date_added,n.article_id as newsid,n.category_id,n.image,n.date_added, n.url, REPLACE(n.url,"http://","") as url1,c.name as catename,
                    (SELECT category.category_code FROM category WHERE category.category_id = n.category_id LIMIT 1) category_code, d.meta_keyword
                    FROM article n, article_description d, category_description c
                    WHERE 
                        n.category_id in (' . $cate . ') 
                    AND 
                        n.article_id = d.article_id 
                    AND 
                        n.status = 1 
                    AND 
                        d.lang_code = "' . $_SESSION['LANG_CURRENT'] . '"
                    AND 
                        c.lang_code = "' . $_SESSION['LANG_CURRENT'] . '" 
                    AND 
                        c.category_id = n.category_id 
                    ORDER BY n.sort_order ASC ' . $limit;
            $sqlDF = 'SELECT d.article_id,d.title,d.file,d.description,d.long_description,n.date_added,n.article_id as newsid,n.category_id,n.image,n.date_added, n.url, REPLACE(n.url,"http://","") as url1,c.name as catename,
                    (SELECT category.category_code FROM category WHERE category.category_id = n.category_id LIMIT 1) category_code, d.meta_keyword
                    FROM article n, article_description d, category_description c
                    WHERE 
                        n.category_id in (' . $cate . ') 
                    AND 
                        n.article_id = d.article_id 
                    AND 
                        n.status = 1 
                    AND 
                        d.lang_code = "' . $_SESSION['LANG_DEFAULT'] . '"
                    AND 
                        c.lang_code = "' . $_SESSION['LANG_DEFAULT'] . '" 
                    AND 
                        c.category_id = n.category_id 
                    ORDER BY n.sort_order ASC ' . $limit;
            $data['curent'] = $this->db->selectQuery($sql);
            $data['default'] = $this->db->selectQuery($sqlDF);
            if ($data['curent'] || empty($data['curent']))
            {
                $data['curent'] = replaceValueNull($data['curent'], $data['default']);
            }
        }
        return $data;
    }

    public function ds_code_cate_news($parent_id = '', $data = NULL)
    {
        if (!$data)
            $data = array();

        // $row = $this->select('cate_news', '*', "parent_id = '$parent_id'", ' sort_order asc');
        //$this->db->where('parent_id', $parent_id);
        //$this->db->order_by('sort_order', 'ASC');
        //$row = $this->db->get($this->_table_cate)->result_array();

        $sql = "select * from category where parent_id = '$parent_id' order by sort_order ASC";
        $row = $this->db->selectQuery($sql);

        if (count($row) > 0)
            foreach ($row as $key => $value)
            {
                //print_r($value);exit;
                // $name = $this->select('cate_news_detail', 'name', "code_cate_news = '$value[code_cate_news]' and lang_code = '$this->lang['code']'");
                //$this->db->select('name');
                //$this->db->where('category_id', $value['category_id']);
                //$this->db->where('lang_code', $this->_lang['code']);
                //$name = $this->db->get($this->_table_cate_detail)->result_array();

                $sql = "select `name` from category_description where category_id = '{$value['category_id']}' and lang_code = '{$_SESSION['LANG_CURRENT']}'";
                $name = $this->db->selectQuery($sql);

                $data[] = array('category_id' => $value['category_id'], 'name' => $name[0]['name']);
                $data = $this->ds_code_cate_news($value['category_id'], $data);
            }
        return $data;
    }

    public function getArticleById($id = '')
    {
        $data = array('current' => array(), 'default' => array());
        if (is_numeric($id))
        {
            $sql = "select ad.article_id, ad.title, ad.file, ad.description, ad.long_description, a.date_added, a.article_id as newsid, a.category_id, a.image, a.date_added, ad.meta_keyword
                    from article a, article_description ad
                    where a.article_id = ad.article_id
                    and ad.lang_code = '{$_SESSION['LANG_CURRENT']}'
                    and a.article_id = '{$id}'
                    limit 1;";
            $data['current'] = $this->db->selectQuery($sql);

            $sql = "select ad.article_id, ad.title, ad.file, ad.description, ad.long_description, a.date_added, a.article_id as newsid, a.category_id, a.image, a.date_added, ad.meta_keyword
                    from article a, article_description ad
                    where a.article_id = ad.article_id
                    and ad.lang_code = '{$_SESSION['LANG_DEFAULT']}'
                    and a.article_id = '{$id}'
                    limit 1;";
            $data['default'] = $this->db->selectQuery($sql);

            if ($data['current'] || empty($data['current']))
            {
                $data['current'] = replaceValueNull($data['current'], $data['default']);
            }
        }
        return $data;
    }

    public function getListArticleHome($codeCate = '')
    {
        $sql = "select ad.article_id, temp.group, temp.sort_order
                from article_description ad, (select a.article_id, a.group, a.sort_order
                from article a, article_description ad, category c
                where a.category_id = c.category_id
                and c.category_code = '{$codeCate}'
                and a.article_id = ad.article_id
                and a.status = 1
                and ad.lang_code = '{$_SESSION['LANG_DEFAULT']}'
                and a.sort_order > 0
                group by ad.title
                order by a.date_modified) temp
                where ad.article_id = temp.article_id
                and ad.lang_code = '{$_SESSION['LANG_DEFAULT']}'
                order by temp.sort_order asc;";
        return $this->db->selectQuery($sql);
    }

    public function getArticleProfile($codeCate = '')
    {
        $sql = "select a.article_id
                from article a, category c
                where a.category_id = c.category_id
                and c.category_code = '{$codeCate}'
                and a.sort_order = 0
                limit 1;";
        $id = $this->db->selectQuery($sql);
        $data = array('current' => array(), 'default' => array());
        if (isset($id[0]['article_id']))
        {
            $article_id = $id[0]['article_id'];
            $sql = "select ad.article_id, ad.title, ad.file, ad.description, ad.long_description, a.date_added, a.article_id as newsid, a.category_id, a.image, a.date_added, ad.meta_keyword
                    from article a, article_description ad
                    where a.article_id = ad.article_id
                    and ad.lang_code = '{$_SESSION['LANG_CURRENT']}'
                    and a.article_id = '{$article_id}'
                    limit 1;";
            $data['current'] = $this->db->selectQuery($sql);

            $sql = "select ad.article_id, ad.title, ad.file, ad.description, ad.long_description, a.date_added, a.article_id as newsid, a.category_id, a.image, a.date_added, ad.meta_keyword
                    from article a, article_description ad
                    where a.article_id = ad.article_id
                    and ad.lang_code = '{$_SESSION['LANG_DEFAULT']}'
                    and a.article_id = '{$article_id}'
                    limit 1;";
            $data['default'] = $this->db->selectQuery($sql);

            if ($data['current'] || empty($data['current']))
            {
                $data['current'] = replaceValueNull($data['current'], $data['default']);
            }
        }
        return $data;
    }

    public function getDocumentsByArticleSortOrder($sort_order = '', $codeCate = '')
    {
        $output = array();
        $sql = "select ad.meta_keyword
                from article a, article_description ad, category c
                where a.sort_order = '{$sort_order}'
                and a.article_id = ad.article_id
                and a.category_id = c.category_id
                and c.category_code = '{$codeCate}'
                limit 1;";
        $query = $this->db->selectQuery($sql);
        if(isset($query[0]['meta_keyword'])) {
            $output = $this->db->selectQuery($query[0]['meta_keyword']);
        }
        return $output;
    }

}
