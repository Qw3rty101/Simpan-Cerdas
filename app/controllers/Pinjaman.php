<?php 

class Pinjaman extends Controller {
    
    public function pengajuan()
    {
        $userId = $_SESSION['anggota'];

        $data['judul'] = 'Pengajuan';
        $data['nama'] = $this->model('User_model')->getUser($userId);
        // $data['saldo'] = $this->model('Pinjaman_model')->getSaldo($userId);
        $this->view('templates/header', $data);
        $this->view('pinjaman/pengajuan', $data);
        $this->view('templates/footer');
    }

    public function peminjam()
    {
        $userId = $_SESSION['anggota'];
        
        $data['judul'] = 'Peminjam';
        $data['nama'] = $this->model('User_model')->getUser($userId);
        // $data['saldo'] = $this->model('Pinjaman_model')->getSaldo($userId);
        $this->view('templates/header', $data);
        $this->view('pinjaman/peminjam', $data);
        $this->view('templates/footer');
    }

    public function setor() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nominal = isset($_POST['nominal']) ? intval($_POST['nominal']) : 0;
    
            // Sesuaikan dengan ID anggota yang sesuai dengan sesi pengguna saat login
            $id_anggota = $_SESSION['anggota'];
    
            // Panggil metode peminjam pada model Pinjaman_model
            if ($this->model('Pinjaman_model')->peminjam($id_anggota, $nominal)) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . '/pinjaman/peminjam');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . '/pinjaman/peminjam');
                exit;
            }
        }

        // var_dump($_POST['nominal']);
    }

    public function ambil() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nominal = isset($_POST['nominal']) ? intval($_POST['nominal']) : 0;
    
            // Sesuaikan dengan ID anggota yang sesuai dengan sesi pengguna saat login
            $id_anggota = $_SESSION['anggota'];
    
            // Panggil metode peminjam pada model Pinjaman_model
            if ($this->model('Pinjaman_model')->ambil($id_anggota, $nominal)) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . '/pinjaman/pengajuan');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . '/pinjaman/pengajuan');
                exit;
            }
        }

        // var_dump($_POST['nominal']);
    }
}