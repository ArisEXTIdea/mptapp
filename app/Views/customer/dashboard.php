<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/css/customer/dashboard.css">
<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<script src="/assets/js/frontpage/allproduct.js">

</script>
<?= $this->endSection() ?>


<!-- Content Section -->

<?= $this->section('content') ?>
<div class="container-fluid m-0 p-0 main-c">
    <!-- Intro -->
    <div class="row">
        <div class="col-12">
            <?php echo view('/theme/navbar')?>
            <div class="row product-container justify-content-center p-3">
                <?php echo view('/theme/sidenav')?>
                <div class="col-12 col-md-7 col-lg-8 w-bg m-2 p-5">
                    <!-- Allert pendaftaran berhasil -->
                    <?php $session = \Config\Services::session();?>
                    <?php if($session->getFlashdata('success')):?>
                    <div class="alert alert-success" role="alert">
                        <?php  echo $session->getFlashdata('success'); ?>
                    </div>
                    <?php endif;?>
                    <!-- --------------------------------- -->
                    <h3 class="p-3 main-bg">Akun Saya</h3>
                    <div>
                        <div style="background-image: url(/assets/images/imagestore/profilepicture/<?= $userdata['profile_picture']?>)" class="myprofile-picture mt-5">
                        </div>
                        <form class="mt-5" id="form-myprofile">
                            <h4 class="mt-5 mb-3 main-bg p-3">Data Diri</h4>
                            <div class="form-group my-3">
                                <label for="full-name">Nama Lengkap</label>
                                <input type="text" name="full_name" class="form-control mt-1" value="<?= $userdata['full_name']?>" required>
                            </div>
                            <div class="form-group my-3">
                                <label for="gender">Jenis Kelamin</label>
                                <select class="form-control" name="gender" required>
                                    <option disabled id="gender-default" selected>-------- Pilih Jenis Kelamin --------</option>
                                    <option value="Laki-Laki" id="gender-laki-laki">Laki-Laki</option>
                                    <option value="Perempuan" id="gender-perempuam">Perempuan</option>
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
                                <select class="form-control" name="level_user" required>
                                    <option disabled id="level-default" selected>-------- Pilih Level --------</option>
                                    <option value="1" id="level-admin">Admin</option>
                                    <option value="2" id="level-customer">Customer</option>
                                </select>
                            </div>
                            <div>
                            <div class="alert alert-success d-none" role="alert" id="update-myprofile-success">
                                Profil berhasil diperbaharui...
                            </div>
                                <a href="#" class="btn btn-primary main-bg" onclick="updateCurentUserProfile()">Update Profile</a>
                            </div>
                        </form>
                        <form id="form-myprofile-picture" action="/customercontroller/updateCurrentUserProfilePicture" method="post" enctype="multipart/form-data">
                            <h4 class="mt-5 mb-3 main-bg p-3">Ganti Foto Profil</h4>
                            <div class="form-group my-3">
                                <label for="profile_picture">Foto Profil</label>
                                <input type="file" name="profile_picture" class="form-control mt-1">
                            </div>
                            <div>
                                <button class="btn btn-primary main-bg">Update Foto Profile</button>
                            </div>
                        </form>
                        <h4 class="mt-5 mb-3 main-bg p-3">Update Dokumen KTP dan KK</h4>
                        <form id="form-myprofile-picture" action="/customercontroller/updateCurrentUserKtpPicture" method="post" enctype="multipart/form-data">
                            <div class="form-group my-3">
                                <label for="scan_ktp">Unggah KTP</label>
                                <input type="file" name="scan_ktp" class="form-control mt-1">
                            </div>
                            <div>
                                <button class="btn btn-primary main-bg">Update KTP</button>
                            </div>
                            <img src="/assets/images/imagestore/ktp/<?= $userdata['scan_ktp']?>" alt="ktp" class="img-fluid my-3">
                        </form>
                        <form id="form-myprofile-picture" action="/customercontroller/updateCurrentUserkkPicture" method="post" enctype="multipart/form-data">
                            <div class="form-group my-3">
                                <label for="scan_kk">Unggah KK</label>
                                <input type="file" name="scan_kk" class="form-control mt-1">
                            </div>
                            <div>
                                <button class="btn btn-primary main-bg">Update KK</button>
                            </div>
                            <img src="/assets/images/imagestore/kk/<?= $userdata['scan_kk']?>" alt="kk" class="img-fluid my-3">
                        </form>
                    </div>
                </div>
            </div>
            <?php echo view('/theme/footerfull')?>
        </div>
    </div>
      <!-- Show data in page based on session -->
      <script>
        const getDataUserId = () => {
            $.ajax({
                type: "post",
                url: "<?php echo base_url().'/Customercontroller/getDataUserId'?>",
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
                    url: "<?php echo base_url().'/Customercontroller/updateCurrentUser'?>",
                    data: $("#form-myprofile").serialize(),
                    dataType: "json",
                    success: function (response) {
                        getDataUserId()
                        $("#update-myprofile-success").removeClass("d-none");
                        setTimeout(() => {
                            $("#update-myprofile-success").addClass("d-none");
                        }, 3000);
                        alert('Profil berhasil diperbaharui')
                    }
                });
            });
        }
    </script>
</div>
<?= $this->endSection() ?>

