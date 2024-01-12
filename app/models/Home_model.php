<?php 

class Home_model {
    private $table = 'tbl_anggota';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMahasiswa()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getMahasiswaById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getAllUsers() {
        $query = "
            SELECT (
                SELECT COUNT(*) FROM tbl_anggota
            ) AS total_anggota,
            (
                SELECT SUM(jml_simpanan) FROM tbl_simpanan
            ) AS total_simpanan
        ";

        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }
}