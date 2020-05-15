<?php
header('Refresh:5; url= ' . base_url() . '/');
?>
<!-- About Section -->
<section class="page-section bg-primary text-white mb-0 mt-5 " style="min-height:514px;">
    <div class="container">
        <!-- About Section Heading -->
        <h2 class="page-section-heading text-center text-uppercase text-white my-5">Pesanan berhasil dilakukan</h2>
        <center>
            <h4>Silahkan transfer atau bayar saat pengambilan barang di toko sejumlah <?= $this->session->flashdata('berhasil'); ?></h4>
            <h4>Daftar Pesanan bisa dilihat pada halaman daftar pesanan.</h4>
        </center>
    </div>
</section>