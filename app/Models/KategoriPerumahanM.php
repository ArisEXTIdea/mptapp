<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriPerumahanM extends Model
{
    protected $table = 'master_perumahan';
    protected $allowedFields = ['id_perumahan','nama_perumahan','keterangan_perumahan','lokasi_perumahan'];

    public function getPerumahan(){
        return $this->findAll();
    }

    public function postPerumahan($data){
        $this->insert($data);
    } 

    public function deletePerumahan($id){
        $this->where('id_perumahan', $id);
        $this->delete();
    }

    public function getPerumahanId($id){
        $this->select('*');
        $this->where('id_perumahan', $id);
        return $this->findAll();
    }

    public function putPerumahanId($data){
        $this->set('nama_perumahan', $data['nama_perumahan']);
        $this->set('keterangan_perumahan', $data['keterangan_perumahan']);
        $this->set('lokasi_perumahan', $data['lokasi_perumahan']);
        $this->where('id_perumahan', $data['id_perumahan']);
        $this->update();
    }

    public function dGetDataAllKategori(){
        return $this->findAll();
    }
    
}