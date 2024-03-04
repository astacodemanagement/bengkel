<?php

class User_model extends CI_Model
{
    function get($where = array())
    {
        if ($where) {
            return $this->db->get_where("users", $where);
        } else {
            return $this->db->get("users");
        }
    }

    function set_shop($data)
    {
        $this->db->where("id", 1);
        $this->db->update("shop_info", $data);
    }

    function set_user($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("users", $data);
    }

    function insert_user($data)
    {
        $this->db->insert("users", $data);
        return $this->db->insert_id();
    }

    function delete_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }

    public function searchUser($term)
    {
        $this->db->select('id, name, telephone');
        $this->db->like('telephone', $term); // Ganti 'name' dengan bidang yang ingin Anda gunakan
        $this->db->or_like('name', $term); // Ganti 'name' dengan bidang yang ingin Anda gunakan
        $result = $this->db->get('users')->result_array();
        return $result;
    }

    public function getFilteredData($start_date, $end_date, $user_id)
    {
        $this->db->select('transactions.*, mechanic_details.user_id'); // Sesuaikan dengan bidang yang Anda butuhkan
        $this->db->from('transactions');
        $this->db->join('mechanic_details', 'mechanic_details.transaction_id = transactions.id');
        
        // Tambahkan kondisi WHERE sesuai dengan kebutuhan filter
        $this->db->where('transactions.date >=', $start_date);
        $this->db->where('transactions.date <=', $end_date);
        $this->db->where('mechanic_details.user_id', $user_id);
    
        $result = $this->db->get()->result_array();
        return $result;
    }
    
}
