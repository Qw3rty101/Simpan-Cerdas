<?php 

class Home extends Controller {
    public function index()
    {
        $userId = $_SESSION['anggota'];

        $data['judul'] = 'Dashboard';
        $data['nama'] = $this->model('User_model')->getUser($userId);
        $data['anggota'] = $this->model('Home_model')->getAllUsers();
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');

    }
}