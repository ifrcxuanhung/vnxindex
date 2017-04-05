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
        if (!$result)
        {
            die(mysql_error());
        }
        $data = array();
        $i = 0;
        while ($row = mysql_fetch_assoc($result))
        {
            $data[$i++] = $row;
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
    
    function connect2()
    {
        $config = new Config();
        $cnn = mysql_connect($config->server2, $config->username2, $config->password2);
        mysql_select_db($config->database2, $cnn);
        mysql_query('set names utf8');
        return $cnn;
    }

    function close2()
    {
        $cnn = $this->connect2();
        mysql_close($cnn);
    }

    public function selectQuery2($sql)
    {
        $result = mysql_query($sql, $this->connect2());
        if (!$result)
        {
            die(mysql_error());
        }
        $data = array();
        $i = 0;
        while ($row = mysql_fetch_assoc($result))
        {
            $data[$i++] = $row;
        }
        $this->close2();
        return $data;
    }

    public function excuteQuery2($sql)
    {
        $result = mysql_query($sql, $this->connect2());
        if (!$result)
        {
            echo '<script type="text/javascript">alert("Could not run query: ' . mysql_error() . '");</script>';
            exit;
        }
        else
        {
            return true;
        }
        $this->close2();
    }

}
