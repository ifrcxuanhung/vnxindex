<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class synchronization_model extends CI_Model {

    public $table = "";

    function __construct() {
        parent::__construct();
    }

    function duplicateTables($source_database, $destination_database, $source_table, $destination_table) {
		//$link = mysql_connect('local', 'local', 'ifrcvn') or die(mysql_error()); // connect to database
		//$result = mysql_query('SHOW TABLES FROM ' . $source_database  .' WHERE TABLES_IN_'.$source_database.' = "'.$source_table.'"') or die(mysql_error());
		//while($row = mysql_fetch_row($result)) {
			$this->db->query('DROP TABLE IF EXISTS `' . $destination_database . '`.`' . $destination_table . '`');
			$this->db->query('CREATE TABLE `' . $destination_database . '`.`' . $destination_table . '` LIKE `' . $source_database . '`.`' . $source_table . '`');
			$this->db->query('INSERT INTO `' . $destination_database . '`.`' . $destination_table . '` SELECT * FROM `' . $source_database . '`.`' . $source_table . '`');
			$this->db->query('OPTIMIZE TABLE `' . $destination_database . '`.`' . $destination_table . '`');
		//}
		//mysql_free_result($result);
		//mysql_close($link);
	} // end duplicateTables()

}

?>