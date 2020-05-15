<!-- About Section -->
<section class="page-section bg-primary text-white mb-0 mt-5">
    <div class="container">
        <!-- About Section Heading -->
        <h2 class="page-section-heading text-center text-uppercase text-white my-5">Daftar Keranjang</h2>
        <?php 
        foreach ($product as $p) : 
            $this->db->where('prod_id', $p['prod_id']);
            $produk = $this->db->get('products')->result_array();
            foreach ($produk as $q) : 
            ?>
                <div class="card mb-3 mx-5">
                    <div class="row no-gutters">
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
                            <form action="<?= base_url('beranda/editatc'); ?>" method="POST">
                                <div class="row  mt-5">
                                    <div class="col-3">
                                        <input type="text" name="id" class="form-control" placeholder="Durasi" hidden value="<?= $p['cart_id'] ?>">
                                        <input type="text" name="durasi" class="form-control" placeholder="Durasi" value="<?= $p['qty'] ?>">
                                    </div>
                                    <div class="col-4">
                                        <input class="btn btn-info btn-user btn-block center" type="submit" name="btnSubmit" value="Ubah" /> 
                                    </div>
                                    <div class="col-3">
                                        <a class="btn btn-danger h3" href="<?= base_url('beranda/hapusatc/'), $p['cart_id']; ?>">Hapus</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; 
        endforeach; ?>
        <div class="row">
            <?php
                if (!$product) { ?>
                        <div class="col-12 mt-4">
                            <center>
                                <h4>Keranjang belanja masih kosong, silahkan memilih produk</h4>
                                <a href="<?= base_url(''); ?>" class="h4 text-white mt-4">Kembali ke Beranda</a>
                            </center>
                        </div>
                <?php } else { ?>
                        <div class="col-md-4 offset-md-6 mt-4">
                            <h4>Total Belanja : Rp. <?= number_format($price,0,",",".");?>  </h4>
                        </div>
                        <div class="col-md-2 mt-3">
                            <a class="btn btn-light h2 float-right mr-5" href="<?= base_url('beranda/co'); ?>">Checkout</a>
                        </div>
                <?php }
            ?>
        </div>

    </div>
</section>