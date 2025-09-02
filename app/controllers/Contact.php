<?php

namespace App\Controllers;

// use App\Controllers\Index;
use App\Systems\Controller;

// require_once __DIR__ . '/Index.php';

class Contact extends Controller
{
  public function __construct()
  {
    $this->api('POST');
    $this->tokenverify();
  }

  public function index()
  {
    if (!$_POST) {
      $this->code("400", "Data request does not exist");
    }
    if (empty($_POST['time']) | empty($_POST['date']) | empty($_POST['name']) | empty($_POST['email']) | empty($_POST['message'])) {
      $this->code("400", "Incomplete data request");
    }
    $_POST['device'] = $_SERVER['HTTP_USER_AGENT'];
    if ($this->model('Contact')->Add($_POST) < 0) {
      $this->code("503", "Server are down");
    }
    $this->code("200", "Contact has send");
  }
}
