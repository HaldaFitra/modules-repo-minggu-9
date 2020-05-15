<?php

class Barang extends CI_Model{

    public function getAllBarang()
    {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('products');
        $this->db->join('category', 'products.cat_id = category.cat_id');
        $query=$this->db->get();
        return $query->result_array();
    }

    public function getBarang($id)
    {   
        $this->db->where('prod_id', $id);
        return $this->db->get('products')->result_array();
    }
    
    public function getAllKategori()
    {
        return $this->db->get('category')->result_array();
    }
}