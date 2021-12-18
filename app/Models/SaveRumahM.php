<?php

namespace App\Models;

use CodeIgniter\Model;

class SaveRumahM extends Model
{
    protected $table = 'master_save_rumah';
    protected $allowedFields = [
        'id_perumahan',
        'userId',
    ];

    public function postSaveRumah($data){
        $this->insert($data);
    }

    public function getDataId($id){
        $this->where('userId', $id);
        $this->join('master_produk_perumahan', 'master_produk_perumahan.id_produk = master_save_rumah.id_perumahan');
        return $this->findAll();
    }

    public function deleteData($id){
        $this->where('id_perumahan', $id);
        $this->delete();
    }
    

    
}