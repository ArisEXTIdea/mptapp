<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css-header-theme') ?>
<link rel="stylesheet" href="/assets/css/theme/sidenav.css">
<?= $this->endSection() ?>


<!-- Import javascript here -->
<?= $this->section('js-header-theme') ?>
<script src="/assets/js/theme/sidebar.js"></script>
<?= $this->endSection() ?>



<div class="col-12 col-md-4 col-lg-3 w-bg m-2 p-3 sidemenu-container">
    <ul>
        <a href="/customer/dashboard">
            <li class="sidemenu-item d-flex align-items-center">
                <span class="material-icons-round mx-3">account_circle</span>
                Akun Saya
            </li>
        </a>
        <a href="/customer/wishlist">
            <li class="sidemenu-item d-flex align-items-center">
                <span class="material-icons-round mx-3">cottage</span>
                Rumah Tersimpan
            </li>
        </a>
        <a href="/customer/transaksi">
            <li class="sidemenu-item d-flex align-items-center">
                <span class="material-icons-round mx-3">monetization_on</span>
                Transaksi dan Pembayaran
            </li>
        </a>
        <a href="/logout">
            <li class="sidemenu-item d-flex align-items-center">
                <span class="material-icons-round mx-3">logout</span>
                Logout
            </li>
        </a>
    </ul>
</div>