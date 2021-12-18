<?php

namespace App\Models;

use CodeIgniter\Model;

class UbahPassM extends Model
{
    protected $table = 'master_ubah_password_link';
    protected $allowedFields = ['id_link','time','link','email','userId','linkStatus'];

    public function postData($data){
        $this->insert($data);
    }
}