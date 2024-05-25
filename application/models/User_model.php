<?php

class User_model extends CI_Model {
    public function saveUser($data) {
        return $this->db->insert("users", $data);
    }
}