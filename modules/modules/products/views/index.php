<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <h1 class="h3 mb-4 text-gray-800 ml-3">Daftar Produk</h1>
        <?php if($this->session->flashdata('error') == TRUE): ?>
        <div class="alert alert-danger alert-dismissible fade show ml-5" role="alert">
            <?= $this->session->flashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
        <a class="btn btn-primary h3 mb-4 ml-auto mr-3" href="<?= base_url('products/add'); ?>">Tambah Produk</a>
        
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Biaya</th>
                            <th>Vendor</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($barang as $p) : ?>
                            <tr>
                                <td>
                                    <center>
                                        <img src="<?= base_url('assets/img/produk/'), $p['prod_image'] ?>" height="50px">
                                    </center>
                                </td>
                                <td><?= $p['prod_name'] ?></td>
                                <td><?= $p['prod_price'] ?></td>
                                <td><?= $p['vend_id'] ?></td>
                                <td><?= $p['cat_name'] ?></td>
                                <td><?= $p['prod_desc'] ?></td>
                                <td>
                                    <center>
                                        <a class="btn btn-success" href="<?= base_url('products/edit/'), $p['prod_id'] ?>">Edit</a>
                                        <a class="btn btn-danger" href="<?= base_url('products/delete/'), $p['prod_id'] ?>">Delete</a>
                                    <center>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->