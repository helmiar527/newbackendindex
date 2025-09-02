<?php

namespace App\Controllers;

use App\Systems\Controller;

class Index extends Controller
{
  public function __construct()
  {
    $this->api('POST');
  }
  public function index($data = NULL)
  {
    // Cek kelengkapan pengiriman data
    if (empty($_POST) || !isset($_POST['timestamp'], $_POST['key'], $_POST['username'])) {
      $this->code('400', 'Data request does not exist');
    }
    $timestamp = $_POST['timestamp'];
    $receivedHash = $_POST['key'];
    // Verifikasi hash dari frontend
    $apikeydatabase = $this->model('ApiKey')->CheckApi($_POST['username']);
    if ($apikeydatabase === false) {
      $this->code('404', 'Api not found');
    }
    // Dekripsi API Key
    $cipher_method = 'aes-256-cbc';
    $key = SALT_API;
    $encrypted_data = $apikeydatabase['api_key'];
    $iv_length = openssl_cipher_iv_length($cipher_method);
    $decoded_data = base64_decode($encrypted_data);
    $iv = substr($decoded_data, 0, $iv_length);
    $ciphertext = substr($decoded_data, $iv_length);
    $decrypted_text = openssl_decrypt(
      $ciphertext,
      $cipher_method,
      $key,
      0,
      $iv
    );
    // Cek apakah api valid atau tidak
    $expectedHash = hash_hmac('sha256', $timestamp, $decrypted_text);
    if ($receivedHash !== $expectedHash) {
      $this->code('401', 'Invalid API key');
    }
    // Buat token
    $data['token'] = bin2hex(random_bytes(32));
    $data['expiry_time'] = time() + '300';

    // Simpan token ke database
    if ($this->model('Token')->Add($data) > 0) {
      $this->code('200', 'Token has created', ['token' => $data['token']]);
    } else {
      $this->code('503', 'Server are down');
    }
  }
}
