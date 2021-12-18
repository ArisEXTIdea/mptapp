<?php

namespace App\Controllers;

use App\Models\AuthM;
use App\Models\KategoriM;
use App\Models\UserM;
use App\Models\KategoriPerumahanM;
use App\Models\KontenM;
use App\Models\ProdukM;
use App\Models\MessageM;
use App\Models\PesananM;
use App\Models\KprM;
use App\Models\BayarM;
use App\Models\BankM;
use App\Models\CbM;
use App\Models\CtM;

class AdminController extends BaseController
{

    protected $AuthM;
    protected $KategoriM;
    protected $KontenM;
    protected $UserM;
    protected $ProdukM;
    protected $MessageM;
    protected $PesananM;
    protected $kategoriPerumahanM;
    protected $KprM;
    protected $BayarM;
    protected $BankM;
    protected $CbM;
    protected $CtM;
    public function __construct(){
        $this->AuthM = new AuthM;
        $this->KategoriM = new KategoriM;
        $this->UserM = new UserM;
        $this->KontenM = new KontenM;
        $this->ProdukM = new ProdukM;
        $this->kategoriPerumahanM = new kategoriPerumahanM;
        $this->MessageM = new MessageM;
        $this->PesananM = new PesananM;
        $this->KprM = new KprM;
        $this->BayarM = new BayarM;
        $this->BankM = new BankM;
        $this->CbM = new CbM;
        $this->CtM = new CtM;
    }

    public function dashboard()
    {
        $kprDataAll = $this->PesananM->dGetDataAllKpr();
        $cbDataAll = $this->PesananM->dGetDataAllCb();
        $ctDataAll = $this->PesananM->dGetDataAllct();
        $userDataAll = $this->UserM->dGetDataAllUser();
        $produkDataAll = $this->ProdukM->dGetDataAllProduk();
        $kategoriDataAll = $this->kategoriPerumahanM->dGetDataAllKategori();
        $bankDataAll = $this->BankM->dGetDataAllBank();
        $DiterimaDataAll = $this->BayarM->dGetDataAllDiterima();
        $MenungguCekDataAll = $this->BayarM->dGetDataAllMenungguCek();
        $DitolakDataAll = $this->BayarM->dGetDataAllDitolak();
        $BelumDibacaDataAll = $this->MessageM->dGetDataAllBelumDibaca();
        $PersetujuanaDataAll = $this->PesananM->dGetDataAllPersetujuan();
        $belumBayar = $this->PesananM->getBelumBayar();
        

        $data = [
            'title' => 'Dashboard Admin | Maestro Putra Timur',
            'countKpr' => count($kprDataAll),
            'countCb' => count($cbDataAll),
            'countCt' => count($ctDataAll),
            'countUser' => count($userDataAll),
            'countProduk' => count($produkDataAll),
            'countKategori' => count($kategoriDataAll),
            'countBank' => count($bankDataAll),
            'countDiterima' => count($DiterimaDataAll),
            'countDitolak' => count($DitolakDataAll),
            'countBelumDibaca' => count($BelumDibacaDataAll),
            'countPersetujuan' => count($PersetujuanaDataAll),
            'countMenungguCek' => count($MenungguCekDataAll),
            'data' => array_reverse($belumBayar)
            
        ];

        // dd($data);


        return view('admin/dashboard', $data);
    }

    // Ketegori Module---------------------------------------------------------------------------------------------------------------------------

    public function kategoriProdukLoad(){
        $data = [
            'title' => 'Kategori Produk | Maestro Putra Timur',
        ];


        return view('admin/kategoriprodukview', $data);
    }

    public function getCategory(){
        $kategoriData = $this->KategoriM->getCategory();
        return json_encode($kategoriData);
    }

    public function postCategory(){

        $namaKategori = $this->request->getVar('nama_kategori');
        $deskripsi = $this->request->getVar('deskripsi');

        $data = [
            'id_kategori' => 'cat-'. uniqid(),
            'nama_kategori' => $namaKategori,
            'deskripsi' => $deskripsi
        ];

        $this->KategoriM->saveCategory($data);
        return json_encode($data);
    }

    public function deleteCategory(){
        $idKategory = $this->request->getVar('id_kategori');

        $this->KategoriM->deleteCategory($idKategory);
        return json_encode($idKategory);
    }

    public function editCategory(){

        $idKategori = $this->request->getVar('id_kategori');
        $namaKategori = $this->request->getVar('nama_kategori');
        $deskripsi = $this->request->getVar('deskripsi');

        $data = [
            'id_kategori' => $idKategori,
            'nama_kategori' => $namaKategori,
            'deskripsi' => $deskripsi
        ];

        $this->KategoriM->putCategory($data);
        return json_encode($data);
    }

    public function serachCategory(){

        $key = $this->request->getVar('searchKey');

        $data = $this->KategoriM->searchCategory($key);

        return json_encode($data);

    }

    // Pengguna Module-----------------------------------------------------------------------------------------------------------------

    public function penggunaLoad(){
        $data = [
            'title' => 'User | Maestro Putra Timur',
        ];


        return view('admin/listpenggunaview', $data);
    }

    public function createNewPenggunaLoad(){
        $data = [
            'title' => 'Buat User Baru | Maestro Putra Timur',
        ];


        return view('admin/listpenggunabaruview', $data);
    }
    
    public function getUser(){
        $data = $this->UserM->getUsers();
        return json_encode($data);
    }

    public function getUserId(){
        $id = $this->request->getVar('userId');
        $data = $this->UserM->getUsersId($id);
        return json_encode($data);
    }

    public function userSuspend(){
        $id = $this->request->getVar('userId');
        $data = [
            'userId' => $id,
            'status' => 'Tidak Aktif'
        ];
        $this->UserM->updateUserStatusSuspend($data);
        return json_encode($data);
    }

    public function userReactive(){
        $id = $this->request->getVar('userId');
        $data = [
            'userId' => $id,
            'status' => 'Aktif'
        ];
        $this->UserM->updateUserStatusReactive($data);
        return json_encode($data);
    }

    public function userSearch(){
        $searchKey =  $this->request->getVar('key');
        $data = $this->UserM->userSearch($searchKey);
        return json_encode($data);
    }
    
    public function saveNewUser(){

        // Create new id

        $createNewUID = 'uid-' . strval(time());
        
        // Hashing password
        $getPassword = $this->request->getVar('password');
        $hashedPass = password_hash($getPassword, PASSWORD_DEFAULT);

        // Handle file upload

        // Upload Profile-picture
        $pp = $this->request->getFile('profile_picture');
        $ppFileName = $pp->getRandomName();
        $pp->store('../../public/assets/images/imagestore/profilepicture', $ppFileName);

        // Upload KTP

        $ktp = $this->request->getFile('scan_ktp');
        $ktpFileName = $ktp->getRandomName();
        $ktp->store('../../public/assets/images/imagestore/ktpkk', $ktpFileName);

        // Upload KK

        $kk = $this->request->getFile('scan_kk');
        $kkFileName = $kk->getRandomName();
        $kk->store('../../public/assets/images/imagestore/ktpkk', $kkFileName);


        $data = [
            'userId' => $createNewUID,
            'full_name' => $this->request->getVar('full_name'),
            'gender' => $this->request->getVar('gender'),
            'address' => $this->request->getVar('address'),
            'phone' => $this->request->getVar('phone'),
            'email' => $this->request->getVar('email'),
            'profile_picture' => $ppFileName,
            'scan_ktp' => $ktpFileName,
            'scan_kk' => $kkFileName,
            'user_level' => $this->request->getVar('level_user'),
            'password' => $hashedPass,
            'status' => 'Aktif',
        ];

        $this->UserM->saveUser($data);

        return redirect()->to('/admin/pengguna');
        
    }

    // My Profile Module -----------------------------------------------------------------------------------------------------------------------------

    public function myProfileLoad(){
        $currentData = session('login');

        $data = [
            'title' => 'Profil Saya | Maestro Putra Timur',
            'userdata' => $currentData
        ];


        return view('admin/myprofile', $data);
    }

    public function getDataUserId(){
        $currentData = session('login');
        return json_encode($currentData);
    }

    public function updateCurrentUser(){
        $session = \Config\Services::session();
        $currentSessionData = session('login');
        $userId = $currentSessionData['userId'];

        $data = [
            'userId' => $userId,
            'full_name' => $this->request->getVar('full_name'),
            'gender' => $this->request->getVar('gender'),
            'address' => $this->request->getVar('address'),
            'phone' => $this->request->getVar('phone'),
            'email' => $this->request->getVar('email'),
            'user_level' => $this->request->getVar('level_user'),
        ];

        $this->UserM->updateGeneralProfile($data);

        $newSession = [
            'userId' => $currentSessionData['userId'],
            'full_name' => $data['full_name'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' =>$data['email'],
            'profile_picture' => $currentSessionData['profile_picture'],
            'scan_ktp' => $currentSessionData['scan_ktp'],
            'scan_kk' => $currentSessionData['scan_kk'],
            'user_level' => $currentSessionData['user_level'],
            'levelID' => $currentSessionData['levelID'],
            'level_name' => $currentSessionData['level_name'],
            'status' => $currentSessionData['status'],
        ];

        $session->remove('login');
        $session->set('login', $newSession);
        $session->setFlashdata('successprofile', 'Profil berhasil diperaharui...');

        return json_encode($newSession);
    }
    
    public function updateCurrentUserProfilePicture(){

        $session = \Config\Services::session();
        $currentSessionData = session('login');

        $pp = $this->request->getFile('profile_picture');
        $ppFileName = $pp->getRandomName();
        $pp->store('../../public/assets/images/imagestore/profilepicture', $ppFileName);

        unlink('assets/images/imagestore/profilepicture/'. $currentSessionData['profile_picture']);
        $data = [
            'userId' => $currentSessionData['userId'],
            'profile_picture' => $ppFileName
        ];



        $this->UserM->updateProfilePicture($data);

        $newSession = [
            'userId' => $currentSessionData['userId'],
            'full_name' => $currentSessionData['full_name'],
            'gender' => $currentSessionData['gender'],
            'address' => $currentSessionData['address'],
            'phone' => $currentSessionData['phone'],
            'email' =>$currentSessionData['email'],
            'profile_picture' => $ppFileName,
            'scan_ktp' => $currentSessionData['scan_ktp'],
            'scan_kk' => $currentSessionData['scan_kk'],
            'user_level' => $currentSessionData['user_level'],
            'levelID' => $currentSessionData['levelID'],
            'level_name' => $currentSessionData['level_name'],
            'status' => $currentSessionData['status'],
        ];

        $session->remove('login');
        $session->set('login', $newSession);
        $session->setFlashdata('successppupdate', 'Foto Profil berhasil diperaharui...');

        return redirect()->to('/admin/profil-saya');
    }

    public function updateCurrentUserKtpPicture(){

        $session = \Config\Services::session();
        $currentSessionData = session('login');

        $ktp = $this->request->getFile('scan_ktp');
        $ktpFileName = $ktp->getRandomName();
        $ktp->store('../../public/assets/images/imagestore/ktp/', $ktpFileName);

        unlink('assets/images/imagestore/ktp/'. $currentSessionData['scan_ktp']);
        $data = [
            'userId' => $currentSessionData['userId'],
            'scan_ktp' => $ktpFileName
        ];



        $this->UserM->updateKtpPicture($data);

        $newSession = [
            'userId' => $currentSessionData['userId'],
            'full_name' => $currentSessionData['full_name'],
            'gender' => $currentSessionData['gender'],
            'address' => $currentSessionData['address'],
            'phone' => $currentSessionData['phone'],
            'email' =>$currentSessionData['email'],
            'profile_picture' => $currentSessionData['profile_picture'],
            'scan_ktp' => $ktpFileName,
            'scan_kk' => $currentSessionData['scan_kk'],
            'user_level' => $currentSessionData['user_level'],
            'levelID' => $currentSessionData['levelID'],
            'level_name' => $currentSessionData['level_name'],
            'status' => $currentSessionData['status'],
        ];

        $session->remove('login');
        $session->set('login', $newSession);
        $session->setFlashdata('successktpupdate', 'KTP berhasil diperaharui...');

        return redirect()->to('/admin/profil-saya');
    }

    public function updateCurrentUserKkPicture(){

        $session = \Config\Services::session();
        $currentSessionData = session('login');

        $kk = $this->request->getFile('scan_kk');
        $kkFileName = $kk->getRandomName();
        $kk->store('../../public/assets/images/imagestore/kk/', $kkFileName);

        unlink('assets/images/imagestore/kk/'. $currentSessionData['scan_kk']);
        $data = [
            'userId' => $currentSessionData['userId'],
            'scan_kk' => $kkFileName
        ];



        $this->UserM->updateKkPicture($data);

        $newSession = [
            'userId' => $currentSessionData['userId'],
            'full_name' => $currentSessionData['full_name'],
            'gender' => $currentSessionData['gender'],
            'address' => $currentSessionData['address'],
            'phone' => $currentSessionData['phone'],
            'email' =>$currentSessionData['email'],
            'profile_picture' => $currentSessionData['profile_picture'],
            'scan_ktp' => $currentSessionData['scan_ktp'],
            'scan_kk' => $kkFileName,
            'user_level' => $currentSessionData['user_level'],
            'levelID' => $currentSessionData['levelID'],
            'level_name' => $currentSessionData['level_name'],
            'status' => $currentSessionData['status'],
        ];

        $session->remove('login');
        $session->set('login', $newSession);
        $session->setFlashdata('successkkupdate', 'KK berhasil diperaharui...');

        return redirect()->to('/admin/profil-saya');
    }

    // Kategori Perumahan Module


    public function kategoriPerumahanLoad(){

        // get all data from database and render it.

        $perumahanData = $this->kategoriPerumahanM->getPerumahan();


        $data = [
            'title' => 'Kategori Rumah | Maestro Putra Timur',
            'perumahanData' => $perumahanData
        ];


        return view('admin/kategori_perumahan_vierw/kategoriperumahanview', $data);

    }

    public function postPerumahan(){
        // Simpan data kategori perumahan ke database

        $session = \Config\Services::session();

        $data = [
            'id_perumahan' => 'perum-'. uniqid(),
            'nama_perumahan' => $this->request->getVar('nama_perumahan'),
            'keterangan_perumahan' => $this->request->getVar('keterangan_perumahan'),
            'lokasi_perumahan' => $this->request->getVar('lokasi_perumahan'),
        ];

        $this->kategoriPerumahanM->postPerumahan($data);
        
        $session->setFlashdata('success','Perumahan berhasil ditambahkan');

        return redirect()->to('/admin/kategori-perumahan');
    }

    public function deletePerumahan(){
        $id = $this->request->getVar('id');
        
        $this->kategoriPerumahanM->deletePerumahan($id);
        // return json_encode($id);
    }

    public function getDataPerumahanId(){
        $id = $this->request->getVar('id');

        $data = $this->kategoriPerumahanM->getPerumahanId($id);

        return json_encode($data);
    }

    public function putPerumahan(){
        
        $data = [
            'id_perumahan' => $this->request->getVar('id_perumahan'),
            'nama_perumahan' => $this->request->getVar('nama_perumahan'),
            'keterangan_perumahan' => $this->request->getVar('keterangan_perumahan'),
            'lokasi_perumahan' => $this->request->getVar('lokasi_perumahan'),
        ];

        $this->kategoriPerumahanM->putPerumahanId($data);

        return redirect()->to('/admin/kategori-perumahan');
    }


    // Content Modul ----------------------------------------------------------------------------------------------------------
    
    public function contentLoad(){
        $kontenData = $this->KontenM->getKonten();
        $currentData = session('login');
        
        $data = [
            'title' => 'Atur Kontent Saya | Maestro Putra Timur',
            'kontenData' => $kontenData
        ];


        return view('admin/kontent_view/content', $data);
    }

    public function updatecontentlogo(){
        $session = \Config\Services::session();
        $data = $this->request->getFile('logo_pic');
        $datavalidation = $this->validate([
            'logo_pic' => 'is_image[logo_pic]',
        ]);


        if($datavalidation){
            $oldData = $this->KontenM->getKonten();
            $dataname = $data->getRandomName();
            $fileType = $data->getClientMimeType();
            $data->store('../../public/assets/images/imagestore/konten', $dataname);
            unlink('assets/images/imagestore/konten/'. $oldData[0]['logo_pic']);

            $logoData = [
                'id_content' => 'cont-001',
                'file_name' => $dataname,
            ];

            $this->KontenM->updateLogo($logoData);
            $session->setFlashdata('success', 'Logo berhasil diperbaharui');

            return redirect()->to('/admin/atur-konten');
        } else{
            $session->setFlashdata('failed', 'Gambar yang anda unggah tidak berekstensi jpg|jpeg|png|gif');

            return redirect()->to('/admin/atur-konten');
        }
        
    }

    public function updatecontentillustration(){
        $session = \Config\Services::session();
        $data = $this->request->getFile('front_illustration_pic');
        $datavalidation = $this->validate([
            'front_illustration_pic' => 'is_image[front_illustration_pic]',
        ]);

        if($datavalidation){
            $oldData = $this->KontenM->getKonten();
            $dataname = $data->getRandomName();
            $fileType = $data->getClientMimeType();
            $data->store('../../public/assets/images/imagestore/konten', $dataname);
            unlink('assets/images/imagestore/konten/'. $oldData[0]['front_illustration_pic']);

            $illusData = [
                'id_content' => 'cont-001',
                'file_name' => $dataname,
            ];

            $this->KontenM->updateIllustration($illusData);
            $session->setFlashdata('success', 'Illustrasi berhasil diperbaharui');

            return redirect()->to('/admin/atur-konten');
        } else{
            $session->setFlashdata('failed', 'Gambar yang anda unggah tidak berekstensi jpg|jpeg|png|gif');

            return redirect()->to('/admin/atur-konten');
        }
        // dd($datavalidation);
        
    }

    public function updateTeksKonten(){
        $session = \Config\Services::session();
        $data = [
            'id_content' => 'cont-001',
            'brand_name' => $this->request->getVar('brand_name'),
            'slogan' => $this->request->getVar('slogan'),
            'keterangan_slogan' => $this->request->getVar('keterangan_slogan'),
            'tentang_kami' => $this->request->getVar('tentang_kami'),
            'alamat' => $this->request->getVar('alamat'),
            'wa' => $this->request->getVar('wa'),
            'email' => $this->request->getVar('email'),
            'fb' => $this->request->getVar('fb'),
            'ig' => $this->request->getVar('ig'),
            'cara_pemesanan' => $this->request->getVar('cara_pemesanan'),
        ];

        $this->KontenM->updateTeks($data);

        $session->setFlashdata('success', 'Konten berhasil diperbaharui');

        return redirect()->to('/admin/atur-konten');
    }

    // Produk Module

    public function produkPerumahanLoad(){

        $dataPerumahan = $this->ProdukM->getProduk();


        $data = [
            'title' => 'Kategori Produk | Maestro Putra Timur',
            'data' => $dataPerumahan,
            'pager' => $this->ProdukM->pager
        ];


        return view('admin/produk_view/produkview', $data);
    }


    public function newProductForm(){

        $dataPerumahan = $this->kategoriPerumahanM->getPerumahan();
        $namaPerumahanArray =  [];
        
        
        foreach ($dataPerumahan as $dp) {
            array_push($namaPerumahanArray, $dp['nama_perumahan']);
        };

        
        $data= [
            'title' => 'Tambah Produk Baru',
            'kategori' => $namaPerumahanArray,
        ];

        // dd($data);
        return view('/admin/produk_view/newproductform.php', $data);
    }

    public function postProduk(){
        
        $produkPic = $this->request->getFileMultiple('product_pic');
        
        $produkPicName = [];
        
        foreach($produkPic as $pp){
            $ppName = $pp->getRandomName();
            array_push($produkPicName, $ppName);
            $pp->store('../../public/assets/images/imagestore/produk', $ppName);
        }

        
        $data = [
            'id_produk' => 'pro-'. uniqid(),
            'judul_p' => $this->request->getVar('judul_p'),
            'harga_normal' => $this->request->getVar('harga_normal'),
            'harga_diskon' => $this->request->getVar('harga_diskon'),
            'kategori_p' => $this->request->getVar('kategori_p'),
            'alamat' => $this->request->getVar('alamat'),
            'subsidi' => $this->request->getVar('subsidi'),
            'kt' => $this->request->getVar('kt'),
            'km' => $this->request->getVar('km'),
            'luas_area' => $this->request->getVar('luas_area'),
            'panjang_bangunan' => $this->request->getVar('panjang_bangunan'),
            'lebar_bangunan' => $this->request->getVar('lebar_bangunan'),
            'listrik' => $this->request->getVar('listrik'),
            'air' => $this->request->getVar('air'),
            'unit_tersisa' => $this->request->getVar('unit_tersisa'),
            'jumlah_unit' => $this->request->getVar('jumlah_unit'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'product_pic' => json_encode( $produkPicName),
            'status' => $this->request->getVar('status'),
            'created_at' => date("d-m-Y"),
            'updated_at' => date("d-m-Y")
        ];
        
        $this->ProdukM->postProduk($data);

        $session = \Config\Services::session();

        $session->setFlashdata('success', 'Produk Berhasil Disimpan');

        return redirect()->to('/admin/daftar-produk');

        
    }
    
    public function deleteProduk(){
        $id = $this->request->getVar('id');
        
        $oldData = $this->ProdukM->getProdukId($id);

        $oldPic = $oldData[0]['product_pic'];

        $oldPicDelete = json_decode($oldPic);

        $pic = $oldPicDelete;

        for($i = 0; $i < count($pic); $i++ ){
            unlink('assets/images/imagestore/produk/'. $pic[$i]);
        }

        $this->ProdukM->deleteProduk($id);

        $session = \Config\Services::session();

        $session->setFlashdata('success', 'Produk Berhasil Dihapus');

        return json_encode($pic);
    }

    public function produkPerumahanDetailLoad(){

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);
        $parameter = implode(' ', explode('-', $lastUrl));

        $dataPerumahan = $this->ProdukM->getProdukName($parameter);

        $data = [
            'title' => 'Detail Produk | Maestro Putra Timur',
            'data' => $dataPerumahan[0],
        ];


        return view('admin/produk_view/produkviewdetail', $data);
    }

    public function produkPerumahanEditLoad(){

        $dataPerumahan = $this->kategoriPerumahanM->getPerumahan();
        $namaPerumahanArray =  [];

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);
        $parameter = implode(' ', explode('-', $lastUrl));

        $dataPerumahanResult = $this->ProdukM->getProdukName($parameter);
        
        
        foreach ($dataPerumahan as $dp) {
            array_push($namaPerumahanArray, $dp['nama_perumahan']);
        };

        
        $data= [
            'title' => 'Tambah Produk Baru',
            'kategori' => $namaPerumahanArray,
            'data' => $dataPerumahanResult[0]
        ];


        return view('admin/produk_view/produkeditview', $data);
    }

    public function putProduk(){

        $produkPic = $this->request->getFileMultiple('product_pic');

        $idProduk = $this->request->getVar('id_produk');

        if($produkPic[0] == ''){
            $updatedata = [
                'id_produk' => $this->request->getVar('id_produk'),
                'judul_p' => $this->request->getVar('judul_p'),
                'harga_normal' => $this->request->getVar('harga_normal'),
                'harga_diskon' => $this->request->getVar('harga_diskon'),
                'kategori_p' => $this->request->getVar('kategori_p'),
                'alamat' => $this->request->getVar('alamat'),
                'subsidi' => $this->request->getVar('subsidi'),
                'kt' => $this->request->getVar('kt'),
                'km' => $this->request->getVar('km'),
                'luas_area' => $this->request->getVar('luas_area'),
                'panjang_bangunan' => $this->request->getVar('panjang_bangunan'),
                'lebar_bangunan' => $this->request->getVar('lebar_bangunan'),
                'listrik' => $this->request->getVar('listrik'),
                'air' => $this->request->getVar('air'),
                'unit_tersisa' => $this->request->getVar('unit_tersisa'),
                'jumlah_unit' => $this->request->getVar('jumlah_unit'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'status' => $this->request->getVar('status'),
                'updated_at' => date("d-m-Y")
            ];
    
            
            $this->ProdukM->putProduk($updatedata);
            $session = \Config\Services::session();
            
            $session->setFlashdata('success', 'Produk berhasil diupdate');
    
            return redirect()->to('/admin/daftar-produk');
        
        } else {
            $produkPicName = [];
        
            foreach($produkPic as $pp){
                $ppName = $pp->getRandomName();
                array_push($produkPicName, $ppName);
                $pp->store('../../public/assets/images/imagestore/produk', $ppName);
            }
            $updatedata = [
                'id_produk' => $this->request->getVar('id_produk'),
                'judul_p' => $this->request->getVar('judul_p'),
                'harga_normal' => $this->request->getVar('harga_normal'),
                'harga_diskon' => $this->request->getVar('harga_diskon'),
                'kategori_p' => $this->request->getVar('kategori_p'),
                'alamat' => $this->request->getVar('alamat'),
                'subsidi' => $this->request->getVar('subsidi'),
                'kt' => $this->request->getVar('kt'),
                'km' => $this->request->getVar('km'),
                'luas_area' => $this->request->getVar('luas_area'),
                'panjang_bangunan' => $this->request->getVar('panjang_bangunan'),
                'lebar_bangunan' => $this->request->getVar('lebar_bangunan'),
                'listrik' => $this->request->getVar('listrik'),
                'air' => $this->request->getVar('air'),
                'unit_tersisa' => $this->request->getVar('unit_tersisa'),
                'jumlah_unit' => $this->request->getVar('jumlah_unit'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'product_pic' => json_encode( $produkPicName),
                'status' => $this->request->getVar('status'),
                'updated_at' => date("d-m-Y")
            ];

            $oldData = $this->ProdukM->getProdukId($idProduk);

            $oldPic = $oldData[0]['product_pic'];

            $oldPicDelete = json_decode($oldPic);

            $pic = $oldPicDelete;

            for($i = 0; $i < count($pic); $i++ ){
                unlink('assets/images/imagestore/produk/'. $pic[$i]);
            }

            

            $this->ProdukM->putProdukWimg($updatedata);
            $session = \Config\Services::session();
            
            $session->setFlashdata('success', 'Produk berhasil diupdate');
    
            return redirect()->to('/admin/daftar-produk');


            
        }

        
        
    }

    public function ProdukPerumahanCari(){
        $searchKey = $this->request->getVar('cariProduk');

        $dataPerumahan = $this->ProdukM->searchProduct($searchKey);

        $data = [
            'title' => 'Kategori Produk | Maestro Putra Timur',
            'data' => $dataPerumahan,
            'pager' => $this->ProdukM->pager
        ];


        return view('admin/produk_view/produkview', $data);
    }

    // Module Pesan


    public function loadPesan(){
        $dataPesan = $this->MessageM->getPesan();

        $arrayDibaca = 0;
        $arrarBelumDibaca = 0;

        for($i = 0; $i < sizeof($dataPesan); $i++ ){
            if($dataPesan[$i]['status']=='Dibaca'){
                $arrayDibaca++;
            }
            else{
                $arrarBelumDibaca++;
            }
        }

        $data = [
            'title' => 'Pesan | Maestro Putra Timur',
            'pager' => $this->MessageM->pager,
            'dataPesan' => $dataPesan,
            'dibaca' => $arrayDibaca,
            'belumDibaca' => $arrarBelumDibaca,
            'totalPesan' => $arrayDibaca + $arrarBelumDibaca
        ];

        return view('admin/pesan_pengguna/pesanPenggunaView', $data);
    }

    public function getPesanId(){

        $id = $this->request->getVar('id');
        $idProduk = $this->request->getVar('id_produk');

        $this->MessageM->updateStatus($id);

        $dataProduk = $this->ProdukM->getProdukId($idProduk);
        $dataPesan = $this->MessageM->getPesanId($id);
        

        $data = [
            'dataPesan' => $dataPesan[0],
            'namaproduk' => $dataProduk[0]['judul_p'],
        ];

        return json_encode($data);
        
        
    }
    
    public function deletePesan(){
        $id = $this->request->getVar('id');

        $this->MessageM->deletePesan($id);

        return json_encode($id);
    }

    // Modul Pesanan

    public function loadPesanan(){

        $dataPesanan = $this->PesananM->getPesanan();

        $data = [
            'title' => 'Daftar Pesanan | Maestro Putra Timur',
            'data' => array_reverse($dataPesanan),
            'pager' => $this->PesananM->pager
        ];

        

        return view('admin/pesanan_view/pesananview', $data);
    }

    public function loadPesananDetail(){

        $url = explode('/',$_SERVER['PHP_SELF']);
        $id = end($url);

        $dataPesanan = $this->PesananM->getPesananId($id);

        // dd($dataPesanan);

        $data = [
            'title' => 'Daftar Pesanan | Maestro Putra Timur',
            'data' => $dataPesanan[0],
        ];

        return view('admin/pesanan_view/pesanandetailview', $data);
    }

    public function loadPesananEdit(){

        $url = explode('/',$_SERVER['PHP_SELF']);
        $id = end($url);

        $dataPesanan = $this->PesananM->getPesananId($id);
        $dataBank = $this->BankM->getBank();

        // dd($dataPesanan);

        $data = [
            'title' => 'Daftar Pesanan | Maestro Putra Timur',
            'data' => $dataPesanan[0],
            'bankData' => $dataBank
        ];

        return view('admin/pesanan_view/pesananEditview', $data);
    }

    public function ubahPesanan(){
        $session = \Config\Services::session();

        $data = [
            'id_pesanan' => $this->request->getVar('id_pesanan'),
            'bank' => $this->request->getVar('bank'),
            'pembayaran' => $this->request->getVar('pembayaran'),
        ];

        $this->PesananM->ubahPesanan($data);
        
        $session->setFlashdata('success', 'Data berhasil diubah');

        return redirect()->to('/admin/pesanan');
        
    }

    public function deletePesanan(){
        $id = $this->request->getVar('id');

        $this->PesananM->deletePesanan($id);

        $session = \Config\Services::session();

        $session->setFlashdata('success', 'Pesanan Berhasil Dihapus');

        return json_encode($id);
    }

    public function konfirmasiPesanan(){
        $id = $this->request->getVar('id');
        $konfirmasi = $this->request->getVar('konfirmasi');
        $dataPesananAll = $this->PesananM->getPesananId($id);
        $dataPesanan = $dataPesananAll[0];


        $data = [
            'id' => $id,
            'status' => $konfirmasi,
            'metodePembayaran' =>$dataPesanan['pembayaran'],
            'status_bank' => $konfirmasi,
        ];

        
        $this->PesananM->konfirmasiPesanan($data);

        return json_encode($data);
    }

    public function getPesananCbDatatoDownload(){
        $data = $this->PesananM->getPesananDatatoDownload('Cash Bertahap');
        return json_encode($data);
    }

    public function getPesananKprDatatoDownload(){
        $data = $this->PesananM->getPesananDatatoDownload('KPR');
        return json_encode($data);
    }

    public function cariCbData(){
        $key = $this->request->getVar('searchKey');

        if($key == null){
            $key = '';
        }


        $dataCari = [
            'key' => $key,
            'pembayaran' => 'Cash Bertahap'
        ];
        

        $dataCb = $this->PesananM->cariCbData($key);

        $data = [
            'title' => 'Cash Bertahap Pesanan | Maestro Putra Timur',
            'data' => array_reverse($dataCb),
            'pager' => $this->PesananM->pager
        ];

        // dd($data);

        return view('admin/cashbertahap_view/cbview', $data);

        // 
    }

    public function cariCtData(){
        $key = $this->request->getVar('searchKey');

        $dataCari = [
            'key' => $key,
            'pembayaran' => 'Cash Tunai'
        ];
        

        $dataCb = $this->PesananM->cariCtData($dataCari);

        $data = [
            'title' => 'Cash Bertahap Pesanan | Maestro Putra Timur',
            'data' => array_reverse($dataCb),
            'pager' => $this->PesananM->pager
        ];

        // dd($data);

        return view('admin/cashtunai_view/ctview', $data);
    }

    // Module Riwayat Penjualan

    public function loadRiwayatPesanan(){

        $dataPesanan = $this->PesananM->getPesananAll();

        $data = [
            'title' => 'Riwayat Pesanan | Maestro Putra Timur',
            'data' => array_reverse($dataPesanan),
            'pager' => $this->PesananM->pager
        ];

        // dd($data);

        return view('admin/riwayat_pesanan_view/riwayatpesananview', $data);
    }

    public function loadRiwayatPesananDetail(){

        $url = explode('/',$_SERVER['PHP_SELF']);
        $id = end($url);

        $dataPesanan = $this->PesananM->getPesananId($id);

        // dd($dataPesanan);

        $data = [
            'title' => 'Daftar Pesanan | Maestro Putra Timur',
            'data' => $dataPesanan[0],
        ];

        return view('admin/riwayat_pesanan_view/riwayatpesanandetailview', $data);
    }

    public function pesananCari(){
        $key = $this->request->getVar('searchKey');

        if($key == null){
            $key = '';
        }

        $dataPesanan = $this->PesananM->searchPesananAll($key);

        $data = [
            'title' => 'Riwayat Pesanan | Maestro Putra Timur',
            'data' => array_reverse($dataPesanan),
            'pager' => $this->PesananM->pager
        ];

        // dd($data);

        return view('admin/riwayat_pesanan_view/riwayatpesananview', $data);
    }

    // Kpr Module

    public function loadKpr(){

        $dataKpr = $this->PesananM->getPesananAllKpr();

        $data = [
            'title' => 'Daftar Pesanan | Maestro Putra Timur',
            'data' => array_reverse($dataKpr),
            'pager' => $this->PesananM->pager
        ];

        // dd($data);

        return view('admin/kpr_view/kprview', $data);
    }

    public function cariKprData(){
        $key = $this->request->getVar('searchKey');

        if($key == null){
            $key = '';
        }


        $dataCari = [
            'key' => $key,
            'pembayaran' => 'Cash Bertahap'
        ];
        

        $dataCb = $this->PesananM->cariKprData($key);

        $data = [
            'title' => 'Cash Bertahap Pesanan | Maestro Putra Timur',
            'data' => array_reverse($dataCb),
            'pager' => $this->PesananM->pager
        ];

        // dd($data);

        return view('admin/kpr_view/kprview', $data);

        // 
    }

    // public function loadKprDetail(){

    //     $url = explode('/',$_SERVER['PHP_SELF']);
    //     $lastUrl = end($url);

    //     $dataKpr = $this->BayarM->getBayarBelum($lastUrl);
    //     $datacek = $this->BayarM->getBayarCek($lastUrl);
    //     $datalunas = $this->BayarM->getBayarLunas($lastUrl);
    //     $dataTolak = $this->BayarM->getBayarTolak($lastUrl);


    //     $data = [
    //         'title' => 'Daftar Pesanan | Maestro Putra Timur',
    //         'data' => $dataKpr,
    //         'datacek' => $datacek,
    //         'datalunas' => $datalunas,
    //         'dataTolak' => $dataTolak,

    //     ];

    //     // dd($data);

    //     return view('admin/kpr_view/kprdetailview', $data);
    // }

    public function loadCekPembayaran(){

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);
        $idPembayaran = $lastUrl;

        $dataPembayaran = $this->BayarM->getDataBayarId($idPembayaran);

        $data = [
            'title' => 'Daftar Pesanan | Maestro Putra Timur',
            'data' => $dataPembayaran[0],
        ];


        return view('admin/cashbertahap_view/cekcbbayarview', $data);
    }

    // public function loadDetailPembayaran(){

    //     $url = explode('/',$_SERVER['PHP_SELF']);
    //     $lastUrl = end($url);
    //     $idPembayaran = $lastUrl;

    //     $dataPembayaran = $this->BayarM->getDataBayarId($idPembayaran);

    //     $data = [
    //         'title' => 'Daftar Pesanan | Maestro Putra Timur',
    //         'data' => $dataPembayaran[0],
    //     ];


    //     return view('admin/kpr_view/detailkprbayarview', $data);
    // }

    // public function loadPembayaranKpr(){

    //     $url = explode('/',$_SERVER['PHP_SELF']);
    //     $id = end($url);

    //     $dataPembayaran = $this->BayarM->getDataBayarId($id);
    //     $bankData = $this->BankM->getBank();


    //     $data = [
    //         'title' => 'Daftar Pesanan | Maestro Putra Timur',
    //         'data' => $dataPembayaran[0],
    //         'bankData' => $bankData
    //     ];

    //     return view('admin/kpr_view/bayarkprview', $data);
    // }

    // public function aturKpr(){


    //     $data = [
    //         'title' => 'Atur KPR  | Maestro Putra Timur',
    //     ];

    //     return view('admin/kpr_view/formaturkprview', $data);
    // }
    
    // public function simpanPengaturanKpr(){
        
    //     $session = \Config\Services::session();
    //     date_default_timezone_set('Asia/Jakarta');

    //     $uangMuka = $this->request->getVar('uang_muka');
    //     $jumlahBunga = $this->request->getVar('jumlah_bunga');
    //     $lamaBulanan = $this->request->getVar('lama_bulanan');
    //     $bayarBulanan = $this->request->getVar('bayar_bulanan');
        
    //     $totalBayar = $bayarBulanan * $lamaBulanan;
    //     $sisaBayar = $totalBayar - $uangMuka;
        

    //     $data = [
    //         'id_kpr' => 'kpr-' . uniqid(),
    //         'id_pesanan' => $this->request->getVar('id_pesanan'),
    //         'total_pembayaran' => $totalBayar,
    //         'uang_muka' => $uangMuka,
    //         'jumlah_bunga' => $jumlahBunga,
    //         'lama_bulanan' => $lamaBulanan,
    //         'bayar_bulanan' => $bayarBulanan,
    //         'kpr_created_at' => date("l jS \of F Y h:i:s A", time()),
    //     ];

    //     $kprStatus = [
    //         'id' => $data['id_pesanan'],
    //         'status' => 1,
    //         'id_kpr' =>$data['id_kpr']
    //     ];

    //     $this->PesananM->setKprStatus($kprStatus);

    //     $this->KprM->saveKpr($data);

    //     for($i = 0; $i < $lamaBulanan; $i++){
    //         $bulan = $i + 1;
    //         $dataBayar = [
    //             'id_pembayaran' => 'bayar-' . uniqid(),
    //             'id_metode_pembayaran' => $data['id_kpr'],
    //             'jumlah_bayar' => $data['bayar_bulanan'],
    //             'keterangan_pembayaran' => 'Pembayaran Bulan ke ' . $bulan,
    //             'keterangan_pembayar' => '',
    //             'status_pembayaran' => 'sudah dibayar',
    //             'tanggal_pembayaran' => '',
    //             'bank_pemmbayaran' => '',
    //             'bukti_pembayaran' => '',
    //         ];

    //         $this->BayarM->postPembayaran($dataBayar);

    //     }


    //     $session->setFlashdata('success', 'KPR berhasil di setting');

        
    //     return redirect()->to('/admin/kpr');

    // }


    public function confirmPayment(){
        $session = \Config\Services::session();
        $idCb = $this->request->getVar('id_metode_pembayaran');
        $idPembayaran = $this->request->getVar('id_pembayaran');
        $statusPembayaran = $this->request->getVar('status_pembayaran');
        $keteranganStatus = $this->request->getVar('keterangan_status');

        $data = [
            'id_pembayaran' => $idPembayaran,
            'status_pembayaran' => $statusPembayaran,
            'keterangan_status' => $keteranganStatus,
        ];

        // dd($data);

        $this->BayarM->confirmPayment($data);

        $session->setFlashdata('success', 'Pembayaran berhasil diverifikasi');

        return redirect()->to('/admin/cash-bertahap-detail/' . $idCb);

    }

    // public function updatePembayaran(){
    //     $session = \Config\Services::session();
    //     date_default_timezone_set('Asia/Jakarta');
    //     $pp = $this->request->getFile('bukti_pembayaran');
    //     $ppFileName = $pp->getRandomName();
    //     $pp->store('../../public/assets/images/imagestore/buktipembayaran', $ppFileName);
    //     $idPembayaran = $this->request->getVar('id_pembayaran');

    //     $userData = session('login');
    //     $bayarDataAll = $this->BayarM->getDataBayarId($idPembayaran);
    //     $bayarData = $bayarDataAll[0];


    //     $data = [
    //         'id_pembayaran' => $this->request->getVar('id_pembayaran'),
    //         'keterangan_pembayar' => $userData['full_name'],
    //         'status_pembayaran' => 'sudah dibayar',
    //         'tanggal_pembayaran' => date("l jS \of F Y h:i:s A", time()),
    //         'bank_pembayaran' => $this->request->getVar('bank_pembayaran'),
    //         'bukti_pembayaran' => $ppFileName,
    //     ];


    //     $this->BayarM->getBayarCekByCustomer($data);
    //     $session->setFlashdata('success', 'Pembayaran berhasil dailakukan');

    //     return redirect()->to('/admin/kpr-detail/'. $bayarData['id_metode_pembayaran']);
    // }

    // Cash Betahap Module

    public function loadcashbertahap(){
        $dataCb = $this->PesananM->getPesananAllCb();

        $data = [
            'title' => 'Cash Bertahap Pesanan | Maestro Putra Timur',
            'data' => array_reverse($dataCb),
            'pager' => $this->PesananM->pager
        ];

        // dd($data);

        return view('admin/cashbertahap_view/cbview', $data);

    }

    public function aturCb(){


        $data = [
            'title' => 'Atur Cash Bertahap  | Maestro Putra Timur',
        ];

        return view('admin/cashbertahap_view/formaturcbview', $data);
    }

    public function simpanPengaturanCb(){
        
        $session = \Config\Services::session();
        date_default_timezone_set('Asia/Jakarta');

        $uangMuka = $this->request->getVar('uang_muka');
        $jumlahBunga = $this->request->getVar('jumlah_bunga');
        $lamaBulanan = $this->request->getVar('lama_bulanan');
        $bayarBulanan = $this->request->getVar('bayar_bulanan');
        
        $totalBayar = $bayarBulanan * $lamaBulanan;
        $sisaBayar = $totalBayar - $uangMuka;
        

        $data = [
            'id_cb' => 'cb-' . uniqid(),
            'id_pesanan' => $this->request->getVar('id_pesanan'),
            'total_pembayaran' => $totalBayar,
            'uang_muka' => $uangMuka,
            'jumlah_bunga' => $jumlahBunga,
            'lama_bulanan' => $lamaBulanan,
            'bayar_bulanan' => $bayarBulanan,
            'kpr_created_at' => date("l jS \of F Y h:i:s A", time()),
        ];

        $cbStatus = [
            'id' => $data['id_pesanan'],
            'status' => 1,
            'id_cash_bertahap' =>$data['id_cb']
        ];

        $this->PesananM->setCbStatus($cbStatus);

        $this->CbM->saveCb($data);

        for($i = 0; $i < $lamaBulanan; $i++){
            $bulan = $i + 1;
            $dataBayar = [
                'id_pembayaran' => 'bayar-' . uniqid(),
                'id_metode_pembayaran' => $data['id_cb'],
                'jumlah_bayar' => $data['bayar_bulanan'],
                'keterangan_pembayaran' => 'Pembayaran Bulan ke ' . $bulan,
                'keterangan_pembayar' => '',
                'status_pembayaran' => 'belum dibayar',
                'tanggal_pembayaran' => '',
                'bank_pemmbayaran' => '',
                'bukti_pembayaran' => '',
            ];

            $this->BayarM->postPembayaran($dataBayar);

        }


        $session->setFlashdata('success', 'Cash Bertahap berhasil di setting');

        
        return redirect()->to('/admin/cash-bertahap');

    }

    public function loadCbDetail(){

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);

        $dataCb = $this->BayarM->getBayarBelum($lastUrl);
        $datacek = $this->BayarM->getBayarCek($lastUrl);
        $datalunas = $this->BayarM->getBayarLunas($lastUrl);
        $dataTolak = $this->BayarM->getBayarTolak($lastUrl);


        $data = [
            'title' => 'Daftar Pesanan | Maestro Putra Timur',
            'data' => $dataCb,
            'datacek' => $datacek,
            'datalunas' => $datalunas,
            'dataTolak' => $dataTolak,

        ];

        // dd($data);

        return view('admin/cashbertahap_view/cbdetailview', $data);
    }

    public function loadPembayaranCb(){

        $url = explode('/',$_SERVER['PHP_SELF']);
        $id = end($url);

        $dataPembayaran = $this->BayarM->getDataBayarId($id);
        $bankData = $this->BankM->getBank();


        $data = [
            'title' => 'Daftar Pesanan | Maestro Putra Timur',
            'data' => $dataPembayaran[0],
            'bankData' => $bankData
        ];

        return view('admin/cashbertahap_view/bayarcbview', $data);
    }

    public function updatePembayarancb(){
        $session = \Config\Services::session();
        date_default_timezone_set('Asia/Jakarta');
        $pp = $this->request->getFile('bukti_pembayaran');
        $ppFileName = $pp->getRandomName();
        $pp->store('../../public/assets/images/imagestore/buktipembayaran', $ppFileName);
        $idPembayaran = $this->request->getVar('id_pembayaran');

        $userData = session('login');
        $bayarDataAll = $this->BayarM->getDataBayarId($idPembayaran);
        $bayarData = $bayarDataAll[0];


        $data = [
            'id_pembayaran' => $this->request->getVar('id_pembayaran'),
            'keterangan_pembayar' => $userData['full_name'],
            'status_pembayaran' => 'sudah dibayar',
            'tanggal_pembayaran' => date("l jS \of F Y h:i:s A", time()),
            'bank_pembayaran' => $this->request->getVar('bank_pembayaran'),
            'bukti_pembayaran' => $ppFileName,
        ];


        $this->BayarM->getBayarCekByCustomer($data);
        $session->setFlashdata('success', 'Pembayaran berhasil dailakukan');

        return redirect()->to('/admin/cash-bertahap-detail/'. $bayarData['id_metode_pembayaran']);
    }

    public function loadDetailPembayaranCb(){

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);
        $idPembayaran = $lastUrl;

        $dataPembayaran = $this->BayarM->getDataBayarId($idPembayaran);

        $data = [
            'title' => 'Daftar Pesanan | Maestro Putra Timur',
            'data' => $dataPembayaran[0],
        ];


        return view('admin/cashbertahap_view/detailcbbayarview', $data);
    }

    public function loadCekPembayarancb(){

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);
        $idPembayaran = $lastUrl;

        $dataPembayaran = $this->BayarM->getDataBayarId($idPembayaran);

        $data = [
            'title' => 'Daftar Pesanan | Maestro Putra Timur',
            'data' => $dataPembayaran[0],
        ];


        return view('admin/cashbertahap_view/cekcbbayarview', $data);
    }

    // Cash Tunai Module

    public function loadcashtunai(){
        $dataCt = $this->PesananM->getPesananAllCt();

        $data = [
            'title' => 'Cash Bertahap Pesanan | Maestro Putra Timur',
            'data' => array_reverse($dataCt),
            'pager' => $this->PesananM->pager
        ];

        // dd($data);

        return view('admin/cashtunai_view/ctview', $data);
    }

    public function getPesananCtDatatoDownload(){
        $data = $this->PesananM->getPesananDatatoDownload('Cash Tunai');
        return json_encode($data);
    }

    public function aturCt(){

        $data = [
            'title' => 'Atur Cash Bertahap  | Maestro Putra Timur',
        ];

        return view('admin/cashtunai_view/formaturctview', $data);
    }

    public function simpanPengaturanCt(){
        
        $session = \Config\Services::session();
        date_default_timezone_set('Asia/Jakarta');

        $uangMuka = $this->request->getVar('uang_muka');
        $jumlahBunga = $this->request->getVar('jumlah_bunga');
        $lamaBulanan = $this->request->getVar('lama_bulanan');
        $bayarBulanan = $this->request->getVar('bayar_bulanan');
        
        $totalBayar = $bayarBulanan * $lamaBulanan;
        $sisaBayar = $totalBayar - $uangMuka;
        

        $data = [
            'id_ct' => 'ct-' . uniqid(),
            'id_pesanan' => $this->request->getVar('id_pesanan'),
            'total_pembayaran' => $totalBayar,
            'uang_muka' => $uangMuka,
            'jumlah_bunga' => $jumlahBunga,
            'lama_bulanan' => $lamaBulanan,
            'bayar_bulanan' => $bayarBulanan,
            'kpr_created_at' => date("l jS \of F Y h:i:s A", time()),
        ];

        $ctStatus = [
            'id' => $data['id_pesanan'],
            'status' => 1,
            'id_cash_tunai' =>$data['id_ct']
        ];

        $this->PesananM->setCtStatus($ctStatus);

        $this->CtM->saveCt($data);

        for($i = 0; $i < $lamaBulanan; $i++){
            $bulan = $i + 1;
            $dataBayar = [
                'id_pembayaran' => 'bayar-' . uniqid(),
                'id_metode_pembayaran' => $data['id_ct'],
                'jumlah_bayar' => $data['bayar_bulanan'],
                'keterangan_pembayaran' => 'Pembayaran Bulan ke ' . $bulan,
                'keterangan_pembayar' => '',
                'status_pembayaran' => 'belum dibayar',
                'tanggal_pembayaran' => '',
                'bank_pemmbayaran' => '',
                'bukti_pembayaran' => '',
            ];

            $this->BayarM->postPembayaran($dataBayar);

        }


        $session->setFlashdata('success', 'Cash Bertahap berhasil di setting');

        
        return redirect()->to('/admin/cash-tunai');

    }
    public function loadCtDetail(){

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);

        $dataCt = $this->BayarM->getBayarBelum($lastUrl);
        $datacek = $this->BayarM->getBayarCek($lastUrl);
        $datalunas = $this->BayarM->getBayarLunas($lastUrl);
        $dataTolak = $this->BayarM->getBayarTolak($lastUrl);


        $data = [
            'title' => 'Daftar Pesanan | Maestro Putra Timur',
            'data' => $dataCt,
            'datacek' => $datacek,
            'datalunas' => $datalunas,
            'dataTolak' => $dataTolak,

        ];

        // dd($data);

        return view('admin/cashtunai_view/ctdetailview', $data);
    }

    public function loadPembayaranCt(){

        $url = explode('/',$_SERVER['PHP_SELF']);
        $id = end($url);

        $dataPembayaran = $this->BayarM->getDataBayarId($id);
        $bankData = $this->BankM->getBank();


        $data = [
            'title' => 'Daftar Pesanan | Maestro Putra Timur',
            'data' => $dataPembayaran[0],
            'bankData' => $bankData
        ];

        return view('admin/cashtunai_view/bayarctview', $data);
    }

    public function updatePembayaranct(){
        $session = \Config\Services::session();
        date_default_timezone_set('Asia/Jakarta');
        $pp = $this->request->getFile('bukti_pembayaran');
        $ppFileName = $pp->getRandomName();
        $pp->store('../../public/assets/images/imagestore/buktipembayaran', $ppFileName);
        $idPembayaran = $this->request->getVar('id_pembayaran');

        $userData = session('login');
        $bayarDataAll = $this->BayarM->getDataBayarId($idPembayaran);
        $bayarData = $bayarDataAll[0];


        $data = [
            'id_pembayaran' => $this->request->getVar('id_pembayaran'),
            'keterangan_pembayar' => $userData['full_name'],
            'status_pembayaran' => 'sudah dibayar',
            'tanggal_pembayaran' => date("l jS \of F Y h:i:s A", time()),
            'bank_pembayaran' => $this->request->getVar('bank_pembayaran'),
            'bukti_pembayaran' => $ppFileName,
        ];


        $this->BayarM->getBayarCekByCustomer($data);
        $session->setFlashdata('success', 'Pembayaran berhasil dailakukan');

        return redirect()->to('/admin/cash-tunai-detail/'. $bayarData['id_metode_pembayaran']);
    }

    public function loadDetailPembayaranCt(){

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);
        $idPembayaran = $lastUrl;

        $dataPembayaran = $this->BayarM->getDataBayarId($idPembayaran);

        $data = [
            'title' => 'Daftar Pesanan | Maestro Putra Timur',
            'data' => $dataPembayaran[0],
        ];


        return view('admin/cashtunai_view/detailctbayarview', $data);
    }


    // Informasi Bank Module

    public function loadInformasiBank(){
        $bankData = $this->BankM->getBank();


        $data = [
            'title' => 'Informasi Bank | Maestro Putra Timur',
            'bankData' => array_reverse($bankData)
        ];


        return view('admin/bank_view/bankview', $data);

    }
    
    public function postBank(){
        $session = \Config\Services::session();

        $data = [
            'id_bank' => 'bank-' . uniqid(),
            'nama_bank' => $this->request->getVar('nama_bank'),
            'nama_penerima' => $this->request->getVar('nama_penerima'),
            'nomor_pembayaran' => $this->request->getVar('nomor_pembayaran'),
        ];

        $this->BankM->postBank($data);

        $session->setFlashdata('success', 'Bank berhasil ditambahkan');

        return redirect()->to('/admin/informasi-bank');
    }


    public function putBank(){
        $session = \Config\Services::session();

        $data = [
            'id_bank' => $this->request->getVar('id_bank'),
            'nama_bank' => $this->request->getVar('nama_bank'),
            'nama_penerima' => $this->request->getVar('nama_penerima'),
            'nomor_pembayaran' => $this->request->getVar('nomor_pembayaran'),
        ];

        $this->BankM->putBank($data);

        $session->setFlashdata('success', 'Bank berhasil diupdate');

        return redirect()->to('/admin/informasi-bank');
    }

    public function getDataBankId(){
        $id = $this->request->getVar('id');

        $data = $this->BankM->getBankId($id);

        return json_encode($data);
    }

    public function deleteBank(){
        $id = $this->request->getVar('id');

        $this->BankM->deleteBank($id);

        return json_encode($id);
    }

    // Dowload Excel data get

    public function getprodukDatatoDownload(){
        $data = $this->ProdukM->getAllProduk();

        return json_encode($data);
    }
    public function getPesananDatatoDownload(){
        $data = $this->PesananM->getAllData();

        return json_encode($data);
    }



    // Hapus berelasi pada database pesanan berelasi ke tabel lain 

    // Task besok
    // 1. Skema KPR
    // 2. Skema Cash Bertahap
    // 3. Skema Cash Tunai
    // 4. Akun Pengguna
}
