<?php

class Login_model extends CI_Model
{
    public function login($email, $password) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');

        if($query->num_rows() == 1) {
            $user = $query->row();
            if(password_verify($password, $user->password)) {
                return $user;
            }

            return false;
        }
    }
}
