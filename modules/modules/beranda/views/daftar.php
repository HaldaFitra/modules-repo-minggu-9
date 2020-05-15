<!-- About Section -->
<section class="page-section bg-primary text-white mb-0 mt-5">
    <div class="container">
        <!-- About Section Heading -->
        <h3 class="page-section-heading text-center text-uppercase text-white mb-5">Daftar Produk</h3>
        <div class="row">
            <?php foreach ($product as $p) : ?>
                <div class="col-lg-4 col-sm-2 mb-5">
                        <div class="card" style="width: 18rem;">
                            <img src="<?= base_url('assets/img/produk/'), $p['prod_image'] ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title text-dark"><?= $p['prod_name'] ?></h5>
                                <p class="card-text text-dark"><?= $p['prod_desc'] ?></p>
                                <table>
                                    <tr>
                                        <td width="50%"><h6 class="text-dark center">Rp. <?= number_format($p['prod_price'],0,",",".");?></h6></td>
                                        <td><a href="<?= base_url('beranda/product/'), $p['prod_id'] ?>" class="btn btn-primary">Lihat Produk</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>