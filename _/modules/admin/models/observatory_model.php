<?php

class Observatory_Model extends CI_Model {

    public $table = 'idx_sample';
    public $vndb_economics_ref = "vndb_economics_ref";
    public $vndb_economics_data = "vndb_economics_data";
    /* group table currency */
    public $idx_currency_day = "vndb_currency_day";
    public $idx_currency_month = "vndb_currency_month";
    public $idx_currency_year = "vndb_currency_year";

    public function __construct() {
        parent::__construct();
    }

    /*     * ************************************************************** */
    /*    Name ： upload_sample                                                */
    /* --------------------------------------------------------------- */
    /*    Description  ： add new data sample in database                 */
    /* --------------------------------------------------------------- */
    /*    Params  ：  			                                       */
    /* --------------------------------------------------------------- */
    /*    Return  ：   count data success or false if file not exist  */
    /* --------------------------------------------------------------- */
    /*    Warning ：                                                     */
    /* --------------------------------------------------------------- */
    /*    Copyright : IFRC                                         */
    /* --------------------------------------------------------------- */
    /*    M001 : New  2012.08.14 (LongNguyen)                             */
    /*     * ************************************************************** */

    public function upload_sample() {
        if (is_file(APPPATH . '../../assets/upload/files/sample/sample.csv')) {
            $file = fopen(APPPATH . '../../assets/upload/files/sample/sample.csv', 'r');
            $this->db->truncate($this->table);
            $i = 0;
            $count = 0;
            while ($info = fgetcsv($file)) {
                if (++$i == 1) {
                    $headers = $info;
                } else {
                    foreach ($headers as $key => $item) {
                        $data[$item] = $info[$key];
                    }
                    if ($this->db->insert($this->table, $data)) {
                        $count++;
                    }
                }
            }
            return $count;
        } else {
            return FALSE;
        }
    }

    public function import_economics() {
        $data_name = array(
            $this->vndb_economics_ref => array('column' => 'code,name,description'),
            $this->vndb_economics_data => array('column' => 'name,code_ctr,indcode,year,value,last_upd')
        );
        if (is_array($data_name)) {
            foreach ($data_name as $name => $column) {
                $this->db->query("TRUNCATE TABLE " . $name);
                $path = '\\\LOCAL\IFRCVN\WORKS\VNFDB\DATA\\' . $name . '.txt';
                $base_url = str_replace('\\', '\\\\', $path);
                $this->db->query("LOAD DATA LOCAL INFILE '" . $base_url . "' INTO TABLE " . $name . " FIELDS TERMINATED BY '\t' IGNORE 1 LINES (" . $column['column'] . ")");
            }
        }
    }

    /*     * ***********************************************************************************************************
     * Name         ： import_currency_day
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M003         ： New  2013.07.16 (Nguyen Tuan Anh) Update 2013.08.21 (Vu Khai)
     * *************************************************************************************************************** */

    public function import_currency_day() {

        $sql = "DROP TABLE IF EXISTS `vndb_currency_day_temp`";
        $this->db->simple_query($sql);

        $sql = "CREATE TABLE `vndb_currency_day_temp` LIKE {$this->idx_currency_day}";
        $this->db->simple_query($sql);

        /* path file currency text */
        $path = "\\\LOCAL\IFRCVN\WORKS\VNFDB\DATA\\vndb_currency_day.txt";

        /* config path file on mysql */
        $base_url = str_replace("\\", "\\\\", $path);

        /* import idx_currency_day */
        $sql = "LOAD DATA LOCAL INFILE '{$base_url}'
                INTO TABLE `vndb_currency_day_temp`
                FIELDS TERMINATED BY '\t' LINES TERMINATED BY '\r\n' IGNORE 1 LINES (code, date, close)
                SET yyyymmdd = DATE_FORMAT(date, '%Y%m%d')";
        $this->db->query($sql);
        
        $sql = "INSERT INTO {$this->idx_currency_day} (code, yyyymmdd, date, close) 
                SELECT `code`, `yyyymmdd`, `date`, `close` FROM `vndb_currency_day_temp` as vndb_temp
                WHERE NOT EXISTS (SELECT 1 FROM `vndb_currency_day` WHERE vndb_currency_day.code = vndb_temp.code AND vndb_temp.`yyyymmdd` = vndb_currency_day.`yyyymmdd`)
                ORDER BY `code`, `date`;";
        $this->db->query($sql);

//        /* path file currency text */
//        $path = "\\\LOCAL\IFRCVN\WORKS\VNFDB\DATA\\vndb_currency_day.txt";
//        /* config path file on mysql */
//        $base_url = str_replace("\\", "\\\\", $path);
//
//        /* import idx_currency_day */
//        $sql = "LOAD DATA LOCAL INFILE '{$base_url}'
//                INTO TABLE {$this->idx_currency_day}
//                FIELDS TERMINATED BY '\t' LINES TERMINATED BY '\r\n' IGNORE 1 LINES (code, date, close)
//                SET yyyymmdd = DATE_FORMAT(date, '%Y%m%d')";
//        $this->db->query($sql);
//
//        $sql = "DROP TABLE IF EXISTS `vndb_currency_day_temp`";
//        $this->db->simple_query($sql);
//
//        $sql = "CREATE TABLE `vndb_currency_day_temp` LIKE {$this->idx_currency_day}";
//        $this->db->simple_query($sql);
//
//        $sql = "INSERT INTO `vndb_currency_day_temp` (code, yyyymmdd, date, close)
//                SELECT `code`, `yyyymmdd`, `date`, `close` FROM {$this->idx_currency_day} GROUP BY `code`, `date`";
//        $this->db->query($sql);
//
//        $sql = "TRUNCATE TABLE {$this->idx_currency_day}";
//        $this->db->simple_query($sql);
//
//        $sql = "INSERT INTO {$this->idx_currency_day} (code, yyyymmdd, date, close)
//                SELECT `code`, `yyyymmdd`, `date`, `close` FROM `vndb_currency_day_temp`";
//        $this->db->query($sql);
    }

    /*     * ***********************************************************************************************************
     * Name         ： import_currency_month
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M004         ： New  2013.07.16 (Nguyen Tuan Anh)
     * *************************************************************************************************************** */

    public function import_currency_month() {
        /* empty idx_currency_month */
        $sql = "TRUNCATE TABLE {$this->idx_currency_month};";
        $this->db->simple_query($sql);

        /* import idx_currency_month */
        $sql = "INSERT INTO {$this->idx_currency_month} (code, yyyymm, date, close)
                SELECT code, DATE_FORMAT(date, '%Y%m') AS yyyymm, MAX(date) AS max_date, close
                FROM {$this->idx_currency_day}
                GROUP BY YEAR(date), MONTH(date), code
                ORDER BY code, date;";
        $this->db->query($sql);
    }

    /*     * ***********************************************************************************************************
     * Name         ： import_currency_year
     * -----------------------------------------------------------------------------------------------------------------
     * Description  ：
     * -----------------------------------------------------------------------------------------------------------------
     * Params       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Return       ：
     * -----------------------------------------------------------------------------------------------------------------
     * Warning      ：
     * -----------------------------------------------------------------------------------------------------------------
     * Copyright    ： IFRC
     * -----------------------------------------------------------------------------------------------------------------
     * M005         ： New  2013.07.16 (Nguyen Tuan Anh)
     * *************************************************************************************************************** */

    public function import_currency_year() {
        /* empty idx_currency_year */
        $sql = "TRUNCATE TABLE {$this->idx_currency_year};";
        $this->db->simple_query($sql);

        /* import idx_currency_year */
        $sql = "INSERT INTO {$this->idx_currency_year} (code, yyyy, date, close)
                SELECT code, DATE_FORMAT(date,'%Y') AS yyyy, MAX(date) AS max_date, close
                FROM {$this->idx_currency_day}
                GROUP BY YEAR(date), code
                ORDER BY code, date;";
        $this->db->query($sql);
    }

}