<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukM extends Model
{
    protected $table = 'master_produk_perumahan';
    protected $allowedFields = [
        'id_produk',
        'judul_p',
        'harga_normal',
        'harga_diskon',
        'kategori_p',
        'alamat',
        'subsidi',
        'kt',
        'km',
        'luas_area',
        'panjang_bangunan',
        'lebar_bangunan',
        'listrik',
        'air',
        'unit_tersisa',
        'jumlah_unit',
        'deskripsi',
        'product_pic',
        'status',
        'created_at',
        'updated_at'
    ];

    public function postProduk($data){
        $this->insert($data);
    }

    public function getAllProduk(){
        return $this->findAll();
    }
    
    public function getProduk(){
        return $this->paginate(8);
    }

    public function getProdukFront(){
        return $this->paginate(3);
    }

    public function getProdukId($id){
        $this->select('*');
        $this->where('id_produk', $id);
        return $this->findAll();
    }

    public function getProdukIdFront($key){
        $this->select('*');
        $this->like('judul_p', $key);
        // $this->orlike('deskripsi', $key);
        return $this->paginate(8);
    }

    public function getProdukName($p){
        $this->select('*');
        $this->where('judul_p', $p);
        return $this->findAll();
    }

    public function deleteProduk($id){
        $this->where('id_produk', $id);
        $this->delete();
    }

    public function putProduk($updatedata){
        $this->set('judul_p', $updatedata['judul_p']);
        $this->set('harga_normal', $updatedata['harga_normal']);
        $this->set('harga_diskon', $updatedata['harga_diskon']);
        $this->set('kategori_p', $updatedata['kategori_p']);
        $this->set('alamat', $updatedata['alamat']);
        $this->set('subsidi', $updatedata['subsidi']);
        $this->set('kt', $updatedata['kt']);
        $this->set('km', $updatedata['km']);
        $this->set('luas_area', $updatedata['luas_area']);
        $this->set('panjang_bangunan', $updatedata['panjang_bangunan']);
        $this->set('lebar_bangunan', $updatedata['lebar_bangunan']);
        $this->set('listrik', $updatedata['listrik']);
        $this->set('air', $updatedata['air']);
        $this->set('unit_tersisa', $updatedata['unit_tersisa']);
        $this->set('jumlah_unit', $updatedata['jumlah_unit']);
        $this->set('deskripsi', $updatedata['deskripsi']);
        $this->set('status', $updatedata['status']);
        $this->set('updated_at', $updatedata['updated_at']);
        $this->where('id_produk', $updatedata['id_produk']);
        $this->update();
    }

    public function putProdukWimg($updatedata){
        $this->set('judul_p', $updatedata['judul_p']);
        $this->set('harga_normal', $updatedata['harga_normal']);
        $this->set('harga_diskon', $updatedata['harga_diskon']);
        $this->set('kategori_p', $updatedata['kategori_p']);
        $this->set('alamat', $updatedata['alamat']);
        $this->set('subsidi', $updatedata['subsidi']);
        $this->set('kt', $updatedata['kt']);
        $this->set('km', $updatedata['km']);
        $this->set('luas_area', $updatedata['luas_area']);
        $this->set('panjang_bangunan', $updatedata['panjang_bangunan']);
        $this->set('lebar_bangunan', $updatedata['lebar_bangunan']);
        $this->set('listrik', $updatedata['listrik']);
        $this->set('air', $updatedata['air']);
        $this->set('unit_tersisa', $updatedata['unit_tersisa']);
        $this->set('jumlah_unit', $updatedata['jumlah_unit']);
        $this->set('deskripsi', $updatedata['deskripsi']);
        $this->set('product_pic', $updatedata['product_pic']);
        $this->set('status', $updatedata['status']);
        $this->set('updated_at', $updatedata['updated_at']);
        $this->where('id_produk', $updatedata['id_produk']);
        $this->update();
    }

    public function searchProduct($key){
        $this->select('*');
        $this->like('judul_p', $key);
        return $this->paginate(8);
    }

    public function getProdukIdFilter($myFilter){
        $this->select('*');
        $this->where('subsidi', $myFilter['key1']);
        return $this->paginate(8);
    }

    public function dGetDataAllProduk(){
        return $this->findAll();
    }

    
}