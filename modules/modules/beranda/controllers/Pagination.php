<?php defined('BASEPATH') OR exit ('No direct script access allowed');

class Pagination extends CI_Controller {

     public function __construct()
     {
          parent::__construct();
          $this->load->model('pagination_model');
     }
     public function index()
     {
     $perpage = 5;
     $offset = $this->uri->segment(1);
     $data['semua_pengguna'] = $this->pagination_model->getDataPagination($perpage, $offset)->result();

     $config['base_url'] = site_url();
     $config['total_rows'] = $this->pagination_model->getAll()->num_rows();
     $config['per_page'] = $perpage;
     $this->pagination->initialize($config);

     $this->load->view('pagination', $data);
}

}