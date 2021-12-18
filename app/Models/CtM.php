<?php

namespace App\Models;

use CodeIgniter\Model;

class CtM extends Model
{
    protected $table = 'master_ct';
    protected $allowedFields = ['id_ct','id_pesanan','total_pembayaran','uang_muka', 'jumlah_bunga','lama_bulanan','bayar_bulanan','kpr_created_at'];


    public function saveCt($data){
        $this->insert($data);
    }
    


}