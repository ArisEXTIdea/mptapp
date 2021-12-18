<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananM extends Model
{
    protected $table = 'master_pesanan';
    protected $allowedFields = ['id_pesanan','id_produk','userId','pembayaran','bank','harga','status_pesanan','order_date','kpr_set_status', 'id_kpr','cash_tunai_set_status', 'id_cash_tunai', 'cash_bertahap_set_status', 'id_cash_bertahap','status_bank'];
    
    public function buatPesanan($data){
        $this->insert($data);
    }

    public function getAllData(){
        $this->select('judul_p, kategori_p, full_name, pembayaran, order_date, bank, status_pesanan');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->join('users', 'users.userId = master_pesanan.userId');
        return $this->findAll();
    }

    public function getPesananDatatoDownload($where){
        $this->select('judul_p, kategori_p, full_name, pembayaran, order_date, bank, status_pesanan');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->join('users', 'users.userId = master_pesanan.userId');
        $this->where('pembayaran', $where);
        return $this->findAll();
    }

    public function getPesanan(){
        $this->select('*');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->join('users', 'users.userId = master_pesanan.userId');
        $this->where('status_pesanan', 'Menunggu Persetujuan');
        return $this->paginate(8);
    }

    public function getPesananAll(){
        $this->select('*');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->join('users', 'users.userId = master_pesanan.userId');
        $this->where('status_pesanan !=', 'Menunggu Persetujuan');
        return $this->paginate(8);
    }

    public function searchPesananAll($key){
        $this->select('*');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->join('users', 'users.userId = master_pesanan.userId');
        $this->like('full_name', $key);
        // $this->orLike('judul_p', $key);
        // $this->orLike('full_name', $key);
        // $this->orLike('bank', $key);
        // $this->orLike('kategori_p', $key);
        // $this->orLike('status_pesanan', $key);
        $this->where('status_pesanan !=', 'Menunggu Persetujuan');
        return $this->paginate(8);
    }

    public function getBelumBayar(){
        $this->select('*');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->join('users', 'users.userId = master_pesanan.userId');
        // $this->join('master_bayar', 'master_bayar.id_metode_pembayaran = master_pesanan.id_kpr');
        $this->join('master_bayar', 'master_bayar.id_metode_pembayaran = master_pesanan.id_cash_bertahap');
        // $this->join('master_bayar', 'master_bayar.id_metode_pembayaran = master_pesanan.id_cash_tunai');
        $this->where('status_pembayaran', 'sedang dicek');
        return $this->findAll(8);
    }

    public function cariKprData($key){
        $this->select('*');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->join('users', 'users.userId = master_pesanan.userId');
        $this->like('full_name', $key);
        $this->where('pembayaran', 'KPR');
        $this->where('status_pesanan !=', 'Menunggu Persetujuan');
        return $this->paginate(8);
    }

    public function cariCbData($key){
        $this->select('*');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->join('users', 'users.userId = master_pesanan.userId');
        $this->like('full_name', $key);
        $this->where('pembayaran', 'Cash Bertahap');
        $this->where('status_pesanan !=', 'Menunggu Persetujuan');

        return $this->paginate(8);
    }

    public function cariCtData($dataCari){
        $this->select('*');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->join('users', 'users.userId = master_pesanan.userId');
        $this->like('full_name', $dataCari['key']);
        $this->where('pembayaran', 'Cash Bertahap');
        $this->where('status_pesanan !=', 'Menunggu Persetujuan');
        return $this->paginate(8);
    }

    public function getPesananAllKpr(){
        $this->select('*');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->join('users', 'users.userId = master_pesanan.userId');
        $this->where('pembayaran', 'KPR');
        $this->where('status_pesanan', 'Disetujui');
        return $this->paginate(8);
    }

    public function getPesananAllCb(){
        $this->select('*');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->join('users', 'users.userId = master_pesanan.userId');
        $this->where('pembayaran', 'Cash Bertahap');
        $this->where('status_pesanan', 'Disetujui');
        return $this->paginate(8);
    }

    public function getPesananAllCt(){
        $this->select('*');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->join('users', 'users.userId = master_pesanan.userId');
        $this->where('pembayaran', 'Cash Tunai');
        $this->where('status_pesanan', 'Disetujui');
        return $this->paginate(8);
    }
    

    public function getPesananId($id){
        $this->select('*');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->join('users', 'users.userId = master_pesanan.userId');
        $this->where('id_pesanan', $id);
        return $this->findAll();
    }

    public function getPesananUserId($id){
        $this->select('*');
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_pesanan.id_produk');
        $this->where('userId', $id);
        return $this->findAll();
    }

    public function deletePesanan($id){
        $this->where('id_pesanan', $id);
        $this->delete();
    }

    public function cancelPesanan($data){
        $this->set('status_pesanan', $data['status_pesanan']);;
        $this->where('id_pesanan', $data['id']);
        $this->update();
    }

    public function konfirmasiPesanan($data){
        $this->set('status_pesanan', $data['status']);;
        $this->set('status_bank', $data['status_bank']);;
        $this->where('id_pesanan', $data['id']);
        $this->update();
    }

    public function setKprStatus($kprStatus){
        $this->set('kpr_set_status', $kprStatus['status']);
        $this->set('id_kpr', $kprStatus['id_kpr']);
        $this->where('id_pesanan', $kprStatus['id']);
        $this->update();
    }

    public function setCbStatus($cbStatus){
        $this->set('cash_bertahap_set_status', $cbStatus['status']);
        $this->set('id_cash_bertahap', $cbStatus['id_cash_bertahap']);
        $this->where('id_pesanan', $cbStatus['id']);
        $this->update();
    }

    public function setCtStatus($ctStatus){
        $this->set('cash_tunai_set_status', $ctStatus['status']);
        $this->set('id_cash_tunai', $ctStatus['id_cash_tunai']);
        $this->where('id_pesanan', $ctStatus['id']);
        $this->update();
    }

    public function ubahPesanan($data){
        $this->set('bank', $data['bank']);
        $this->set('pembayaran', $data['pembayaran']);
        $this->where('id_pesanan', $data['id_pesanan']);
        $this->update();
    }

    // Dashboard data

    public function dGetDataAllKpr(){
        $this->where('pembayaran', 'KPR');
        return $this->findAll();
    }
    
    public function dGetDataAllCb(){
        $this->where('pembayaran', 'Cash Bertahap');
        return $this->findAll();
    }
    public function dGetDataAllCt(){
        $this->where('pembayaran', 'Cash Tunai');
        return $this->findAll();
    }

    public function dGetDataAllPersetujuan(){
        $this->where('status_pesanan', 'Menunggu Persetujuan');
        return $this->findAll();
    }


}