<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'FrontPageController::index');

// Autentikasi Routes
$routes->get('/daftar', 'AuthenticationController::userRegistration');
$routes->get('/login', 'AuthenticationController::login');
$routes->get('/logout', 'AuthenticationController::logout');
$routes->get('/lupa-password', 'AuthenticationController::lupaPassword');
$routes->get('/ubah-password/(:any)/(:any)', 'AuthenticationController::loadGantiPasswordForm');

// Front Page

$routes->get('/halaman-tidak-ditemukan', 'FrontPageController::pagenotfound');
$routes->get('/semua-rumah', 'FrontPageController::allproduct');
$routes->get('/cari-rumah', 'FrontPageController::searchProduct');
$routes->get('/rumah/(:any)', 'FrontPageController::lihatDetailRumah');
$routes->get('/buat-pesanan/(:any)', 'FrontPageController::loadPesanan');
$routes->get('/pesanan-berhasil', 'FrontPageController::pesananBerhasil');

// -------------------- No Login Routes -----------------------------------

$routes->get('/', 'FrontPageController::index');


// -------------------Admin Routes _--------------
// Modul Kategori
$routes->get('/admin/kategori-produk', 'AdminController::kategoriProdukLoad');
// Modul Pengguna
$routes->get('/admin/pengguna', 'AdminController::penggunaLoad');
$routes->get('/admin/pengguna-baru', 'AdminController::createNewPenggunaLoad');
// Modul Kontent
$routes->get('/admin/atur-konten', 'AdminController::contentLoad');
// Modul MyProfile
$routes->get('/admin/profil-saya', 'AdminController::myProfileLoad');
// Module Kategori Perumahan
$routes->get('/admin/kategori-perumahan', 'AdminController::kategoriPerumahanLoad');
// Modul Daftar Produk
$routes->get('/admin/daftar-produk', 'AdminController::produkPerumahanLoad');
$routes->get('/admin/produk-baru', 'AdminController::newProductForm');
$routes->get('/admin/daftar-produk-detail/(:any)', 'AdminController::produkPerumahanDetailLoad');
$routes->get('/admin/daftar-produk-edit/(:any)', 'AdminController::produkPerumahanEditLoad');
$routes->get('/admin/cari-daftar-produk/(:any)', 'AdminController::ProdukPerumahanCariLoad');
// Module Pesan Pengguna
$routes->get('/admin/pesan', 'AdminController::loadPesan');
// Module Pesanan
$routes->get('/admin/pesanan', 'AdminController::loadPesanan');
$routes->get('/admin/pesanan/(:any)', 'AdminController::loadPesananDetail');
$routes->get('/admin/edit-pesanan/(:any)', 'AdminController::loadPesananEdit');
// Module Riwayat Pesanan
$routes->get('/admin/riwayat-pesanan', 'AdminController::loadRiwayatPesanan');
$routes->get('/admin/riwayat-pesanan-detail/(:any)', 'AdminController::loadRiwayatPesananDetail');
// Module KPR
$routes->get('/admin/kpr', 'AdminController::loadKpr');
$routes->get('/admin/atur-kpr/(:any)', 'AdminController::aturKpr');
$routes->get('/admin/kpr-detail/(:any)', 'AdminController::loadkprdetail');
$routes->get('/admin/cek-pembayaran/(:any)', 'AdminController::loadCekPembayaran');
$routes->get('/admin/detail-pembayaran/(:any)', 'AdminController::loadDetailPembayaran');
$routes->get('/admin/bayar-tagihan-kpr/(:any)', 'AdminController::loadPembayaranKpr');
// Module Cash Bertahap
$routes->get('/admin/cash-bertahap', 'AdminController::loadcashbertahap');
$routes->get('/admin/atur-cash-bertahap/(:any)', 'AdminController::aturCb');
$routes->get('/admin/cash-bertahap-detail/(:any)', 'AdminController::loadcbdetail');
$routes->get('/admin/bayar-tagihan-cash-bertahap/(:any)', 'AdminController::loadPembayaranCb');
$routes->get('/admin/detail-pembayaran-cash-bertahap/(:any)', 'AdminController::loadDetailPembayaranCb');
$routes->get('/admin/cek-pembayaran-cash-bertahap/(:any)', 'AdminController::loadCekPembayarancb');
// Module Cash Tunai
$routes->get('/admin/cash-tunai', 'AdminController::loadcashtunai');
$routes->get('/admin/atur-cash-tunai/(:any)', 'AdminController::aturCt');
$routes->get('/admin/cash-tunai-detail/(:any)', 'AdminController::loadctdetail');
$routes->get('/admin/bayar-tagihan-cash-tunai/(:any)', 'AdminController::loadPembayaranCt');
$routes->get('/admin/detail-pembayaran-cash-tunai/(:any)', 'AdminController::loadDetailPembayaranCt');



// Module Bank
$routes->get('/admin/informasi-bank', 'AdminController::loadInformasiBank');

// Customer Routes-------------------------------------
// Wish list module
$routes->get('/customer/wishlist', 'CustomerController::wishListLoad');
// Transaction module
$routes->get('/customer/transaksi', 'CustomerController::transactionLoad');
// Kpr Module
$routes->get('/customer/pembayaran-kpr/(:any)', 'CustomerController::customerKprLoad');
$routes->get('/customer/bayar-tagihan-kpr/(:any)', 'CustomerController::tagihanKprFormLoad');
$routes->get('/customer/bayar-ulang-tagihan-kpr/(:any)', 'CustomerController::tagihanUlangFormLoad');
$routes->get('/customer/detail-pembayaran/(:any)', 'CustomerController::detailtagihanKprFormLoad');
// Cash Bertahap Module
$routes->get('/customer/pembayaran-cash-bertahap/(:any)', 'CustomerController::customercbLoad');
$routes->get('/customer/bayar-tagihan-cash-bertahap/(:any)', 'CustomerController::tagihancbFormLoad');
$routes->get('/customer/bayar-ulang-tagihan-cash-bertahap/(:any)', 'CustomerController::tagihanUlangCbFormLoad');
$routes->get('/customer/detail-pembayaran/(:any)', 'CustomerController::detailtagihanKprFormLoad');
// Cash Tunai Module
$routes->get('/customer/pembayaran-cash-tunai/(:any)', 'CustomerController::customerctLoad');
$routes->get('/customer/bayar-tagihan-cash-tunai/(:any)', 'CustomerController::tagihanctFormLoad');
$routes->get('/customer/bayar-ulang-tagihan-cashtunai/(:any)', 'CustomerController::tagihanUlangFormLoad');
$routes->get('/customer/detail-pembayaran/(:any)', 'CustomerController::detailtagihanKprFormLoad');






// Dashboard

$routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/customer/dashboard', 'CustomerController::dashboard');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
