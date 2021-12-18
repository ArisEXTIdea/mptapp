<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css-header-theme') ?>
<link rel="stylesheet" href="/assets/css/theme/header.css">
<?= $this->endSection() ?>


<!-- Import javascript here -->
<?= $this->section('js-header-theme') ?>
<script src="/assets/js/theme/header.js"></script>
<?= $this->endSection() ?>


<!-- Header Section -->
<div class="row m-0 p-0 align-items-center header-container">
    <!-- Brand -->
    <div class="col-12 col-sm-4 col-md-3 col-lg-2 p-2 header-brand">
        <h3 class="text-center">MPT</h3>
    </div>
    <!-- Control -->
    <div class="col-12 col-sm-8 col-md-9 col-lg-10 d-flex justify-content-between align-items-center p-2 header-control">
        <div class="header-hamburger">
            <span class="material-icons-round" id="hamburger">menu</span>
        </div>
        <div class="d-flex">
            <?php 
                $sessionData = session('login');
            ?>
            <img src="/assets/images/imagestore/profilepicture/<?=$sessionData['profile_picture']?>" alt="Profile Picture" width="45" height="45" class="profile-image" id="profile-image">
            <div class='mx-2'>
                <?php $session= session('login')?>
                <span class="header-profile-name">
                    <?= $session['full_name'] ?> <br>
                </span>
                <?= $session['level_name'] ?> <br>
            </div>
        </div>
    </div>
    <div class="header-profile m-1" style="display:none">
        <div class="row">
            <div class="col-12 p-0">
                <div class="d-flex justify-content-center">
                    <img src="/assets/images/imagestore/profilepicture/<?=$sessionData['profile_picture']?>" alt="Profile Picture" width="60" height="60" class="profile-image my-2" >
                </div>
                <h6 class="text-center">Muhammad Aris Widaryani</h6>
                <p class="text-center">Admin</p>
                <div class="d-flex justify-content-between header-profile-control p-2">
                    <a href="/admin/profil-saya" class="btn btn-light">Profile</a>
                    <a href="/logout" class="btn btn-light">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>