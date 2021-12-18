<?= $this->extend('/theme/head') ?>


<!-- Import css here -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="/assets/css/authentication/registrationPageStyle.css">
<?= $this->endSection() ?>

<!-- Import Javascript here -->

<?= $this->section('js') ?>
<script src="/assets/js/authentication/registrationPage.js"></script>
<?= $this->endSection() ?>


<!-- Content Section -->

<?= $this->section('content') ?>
<div class="container-fluid m-0 p-0 reg-container">
    <div class="row p-0 m-0">
        <div class="col-12 col-sm-7 col-md-5 reg-form border p-5">
            <div class='reg-brand d-flex' >
                <a href="/">
                    <div>
                        <img src="/assets/images/systemimages/logompt.png" alt="Maestro Putra Timur" width="250px">
                    </div>
                </a>
            </div>
            <div class="reg-info my-5">
                <H4>Masuk ke akun anda</H4>

                <!-- Allert pendaftaran berhasil -->
                <?php $session = \Config\Services::session();?>
                <?php if($session->getFlashdata('success')):?>
                <div class="alert alert-success" role="alert">
                    <?php  echo $session->getFlashdata('success'); ?>
                </div>
                <?php endif;?>
                <!-- --------------------------------- -->

                <!-- Allert pendaftaran berhasil -->
                <?php if($session->getFlashdata('loginfailed')):?>
                <div class="alert alert-danger" role="alert">
                    <?php  echo $session->getFlashdata('loginfailed'); ?>
                </div>
                <?php endif;?>
                <!-- --------------------------------- -->
                <p>Login dan mulai memilih rumah yang anda inginkan dengan cepat dan mudah</p>
            </div>

            <!-- form Login -->
            <div class="reg-form">
                <form action="/AuthenticationController/auth" method='post'>
                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Masukkan email anda" class='form-control mt-1' id='email' required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Masukkan password anda" class='form-control mt-1' id='password-input' required>
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-block btn-primary btn-register">Login</button>
                    </div>
                    <div class='d-flex justify-content-between mt-1'>
                        <a href="/daftar">Belum Punya Akun?</a>
                        <a href="/lupa-password">Lupa Password?</a>
                    </div>
                    <script src="/assets/js/authentication/validation.js"></script>
                </form>
            </div>
        </div>
        <div class="d-none d-xs-none d-sm-block col-sm-5 col-md-7 reg-illustration border p-5 d-flex align-items-end">
            <div class="p-3 reg-illustration-text mb-5">
                <h4>Cari Kenyaman di Rumah yang Anda Miliki</h4>
                <p>Anda dapat membeli rumah dengan mudah dan cepat, kami melayani pembelian runmah dengan sistem KPR, Cash, dan Cash Berjangka</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
