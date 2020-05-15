<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('Barang');
	}
	
	public function index()
	{
		$data['judul'] = "Daftar Produk";
        $data['barang'] = $this->Barang->getAllBarang();
        $data['username'] = $this->session->userdata('username');
		$this->load->view('dashboard/template/home_header', $data);
		$this->load->view('dashboard/template/home_sidebar');
		$this->load->view('dashboard/template/home_topbar', $data);
		$this->load->view('index', $data);
		$this->load->view('dashboard/template/home_footer');
	}

	public function add()
	{
        $data['kategori'] = $this->Barang->getAllKategori();
        if(!$this->Barang->getAllKategori()){
            $this->session->set_flashdata('error', 'Kategori tidak ditemukan, silahkan tambahkan kategori terlebih dahulu');
            redirect('products');
        } else {
            $data['judul'] = "Tambah Produk";
            $data['username'] = $this->session->userdata('username');
            $this->load->view('dashboard/template/home_header', $data);
            $this->load->view('dashboard/template/home_sidebar');
            $this->load->view('dashboard/template/home_topbar', $data);
            $this->load->view('add', $data);
            $this->load->view('dashboard/template/home_footer');
        }
	}

	public function edit($id)
	{
		$data['judul'] = "Edit Produk";
        $data['kategori'] = $this->Barang->getAllKategori();
		$data['edit'] = $this->Barang->getBarang($id);
        $data['username'] = $this->session->userdata('username');
		$this->load->view('dashboard/template/home_header', $data);
		$this->load->view('dashboard/template/home_sidebar');
		$this->load->view('dashboard/template/home_topbar', $data);
		$this->load->view('edit', $data);
		$this->load->view('dashboard/template/home_footer');
	}

    public function tambah_produk()
    {
        $username = $this->session->userdata('username');

        $this->form_validation->set_rules('nama_produk', 'Nama', 'trim|required');
        $this->form_validation->set_rules('harga_produk', 'Harga', 'trim|required');
        $this->form_validation->set_rules('deskripsi_produk', 'Deskripsi', 'trim|required');
        $this->form_validation->set_rules('kategori_produk', 'Kategori', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['errors'] = null;
            $this->load->view('dashboard/template/home_header', $data);
            $this->load->view('dashboard/template/home_sidebar');
            $this->load->view('dashboard/template/home_topbar');
            $this->load->view('add', $data);
            $this->load->view('dashboard/template/home_footer');
        } else {
            $this->_tambahproduk();
        }
    
    }

    private function _tambahproduk()
    {
        $nama_produk = $this->input->post('nama_produk', true);
        $harga_produk = $this->input->post('harga_produk', true);
        $deskripsi_produk = $this->input->post('deskripsi_produk', true);
        $kategori_produk = $this->input->post('kategori_produk', true);
		$total_produk = $this->db->count_all_results('products');
		$final = $total_produk + 1;

        $config = array(
            'upload_path' => "./assets/img/produk/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'file_name' => $final . ".jpeg"
        );


        $this->load->library('upload', $config);
        $this->upload->initialize($config);
		$this->upload->do_upload('upload_image');

        $data['errors'] = $this->upload->display_errors('<p>', '</p>');
        $data['result'] = print_r($this->upload->data(), true);
        $data['files']  = print_r($_FILES, true);
        $data['post']   = print_r($_POST, true);
        if ($data['errors'] = $this->upload->display_errors('<p>', '</p>')) {
            $this->session->set_flashdata('error', $this->upload->display_errors('<p>', '</p>'));
            redirect('products');
        } else {
            $dataa = array(
				'prod_id' => $final,
				'vend_id' => $final,
                'prod_name' => $nama_produk,
                'prod_price' => $harga_produk,
                'prod_desc' => $deskripsi_produk,
                'prod_image' => $config['file_name'],
                'cat_id' => $kategori_produk
            );

            $this->db->insert('products', $dataa);

            $ip_address = $_SERVER['REMOTE_ADDR'];
            $username = $this->session->userdata('username');
            $keterangan = "Menambahkan produk $nama_produk";
            $data = array(
                'username' => $username,
                'ip' => $ip_address,
                'keterangan' => $keterangan
            );
            $this->db->insert('log', $data);  

            redirect('products');
        }
    }
	
    public function edit_produk()
    {
        $username = $this->session->userdata('username');

        if ($username == '') {
            redirect('login');
        } else {
            $this->form_validation->set_rules('nama_produk', 'Nama', 'trim|required');
            $this->form_validation->set_rules('harga_produk', 'Harga', 'trim|required');
            $this->form_validation->set_rules('deskripsi_produk', 'Deskripsi', 'trim|required');
            $this->form_validation->set_rules('kategori_produk', 'Kategori', 'trim|required');

            if ($this->form_validation->run() == false) {
				$data['errors'] = null;
				$this->index();
            } else {
                $this->_editproduk();
            }
        }
    }

    private function _editproduk()
    {
        $nama_produk = $this->input->post('nama_produk', true);
        $harga_produk = $this->input->post('harga_produk', true);
        $deskripsi_produk = $this->input->post('deskripsi_produk', true);
        $kategori_produk = $this->input->post('kategori_produk', true);
        $prod_id = $this->input->post('prod_id', true);
        $total_produk = $this->db->count_all_results('products');
        $final = $total_produk + 1;
        $image = $this->input->post('upload_image', true);

        $config = array(
            'upload_path' => "./assets/img/produk/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'file_name' => $final . ".jpeg"
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $image = $this->upload->do_upload('upload_image');

        if ($image != null){
            
            $data['errors'] = $this->upload->display_errors('<p>', '</p>');
            $data['result'] = print_r($this->upload->data(), true);
            $data['files']  = print_r($_FILES, true);
            $data['post']   = print_r($_POST, true);
            if ($data['errors'] = $this->upload->display_errors('<p>', '</p>')) {
                $data['username'] = $this->session->userdata('username');
                $this->load->view('dashboard/template/home_header', $data);
                $this->load->view('dashboard/template/home_sidebar');
                $this->load->view('dashboard/template/home_topbar');
                $this->load->view('add', $data);
                $this->load->view('dashboard/template/home_footer');
            } else {
                $data = array(
                    'prod_id' => $final,
                    'vend_id' => $final,
                    'prod_name' => $nama_produk,
                    'prod_price' => $harga_produk,
                    'prod_desc' => $deskripsi_produk,
                    'prod_image' => $config['file_name'],
                    'cat_id' => $kategori_produk
                );

                $this->db->where('prod_id', $prod_id);
                $this->db->update('products', $data);
            }
        } else {
            $data = array(
                'prod_id' => $final,
                'vend_id' => $final,
                'prod_name' => $nama_produk,
                'prod_price' => $harga_produk,
                'prod_desc' => $deskripsi_produk,
                'cat_id' => $kategori_produk
            );

            $this->db->where('prod_id', $prod_id);
            $this->db->update('products', $data);
        }

        $ip_address = $_SERVER['REMOTE_ADDR'];
        $username = $this->session->userdata('username');
        $keterangan = "Mengubah produk $nama_produk";
        $data = array(
            'username' => $username,
            'ip' => $ip_address,
            'keterangan' => $keterangan
        );
        $this->db->insert('log', $data);  

        redirect('products');

    }

    public function delete($id)
    {
        $this->db->where('prod_id', $id);
        $image = $this->db->get('products')->result_array();

        foreach ($image as $p) :
        $nama = $p['prod_name'];
        $gambar = $p['prod_image'];
        $path = "./assets/img/produk/$gambar";
        unlink($path); 
        endforeach;

        $ip_address = $_SERVER['REMOTE_ADDR'];
        $username = $this->session->userdata('username');
        $keterangan = "Menghapus produk $nama";
        $data = array(
            'username' => $username,
            'ip' => $ip_address,
            'keterangan' => $keterangan
        );
        $this->db->insert('log', $data);    

        $this->db->where('prod_id', $id);
        $this->db->delete('products');
        redirect('products');
    }
}
