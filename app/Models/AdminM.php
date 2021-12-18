<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminM extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['userId','full_name','address','phone','email','profile_picture','scan_ktp', 'scan_kk', 'user_level', 'password'];

    public function postUsers($userData){
        $this->insert($userData);
    }

    public function getUsers(){
        return $this->findAll();
    }
}