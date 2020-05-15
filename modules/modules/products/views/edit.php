<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <h1 class="h3 mb-4 text-gray-800 ml-3">Tambah Produk</h1>
        <a class="btn btn-primary h3 mb-4 ml-auto mr-3" href="<?= base_url('products'); ?>">Daftar Produk</a>
    </div>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-sm-10 offset-1">
            <?php foreach ($edit as $p) : ?>
            <form class="user" method="POST" action="<?= base_url('products/edit_produk'); ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" name="nama_produk" class="form-control form-control-user" placeholder="Nama Produk" value="<?= $p['prod_name']; ?>">
                    <input type="text" name="prod_id" class="form-control form-control-user" placeholder="Nama Produk" value="<?= $p['prod_id']; ?>" hidden>
                    <?= form_error('nama_produk', '<small class="text-danger">', '<small>'); ?>
                </div>
                <div class="form-group">
                    <input type="text" name="harga_produk" class="form-control form-control-user" placeholder="Biaya Produk" value="<?= $p['prod_price']; ?>">
                    <?= form_error('harga_produk', '<small class="text-danger">', '<small>'); ?>
                </div>
                <div class="form-group">
                    <input type="text" name="deskripsi_produk" class="form-control form-control-user" placeholder="Deskripsi Produk" value="<?= $p['prod_desc']; ?>">
                    <?= form_error('deskripsi_produk', '<small class="text-danger">', '<small>'); ?>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <span class="h6 mr-2">Kategori Produk</span>
                        <select name="kategori_produk" class="form-control form-control-user">
                        <?php 
                        foreach($kategori as $k):
                            if ($k['cat_id'] == $p['cat_id']){
                            echo "<option value='".$k['cat_id']."' selected>".$k['cat_name']."</option>";
                            } else {
                            echo "<option value='".$k['cat_id']."'>".$k['cat_name']."</option>";
                            }
                        endforeach; 
                        ?>        
                        </select>
                        <?= form_error('kategori_produk', '<small class="text-danger">', '<small>'); ?>
                    </div>
                    <div class="col-sm-8 mt-3">
                        <span class="h6 ml-5 mr-2">Gambar Produk</span>
                        <input type="file" name="upload_image" id="upload_image" >
                        <?= form_error('upload_image', '<small class="text-danger">', '<small>'); ?>
                    </div>
                </div>
                    <center>
                    <input class="btn btn-primary btn-user btn-block mt-4 w-50 center" type="submit" name="btnSubmit" value="Edit Produk" /> 
                    </center>
            </form>
            <?php endforeach; ?>
        </div>

    </div>
</div>