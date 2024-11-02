<?php

namespace app\models;

class Contact
{
  private $table = 'contact';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  public function Add($datas)
  {
    $query = "INSERT INTO " . $this->table . " (id, time, date, name, email, message, device) VALUES(NULL, :time, :date, :name, :email, :message, :device)";
    $this->db->query($query);
    $this->db->bind('time', $datas['time']);
    $this->db->bind('date', $datas['date']);
    $this->db->bind('name', $datas['name']);
    $this->db->bind('email', $datas['email']);
    $this->db->bind('message', $datas['message']);
    $this->db->bind('device', $datas['device']);
    $this->db->execute();
    return $this->db->rowCount();
  }
}
