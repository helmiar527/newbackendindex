<?php

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
    $query = "INSERT INTO " . $this->table . " (id, token, user_agent, combine, expiry_time) VALUES(NULL, :token, :user_agent, :combine, :expiry_time)";
    $this->db->query($query);
    $this->db->bind('token', $datas['token']);
    $this->db->bind('user_agent', $datas['user_agent']);
    $this->db->bind('combine', $datas['combine']);
    $this->db->bind('expiry_time', $datas['expiry_time']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function Verification($datas)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE token = :token AND user_agent = :user_agent";
    $this->db->query($query);
    $this->db->bind('token', $datas['token']);
    $this->db->bind('user_agent', $datas['user_agent']);
    return $this->db->single();
  }

  public function Delete($datas)
  {
    $query = "DELETE FROM " . $this->table . " WHERE token = :token AND user_agent = :user_agent";
    $this->db->query($query);
    $this->db->bind('token', $datas['token']);
    $this->db->bind('user_agent', $datas['user_agent']);
    $this->db->execute();
    return $this->db->rowCount();
  }
}
