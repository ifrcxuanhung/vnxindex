<?php
Class db
{
	public $server      = "local";
    public $username    = "local";
    public $password    = "ifrcvn";
    public $database    = "vnxindex_data";
	
	
	function connect() {
        $cnn = mysql_connect($this->server, $this->username, $this->password);
        mysql_select_db($this->database, $cnn);
        return $cnn;
    }

    function close() {
        $cnn = $this->connect();
        mysql_close($cnn);
    }

    public function selectQuery($sql) {
        $result = mysql_query($sql, $this->connect());

        if(@mysql_num_rows($result) != 0)
        {
            $data = array();
            $i = 0;
            while ($row = mysql_fetch_assoc($result)) {
                $data[$i++] = $row;
            }
            $this->close();
            return $data;
        }
        else
            return mysql_error();
    }

    public function excuteQuery($sql) {
        $result = mysql_query($sql, $this->connect());
        if (!$result) {
            echo '<script type="text/javascript">alert("Could not run query: ' . mysql_error() . '");</script>';
            exit;
        } else {
            return true;
        }
        $this->close();
    }
}


define('HOST','http://'.$_SERVER['HTTP_HOST']);
define('BASE_URL',HOST.dirname($_SERVER['PHP_SELF']).'/');


