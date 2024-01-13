<?php 

class Master extends Controller {
    public function index()
    {
        $userId = $_SESSION['anggota'];

        $data['judul'] = 'Users';
        $data['nama'] = $this->model('User_model')->getUser($userId);
        $data['anggota'] = $this->model('Home_model')->getAllAnggota();
        $this->view('templates/header', $data);
        $this->view('USER/index', $data);
        $this->view('templates/footer');

    }
}