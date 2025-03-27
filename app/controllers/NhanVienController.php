<?php
require_once('app/config/database.php');
require_once('app/models/NhanVienModel.php');

class NhanVienController
{
    private $nhanVienModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->nhanVienModel = new NhanVienModel($this->db);
    }

    public function index()
    {
        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $total = $this->nhanVienModel->countNhanViens();
        $totalPages = ceil($total / $limit);

        $nhanviens = $this->nhanVienModel->getNhanViensByPage($limit, $offset);
        include 'app/views/nhanvien/list.php';
    }

    public function show($ma_nv)
    {
        $nhanvien = $this->nhanVienModel->getNhanVienById($ma_nv);
        if ($nhanvien) {
            include 'app/views/nhanvien/show.php';
        } else {
            echo "Không tìm thấy nhân viên.";
        }
    }

    public function add()
    {
        // Lấy danh sách phòng ban để đổ vào dropdown
        $stmt = $this->db->prepare("SELECT * FROM phongban");
        $stmt->execute();
        $phongbans = $stmt->fetchAll(PDO::FETCH_OBJ);

        include 'app/views/nhanvien/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ma_nv     = $_POST['Ma_NV'];
            $ten_nv    = $_POST['Ten_NV'];
            $phai      = $_POST['Phai'];
            $noi_sinh  = $_POST['Noi_Sinh'];
            $ma_phong  = $_POST['Ma_Phong'];
            $luong     = $_POST['Luong'];

            $result = $this->nhanVienModel->addNhanVien($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong);

            if ($result) {
                header('Location: /KT/NhanVien');
            } else {
                echo "Thêm nhân viên thất bại.";
            }
        }
    }

    public function edit($ma_nv)
    {
        $nhanvien = $this->nhanVienModel->getNhanVienById($ma_nv);

        // Lấy danh sách phòng ban
        $stmt = $this->db->prepare("SELECT * FROM phongban");
        $stmt->execute();
        $phongbans = $stmt->fetchAll(PDO::FETCH_OBJ);

        if ($nhanvien) {
            include 'app/views/nhanvien/edit.php';
        } else {
            echo "Không tìm thấy nhân viên.";
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ma_nv     = $_POST['Ma_NV'];
            $ten_nv    = $_POST['Ten_NV'];
            $phai      = $_POST['Phai'];
            $noi_sinh  = $_POST['Noi_Sinh'];
            $ma_phong  = $_POST['Ma_Phong'];
            $luong     = $_POST['Luong'];

            $result = $this->nhanVienModel->updateNhanVien($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong);

            if ($result) {
                header('Location: /KT/NhanVien');
            } else {
                echo "Cập nhật thất bại.";
            }
        }
    }

    public function delete($ma_nv)
    {
        $result = $this->nhanVienModel->deleteNhanVien($ma_nv);

        if ($result) {
            header('Location: /KT/NhanVien');
        } else {
            echo "Xóa nhân viên thất bại.";
        }
    }



}
?>
