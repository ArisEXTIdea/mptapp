<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/css/admin/listpengguna.css">
<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<script src="/assets/js/admin/pengguna.js"></script>
<?= $this->endSection() ?>


<!-- Content Section -->

<?= $this->section('content') ?>
<div class="container-fluid m-0 p-0 main-c">
    <!-------------------------------------------- Modal ---------------------------------->
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

    <!-- ------------------------------------------------------- -->
    <?php echo view('/theme/header')?>
    <div class="row p-0 m-0" style="height: 100vh">
        <div class="col-12 col-sm-4 col-md-3 col-lg-2 p-0 m-0" id="sidebar">
            <?php echo view('/theme/Sidemenu')?>
        </div>
        <div class="col-12 col-sm-8 col-md-9 col-lg-10 p-3 content-bg content-container" id='content'>
            <div class="container-fluid p-4 m-0 item-bg">
                <div class="row">
                    <!-- Header Section -->
                    <div class="col-12 d-flex justify-content-between my-3">
                        <h3>Tambah Pengguna Baru</h3>
                        <a href="pengguna" class="btn btn-warning d-flex align-items-center">
                        <span class="material-icons-round">arrow_back</span>
                            Kembali
                        </a>
                    </div>
                </div>
                <!-- Users Tabele -->
                <div class="row">
                    <div class="col-12">
                        <form action="/admincontroller/saveNewUser" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group my-3">
                                        <label for="full-name">Nama Lengkap</label>
                                        <input type="text" name="full_name" class="form-control mt-1" required>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="gender">Jenis Kelamin</label>
                                        <select class="form-control" name="gender" required>
                                            <option disabled selected>-------- Pilih Jenis Kelamin --------</option>
                                            <option value="Laki-Laki" >Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="full-name">Alamat</label>
                                        <input type="text" name="address" class="form-control mt-1" required>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="full-name">Nomor Telepon</label>
                                        <input type="text" name="phone" class="form-control mt-1" required>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="full-name">Email</label>
                                        <input type="text" name="email" class="form-control mt-1" required>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control mt-1" required>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="full-name">Level User</label>
                                        <select class="form-control" name="level_user" required>
                                            <option disabled selected>-------- Pilih Level --------</option>
                                            <option value="1" >Admin</option>
                                            <option value="2">Customer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group my-3">
                                        <label for="profile_picture">Foto Profil</label>
                                        <input type="file" name="profile_picture" class="form-control mt-1" required>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="scan_ktp">Upload Kartu Tanda Penduduk(KTP)</label >
                                        <input type="file" name="scan_ktp" class="form-control mt-1" required>
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="scan_kk">Unggah Kartu Keluarga(KK)</label>
                                        <input type="file" name="scan_kk" class="form-control mt-1" required>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary main-bg">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                    <!-- Buat form pengguna baru -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

