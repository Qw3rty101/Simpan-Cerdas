<?php 

class Pinjaman_model {
    private $table = 'tbl_pinjaman';
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

    public function getPinjaman($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_anggota=:id');
        $this->db->bind('id', $id);
        // return $this->db->single();
        return $this->db->resultSet();
    }

    // public function getPinjamanAll()
    // {
    //     $this->db->query('SELECT * FROM ' . $this->table);
    //     // $this->db->bind('id', $id);
    //     // return $this->db->single();
    //     return $this->db->resultSet();
    // }

    public function getPinjamanAll()
    {
        $this->db->query('SELECT p.*, a.nama_anggota FROM ' . $this->table . ' p JOIN tbl_anggota a ON p.id_anggota = a.id_anggota');
        return $this->db->resultSet();
    }


    public function getSaldo($id)
    {
        $this->db->query('SELECT SUM(jml_pinjaman) AS total_pinjaman FROM ' . $this->table . ' WHERE id_anggota=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    

    public function pinjam($id_anggota, $nominal)
    {
        // Lakukan update pada tabel tbl_simpanan
        $this->db->query('INSERT INTO ' . $this->table . '(id_anggota, jml_pinjaman, tgl_pinjaman, status_pinjaman) VALUES (:id, :nominal, NOW(),  :status)');
        $this->db->bind(':nominal', $nominal, PDO::PARAM_INT);
        $this->db->bind(':id', $id_anggota, PDO::PARAM_INT);
        // $this->db->bind(':tgl', 'NOW()');
        $this->db->bind(':status', 'Diproses');
    
        return $this->db->execute(); // Jalankan query update
    }

    public function ambil($id_anggota, $nominal)
    {
        // Ambil jumlah simpanan yang saat ini ada
        $this->db->query('SELECT jml_simpanan FROM ' . $this->table . ' WHERE id_anggota = :id');
        $this->db->bind(':id', $id_anggota, PDO::PARAM_INT);
        $jml_simpanan_sekarang = $this->db->single()['jml_simpanan'];
    
        // Cek apakah nominal yang diambil tidak melebihi jumlah simpanan yang ada
        if ($nominal > $jml_simpanan_sekarang) {
            return false; // Jika melebihi, kembalikan false atau lakukan tindakan lain sesuai kebutuhan
        }
    
        // Lakukan update pada tabel tbl_simpanan
        $this->db->query('UPDATE ' . $this->table . ' SET jml_simpanan = jml_simpanan - :nominal WHERE id_anggota=:id');
        $this->db->bind(':nominal', $nominal, PDO::PARAM_INT);
        $this->db->bind(':id', $id_anggota, PDO::PARAM_INT);
    
        return $this->db->execute(); // Jalankan query update
    }

    public function terima($id_anggota, $id_pinjaman, $nominal) {
        // Logika Anda untuk menerima pinjaman
        // Contoh: Update status_pinjaman ke 'Diterima' dan lakukan hal-hal lain yang dibutuhkan
        $this->db->query('UPDATE ' . $this->table . ' SET status_pinjaman = "Diterima" WHERE id_anggota = :id_anggota AND id_pinjaman = :id_pinjaman');
        $this->db->bind('id_anggota', $id_anggota);
        $this->db->bind('id_pinjaman', $id_pinjaman);
        return $this->db->execute();
    }
    
    public function tolak($id_anggota, $id_pinjaman, $nominal) {
        // Logika Anda untuk menolak pinjaman
        // Contoh: Update status_pinjaman ke 'Ditolak' dan lakukan hal-hal lain yang dibutuhkan
        $this->db->query('UPDATE ' . $this->table . ' SET status_pinjaman = "Ditolak" WHERE id_anggota = :id_anggota AND id_pinjaman = :id_pinjaman');
        $this->db->bind('id_anggota', $id_anggota);
        $this->db->bind('id_pinjaman', $id_pinjaman);
        return $this->db->execute();
    }
    
    
    
    public function ubahDataMahasiswa($data)
    {
        $query = "UPDATE mahasiswa SET
                    nama = :nama,
                    nrp = :nrp,
                    email = :email,
                    jurusan = :jurusan
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nrp', $data['nrp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

}