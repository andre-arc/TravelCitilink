<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class KasModel extends CI_model {
    
    public function select_cabang(){
        $query = "select * from orgs where parent_id='1'";
        $result = $this->db->query($query);
        $data[0] = "Pilih Cabang";
        if($result->num_rows() > 0){
            foreach($result->result_object() as $r){
                $data[$r->id] = $r->name;
            }
        }
        return $data;
    }

}