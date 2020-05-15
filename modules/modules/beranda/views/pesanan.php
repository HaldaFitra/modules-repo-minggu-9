<!-- About Section -->
<section class="page-section bg-primary text-white mb-0 mt-5">
    <div class="container">
        <!-- About Section Heading -->
        <h2 class="page-section-heading text-center text-uppercase text-white my-5">Daftar Pesanan</h2>

        <?php 
        foreach ($order as $p) : 
            $order_id = $p['order_num'];
            ?>
                <div class="card mb-3 mx-5 py-4 ">
                    <div class="row no-gutters">
                        <div class="col-md-3 ml-5 mr-4">
                            <h6 class="text-dark">Nomor Order : <?= $p['order_num'] ?></h6>
                        </div>
                        <div class="col-md-4 offset-4 ">
                            <h6 class="text-dark">Tanggal Order : <?= $p['order_date'] ?></h6> 
                        </div>
                    </div>
                    <div class="row">
                        <?php 
		                    $row = $this->db->query("select * from orders, orderitems, products where orderitems.order_num = $order_id and products.prod_id = orderitems.prod_id group by products.prod_id")->result_array();
                            foreach ($row as $q) : 
                        ?>
                        <div class="col-md-3 ml-5 mr-3">
                            <img src="<?= base_url('assets/img/produk/'), $q['prod_image'] ?>" class="card-img"  style="max-width: 300px;">
                        </div>
                        <div class="col-md-4">
                            <div class="card-body mt-3">
                                <a class="card-title text-dark h3" href="<?= base_url('beranda/product/'), $q['prod_id']; ?>"><?= $q['prod_name'] ?></a>
                                <h4 class="card-text text-dark mt-1"> Rp. <?= number_format($q['prod_price'],0,",",".");?></h4>
                            </div>
                        </div>
                        <div class="col-md-4 ml-3">
                            <div class="card-body mt-3">
                                <h6 class="card-text text-dark mt-1">Durasi peminjaman </h6>
                                <button class="btn btn-success ml-5" disabled><?= $q['quantity'];?> Hari</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
        <?php endforeach; ?>
    </div>
</section>