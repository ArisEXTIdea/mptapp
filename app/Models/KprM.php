<?php

namespace App\Models;

use CodeIgniter\Model;

class KprM extends Model
{
    protected $table = 'master_kpr';
    protected $allowedFields = ['id_kpr','id_pesanan','total_pembayaran','uang_muka', 'jumlah_bunga','lama_bulanan','bayar_bulanan','kpr_created_at'];


    public function saveKpr($data){
        $this->insert($data);
    }
    


}