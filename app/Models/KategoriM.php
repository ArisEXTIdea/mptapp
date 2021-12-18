<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriM extends Model
{
    protected $table = 'master_category';
    protected $allowedFields = ['id_kategori','nama_kategori','deskripsi'];


    public function getCategory(){
        return $this->findAll();
    }

    public function saveCategory($data){
        $this->insert($data);
    }

    public function deleteCategory($idKategory){
        $this->where('id_kategori', $idKategory);
        $this->delete();
    }

    public function putCategory($data){
        $this->replace($data);
    }

    public function searchCategory($searchKey){
        $this->select('*');
        $this->like('nama_kategori', $searchKey);
        $this->orlike('deskripsi', $searchKey);
        return $this->findAll();
    }
}