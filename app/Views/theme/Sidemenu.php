<?= $this->extend('/theme/head') ?>

<!-- Import css here -->
<?= $this->section('css-header-theme') ?>
<link rel="stylesheet" href="/assets/css/theme/sidebar.css">
<?= $this->endSection() ?>


<!-- Import javascript here -->
<?= $this->section('js-header-theme') ?>
<script src="/assets/js/theme/sidebar.js"></script>
<?= $this->endSection() ?>



<div class="sidebar-container p-0">
    <form action="" class="px-3 py-2">
        <div class="form-group">
            <input type="text" name="cari_menu" class="form-control form-control-sm">
        </div>
    </form>
    <ul class="p-0">
        <a href="/admin/dashboard" class="sidemenu-item">
            <li class="d-flex align-items-center justify-content-start px-3 py-3">
                <span class="material-icons-round mr-2">grid_view</span>
                Dashboard
            </li>
        </a>
        <a href="/admin/pesan" class="sidemenu-item">
            <li class="d-flex align-items-center justify-content-start px-3 py-3">
                <span class="material-icons-round mr-2">chat</span>
                Pesan
            </li>
        </a>
        <a href="#" class="sidemenu-item main-menu">
            <li class="d-flex align-items-center justify-content-between px-3 py-3">
                <div>
                    <span class="material-icons-round mr-2">currency_exchange</span>
                    Transaksi
                </div>
                <div>
                    <span class="material-icons-round text-right">chevron_left</span>
                </div>
            </li>
        </a>
        <div class="sub-menu">
            <a href="/admin/kpr" class="sidemenu-item">
                <li class="d-flex align-items-center justify-content-start px-3 py-3">
                    <span class="material-icons-round mr-2">account_balance</span>
                    KPR
                </li>
            </a>
            <a href="/admin/cash-tunai" class="sidemenu-item">
                <li class="d-flex align-items-center justify-content-start px-3 py-3">
                    <span class="material-icons-round mr-2">credit_card</span>
                    Cash Tunai
                </li>
            </a>
            <a href="/admin/cash-bertahap" class="sidemenu-item">
                <li class="d-flex align-items-center justify-content-start px-3 py-3">
                    <span class="material-icons-round mr-2">stairs</span>
                    Cash Bertahap
                </li>
            </a>
        </div>
        <a href="/admin/pesanan" class="sidemenu-item">
            <li class="d-flex align-items-center justify-content-start px-3 py-3">
                <span class="material-icons-round mr-2">list_alt</span>
                Pesanan
            </li>
        </a>
        <a href="/admin/riwayat-pesanan" class="sidemenu-item">
            <li class="d-flex align-items-center justify-content-start px-3 py-3">
                <span class="material-icons-round mr-2">sell</span>
                Riwayat Pesanan
            </li>
        </a>
        <a href="/admin/pengguna" class="sidemenu-item">
            <li class="d-flex align-items-center justify-content-start px-3 py-3">
                <span class="material-icons-round mr-2">people_alt</span>
                Pengguna
            </li>
        </a>
        <a href="#" class="sidemenu-item main-menu">
            <li class="d-flex align-items-center justify-content-between px-3 py-3">
                <div>
                    <span class="material-icons-round mr-2">inventory_2</span>
                    Produk
                </div>
                <div>
                    <span class="material-icons-round text-right">chevron_left</span>
                </div>
            </li>
        </a>
        <div class="sub-menu">
            <a href="/admin/daftar-produk" class="sidemenu-item">
                <li class="d-flex align-items-center justify-content-start px-4 py-3">
                    <span class="material-icons-round mr-2">fact_check</span>
                    Daftar Produk
                </li>
            </a>
            <a href="/admin/kategori-produk" class="sidemenu-item">
                <li class="d-flex align-items-center justify-content-start px-4 py-3">
                    <span class="material-icons-round mr-2">credit_card</span>
                    Kategori Produk
                </li>
            </a>
            <a href="/admin/kategori-perumahan" class="sidemenu-item">
                <li class="d-flex align-items-center justify-content-start px-4 py-3">
                    <span class="material-icons-round mr-2">holiday_village</span>
                    Kategori Perumahan
                </li>
            </a>
        </div>
        <a href="/admin/atur-konten" class="sidemenu-item">
            <li class="d-flex align-items-center justify-content-start px-3 py-3">
                <span class="material-icons-round mr-2">history_edu</span>
                Konten
            </li>
        </a>
        <a href="/admin/informasi-bank" class="sidemenu-item">
            <li class="d-flex align-items-center justify-content-start px-3 py-3">
                <span class="material-icons-round mr-2">account_balance</span>
                Informasi Bank
            </li>
        </a>
        <a href="/admin/profil-saya" class="sidemenu-item">
            <li class="d-flex align-items-center justify-content-start px-3 py-3">
                <span class="material-icons-round mr-2">account_circle</span>
                Profil Saya
            </li>
        </a>
        <a href="/logout" class="sidemenu-item">
            <li class="d-flex align-items-center justify-content-start px-3 py-3">
                <span class="material-icons-round mr-2">logout</span>
                Logout
            </li>
        </a>
    </ul>
</div>