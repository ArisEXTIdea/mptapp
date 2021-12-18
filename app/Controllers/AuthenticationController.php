<?php

namespace App\Controllers;

use App\Models\AuthM;
use App\Models\UbahPassM;
use App\Models\UserM;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class AuthenticationController extends BaseController
{

    protected $AuthM;
    protected $UbahPassM;
    protected $UserM;
    public function __construct(){
        $this->AuthM = new AuthM;
        $this->UbahPassM = new UbahPassM;
        $this->UserM = new UserM;
    }

    public function userRegistration()
    {

        $data = [
            'title' => 'Daftar | Maestro Putra Timur',
        ];


        return view('authentication/registrationpage', $data);
    }

    public function saveUserToDatabase(){
        // Make an UID

        $createNewUID = 'uid-' . strval(time());

        // password hasing

        $getPassword = $this->request->getVar('password');
        $hashedPass = password_hash($getPassword, PASSWORD_DEFAULT);

        $data = [
            'userId' => $createNewUID,
            'full_name' => $this->request->getVar('fullname'),
            'email' => $this->request->getVar('email'),
            'user_level'=> 2,
            'password' => $hashedPass
        ];


        $this->AuthM->postUsers($data);

        $session = \Config\Services::session();
        $session->setFlashdata('success', 'Pendaftaran Berhasil');

        return redirect()->to('/login');
    }

    public function login(){

        $session = \Config\Services::session();


        if(session('login')){
            return redirect()->to('/');
        }

        $session->destroy('login');
        
        $data = [
            'title' => 'Login | Maestro Putra Timur'
        ];

        return view('authentication/loginpage', $data);

    }

    public function auth(){

        $session = \Config\Services::session();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $allUsersData = $this->AuthM->getUsers();

        $sessionSave = [

        ];
        // dd($allUsersData);

        echo count($allUsersData);

        // dd($allUsersData[5]['full_name']);

        for($i = 0; $i < count($allUsersData); $i++){
            if($email == $allUsersData[$i]['email'] && password_verify($password, $allUsersData[$i]['password'])){
                $sessionData = $allUsersData[$i];      
                $session->set('login', $sessionData);
                $sessionData = $session->get('login');
                $session->setFlashdata('success', 'Login Berhasil');
                if($sessionData['user_level'] == 1 && $sessionData['status'] == 'Aktif'){
                    return redirect()->to('/admin/dashboard');
                }
                elseif($sessionData['user_level'] == 1 && $sessionData['status'] == 'Tidak Aktif'){
                    $session->destroy('login');
                    $session->setFlashdata('loginfailed', 'Login Gagal: Username / password anda tidak sesuai');
                    return redirect()->to('/login');
                }
                return redirect()->to('/');
                
            }
        }   

        $session->setFlashdata('loginfailed', 'Login Gagal: Username / password anda tidak sesuai');

        return redirect()->to('/login');
    }

    public function lupaPassword(){
        $session = \Config\Services::session();

        $session->destroy('login');
        $data = [
            'title' => 'Lupa Pasword | Maestro Putra Timur'
        ];

        return view('authentication/lupapasswordpage', $data);

    }

    public function sendEmailVerification(){
        $session = \Config\Services::session();
        $toEmail = $this->request->getVar('email');
        $time = time() + 3600;
        $link = 'https://maestroputratimur.com/ubah-password/'. $time. '/' . $toEmail;

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 0;  
            $mail->isSMTP(); 
            $mail->SMTPAutoTLS = false;
            $mail->SMTPSecure = 'ssl';                                          //Send using SMTP
            $mail->Host       = 'smtp.googlemail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'maestroputratimur.official@gmail.com';                     //SMTP username
            $mail->Password   = 'JeparaMempesona';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;  

            //Recipients
            $mail->setFrom('maestroputratimur.official@gmail.com', 'Maestro Putra Timur');
            $mail->addAddress($toEmail);     //Add a recipient 
            $mail->addReplyTo('maestroputratimur.official@gmail.com', 'Terkirim');

            // //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Ganti Password';
            $mail->Body    ='Eamil penggantian password anda: '. $link;

            $mail->send();
            echo "Tunggu sebentar kami sedang mengirim email...";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        sleep(5);
        
        $data = [
            'id_link' => 'link-' . uniqid(),
            'time' => $time,
            'link' => $link,
            'email' => $toEmail,
            'linkStatus' => 'aktif'
        ];

        $this->UbahPassM->postData($data);

        $session->setFlashdata('success', 'Link ganti password berhasil dikirim silakan cek email anda untuk mengganti password, jika link tidak muncul silahkan priksa folder spam');



        return redirect()->to('/login');
    }

    public function logout() {
        $session = \Config\Services::session();
        $session->destroy('login');
        return redirect()->to('/login');
    }

    public function loadGantiPasswordForm(){
        $session = \Config\Services::session();

        $url = explode('/',$_SERVER['PHP_SELF']);
        $arrayUrl = array_reverse($url);

        $email = $arrayUrl[0];
        $time = intval($arrayUrl[1]);

        $timeNow = time();

        $userData = $this->UserM->gatUserByEmail($email);

        $data = [
            'title' => 'Ganti Password',
            'userData' => $userData,
        ];

        if($time > $timeNow){
        return view('authentication/formlupapassword', $data);
            
        }

        else {
            
            $session->setFlashdata('loginfailed', 'Link Kadaluarsa');

            return redirect()->to('/login');
        }
        // ambil url
        // cek status expired max 5 min link;
        // Hapus link expired
        // Jika aktif redirect ke form
        // Jika tidak redirect not found
        
    }

    public function ubahPassword(){

        $session = \Config\Services::session();


        $getPassword = $this->request->getVar('new_pass');
        $getEmail = $this->request->getVar('email');
        $hashedPass = password_hash($getPassword, PASSWORD_DEFAULT);

        $data = [
            'email' => $getEmail,
            'password' => $hashedPass,
        ];

        $this->UserM->updatePassword($data);

        $session->setFlashdata('success', 'Password berhasil diubah');

        return redirect()->to('/login');

    }
}
