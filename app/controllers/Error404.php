<?php

namespace App\Controllers;

use App\Systems\Controller;

class Error404 extends Controller
{
  public function __construct()
  {
    $this->api('GET POST PUT PATCH DELETE HEAD OPTIONS');
  }

  public function index()
  {
    $this->code('404', 'Api url not found');
  }
}
