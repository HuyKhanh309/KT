<?php
require_once('app/config/database.php');
require_once('app/models/UserModel.php');

class UserController
{
    private $userModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    public function index()
    {
        $users = $this->userModel->getAllUsers();
        include 'app/views/user/list.php';
    }

    public function show($id)
    {
        $user = $this->userModel->getUserById($id);
        if ($user) {
            include 'app/views/user/show.php';
        } else {
            echo "Không tìm thấy người dùng.";
        }
    }
}
?>
