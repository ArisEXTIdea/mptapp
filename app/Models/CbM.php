<?php

namespace App\Models;

use CodeIgniter\Model;

class CbM extends Model
{
    protected $table = 'master_cb';
    protected $allowedFields = ['id_cb','id_pesanan','total_pembayaran','uang_muka', 'jumlah_bunga','lama_bulanan','bayar_bulanan','kpr_created_at'];


    public function saveCb($data){
        $this->insert($data);
    }
    


}