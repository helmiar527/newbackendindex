<?php

namespace App\Controllers;

require_once 'Index.php';

class Contact extends Controller
{
  public function __construct()
  {
    $this->api('POST');
  }

  public function index()
  {
    if (!$_POST) {
      $this->code("400", "Data Request Does Not Exist");
    } else {
      if (empty($_POST['token']) | empty($_POST['time']) | empty($_POST['date']) | empty($_POST['name']) | empty($_POST['email']) | empty($_POST['message'])) {
        $this->code("400", "Incomplete Data Request");
      } else {
        $indexController = (new Index())->index($_POST['token']);
        $_POST['device'] = $_SERVER['HTTP_USER_AGENT'];
        if (!empty($indexController[1])) {
          if($this->model('Contact')->Add($_POST) < 0){
            $this->code('503', 'Server are down');
          } else {
            $this->code('200', 'Contact has send');
          }
        }
      }
    }
  }
}
