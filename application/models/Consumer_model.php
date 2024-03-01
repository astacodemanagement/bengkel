<?php
class Consumer_model extends CI_Model {
    function post($data) {
        $this->db->insert("consumers",$data);
    }

    function get($id = 0) {
        if(!$id) {
            $this->db->order_by("name","ASC");
            return $this->db->get("consumers");
        } else {
            return $this->db->get_where("consumers",['id' => $id]);
        }
    }

    function put($id,$data) {
        $this->db->where("id",$id);
        $this->db->update("consumers",$data);
    }

    function delete($id) {
        $this->db->delete("consumers",["id" => $id]);
    }

    public function searchConsumer($term) {
        $this->db->select('id, name, telephone');
        $this->db->like('telephone', $term); // Ganti 'name' dengan bidang yang ingin Anda gunakan
        $this->db->or_like('name', $term); // Ganti 'name' dengan bidang yang ingin Anda gunakan
        $result = $this->db->get('consumers')->result_array();
        return $result;
    }
}