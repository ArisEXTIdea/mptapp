<?= $this->extend('/theme/head') ?>

<!-- Handle upload Profile -->

<!-- Import css here -->
<?= $this->section('css') ?>
<!-- <link rel="stylesheet" href="/assets/css/admin/myprofilestyle.css"> -->
<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<!-- <script src="/assets/js/admin/myprofile.js"></script> -->
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
                   <div class="col-12 col-md-6">
                        <h3>Pengaturan Konten</h3>

                        <!-- Allert Upload logo berhasil -->
                        <?php $session = \Config\Services::session();?>
                        <?php if($session->getFlashdata('success')):?>
                        <div class="alert alert-success" role="alert">
                            <?php  echo $session->getFlashdata('success'); ?>
                        </div>
                        <?php endif;?>
                        <!-- --------------------------------- -->

                        <!-- Allert Upload logo Gagal -->
                        <?php if($session->getFlashdata('failed')):?>
                        <div class="alert alert-danger" role="alert">
                            <?php  echo $session->getFlashdata('failed'); ?>
                        </div>
                        <?php endif;?>
                        <!-- --------------------------------- -->

                        <!-- Upload Logo -->

                        <h4 class="main-bg p-2 mt-5">Logo</h4>

                        <div class="my-3">
                            <img src="/assets/images/imagestore/konten/<?= $kontenData[0]['logo_pic']?>" alt="Logo Maestro Putra Timur" width="300">
                        </div>
                        
                        <form action="/admincontroller/updatecontentlogo" method="post" enctype="multipart/form-data"> 
                            <?= csrf_field() ?>
                            <!--  -->
                            <div class="form_group">
                                <label for="logo_pic" class="mb-2">unggah logo baru</label>
                                <input type="file" class="form-control" name="logo_pic">
                                <p class="text-info">Ekstensi yang disarankan : jpg|jpeg|png|</p>
                            </div>
                            <div>
                                <button class="btn btn-primary main-bg mt-3">Ubah Logo</button>
                            </div>
                        </form>

                        <!-- Upload Ilustrasi -->

                        <h4 class="main-bg p-2 mt-5">Ilustrasi</h4>

                        <div class="my-3">
                            <img src="/assets/images/imagestore/konten/<?= $kontenData[0]['front_illustration_pic']?>" alt="Ilustrasi Maestro Putra Timur" width="300">
                        </div>
                        
                        <form action="/admincontroller/updatecontentillustration" method="post"  enctype="multipart/form-data"> 
                            <?= csrf_field() ?>
                            <!--  -->
                            <div class="form_group">
                                <label for="front_illustration_pic" class="mb-2">unggah Ilustrasi baru</label>
                                <input type="file" class="form-control" name="front_illustration_pic">
                                <p class="text-info">Ekstensi yang disarankan : jpg|jpeg|png|</p>
                            </div>
                            <div>
                                <button class="btn btn-primary main-bg mt-3">Ubah Ilustrasi</button>
                            </div>
                        </form>

                         <!-- Ubah Teks konten -->

                        <h4 class="main-bg p-2 mt-5">Konten</h4>

                        <form action="/admincontroller/updateTeksKonten" method="post"  enctype="multipart/form-data"> 
                            <?= csrf_field() ?>
                            <!--  -->
                            <div class="form_group mt-2">
                                <label for="brand_name" class="mb-2">Nama Brand</label>
                                <input type="text" class="form-control" name="brand_name" value="<?= $kontenData[0]['brand_name']?>">
                            </div>
                            <div class="form_group mt-2">
                                <label for="slogan" class="mb-2">Slogan</label>
                                <input type="text" class="form-control" name="slogan" value="<?= $kontenData[0]['slogan']?>">
                            </div>
                            <div class="form_group mt-2">
                                <label for="keterangan_slogan" class="mb-2">Keterangan Slogan</label>
                                <input type="text" class="form-control" name="keterangan_slogan" value="<?= $kontenData[0]['keterangan_slogan']?>" maxlength="100">
                            </div>
                            <div class="form_group mt-2">
                                <label for="tentang_kami" class="mb-2">Tentang Kami</label>
                                <textarea name="tentang_kami" class="form-control" id="aboutus"><?= $kontenData[0]['tentang_kami']?></textarea>
                            </div>
                            <script>
                                CKEDITOR.replace( 'aboutus' );
                            </script>
                            <div class="form_group mt-2">
                                <label for="alamat" class="mb-2">Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="<?= $kontenData[0]['alamat']?>">
                            </div>
                            <div class="form_group mt-2">
                                <label for="wa" class="mb-2">WhatsApp</label>
                                <input type="text" class="form-control" name="wa" value="<?= $kontenData[0]['wa']?>" maxlength="100">
                            </div>
                            <div class="form_group mt-2">
                                <label for="email" class="mb-2">Email</label>
                                <input type="text" class="form-control" name="email" value="<?= $kontenData[0]['email']?>" maxlength="100">
                            </div>
                            <div class="form_group mt-2">
                                <label for="fb" class="mb-2">Facebook</label>
                                <input type="text" class="form-control" name="fb" value="<?= $kontenData[0]['fb']?>" maxlength="100">
                            </div>
                            <div class="form_group mt-2">
                                <label for="ig" class="mb-2">Instagram</label>
                                <input type="text" class="form-control" name="ig" value="<?= $kontenData[0]['ig']?>" maxlength="100">
                            </div>
                            <div class="form_group mt-2">
                                <label for="cara_pemesanan" class="mb-2">Cara Pemesanan</label>
                                <textarea name="cara_pemesanan" class="form-control" id="buysteps"><?= $kontenData[0]['cara_pemesanan']?></textarea>
                            </div>
                            <script>
                                CKEDITOR.replace( 'buysteps' );
                            </script>
                            <div>
                                <button class="btn btn-primary main-bg mt-3">Ubah Konten</button>
                            </div>
                        </form>
                   </div>
                   <div class="d-none d-md-block col-md-6">
                    <img src="/assets/images/systemimages/konten.gif" alt="Animasi Profil" class="img-fluid">
                   </div>
               </div>
            </div>
        </div>
        <?php echo view('/theme/footer')?>
    </div>
</div>
<?= $this->endSection() ?>

