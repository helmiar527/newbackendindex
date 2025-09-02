<?php

namespace App\Systems;

class App
{
  // Definisikan konstanta
  protected $controller = HOME;
  protected $method = INDEX;
  protected $params = [];
  protected $controllerNamespace = "App\\Controllers\\";

  public function __construct()
  {
    $url = $this->parseURL();

    // Remove error
    if ($url == NULL) {
      $url = [$this->controller];
    }

    // Change url first
    $url[0] = ucfirst($url[0]);

    // Check controller
    if (file_exists('app/controllers/' . $url[0] . '.php')) {
      $this->controller = $url[0];
      unset($url[0]);
    } else {
      $this->controller = 'Error404';
    }

    // Require controller file
    require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
    // Create full class name with namespace
    $controllerClass = $this->controllerNamespace . $this->controller;

    // Instantiate controller
    if (class_exists($controllerClass)) {
      $this->controller = new $controllerClass();
    }

    // Method
    if (isset($url[1])) {
      if (method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
      }
    }

    // Parameter
    if (!empty($url)) {
      $this->params = array_values($url);
    }

    // controller dan method dan kirim params jika ada
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  protected function parseURL()
  {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return ($url);
    }
  }
}
