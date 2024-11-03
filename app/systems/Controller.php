<?php

namespace App\Systems;

class Controller
{
  // Register model
  public function model($model)
  {
    require_once 'app/models/' . $model . '.php';
    return new $model;
  }

  public function api($methods)
  {
    switch (trim($methods)) {
      case 'GET':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'POST':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'PUT':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'DELETE':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'GET POST':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST'])) {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'GET PUT':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'PUT'])) {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'GET DELETE':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'DELETE'])) {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'POST PUT':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if (!in_array($_SERVER['REQUEST_METHOD'], ['POST', 'PUT'])) {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'POST DELETE':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if (!in_array($_SERVER['REQUEST_METHOD'], ['POST', 'DELETE'])) {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'PUT DELETE':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if (!in_array($_SERVER['REQUEST_METHOD'], ['PUT', 'DELETE'])) {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'GET POST PUT':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST', 'PUT'])) {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'GET POST DELETE':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST', 'DELETE'])) {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'GET PUT DELETE':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'PUT', 'DELETE'])) {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'POST PUT DELETE':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if (!in_array($_SERVER['REQUEST_METHOD'], ['POST', 'PUT', 'DELETE'])) {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      case 'GET POST PUT DELETE':
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: $methods");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json");
        if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST', 'PUT', 'DELETE'])) {
          header('HTTP/1.1 405');
          http_response_code(405);
          echo json_encode(["status" => "error", "message" => "Method not allowed"]);
          exit;
        }
        break;
      default:
        header('HTTP/1.1 400');
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Method Not Found"]);
        break;
    }
  }

  public function code($code, $message, $data = NULL, $type = 'front')
  {
    function response($code)
    {
      header('HTTP/1.1 ' . $code);
      http_response_code($code);
      switch ($code) {
        case '200':
          return ($status = 'Ok');
        case '400':
          return ($status = 'Bad Request');
        case '404':
          return ($status = 'Not Found');
        case '503':
          return ($status = 'Service Unavailable');
        case 'value':
          $status = '';
          break;

        default:
          break;
      }
    }
    switch ($type) {
      case 'front':
        $status = response($code);
        if (!$data) {
          echo json_encode(array("status" => $status, "message" => $message));
        } else {
          echo json_encode(array(array("status" => $status, "message" => $message), $data));
        }
        break;
      case 'back':
        $status = response($code);
        if (!$data) {
          return (json_encode(array("status" => $status, "message" => $message)));
        } else {
          return (json_encode(array(array("status" => $status, "message" => $message), $data)));
        }
      default:
        # code...
        break;
    }
  }

  public function dd($text1, $text2 = NULL)
  {
    echo json_encode(array($text1, array($text2)));
  }
}
