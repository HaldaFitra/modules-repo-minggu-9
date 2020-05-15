<?php

class mBeranda extends CI_Model{

    public function getAllKategori()
    {   
        return $this->db->get('category')->result_array();
    }

    public function getProduct($id)
    {   
        $this->db->where('cat_id', $id);
        return $this->db->get('products')->result_array();
    }

    public function getAllProduct()
    {   
        return $this->db->get('products')->result_array();
    }

    public function getDetail($id)
    {   
        $this->db->where('prod_id', $id);
        return $this->db->get('products')->result_array();
    }

    public function addTC()
    {
        $id_product = $this->input->post('id', true);
        $durasi = $this->input->post('durasi', true);
        $username = $this->session->userdata('username');

        $id_user = $this->id_user();

		$rows = $this->db->query('select * from cart where prod_id ="'.$id_product.'" and id_user = "'.$id_user.'"');
        if ($rows->num_rows() == 1) {
            $product = $rows->row();
            $qty = $product->qty + $durasi;
            $data = array(
                    'qty' => $qty
            );
            $this->db->where('prod_id', $id_product);
            $this->db->update('cart', $data);
        } else {
            $data = array(
                'prod_id' => $id_product,
                'qty' => $durasi,
                'id_user' => $id_user
            );
            
            $this->db->insert('cart', $data);  
        }

        redirect('beranda/keranjang');
    }

    public function getATC()
    {
        $id_user = $this->id_user();

        $this->db->where('id_user', $id_user);
        return $this->db->get('cart')->result_array();
    }

    public function getTotal()
    {
        $id_user = $this->id_user();
        $rows = $this->db->query('select sum(prod_price * qty) as total from products, cart where products.prod_id = cart.prod_id and cart.id_user = "'.$id_user.'"');
		$price = $rows->row();
        return $harga = $price->total;
    }

    public function id_user()
    {
        $username = $this->session->userdata('username');
		$row = $this->db->query('select id_user from users where username ="'.$username.'"');
		$user = $row->row();
        return $id_user = $user->id_user;
        
    }

    public function co()
    {
        $id_user = $this->id_user();

		$row = $this->db->query('select max(order_num) as order_num from orders');
		$order_num = $row->row();
        $nomor = $order_num->order_num;
        $no_order = 1;
        if($nomor == 0){
            $no_orderf= $no_order;
        } else {
            $no_orderf= $nomor+1;
        }

        $query = $this->db->query('select * from cart where id_user = "'.$id_user.'"')->result_array();
        
        $data = array(
            'order_num' => $no_orderf, 
            'cust_id' => $id_user
        );

        $this->db->insert('orders', $data);

        foreach ($query as $q ) {
            $prod_id = $q['prod_id'];
            $data_d = array(
                'order_num' => $no_orderf,
                'prod_id' => $prod_id,
                'quantity' => $q['qty']
            );
            $this->db->insert('orderitems', $data_d);
        }
        $total_bayar = $this->getTotal(); 
        $this->db->where('id_user', $id_user);
        $this->db->delete('cart');
        $this->session->set_flashdata('berhasil', 'Rp. '.number_format($total_bayar,0,",",".").' ');
        redirect('beranda/berhasil');
    }

    public function getOrder()
    {
        $id_user = $this->id_user();

        $this->db->where('cust_id', $id_user);
        return $this->db->get('orders')->result_array();
    }
   
}