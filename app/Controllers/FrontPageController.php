<?php

namespace App\Controllers;

use App\Models\KontenM;
use App\Models\AuthM;
use App\Models\KategoriM;
use App\Models\UserM;
use App\Models\KategoriPerumahanM;
use App\Models\ProdukM;
use App\Models\MessageM;
use App\Models\PesananM;

class FrontPageController extends BaseController
{
    protected $KontenM;
    protected $AuthM;
    protected $KategoriM;
    protected $UserM;
    protected $ProdukM;
    protected $MessageM;
    protected $kategoriPerumahanM;
    protected $PesananM;
    public function __construct(){
        $this->AuthM = new AuthM;
        $this->KategoriM = new KategoriM;
        $this->UserM = new UserM;
        $this->KontenM = new KontenM;
        $this->ProdukM = new ProdukM;
        $this->MessageM = new MessageM;
        $this->kategoriPerumahanM = new kategoriPerumahanM;
        $this->PesananM = new PesananM;
    }

    public function pageNotFound()
    {

        $data = [
            'title' => 'Halaman Tidak Ditemukan | Maestro Putra Timur',
        ];


        return view('frontpage/notfoundpage', $data);
    }

    public function index(){
        $kontenData = $this->KontenM->getKonten();
        $dataPerumahan = $this->ProdukM->getProdukFront();
        $dataKategori = $this->kategoriPerumahanM->getPerumahan();

        // dd($dataKategori);

        $data = [
            'title' => 'Home',
            'kontenData' => $kontenData[0],
            'pager' => $this->ProdukM->pager,
            'dataProduk' => $dataPerumahan,
            'dataKategori' => $dataKategori,
        ];

        return view('frontpage/Home', $data);
    }

    // Semua produk module

    public function allProduct(){
        $kontenData = $this->KontenM->getKonten();
        $dataPerumahan = $this->ProdukM->getProduk();

        // dd($dataPerumahan);

        $data = [
            'title' => 'Lihat Rumah',
            'kontenData' => $kontenData[0],
            'pager' => $this->ProdukM->pager,
            'dataProduk' => $dataPerumahan,
        ];
        

        return view('frontpage/allproduct', $data);
    }
    public function searchProduct(){
        $kontenData = $this->KontenM->getKonten();
        $key = $this->request->getVar('searchKey');

        $dataPerumahan = $this->ProdukM->getProdukIdFront($key);

        // dd($dataPerumahan);

        $data = [
            'title' => 'Cari Rumah',
            'kontenData' => $kontenData[0],
            'pager' => $this->ProdukM->pager,
            'dataProduk' => $dataPerumahan,
        ];
        

       
        return view('frontpage/allproductSearch', $data);
    }

    public function filterSearch(){
        $kontenData = $this->KontenM->getKonten();
        $key = $this->request->getVar('subsidi');
        $key2 = $this->request->getVar('harga-min');

        $myFilter = [
            'key1' => $key,
            'key2' => intval($key2),
        ];

        // dd($myFilter);

        $dataPerumahan = $this->ProdukM->getProdukIdFilter($myFilter);


        // dd($dataPerumahan);

        $data = [
            'title' => 'Cari Rumah',
            'kontenData' => $kontenData[0],
            'pager' => $this->ProdukM->pager,
            'dataProduk' => $dataPerumahan,
        ];
        
        return view('frontpage/allproductSearch', $data);
    }

    public function lihatDetailRumah(){
        $kontenData = $this->KontenM->getKonten();
        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);
        $parameter = implode(' ', explode('-', $lastUrl));

        // dd($parameter);

        $dataRumah = $this->ProdukM->getProdukName($parameter);

        $data = [
            'title' => $parameter,
            'kontenData' => $kontenData[0],
            'data' => $dataRumah[0]
        ];

        return view('frontpage/detailProduk', $data);

    }

    // Kirim Pesan Module

    public function sendMessage(){

        date_default_timezone_set('Asia/Jakarta');

        $data = [
            'id_message' => 'id-'.uniqid(),
            'sender_name' => $this->request->getVar('name'),
            'sender_email' => $this->request->getVar('email'),
            'sender_phone' => $this->request->getVar('phone'),
            'message' => $this->request->getVar('pesan'),
            'id_produk' => $this->request->getVar('id_produk'),
            'created_at' => date("l jS \of F Y h:i:s A", time()),
            'status' => 'Belum Dibaca',
        ];
        

        $this->MessageM->sendMessage($data);

        return json_encode($data);
        

    }

    // Modul Pesanan

    public function loadPesanan(){
        $session = \Config\Services::session();

        $url = explode('/',$_SERVER['PHP_SELF']);
        $lastUrl = end($url);
        $parameter = implode(' ', explode('-', $lastUrl));


        $kontenData = $this->KontenM->getKonten();
        $produkData = $this->ProdukM->getProdukIdFront($parameter);

        $data = [
            'title' => 'Buat Pesanan',
            'kontenData' => $kontenData[0],
            'produkData' => $produkData[0],
        ];

        if(session('login')){
            return view('frontpage/buatPesanan', $data);
        } else {
            $session->setFlashdata('success', 'Harap masuk dulu ke akun anda sebelum membuat pesanan...');
            return redirect()->to('/login');
        }


    }

    public function buatPesanan(){

        date_default_timezone_set('Asia/Jakarta');

        $data = [
            'id_pesanan' => 'order-'. uniqid(),
            'id_produk' => $this->request->getVar('id_produk'),
            'userId' => $this->request->getVar('userId'),
            'pembayaran' => $this->request->getVar('pembayaran'),
            'bank' => $this->request->getVar('bank'),
            'harga' => $this->request->getVar('harga'),
            'status_pesanan' => 'Menunggu Persetujuan',
            'order_date' => date("l jS \of F Y h:i:s A", time()),
            'kpr_set_status' => 0,
            'cash_tunai_set_status' => 0,
            'cash_bertahap_set_status' => 0,
        ];

        $this->PesananM->buatPesanan($data);

        return redirect()->to('/pesanan-berhasil');
    }

    public function pesananBerhasil(){
        $kontenData = $this->KontenM->getKonten();

        $data = [
            'title' => 'Pesanan Berhasil',
            'kontenData' => $kontenData[0],

        ];


        return view('frontpage/pesananBerhasil', $data);

    }

    
}
