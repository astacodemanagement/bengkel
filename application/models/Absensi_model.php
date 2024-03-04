<?php
class Absensi_model extends CI_Model {
    function post($data) {
        $this->db->insert("absensi",$data);
    }

    function get($id = 0) {
        if(!$id) {
            $this->db->order_by("name","ASC");
            return $this->db->get("absensi");
        } else {
            return $this->db->get_where("absensi",['id' => $id]);
        }
    }

    function put($id,$data) {
        $this->db->where("id",$id);
        $this->db->update("absensi",$data);
    }

    function delete($id) {
        $this->db->delete("absensi",["id" => $id]);
    }

    
}