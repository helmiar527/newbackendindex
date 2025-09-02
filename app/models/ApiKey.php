<?php

namespace App\Models;

use App\Systems\Database;

class ApiKey
{
    private $table = 'apiKey';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function Add($datas)
    {
        $query = "INSERT INTO " . $this->table . " (id, api_key, username) VALUES(NULL, :api_key, :username)";
        $this->db->query($query);
        $this->db->bind('api_key', $datas['api_key']);
        $this->db->bind('username', $datas['username']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function CheckApi($datas)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $this->db->query($query);
        $this->db->bind('username', $datas);
        $this->db->execute();
        return $this->db->single();
    }
}
