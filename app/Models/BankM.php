<?php

namespace App\Models;

use CodeIgniter\Model;

class BankM extends Model
{
    protected $table = 'master_bank';
    protected $allowedFields = ['id_bank','nama_bank','nama_penerima','nomor_pembayaran'];

    public function getBank(){
        return $this->findAll();
    }

    public function postBank($data){
        $this->insert($data);
    } 

    public function deleteBank($id){
        $this->where('id_bank', $id);
        $this->delete();
    }

    public function getBankId($id){
        $this->select('*');
        $this->where('id_bank', $id);
        return $this->findAll();
    }

    public function putBankId($data){
        $this->set('nama_bank', $data['nama_bank']);
        $this->set('nama_penerima', $data['nama_penerima']);
        $this->set('nomor_pembayaran', $data['nomor_pembayaran']);
        $this->where('id_bank', $data['id_bank']);
        $this->update();
    }

    public function dGetDataAllBank(){
        return $this->findAll();
    }

}