<?php

class User_model extends CI_Model {
    function get($where = array()) {
        if($where) {
            return $this->db->get_where("users", $where);
        } else {
            return $this->db->get("users");
        }
    }

    function set_shop($data) {
        $this->db->where("id", 1);
        $this->db->update("shop_info", $data);
    }

    function set_user($id, $data) {
        $this->db->where("id", $id);
        $this->db->update("users", $data);
    }

    function insert_user($data) {
        $this->db->insert("users", $data);
        return $this->db->insert_id();
    }

    function delete_user($id) {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }
}
