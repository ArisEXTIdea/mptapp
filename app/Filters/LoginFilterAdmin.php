<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilterAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $data = session('login');
        $dataLevel;

        if($data === null){
            $dataLevel = 'kosong';
        }
        else{
            $dataLevel = $data['user_level'];
        }

        switch ($dataLevel) {
            case 'kosong':
                return redirect()->to('/login');
                break;
            
            case 2:
                return redirect()->to('/halaman-tidak-ditemukan');
        }

        // if($data === null or $data['user_level'] != 1){
        //     return redirect()->to('/login');
        // }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}