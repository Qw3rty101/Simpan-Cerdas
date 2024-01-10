<?php 

class Simpanan_model {
    private $table = 'tbl_simpanan';
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

    public function getSaldo($id)
    {
        $this->db->query('SELECT jml_simpanan FROM ' . $this->table . ' WHERE id_anggota=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function setoran($id_anggota, $nominal)
    {
        // Lakukan update pada tabel tbl_simpanan
        $this->db->query('UPDATE ' . $this->table . ' SET jml_simpanan = jml_simpanan + :nominal WHERE id_anggota=:id');
        $this->db->bind(':nominal', $nominal, PDO::PARAM_INT);
        $this->db->bind(':id', $id_anggota, PDO::PARAM_INT);
    
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