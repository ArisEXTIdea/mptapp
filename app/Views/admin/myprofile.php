<?= $this->extend('/theme/head') ?>

<!-- Handle upload Profile -->

<!-- Import css here -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/css/admin/myprofilestyle.css">
<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<script src="/assets/js/admin/myprofile.js"></script>
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
            <?php echo view('/theme/sidemenu')?>
        </div>
        <div class="col-12 col-sm-8 col-md-9 col-lg-10 p-3 content-bg content-container" id='content'>
            <div class="container-fluid p-4 m-0 item-bg">
                <div class="row">
                    <!-- Header Section -->
                    <div class="col-12 col-md-6">
                        <h3>Pengguna</h3>
                    </div>
                </div>
                <!-- Users Tabele -->
                <div class="row">
                    <div class="col-12 col-md-6 mt-5">
                        <div style="background-image: url(/assets/images/imagestore/profilepicture/<?= $userdata['profile_picture']?>);" class="myprofile-picture">
                        </div>
                        <!-- <img src="/assets/images/imagestore/profilepicture/<?= $userdata['profile_picture']?>" alt="Gambar" class="myprofile-picture"> -->
                        <form class="mt-5" id="form-myprofile">
                            <h4 class="mt-5 mb-3 main-bg p-3">Data Diri</h4>
                            <div class="form-group my-3">
                                <label for="full-name">Nama Lengkap</label>
                                <input type="text" name="full_name" class="form-control mt-1" value="<?= $userdata['full_name']?>" required>
                            </div>
                            <div class="form-group my-3">
                                <label for="gender">Jenis Kelamin</label>
                                <select class="form-control" name="gender" required>
                                    <?php 
                                    $selectedL= '';
                                    $selectedP = '';

                                    if($userdata['gender'] == "Perempuan"){
                                        $selectedP = 'selected';
                                    } else {
                                        $selectedL = 'selected';
                                    }
                                    
                                    ?>
                                    <option disabled id="gender-default" selected>-------- Pilih Jenis Kelamin --------</option>
                                    <option value="Laki-Laki" id="gender-laki-laki" <?= $selectedL ?>>Laki-Laki</option>
                                    <option value="Perempuan" id="gender-perempuam" <?= $selectedP ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group my-3">
                                <label for="full-name">Alamat</label>
                                <input type="text" name="address" class="form-control mt-1" value="<?= $userdata['address']?>" required>
                            </div>
                            <div class="form-group my-3">
                                <label for="full-name">Nomor Telepon</label>
                                <input type="text" name="phone" class="form-control mt-1" value="<?= $userdata['phone']?>" required>
                            </div>
                            <div class="form-group my-3">
                                <label for="full-name">Email</label>
                                <input type="text" name="email" class="form-control mt-1" value="<?= $userdata['email']?>" required>
                            </div>
                            <div class="form-group my-3">
                                <label for="full-name">Level User</label>
                                <?php 
                                    $selectedA= '';
                                    $selectedC = '';

                                    if($userdata['user_level'] == "1"){
                                        $selectedA = 'selected';
                                    } else {
                                        $selectedLC = 'selected';
                                    }
                                    
                                    ?>
                                <select class="form-control" name="level_user" required>
                                    <option value="1" id="level-admin" <?= $selectedA ?>>Admin</option>
                                    <option value="2" id="level-customer" <?= $selectedC ?>>Customer</option>
                                </select>
                            </div>
                            <div>
                            <div class="alert alert-success d-none" role="alert" id="update-myprofile-success">
                                Profil berhasil diperbaharui...
                            </div>
                                <a href="#" class="btn btn-primary main-bg" onclick="updateCurentUserProfile()">Update Profile</a>
                            </div>
                        </form>
                        <form id="form-myprofile-picture" action="/admincontroller/updateCurrentUserProfilePicture" method="post" enctype="multipart/form-data">
                            <h4 class="mt-5 mb-3 main-bg p-3">Ganti Foto Profil</h4>
                            <div class="form-group my-3">
                                <label for="profile_picture">Foto Profil</label>
                                <input type="file" name="profile_picture" class="form-control mt-1">
                            </div>
                            <!-- Allert pendaftaran berhasil -->
                            <?php $session = \Config\Services::session();?>
                            <?php if($session->getFlashdata('successppupdate')):?>
                            <div class="alert alert-success" role="alert">
                                <?php  echo $session->getFlashdata('successppupdate'); ?>
                            </div>
                            <?php endif;?>
                            <!-- --------------------------------- -->
                            <div>
                                <button class="btn btn-primary main-bg">Update Foto Profile</button>
                            </div>
                        </form>
                        <h4 class="mt-5 mb-3 main-bg p-3">Update Dokumen KTP dan KK</h4>
                        <form id="form-myprofile-picture" action="/admincontroller/updateCurrentUserKtpPicture" method="post" enctype="multipart/form-data">
                            <div class="form-group my-3">
                                <label for="scan_ktp">Unggah KTP</label>
                                <input type="file" name="scan_ktp" class="form-control mt-1">
                            </div>
                            <!-- Allert pendaftaran berhasil -->
                            <?php $session = \Config\Services::session();?>
                            <?php if($session->getFlashdata('successktpupdate')):?>
                            <div class="alert alert-success" role="alert">
                                <?php  echo $session->getFlashdata('successktpupdate'); ?>
                            </div>
                            <?php endif;?>
                            <!-- --------------------------------- -->
                            <div>
                                <button class="btn btn-primary main-bg">Update KTP</button>
                            </div>
                            <img src="/assets/images/imagestore/ktp/<?= $userdata['scan_ktp']?>" alt="ktp" class="img-fluid my-3">
                        </form>
                        <form id="form-myprofile-picture" action="/admincontroller/updateCurrentUserkkPicture" method="post" enctype="multipart/form-data">
                            <div class="form-group my-3">
                                <label for="scan_kk">Unggah KK</label>
                                <input type="file" name="scan_kk" class="form-control mt-1">
                            </div>
                            <!-- Allert pendaftaran berhasil -->
                            <?php $session = \Config\Services::session();?>
                            <?php if($session->getFlashdata('successkkupdate')):?>
                            <div class="alert alert-success" role="alert">
                                <?php  echo $session->getFlashdata('successkkupdate'); ?>
                            </div>
                            <?php endif;?>
                            <!-- --------------------------------- -->
                            <div>
                                <button class="btn btn-primary main-bg">Update KK</button>
                            </div>
                            <img src="/assets/images/imagestore/kk/<?= $userdata['scan_kk']?>" alt="kk" class="img-fluid my-3">
                        </form>
                    </div>
                    <div class="col-6 d-none d-md-block">
                        <img src="/assets/images/systemimages/profileanim.gif" alt="Animasi Profil" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <?php echo view('/theme/footer')?>
    </div>

    <!-- Ajax request -->


    <!-- Show data in page based on session -->
    <script>
        const getDataUserId = () => {
            $.ajax({
                type: "post",
                url: "<?php echo base_url().'/AdminController/getDataUserId'?>",
                dataType: "json",
                success: function (response) {
                    $(document).ready(function () {
                        // Selected gender
                        if(response['gender'] === 'Laki-laki'){
                            $("#gender-laki-laki").attr("selected", "selected");
                            $("#gender-default").removeAttr("selected");
                        }
                        else{
                            $("#gender-perempuan").attr("selected", "selected");
                            $("#gender-default").removeAttr("selected");
                        }

                        // Selected Level

                        if(response['user_level'] == 1){
                            $("#level-admin").attr("selected", "selected");
                            $("#level-default").removeAttr("selected");
                        }
                        else{
                            $("#level-customer").attr("selected", "selected");
                            $("#gender-default").removeAttr("selected");
                        }
                    });
                }
            });
        }

        getDataUserId()
    </script>

    <script>
        const updateCurentUserProfile = () => {
            $(document).ready(function () {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url().'/AdminController/updateCurrentUser'?>",
                    data: $("#form-myprofile").serialize(),
                    dataType: "json",
                    success: function (response) {
                        getDataUserId()
                        $("#update-myprofile-success").removeClass("d-none");
                        setTimeout(() => {
                            $("#update-myprofile-success").addClass("d-none");
                        }, 3000);
                    }
                });
            });
        }
    </script>
    
</div>
<?= $this->endSection() ?>

