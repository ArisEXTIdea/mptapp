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
use App\Models\SaveRumahM;

class CustomerController extends BaseController
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
    protected $SaveRumahM;
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
        $this->SaveRumahM = new SaveRumahM;
    }

    public function dashboard()
    {

        $currentData = session('login');

        $kontenData = $this->KontenM->getKonten();


        $data = [
            'title' => 'Dashboard Admin | Maestro Putra Timur',
            'kontenData' => $kontenData[0],
            'userdata' => $currentData
        ];


        return view('customer/dashboard', $data);
    }

    // Myprofile module

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
        $session->setFlashdata('success', 'Profil berhasil diperaharui...');

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
        $session->setFlashdata('success', 'Foto Profil berhasil diperaharui...');

        return redirect()->to('/customer/dashboard');
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
        $session->setFlashdata('success', 'KTP berhasil diperaharui...');

        return redirect()->to('/customer/dashboard');
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
        $session->setFlashdata('success', 'KK berhasil diperaharui...');

        return redirect()->to('/customer/dashboard');
    }

    // Module Save Produk

    public function saveProduct(){
        $id = $this->request->getVar('id');
        $sessionData = session('login');

        $data = [
          'id_perumahan' => $this->request->getVar('id'),
          'userId' => $sessionData['userId']
        ];

        $this->SaveRumahM->postSaveRumah($data);

        return json_encode($data);
    }

    public function wishListLoad(){
        $userData = session('login');
        $id = $userData['userId'];

        $kontenData = $this->KontenM->getKonten();
        $wishListData = $this->SaveRumahM->getDataId($id);

        // dd($wishListData);
        $data = [
            'title' => 'Wish List Admin | Maestro Putra Timur',
            'kontenData' => $kontenData[0],
            'wishListData' => $wishListData,
        ];


        return view('customer/wishlist', $data);
    }

    public function deleteWishList(){
        
        $id = $this->request->getVar('id');

        $this->SaveRumahM->deleteData($id);

        return json_encode($id);
        
    }

    public function transactionLoad(){
        $userData = session('login');
        $id = $userData['userId'];

        $kontenData = $this->KontenM->getKonten();
        $pesananData = $this->PesananM->getPesananUserId($id);

        // dd($pesananData);

        // dd($pesananData);
        $data = [
            'title' => 'Transaksi | Maestro Putra Timur',
            'kontenData' => $kontenData[0],
            'pesananData' => array_reverse($pesananData),
        ];


        return view('customer/transaction_view/transaction', $data);
    }

    public function cancelPesanan(){
        
        $id = $this->request->getVar('id');
        

        $data = [
            'id' => $id,
            'status_pesanan' => 'Dibatalkan'
        ];

        $this->PesananM->cancelPesanan($data);

        return json_encode($data);
        
    }

    // KPR MODULE

    public function customerKprLoad(){

        $kontenData = $this->KontenM->getKonten();

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);

        $dataKpr = $this->BayarM->getBayarBelum($lastUrl);
        $datacek = $this->BayarM->getBayarCek($lastUrl);
        $datalunas = $this->BayarM->getBayarLunas($lastUrl);
        $dataTolak = $this->BayarM->getBayarTolak($lastUrl);


        $data = [
            'title' => 'Daftar Tagihan | Maestro Putra Timur',
            'data' => $dataKpr,
            'datacek' => $datacek,
            'datalunas' => $datalunas,
            'dataTolak' => $dataTolak,
            'kontenData' => $kontenData[0],

        ];

        
        return view('customer/transaction_view/kpr', $data);
    }
   
    public function tagihanKprFormLoad(){

        $kontenData = $this->KontenM->getKonten();

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);
        $bankData = $this->BankM->getBank();
        // $pembayaranData = $this->bayar;


        $data = [
            'title' => 'Bayar Mudah | Maestro Putra Timur',
            'kontenData' => $kontenData[0],
            'idBayar' => $lastUrl,
            'bankData' => $bankData
        ];

        
        return view('customer/transaction_view/kprbayarform', $data);
    }

    public function tagihanUlangFormLoad(){

        $kontenData = $this->KontenM->getKonten();

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);
        $bankData = $this->BankM->getBank();
        // $pembayaranData = $this->bayar;


        $data = [
            'title' => 'Pembayaran Ulang | Maestro Putra Timur',
            'kontenData' => $kontenData[0],
            'idBayar' => $lastUrl,
            'bankData' => $bankData
        ];

        
        return view('customer/transaction_view/kprbayarulangform', $data);
    }


    public function getBankData(){
        $data = $this->BankM->getBank();
        return json_encode($data);
    }

    public function updatePembayaran(){
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
            'status_pembayaran' => 'sedang dicek',
            'tanggal_pembayaran' => date("l jS \of F Y h:i:s A", time()),
            'bank_pembayaran' => $this->request->getVar('bank_pembayaran'),
            'bukti_pembayaran' => $ppFileName,
        ];

        $this->BayarM->getBayarCekByCustomer($data);
        $session->setFlashdata('success', 'Pembayaran berhasil dailakukan, admin kami sedang memverifikasi pembayaran anda.');

        return redirect()->to('/customer/pembayaran-kpr/'. $bayarData['id_metode_pembayaran']);
    }

    public function updatePembayaranUlang(){
        $session = \Config\Services::session();
        date_default_timezone_set('Asia/Jakarta');
        $pp = $this->request->getFile('bukti_pembayaran');
        $ppFileName = $pp->getRandomName();
        $pp->store('../../public/assets/images/imagestore/buktipembayaran', $ppFileName);
        $idPembayaran = $this->request->getVar('id_pembayaran');
        $pembayaranDataAll = $this->BayarM->getDataBayarId($idPembayaran);
        $pembayaranData = $pembayaranDataAll[0];
 
        unlink('assets/images/imagestore/buktipembayaran/'. $pembayaranData['bukti_pembayaran']);


        $userData = session('login');
        $bayarDataAll = $this->BayarM->getDataBayarId($idPembayaran);
        $bayarData = $bayarDataAll[0];


        $data = [
            'id_pembayaran' => $this->request->getVar('id_pembayaran'),
            'keterangan_pembayar' => $userData['full_name'],
            'status_pembayaran' => 'sedang dicek',
            'tanggal_pembayaran' => date("l jS \of F Y h:i:s A", time()),
            'bank_pembayaran' => $this->request->getVar('bank_pembayaran'),
            'bukti_pembayaran' => $ppFileName,
        ];

        $this->BayarM->getBayarCekByCustomer($data);
        $session->setFlashdata('success', 'Pembayaran berhasil dailakukan, admin kami sedang memverifikasi pembayaran anda.');

        return redirect()->to('/customer/pembayaran-kpr/'. $bayarData['id_metode_pembayaran']);
    }

    public function detailtagihanKprFormLoad(){

        $kontenData = $this->KontenM->getKonten();

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);
        $dataPembayaran = $this->BayarM->getDataBayarId($lastUrl);


        $data = [
            'title' => 'Tagihan | Maestro Putra Timur',
            'kontenData' => $kontenData[0],
            'idBayar' => $lastUrl,
            'data' => $dataPembayaran[0]
        ];

        
        return view('customer/transaction_view/kprbayardetail', $data);
    }

    // CASH BERTAHAP MODULE

    public function customercbLoad(){

        $kontenData = $this->KontenM->getKonten();

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);

        $dataKpr = $this->BayarM->getBayarBelum($lastUrl);
        $datacek = $this->BayarM->getBayarCek($lastUrl);
        $datalunas = $this->BayarM->getBayarLunas($lastUrl);
        $dataTolak = $this->BayarM->getBayarTolak($lastUrl);


        $data = [
            'title' => 'Tagihan | Maestro Putra Timur',
            'data' => $dataKpr,
            'datacek' => $datacek,
            'datalunas' => $datalunas,
            'dataTolak' => $dataTolak,
            'kontenData' => $kontenData[0],

        ];

        
        return view('customer/cbview/cb', $data);
    }

    public function tagihanCbFormLoad(){

        $kontenData = $this->KontenM->getKonten();

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);
        $bankData = $this->BankM->getBank();
        // $pembayaranData = $this->bayar;


        $data = [
            'title' => 'Bayar Mudah | Maestro Putra Timur',
            'kontenData' => $kontenData[0],
            'idBayar' => $lastUrl,
            'bankData' => $bankData
        ];

        
        return view('customer/cbview/cbbayarform', $data);
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
            'status_pembayaran' => 'sedang dicek',
            'tanggal_pembayaran' => date("l jS \of F Y h:i:s A", time()),
            'bank_pembayaran' => $this->request->getVar('bank_pembayaran'),
            'bukti_pembayaran' => $ppFileName,
        ];

        $this->BayarM->getBayarCekByCustomer($data);
        $session->setFlashdata('success', 'Pembayaran berhasil dailakukan, admin kami sedang memverifikasi pembayaran anda.');

        return redirect()->to('/customer/pembayaran-cash-bertahap/'. $bayarData['id_metode_pembayaran']);
    }

    public function tagihanUlangCbFormLoad(){

        $kontenData = $this->KontenM->getKonten();

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);
        $bankData = $this->BankM->getBank();
        // $pembayaranData = $this->bayar;


        $data = [
            'title' => 'Pembayaran Ulang | Maestro Putra Timur',
            'kontenData' => $kontenData[0],
            'idBayar' => $lastUrl,
            'bankData' => $bankData
        ];

        
        return view('customer/cbview/cbbayarulangform', $data);
    }

    public function updatePembayaranUlangcb(){
        $session = \Config\Services::session();
        date_default_timezone_set('Asia/Jakarta');
        $pp = $this->request->getFile('bukti_pembayaran');
        $ppFileName = $pp->getRandomName();
        $pp->store('../../public/assets/images/imagestore/buktipembayaran', $ppFileName);
        $idPembayaran = $this->request->getVar('id_pembayaran');
        $pembayaranDataAll = $this->BayarM->getDataBayarId($idPembayaran);
        $pembayaranData = $pembayaranDataAll[0];
 
        unlink('assets/images/imagestore/buktipembayaran/'. $pembayaranData['bukti_pembayaran']);


        $userData = session('login');
        $bayarDataAll = $this->BayarM->getDataBayarId($idPembayaran);
        $bayarData = $bayarDataAll[0];


        $data = [
            'id_pembayaran' => $this->request->getVar('id_pembayaran'),
            'keterangan_pembayar' => $userData['full_name'],
            'status_pembayaran' => 'sedang dicek',
            'tanggal_pembayaran' => date("l jS \of F Y h:i:s A", time()),
            'bank_pembayaran' => $this->request->getVar('bank_pembayaran'),
            'bukti_pembayaran' => $ppFileName,
        ];

        $this->BayarM->getBayarCekByCustomer($data);
        $session->setFlashdata('success', 'Pembayaran berhasil dailakukan, admin kami sedang memverifikasi pembayaran anda.');

        return redirect()->to('/customer/pembayaran-cash-bertahap/'. $bayarData['id_metode_pembayaran']);
    }

    // CASH TUNAI MODULE

    public function customerctLoad(){

        $kontenData = $this->KontenM->getKonten();

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);

        $dataKpr = $this->BayarM->getBayarBelum($lastUrl);
        $datacek = $this->BayarM->getBayarCek($lastUrl);
        $datalunas = $this->BayarM->getBayarLunas($lastUrl);
        $dataTolak = $this->BayarM->getBayarTolak($lastUrl);


        $data = [
            'title' => 'Tagihan | Maestro Putra Timur',
            'data' => $dataKpr,
            'datacek' => $datacek,
            'datalunas' => $datalunas,
            'dataTolak' => $dataTolak,
            'kontenData' => $kontenData[0],

        ];

        
        return view('customer/ctview/ct', $data);
    }


}
