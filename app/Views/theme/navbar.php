<!-- Import css here -->
<?= $this->section('css-header-theme') ?>
<link rel="stylesheet" href="/assets/css/theme/navbar.css"> 
<?= $this->endSection() ?>


<!-- Import javascript here -->
<?= $this->section('js-header-theme') ?>
<!-- <script src="/assets/js/theme/header.js"></script> -->
<?= $this->endSection() ?>


<!-- Header Section -->

<div class="row bg-light p-0 m-0" id="navbar">
    <div class="col-12 px-4 ">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/assets/images/imagestore/konten/<?= $kontenData['logo_pic'] ?>" alt="MAESTRO PUTRA TIMUR" width="200px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " aria-current="page" href="/#produk">Produk</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " aria-current="page" href="/#kontak">Kontak</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " aria-current="page" href="/#tentang">Tentang</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " aria-current="page" href="/#cara-beli">Cara Beli</a>
                </li>
                <?php 
                $sessionData = session('login');
                $level = '';

                if($sessionData == null){
                    $level = '';
                }
                elseif($sessionData['user_level'] == 1){
                    $level = '/admin/dashboard';
                }
                else{
                    $level = '/customer/dashboard';
                }
                
                
                ?>
                <?php if(session('login')):?>
                <li class="nav-item dropdown">
                    <a class="nav-link " aria-current="page" href="<?= $level?>"> <b>Akun Saya</b> </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " aria-current="page" href="/logout">Logout </a>
                </li>
                <?php endif;?>
                <?php if(!session('login')):?>
                <li class="nav-item dropdown">
                    <a class="nav-link " aria-current="page" href="/daftar">Daftar</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="btn btn-outline-dark login-link" aria-current="page" href="/login">Login</a>
                </li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>
    </div>
</div>