<?php 

class Simpanan extends Controller {
    public function penarikan()
    {
        $userId = $_SESSION['anggota'];

        $data['judul'] = 'Penarikan';
        $data['nama'] = $this->model('User_model')->getUser($userId);
        $data['saldo'] = $this->model('Simpanan_model')->getSaldo($userId);
        $this->view('templates/header', $data);
        $this->view('simpanan/penarikan', $data);
        $this->view('templates/footer');
    }

    public function setoran()
    {
        $userId = $_SESSION['anggota'];
        
        $data['judul'] = 'Setoran';
        $data['nama'] = $this->model('User_model')->getUser($userId);
        $data['saldo'] = $this->model('Simpanan_model')->getSaldo($userId);
        $this->view('templates/header', $data);
        $this->view('simpanan/setoran', $data);
        $this->view('templates/footer');
    }

    public function setor() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nominal = isset($_POST['nominal']) ? intval($_POST['nominal']) : 0;
    
            // Sesuaikan dengan ID anggota yang sesuai dengan sesi pengguna saat login
            $id_anggota = $_SESSION['anggota'];
    
            // Panggil metode setoran pada model Simpanan_model
            if ($this->model('Simpanan_model')->setoran($id_anggota, $nominal)) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . '/simpanan/setoran');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . '/simpanan/setoran');
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
    
            // Panggil metode setoran pada model Simpanan_model
            if ($this->model('Simpanan_model')->ambil($id_anggota, $nominal)) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . '/simpanan/penarikan');
                exit;
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . '/simpanan/penarikan');
                exit;
            }
        }

        // var_dump($_POST['nominal']);
    }
}