<!-- About Section -->
<section class="page-section bg-primary text-white mb-0 mt-5">
    <div class="container">

    <?php foreach ($product as $p) : ?>
        <div class="row">
            <div class="col-5">
                <img src="<?= base_url('assets/img/produk/'), $p['prod_image'] ?>" class="img-thumbnail">
            </div>
            <div class="col-7">
                <h2><?= $p['prod_name'] ?></h2>
                    <div class="row mb-3">
                        <div class="col-6">
                            <h4>Rp. <?= number_format($p['prod_price'],0,",",".");?></h4>
                        </div>
                        <div class="col-2">
                            <form action="<?= base_url('beranda/atc'); ?>" method="POST">
                                <input type="text" name="id" class="form-control" placeholder="Durasi" hidden value="<?= $p['prod_id'] ?>">
                                <input type="text" name="durasi" class="form-control" placeholder="Durasi">
                        </div>
                        <div class="col-4">
                                <input class="btn btn-success btn-user btn-block center" type="submit" name="btnSubmit" value="Tambah Keranjang" /> 
                            </form>
                        </div>
                    </div>
                <p><?= $p['prod_desc'] ?></p>
            </div>
        </div>
    <?php endforeach; ?>

    </div>
</section>