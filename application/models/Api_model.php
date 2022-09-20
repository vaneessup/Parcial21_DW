<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function save($data){
        return $this->db->insert("datos",$data);;
    }

    public function verify_if_token_exist($token)
    {
        $this->db->select("*");
        $this->db->from("datos");
        $this->db->where("token", $token);
        $results=$this->db->get();
        return empty($results->result());
    }
    
    public function get_pass($email)
    {
        $this->db->select("u.email, u.password, u.nombre, u.apellido");
        $this->db->from("datos u");
        $this->db->where("u.email",$email);
        $result=$this->db->get();
        return $result->result();
    }

    public function change_pass($token, $password)
    {
        $data = [
            'password' => $password
        ];

        $this->db->select("u.token");
        $this->db->from("datos u");
        $this->db->where("u.token",$token);
        $result=$this->db->get();
        if(!empty($result->result())){
            $this->db->where("token", $token);
            $this->db->update("datos",$data);
            return true;
        }else{
            return false;
        }
    }
}
