<?php

class Index extends Controller
{
  public function __construct()
  {
    $this->api('GET POST');
  }

  public function index($data = NULL)
  {
    switch ($_SERVER['REQUEST_METHOD']) {
      case 'GET':
        if (!$_SERVER['HTTP_USER_AGENT']) {
          $this->code('400', 'Verification not valid');
        } else {
          $generateToken = fn($length = 64) => bin2hex(random_bytes($length / 2));
          $verification = $_SERVER['HTTP_USER_AGENT'];
          $combine = SALT_TOKEN . $generateToken();
          $encrypt = password_hash($verification . $combine, PASSWORD_DEFAULT);
          $datas['user_agent'] = $verification;
          $datas['combine'] = $combine;
          $datas['token'] = $encrypt;
          $datas['expiry_time'] = date('Y-m-d H:i:s', strtotime('+5 minutes'));
          if ($this->model('Token')->Add($datas) > 0) {
            $token = ['token' => base64_encode($encrypt)];
            $this->code('200', 'Token has created', $token);
          } else {
            $this->code('503', 'Server are down');
          }
        }
        break;
      case 'POST':
        if (!$data) {
          $this->code('404', 'Token not found');
        } else {
          $datas['token'] = base64_decode($data);
          $datas['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
          $row = $this->model('Token')->Verification($datas);
          if ($row !== false) {
            if (password_verify($row['user_agent'] . $row['combine'], $row['token'])) {
              if ($this->model('Token')->Delete($datas) < 0) {
                return ($this->code('503', 'Server are down', 0, 'back'));
              } else {
                return ($this->code('200', 'Token is valid', 1, 'back'));
              }
            } else {
              $this->code('404', 'Token not valid');
            }
          } else {
            $this->code('404', 'Token not found');
          }
        }
        break;
    }
  }

  // public function index()
  // {
  //   // AWAL
  //   $generateToken = fn($length = 64) => bin2hex(random_bytes($length / 2));
  //   $verification = $_SERVER['HTTP_USER_AGENT'];
  //   $combine = SALT_TOKEN . $generateToken();
  //   $encrypt = password_hash($verification . $combine, PASSWORD_DEFAULT);
  //   $echo['encrypt'] = $encrypt;
  //   $encode = base64_encode($encrypt);
  //   $echo['encode'] = json_encode($encode);
  //   // AKHIR
  //   $decode = base64_decode($encode);
  //   $echo['decode'] = json_encode($decode);
  //   if (password_verify($verification . $combine, $decode)) {
  //     $echo['berhasil'] = 'true';
  //   } else {
  //     $echo['berhasil'] = 'false';
  //   }
  //   echo (json_encode($echo));
  //   // $a = base64_encode('test');
  //   // $b = base64_decode($a);
  //   // $echo['a'] = $a;
  //   // $echo['b'] = $b;
  //   // awal
  //   // hash dengan possword hash dengan salt
  //   // encode dengan base64 tambah salt
  //   // akhir
  //   // decode dengan salt
  //   // verification dengan salt
  //   // function generateToken($length = 64)
  //   // {
  //   //   return bin2hex(random_bytes($length / 2));
  //   // }

  //   // $token = generateToken();
  //   // echo json_encode($token);
  //   // echo json_encode($_SERVER['HTTP_USER_AGENT']);
  //   // Daftar domain yang diizinkan
  //   // $allowed_domains = ['web.postman.co', 'mollusk-fit-feline.ngrok-free.app'];

  //   // // Mendapatkan header Origin
  //   // $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

  //   // // Memeriksa apakah domain yang mengakses diizinkan
  //   // if (in_array(parse_url($origin, PHP_URL_HOST), $allowed_domains)) {
  //   //   // Domain diizinkan, lanjutkan dengan pemrosesan API
  //   //   header('Content-Type: application/json');
  //   // echo json_encode(['message' => 'Akses diizinkan!']);
  //   // } else {
  //   //   // Domain tidak diizinkan
  //   //   header('HTTP/1.1 403 Forbidden');
  //   //   echo json_encode(['message' => 'Akses ditolak!']);
  //   // }
  // }
}
