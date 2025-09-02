<?php

namespace App\Systems;

class Controller
{
  // Register model
  public function model($model)
  {
    require_once __DIR__ . '/../models/' . $model . '.php';
    $className = "App\\Models\\" . $model;
    return new $className();
  }

  // Register api
  public function api($methods)
  {
    $allowedMethods = explode(' ', $methods);

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: " . implode(', ', $allowedMethods));
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Content-Type: application/json");


    if (!in_array($_SERVER['REQUEST_METHOD'], $allowedMethods)) {
      $this->code('405');
      exit();
    }
  }

  // Register response
  private function response($code)
  {
    header('HTTP/1.1 ' . $code);
    http_response_code($code);
    switch ($code) {
      case '200':
        return 'Ok';
      case '400':
        return 'Bad Request';
      case '401':
        return 'Unauthorized';
      case '404':
        return 'Not Found';
      case '405':
        return 'Method Not Allowed';
      case '503':
        return 'Service Unavailable';
      default:
        return 'Unknown';
    }
  }

  // Register code
  public function code($code, $message = NULL, $data = NULL, $type = 'front')
  {
    switch ($type) {
      case 'front':
        $status = $this->response($code);
        if (!$message) {
          echo json_encode(array("status" => $status));
          exit();
        }
        if (!$data) {
          echo json_encode(array("status" => $status, "message" => $message));
          exit();
        }
        echo json_encode(array(array("status" => $status, "message" => $message), $data));
        break;
      case 'back':
        $status = $this->response($code);
        if (!$message) {
          return (json_encode(array("status" => $status)));
        }
        if (!$data) {
          return (json_encode(array("status" => $status, "message" => $message)));
        }
        return (json_encode(array(array("status" => $status, "message" => $message), $data)));
    }
  }

  // Register dd
  public function dd($dataToDebug, $secondDataToDebug = null)
  {
    $debugData = array($dataToDebug);
    if ($secondDataToDebug !== null) {
      $debugData[] = $secondDataToDebug;
    }
    echo json_encode($debugData);
    exit();
  }

  public function tokenverify()
  {
    $headers = getallheaders();
    if (isset($headers['Authorization'])) {
      $authHeader = $headers['Authorization'];
      $token['token'] = substr($authHeader, 7);
      if ($this->model('Token')->verifyToken($token) === 1) {
        return;
      }
      $this->code("401", "Authorization invalid");
    }
    $this->code("404", "Authorization not found");
  }
}
