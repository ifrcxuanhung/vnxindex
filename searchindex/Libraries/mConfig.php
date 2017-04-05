<?php
class Models_mConfig extends Models {
    private $table = 'config';
    function get_config($col = ''){
        if($col == '') $col = '*';
        $data = $this->select($this->table, $col, 'id = 1');
        
        if($col == '*')
          return $data[0];          
        else
          return $data[0][$col];
    }

    function edit_config($arr){
        $this->update($this->table, $arr , 'id = 1');
    }
}
