<?php
class Transaction_model extends CI_Model
{
    function create($data)
    {
        $this->db->insert("transactions", $data);
        return $this->db->insert_id();
    }

    function get_items($array)
    {
        $this->db->where_in("id", $array);
        return $this->db->get("products");
    }

    function post_details($data)
    {
        $this->db->insert_batch("details", $data);
    }

    function post_mechanic_details($data)
    {
        $this->db->insert_batch("mechanic_details", $data);
    }

    function sparepart_update($data)
    {
        $this->db->update_batch("products", $data, "id");
    }

    function get($id)
    {
        if ($id) {
            return $this->db->get_where("transactions", ["id" => $id]);
        } else {
            return $this->db->get("transactions");
        }
    }

    function get_details($id)
    {
        return $this->db->get_where("details", ["transaction_id" => $id]);
    }

    // Transaction_model.php

    public function getSalaryData($where = null)
    {
        $this->db->select('transactions.*, users.name as mechanic_name');
        $this->db->from('transactions');
        $this->db->join('mechanic_details', 'mechanic_details.transaction_id = transactions.id');
        $this->db->join('users', 'users.id = mechanic_details.user_id');
        $this->db->where('transactions.type', 'service'); // Sesuaikan dengan kondisi yang sesuai

        if ($where) {
            $this->db->where($where);
        }

        $query = $this->db->get();

        return $query->result();
    }

    public function getTransactionDetails($transactionId)
    {
        $this->db->select('product_id, name, price, qty');
        $this->db->from('details');
        $this->db->where('transaction_id', $transactionId);
        $query = $this->db->get();

        return $query->result();
    }

    
}
