<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageM extends Model
{
    protected $table = 'master_message';
    protected $allowedFields = ['id_message','sender_name','sender_email','sender_phone','message','id_produk' ,'created_at','status'];


    public function sendMessage($data){
        $this->insert($data);
    }

    public function getPesan(){
        return $this->paginate(5);
    }

    public function getPesanId($id){
        $this->where('id_message', $id);
        return $this->findAll();
    }

    public function deletePesan($id){
        $this->where('id_message', $id);
        $this->delete();
    }

    public function updateStatus($id){
        $this->set('status', 'Dibaca');
        $this->where('id_message', $id);
        $this->update();
    }

    // Dashboard get data

    public function dGetDataAllBelumDibaca(){
        $this->where('status', 'Belum Dibaca');
        return $this->findAll();
    }
}