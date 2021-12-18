<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>
<!-- <link rel="stylesheet" href="/assets/css/admin/listpengguna.css"> -->
<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<!-- <script src="/assets/js/admin/pengguna.js"></script> -->
<?= $this->endSection() ?>


<!-- Content Section -->

<?= $this->section('content') ?>
<div class="container-fluid m-0 p-0 main-c">
    <!-- Modal -->
    <div class="mymodal-container p-5 d-none">
        <div class="d-flex justify-content-center">
            <div class="mymodal">
                <div class="mymodal-header d-flex justify-content-between align-items-center p-2 main-bg">
                    <h4>Detail Pengguna</h4>
                    <a href="#" onclick="tutupModal()"><span class="material-icons-round">close</span></a>
                </div>
                <div id="data-diri" class="p-3">
    
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <?php echo view('/theme/header')?>
    <div class="row p-0 m-0" style="height: 100vh">
        <div class="col-12 col-sm-4 col-md-3 col-lg-2 p-0 m-0" id="sidebar">
            <?php echo view('/theme/Sidemenu')?>
        </div>
        <div class="col-12 col-sm-8 col-md-9 col-lg-10 p-3 content-bg content-container" id='content'>
            <div class="container-fluid p-4 m-0 item-bg">
                <div class="row">
                    <div class="col-12 mb-5">
                        <h3>Edit Produk Perumahan Baru</h3>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <form action="/admincontroller/putProduk" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="form-group my-2 d-none">
                                    <label for="id_produk">Id Produk</label>
                                    <input type="text" name="id_produk" class="form-control mt-2" value="<?= $data['id_produk']?>" required>
                                </div>
                                <div class="form-group my-2">
                                    <label for="judul_p">Judul Produk</label>
                                    <input type="text" name="judul_p" class="form-control mt-2" value="<?= $data['judul_p']?>" required>
                                </div>
                                <div class="form-group my-2">
                                    <label for="product_pic">Foto Rumah</label>
                                    <input type="file" name="product_pic[]" class="form-control mt-2" multiple>
                                </div>
                                <div class="form-group my-2">
                                    <label for="harga_normal">Harga</label>
                                    <input type="number" name="harga_normal" class="form-control mt-2" placeholder="Rp," value="<?= $data['harga_normal']?>" required>
                                </div>
                                <div class="form-group my-2">
                                    <label for="harga_diskon">Harga Diskon(Jika ada)</label>
                                    <input type="number" name="harga_diskon" class="form-control mt-2" placeholder="Rp," step="0.1" value="<?= $data['harga_diskon']?>" required>
                                </div>
                                <div class="form-group my-2">
                                    <label for="kategori_p">Nama Perumahan</label>
                                    <select name="kategori_p" class="form-control" required>
                                        <option selected disabled>--Pilih Perumahan--</option>
                                        <?php foreach($kategori as $k):?>
                                            <?php 
                                                if($k == $data['kategori_p']){
                                                    $select = 'selected';
                                                } else{
                                                    $select = '';
                                                }
                                                ?>
                                            <option value="<?= $k ?>" <?= $select ?>><?= $k ?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group my-2">
                                    <label for="alamat">Alamat Rumah</label>
                                    <input type="text" name="alamat" class="form-control mt-2" value="<?= $data['alamat']?>" required>
                                </div>
                                <div class="form-group my-2">
                                    <label for="subsidi">Subsidi</label>
                                        <?php
                                            $iya = '';
                                            $tidak = '';
                                            if($data['subsidi'] == 'Iya'){
                                                $iya = 'selected';
                                            }
                                            else{
                                                $tidak = 'selected';
                                            }
                                        ?>
                                    <select name="subsidi" class="form-select" required>
                                        <option value="" selected disabled>--Pilih Subsidi--</option>
                                        <option value="Iya" <?= $iya ?>>Iya</option>
                                        <option value="Tidak" <?= $tidak ?>>Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group my-2">
                                    <label for="kt">Jumlah Kamar Tidur</label>
                                    <input type="number" name="kt" class="form-control mt-2" value="<?= $data['kt']?>" required>
                                </div>
                                <div class="form-group my-2">
                                    <label for="km">Jumlah Kamar Mandi</label>
                                    <input type="number" name="km" class="form-control mt-2" value="<?= $data['km']?>" required>
                                </div>
                                <div class="form-group my-2">
                                    <label for="luas_area">Ukran Bangunan(m2)</label>
                                    <input type="number" name="luas_area" class="form-control mt-2" value="<?= $data['luas_area']?>" required>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group my-2">
                                            <label for="panjang_bangunan">Panjang Bangunan(m)</label>
                                            <input type="number" name="panjang_bangunan" class="form-control mt-2" value="<?= $data['panjang_bangunan']?>" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                    <div class="form-group my-2">
                                            <label for="lebar_bangunan">Lebar Bangunan</label>
                                            <input type="number" name="lebar_bangunan" class="form-control mt-2" value="<?= $data['lebar_bangunan']?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group my-2">
                                            <label for="listrik">Daya Listrik(VA)</label>
                                            <input type="number" name="listrik" class="form-control mt-2" value="<?= $data['listrik']?>" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                    <div class="form-group my-2">
                                            <label for="air">Sumber Air</label>
                                            <input type="text" name="air" class="form-control mt-2" value="<?= $data['air']?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-2">
                                    <label for="unit_tersisa">Unit Tersisa</label>
                                    <input type="number" name="unit_tersisa" class="form-control mt-2" value="<?= $data['unit_tersisa']?>" required>
                                </div>
                                <div class="form-group my-2">
                                    <label for="jumlah_unit">Total Unit Rumah</label>
                                    <input type="number" name="jumlah_unit" class="form-control mt-2" value="<?= $data['jumlah_unit']?>" required>
                                </div>
                                <div class="form-group my-2">
                                    <label for="deskripsi">Deskripsi Produk</label>
                                    <textarea name="deskripsi" id="deskripsi" required><?= $data['deskripsi']?></textarea>
                                    <script>
                                        CKEDITOR.replace( 'deskripsi' );
                                    </script>
                                </div>
                                <div class="form-group my-2">
                                    <label for="status">Status Produk</label>
                                    <select name="status" class="form-select" required>
                                        <option selected disabled>--Pilih Status--</option>
                                        <?php
                                            $aktif = '';
                                            $noaktif = '';
                                            if($data['status'] == 'aktif'){
                                                $aktif = 'selected';
                                            }
                                            else{
                                                $noaktif = 'selected';
                                            }
                                        ?>
                                        <option value="aktif" <?= $aktif?>>Aktif</option>
                                        <option value="tidak aktif" <?= $noaktif?>>Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="my-2">
                                    <p>Pastikan semua form telah terisi dengan benar.</p>
                                    <button type="submit" class="btn btn-primary main-bg">Simpan Produk</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo view('/theme/footer')?>
    </div>

    <!-- Ajax request -->
</div>
<?= $this->endSection() ?>

