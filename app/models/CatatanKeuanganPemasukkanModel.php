<?php

class CatatanKeuanganPemasukkanModel
{
  private $table = 'catatanPemasukkan';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function insertPemasukkan($data)
  {
    $query = "INSERT INTO " . $this->table . " (id, hari, tanggal, pemasukkan, nominal, status, username) VALUES(NULL, :hari, :tanggal, :pemasukkan, :nominal, :status, :username)";
    $this->db->query($query);
    $this->db->bind('hari', $data['tambahhari']);
    $this->db->bind('tanggal', $data['tambahtanggal']);
    $this->db->bind('pemasukkan', $data['tambahpemasukkan']);
    $this->db->bind('nominal', $data['tambahnominal']);
    $this->db->bind('status', $data['tambahstatus']);
    $this->db->bind('username', $data['username']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function changePemasukkan($data)
  {
    $query = "UPDATE " . $this->table . " SET hari = :hari, tanggal = :tanggal, pemasukkan = :pemasukkan, nominal = :nominal, status = :status WHERE id = :id AND username = :username";
    $this->db->query($query);
    $this->db->bind('hari', $data['hari']);
    $this->db->bind('tanggal', $data['tanggal']);
    $this->db->bind('pemasukkan', $data['pemasukkan']);
    $this->db->bind('nominal', $data['nominal']);
    $this->db->bind('status', $data['status']);
    $this->db->bind('id', $data['id']);
    $this->db->bind('username', $data['username']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function deletePemasukkan($data)
  {
    $query = "DELETE FROM " . $this->table . " WHERE id = :id AND username = :username";
    $this->db->query($query);
    $this->db->bind('id', $data['id']);
    $this->db->bind('username', $data['username']);
    $this->db->execute();
    return $this->db->rowCount();
  }
  public function getAllPemasukkan($data)
  {
    $searching = $data['searching'];
    $urutan = $data['urutan'];
    $query = "SELECT * FROM " . $this->table . " WHERE username = :username AND hari LIKE :hari OR username = :username AND tanggal LIKE :tanggal OR username = :username AND pemasukkan LIKE :pemasukkan OR username = :username AND nominal LIKE :nominal $urutan";
    $this->db->query($query);
    $this->db->bind('username', $data['username']);
    $this->db->bind('hari', "%$searching%");
    $this->db->bind('tanggal', "%$searching%");
    $this->db->bind('pemasukkan', "%$searching%");
    $this->db->bind('nominal', "%$searching%");
    $this->db->bind('status', "%$searching%");
    return $this->db->resultSet();
  }

  public function getBulanTahunPemasukkanIndex($data)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE username = :username AND status = :status ORDER BY tanggal ASC";
    $this->db->query($query);
    $this->db->bind('username', $data['username']);
    $this->db->bind('status', $data['status']);
    return $this->db->resultSet();
  }

  public function getAllPemasukkanIndex($data)
  {
    $query = "SELECT * FROM " . $this->table . " WHERE username = :username AND tanggal BETWEEN :tanggalAwal AND :tanggalAkhir AND status = :status ORDER BY tanggal ASC";
    $this->db->query($query);
    $this->db->bind('username', $data['username']);
    $this->db->bind('tanggalAwal', $data['tanggalAwal']);
    $this->db->bind('tanggalAkhir', $data['tanggalAkhir']);
    $this->db->bind('status', $data['status']);
    return $this->db->resultSet();
  }
}
