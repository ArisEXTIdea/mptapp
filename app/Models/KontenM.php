<?php

namespace App\Models;

use CodeIgniter\Model;

class KontenM extends Model
{
    protected $table = 'master_konten';
    protected $allowedFields = ['id_konten','logo_pic','brand_name','slogan','keterangan_slogan','front_illustration_pic','tentang_kami','alamat','wa','email','fb','ig', 'cara_pemesanan'];
    
    public function getKonten(){
        return $this->findAll();
    }

    public function updateLogo($logoData){
        $this->set('logo_pic', $logoData['file_name']);
        $this->where('id_content', $logoData['id_content']);
        $this->update();
    }

    public function updateIllustration($logoData){
        $this->set('front_illustration_pic', $logoData['file_name']);
        $this->where('id_content', $logoData['id_content']);
        $this->update();
    }

    public function updateTeks($teks){
        $this->set('brand_name', $teks['brand_name']);
        $this->set('slogan', $teks['slogan']);
        $this->set('keterangan_slogan', $teks['keterangan_slogan']);
        $this->set('tentang_kami', $teks['tentang_kami']);
        $this->set('alamat', $teks['alamat']);
        $this->set('wa', $teks['wa']);
        $this->set('email', $teks['email']);
        $this->set('fb', $teks['fb']);
        $this->set('ig', $teks['ig']);
        $this->set('cara_pemesanan', $teks['cara_pemesanan']);
        $this->where('id_content', $teks['id_content']);
        $this->update();
    }
}