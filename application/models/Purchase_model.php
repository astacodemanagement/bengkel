<?php
class Purchase_model extends CI_Model {
    function post($data) {
        $this->db->insert("purchase",$data);
        return $this->db->insert_id();
    }

    function post_details($data) {
        $this->db->insert_batch("purchase_details",$data);
    }

    function update_stock($data) {
        $this->db->update_batch("products",$data,"id");
    }

    function get($id = 0) {
        $this->db->select("purchase.*,suppliers.name,suppliers.address,suppliers.telephone");
        $this->db->join("suppliers","suppliers.id = purchase.supplier_id","left");
        if($id) {
            return $this->db->get_where("purchase",["purchase.id" => $id]);
        } else {
            return $this->db->get("purchase");
        }
    }

    function get_details($id) {
        $this->db->select("purchase_details.*,products.name");
        $this->db->join("products","products.id = purchase_details.product_id","left");
        return $this->db->get_where("purchase_details",["purchase_id" => $id]);
    }

    function delete($id) {
        $this->db->trans_start(); // Start transaction
    
        // Get purchase details for the given purchase_id
        $this->db->select('product_id, qty');
        $this->db->where('purchase_id', $id);
        $purchase_details = $this->db->get('purchase_details')->result_array();
    
        // Update product stock
        foreach ($purchase_details as $detail) {
            $product_id = $detail['product_id'];
            $qty = $detail['qty'];
    
            // Reduce stock in products table
            $this->db->where('id', $product_id);
            $this->db->set('stock', 'stock - ' . $qty, FALSE);
            $this->db->update('products');
        }
    
        // Delete from purchase_details
        $this->db->where('purchase_id', $id);
        $this->db->delete('purchase_details');
    
        // Delete from purchase
        $this->db->where('id', $id);
        $this->db->delete('purchase');
    
        $this->db->trans_complete(); // Complete transaction
    
        if ($this->db->trans_status() === FALSE) {
            // Transaction failed
            return FALSE;
        } else {
            // Transaction succeeded
            return TRUE;
        }
    }
    
    
}