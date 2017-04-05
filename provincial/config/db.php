<?php

Class DB {

    function connect()
    {
        $config = new Config();
        $cnn = mysql_connect($config->server, $config->username, $config->password);
        mysql_select_db($config->database, $cnn);
        mysql_query('set names utf8');
        return $cnn;
    }

    function close()
    {
        $cnn = $this->connect();
        mysql_close($cnn);
    }

    public function selectQuery($sql)
    {
        $result = mysql_query($sql, $this->connect());
        $data = array();
        $i = 0;
        if ($result)
        {
            while ($row = mysql_fetch_assoc($result))
            {
                $data[$i++] = $row;
            }
        }
        $this->close();
        return $data;
    }

    public function excuteQuery($sql)
    {
        $result = mysql_query($sql, $this->connect());
        if (!$result)
        {
            echo '<script type="text/javascript">alert("Could not run query: ' . mysql_error() . '");</script>';
            exit;
        }
        else
        {
            return true;
        }
        $this->close();
    }

}
