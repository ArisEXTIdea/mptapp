<?= $this->extend('/theme/head') ?>


<!-- Import css here -->
<?= $this->section('css') ?>
<!-- <link rel="stylesheet" href="/assets/css/authentication/registrationPageStyle.css"> -->
<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<!-- <script src="/assets/js/authentication/registrationPage.js"></script> -->
<?= $this->endSection() ?>

<!-- Content Section -->

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <img src="/assets/images/systemimages/404.gif" alt="Halaman Tidak Ditemukan" width="400">
                <h3 class="text-center">Maaf Halaman yang anda cari tidak dapat ditemukan</h3>
                <a href="/" class="btn btn-primary mt-3 main-bg">Kembali Ke Halaman Awal</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
