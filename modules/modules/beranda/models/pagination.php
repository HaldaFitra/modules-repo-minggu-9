<?php defined('BASEPATH') OR exit ('No direct script access allowed');

class Pagination_model extends CI_Model {

     public function getAll()
     public function getDataPagination($limit, $offset)
{
     $this->db->select('*');
     $this->db->from('products');
     $this->db->order_by('prod_id', 'ASC');
     $this->db->limit($limit, $offset);

     return $this->db->get();
}
     {
          $this->db->select('*');
          $this->db->from('products');
          $this->db->order_by('id', 'ASC');

          return $this->db->get();
     }

}