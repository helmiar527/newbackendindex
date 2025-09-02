<?php

namespace App\Models;

use App\Systems\Database;

class Token
{
  private $table = 'token';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function Add($datas)
  {
    $query = "INSERT INTO " . $this->table . " (id, token, expiry_time) VALUES(NULL, :token, :expiry_time)";
    $this->db->query($query);
    $this->db->bind('token', $datas['token']);
    $this->db->bind('expiry_time', $datas['expiry_time']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function verifyToken($datas)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE token = :token";
    $this->db->query($query);
    $this->db->bind('token', $datas['token']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  // public function Delete($datas)
  // {
  //   $query = "DELETE FROM " . $this->table . " WHERE token = :token AND user_agent = :user_agent";
  //   $this->db->query($query);
  //   $this->db->bind('token', $datas['token']);
  //   $this->db->bind('user_agent', $datas['user_agent']);
  //   $this->db->execute();
  //   return $this->db->rowCount();
  // }
}
