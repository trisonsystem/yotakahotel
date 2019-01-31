<?php

class DepartmentModel extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

    public function infoDepartment(){
    $sql = 'SELECT * FROM DEP';

    $query = $this->db->query($sql);
    $row = $query->result_array();

    return $row;
    }

}