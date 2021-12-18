<?php

namespace App\Models;

use CodeIgniter\Model;

class UserM extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['userId','full_name','gender','address','phone','email','profile_picture','scan_ktp','scan_kk','user_level','password', 'status'];

    // User

    public function getUsers(){
        return $this->paginate(8);
    }

    public function getUsersId($id){
        return $this->where('userId', $id) ->first();
    }
    
    public function updateUserStatusSuspend($data){
        $this->set('status', $data['status']);
        $this->where('userId', $data['userId']);
        $this->update();
    }

    public function updateUserStatusReactive($data){
        $this->set('status', $data['status']);
        $this->where('userId', $data['userId']);
        $this->update();
    }

    public function userSearch($searchKey){
        $this->select('*');
        $this->like('full_name', $searchKey);
        $this->orlike('gender', $searchKey);
        $this->orlike('address', $searchKey);
        $this->orlike('phone', $searchKey);
        $this->orlike('email', $searchKey);
        $this->orlike('user_level', $searchKey);
        $this->orlike('status', $searchKey);
        return $this->findAll();
    }

    public function saveUser($data){
        $this->insert($data);
    }

    // Model for myprofile module

    public function updateGeneralProfile($data){
        $this->set('full_name', $data['full_name']);
        $this->set('gender', $data['gender']);
        $this->set('address', $data['address']);
        $this->set('phone', $data['phone']);
        $this->set('email', $data['email']);
        $this->set('user_level', $data['user_level']);
        $this->where('userId', $data['userId']);
        $this->update();
    }

    public function updateProfilePicture($data){
        $this->set('profile_picture', $data['profile_picture']);
        $this->where('userId', $data['userId']);
        $this->update();
    }
    
    public function updateKtpPicture($data){
        $this->set('scan_ktp', $data['scan_ktp']);
        $this->where('userId', $data['userId']);
        $this->update();
    }

    public function updatekkPicture($data){
        $this->set('scan_kk', $data['scan_kk']);
        $this->where('userId', $data['userId']);
        $this->update();
    }

    public function gatUserByEmail($email){
        $this->where('email', $email);
        return $this->findAll();
    }

    public function updatePassword($data){
        $this->set('password', $data['password']);
        $this->where('email', $data['email']);
        $this->update();
    }

    // Dashboard Data

    public function dGetDataAllUser(){
        return $this->findAll();
    }

}