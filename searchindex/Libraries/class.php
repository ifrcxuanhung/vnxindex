<?php

class ConnectSql {

    protected $host = DB_HOST;
    protected $user = DB_USER;
    protected $pass = DB_PASS;
    protected $database = DB_DATABASE;
    protected $conn;
    protected $result = NULL;
    public $lang;

    function __construct() {
        $this->connect();
        $this->get_dflanguages();
    }

    function __destruct() {
        $this->disconnect();
    }

    function connect() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass) or die("Can't connect to Mysql");
        mysqli_query($this->conn, "SET NAMES 'utf8'");
        mysqli_query($this->conn, "SET CHARACTER SET 'utf8'");
        mysqli_query($this->conn, "SET character_set_connection = 'utf8'");
        mysqli_set_charset($this->conn, "utf8");
        mysqli_select_db($this->conn, $this->database);
    }

    function disconnect() {
        @mysqli_close($this->conn);
    }

    function CleanResult() {
        @mysqli_free_result($this->result);
    }

    function query($sql) {
        //echo $sql;
        //echo '<br />';
        if ($this->result != NULL) {
            $this->CleanResult();
        }
        $this->result = mysqli_query($this->conn, $sql);
    }

    function insert_id() {
        return @mysqli_insert_id($this->conn);
    }

    function affected() {
        return @mysqli_affected_rows($this->conn);
    }

    function numrow() {
        return @mysqli_num_rows($this->result);
    }

    function numfield(){
        return @mysql_num_fields($this->result);
    }

    function fetch($sql) {
        //echo $sql;
        $data = null;
        $this->query($sql);
        if ($this->result != NULL) {
            while ($row = mysqli_fetch_assoc($this->result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    function fetchOne($sql) {
        //echo $sql;
        $data = null;
        $this->query($sql);
        if ($this->result != NULL) {
            while ($row = mysqli_fetch_assoc($this->result)) {
                $data[] = $row;
            }
            return $data[0];
        } else {
            return false;
        }
    }

    public function fetchobject($sql) {
        $this->query($sql);
        if ($this->result != NULL) {
            return mysqli_fetch_object($this->result);
        } else {
            return false;
        }
    }

    /* ------------------------------------------------------------------------------ */

    public function fetchallobject($sql) {
        $result = NULL;
        $this->query($sql);
        if ($this->result != NULL) {
            while ($objset = mysqli_fetch_object($this->result)) {
                $result[] = $objset;
            }
            unset($objset);
            return $result;
        } else {
            return false;
        }
    }

    function get_dflanguages() {
        $sql = "select code_lang from languages where orders = 1 order by id desc limit 0,1";
        $data = $this->fetch($sql);
        $this->lang = $data[0]['code_lang'];
    }

}

class Models extends ConnectSql {

    function __construct() {
        parent::__construct();
    }

    function select($table, $column = '*', $where = '', $orderby = '', $limit = '') {
        if (is_array($column)) {
            $column = implode(",", $column);
        }

        if ($where != '') {
            $where = "WHERE $where";
        }

        if ($limit != '') {
            $limit = "LIMIT $limit";
        }

        if ($orderby != '') {
            $orderby = "ORDER BY $orderby";
        }

        $sql = "select $column from $table $where  $orderby $limit ";
        /* echo '<br>';
          echo $sql;
          echo '<br>';
          echo '<br>'; */
        return $this->fetch($sql);
    }

    function select_sql($sql) {
        return $this->fetch($sql);
    }

//    function insert($table, $column) {
//        $columns = array_keys($column);
//        $columns2 = implode(",", $columns);
//        $value = implode("','", $column);
//        $sql = "insert into $table($columns2) values('$value')";
////       echo $sql;
//        //      echo '<br>';
//        $this->query($sql);
//    }
    function insert($table, $column) {
        $columns = array_keys($column);
        $columns2 = implode(",", $columns);
        $value = implode("','", $column);
        $sql = "insert into $table($columns2) values ('" . $value . "')";
        $sql = str_ireplace('\'NULL\'', 'NULL', $sql);
        //var_dump($sql);
        $this->query($sql);
        if ($this->insert_id()) {
            return 1;
        } else {
            var_dump($sql);
            return 0;
        }
    }

    function delete($table, $where = "") {
        $sql = "delete from $table ";
        if ($where != '')
            $sql .= "where $where";
        
        $this->query($sql);
    }

    function update($table, $column, $where) {
        $sql = "update $table set ";
        $keyend = end(array_keys($column));
        foreach ($column as $key => $value) {

            $sql .= "$key = '$value' ";
            if ($key != $keyend)
                $sql .= ", ";
        }
        $sql .= "where $where";
       /// echo '<br>';
      //  echo $sql;
        $this->query($sql);
    }

    function update_sql($sql) {
        $this->query($sql);
    }

    function total_rows($table, $where = "1 = 1") {

        $sql = "select * from $table where $where";
        //echo $sql;
        $this->query($sql);
        return $this->numrow();
    }

    function languages() {
        $data = $this->select('languages', 'id,code_lang,name,images', 'active = 1', 'orders asc');
        return $data;
    }
	
	// dem so record
	function count_record($table){
		$query = "select COUNT(*) from $table";
		return $this->fetch($query);
	}

}

?>