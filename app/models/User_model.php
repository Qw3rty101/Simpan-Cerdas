<?php 

class User_model {
    private $database;
    private $db;

    public function __construct() {

         $this->database = new Database;
    }

    public function getUser($userId)
    {
        // Query SQL untuk mengambil data nama dari tabel pengguna berdasarkan ID
        $sql = "SELECT nama_anggota FROM tbl_anggota WHERE id_anggota = :userId";

        // Persiapkan statement
        $this->database->query($sql);

        // Binding parameter
        $this->database->bind(':userId', $userId);

        // Eksekusi query dan ambil data pengguna
        $result = $this->database->single();

        // Periksa apakah data ditemukan
        if ($result) {
            return $result['nama_anggota'];
        } else {
            return 'Nama Tidak Ditemukan';
        }
    }
}


// class User_model {
//     private $nama = 'Doddy Ferdiansyah';

//     public function getUser()
//     {
//         return $this->nama;
//     }
// }