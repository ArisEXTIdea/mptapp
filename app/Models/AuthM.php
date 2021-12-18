<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthM extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['userId','full_name','address','phone','email','profile_picture','scan_ktp', 'scan_kk', 'user_level', 'password'];

    public function postUsers($userData){
        $this->insert($userData);
    }

    public function getUsers(){
        $this->select('*');
        $this->join('user_level', 'user_level.levelID = users.user_level');
        $query = $this->findAll();
        return $query;
    }
}