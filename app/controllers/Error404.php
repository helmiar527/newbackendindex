<?php

namespace App\Controllers;

class Error404 extends Controller
{
  public function __construct()
  {
    $this->api('GET POST PUT DELETE');
  }

  public function index()
  {
    header('HTTP/1.1 404');
    http_response_code(404);
    echo json_encode(["status" => "NOT FOUND"]);
  }
}
