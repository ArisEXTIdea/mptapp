<?php

namespace App\Models;

use CodeIgniter\Model;

class BayarM extends Model
{
    protected $table = 'master_bayar';
    protected $allowedFields = ['id_pembayaran','id_metode_pembayaran','jumlah_bayar','keterangan_pembayaran','keterangan_pembayar','status_pembayaran','tanggal_pembayaran', 'bank_pembayaran', 'bukti_pembayaran', 'keterangan_status'];

    // Status Pembayaran sudah dibayar, sedang dicek, belum dibayar, pembayaran ditolak
    public function postPembayaran($userData){
        $this->insert($userData);
    }

    public function getBayarBelum($id){
        $this->select('*');
        $this->where('id_metode_pembayaran', $id);
        $this->where('status_pembayaran', 'belum dibayar');
        return $this->findAll();
    }

    public function getBayarTolak($id){
        $this->select('*');
        $this->where('id_metode_pembayaran', $id);
        $this->where('status_pembayaran', 'pembayaran ditolak');
        return $this->findAll();
    }

    public function getBayarCek($id){
        $this->select('*');
        $this->where('id_metode_pembayaran', $id);
        $this->where('status_pembayaran', 'sedang dicek');
        return $this->findAll();
    }

    public function getBayarLunas($id){
        $this->select('*');
        $this->where('id_metode_pembayaran', $id);
        $this->where('status_pembayaran', 'sudah dibayar');
        return $this->findAll();
    }

    public function getBayarCekByCustomer($data){
        $this->set('keterangan_pembayar', $data['keterangan_pembayar']);
        $this->set('status_pembayaran', $data['status_pembayaran']);
        $this->set('tanggal_pembayaran', $data['tanggal_pembayaran']);
        $this->set('bank_pembayaran', $data['bank_pembayaran']);
        $this->set('bukti_pembayaran', $data['bukti_pembayaran']);
        $this->where('id_pembayaran', $data['id_pembayaran']);
        $this->update();
    }

    public function getDataBayarId($idPembayaran){
        $this->select('*');
        $this->where('id_pembayaran', $idPembayaran);
        return $this->findAll();
    }

    public function confirmPayment($data){
        $this->set('status_pembayaran', $data['status_pembayaran']);
        $this->set('keterangan_status', $data['keterangan_status']);
        $this->where('id_pembayaran', $data['id_pembayaran']);
        $this->update();
    }

    // Dashboard Get Data

    public function dGetDataAllDiterima(){
        $this->where('status_pembayaran', 'sudah dibayar');
        return $this->findAll();
    }

    public function dGetDataAllDitolak(){
        $this->where('status_pembayaran', 'pembayaran ditolak');
        return $this->findAll();
    }

    public function dGetDataAllMenungguCek(){
        $this->where('status_pembayaran', 'sedang dicek');
        return $this->findAll();
    }

   
    
    

}