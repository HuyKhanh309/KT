<?php
class NhanVienModel
{
    private $conn;
    private $table_name = "nhanvien";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllNhanViens()
    {
        $query = "SELECT 
                    nv.Ma_NV,
                    nv.Ten_NV,
                    nv.Phai,
                    nv.Noi_Sinh,
                    pb.Ten_Phong,
                    nv.Luong
                  FROM nhanvien nv
                  JOIN phongban pb ON nv.Ma_Phong = pb.Ma_Phong";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getNhanVienById($ma_nv)
    {
        $query = "SELECT 
                    nv.Ma_NV,
                    nv.Ten_NV,
                    nv.Phai,
                    nv.Noi_Sinh,
                    pb.Ten_Phong,
                    nv.Luong
                  FROM nhanvien nv
                  JOIN phongban pb ON nv.Ma_Phong = pb.Ma_Phong
                  WHERE nv.Ma_NV = :ma_nv";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ma_nv', $ma_nv);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getNhanViensByPage($limit, $offset)
    {
        $query = "SELECT 
                    nv.Ma_NV, nv.Ten_NV, nv.Phai, nv.Noi_Sinh,
                    pb.Ten_Phong, nv.Luong
                FROM nhanvien nv
                JOIN phongban pb ON nv.Ma_Phong = pb.Ma_Phong
                LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function countNhanViens()
    {
        $query = "SELECT COUNT(*) as total FROM nhanvien";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function addNhanVien($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong)
    {
        $query = "INSERT INTO nhanvien 
                    (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong)
                VALUES 
                    (:ma_nv, :ten_nv, :phai, :noi_sinh, :ma_phong, :luong)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ma_nv', $ma_nv);
        $stmt->bindParam(':ten_nv', $ten_nv);
        $stmt->bindParam(':phai', $phai);
        $stmt->bindParam(':noi_sinh', $noi_sinh);
        $stmt->bindParam(':ma_phong', $ma_phong);
        $stmt->bindParam(':luong', $luong);

        return $stmt->execute();
    }

    public function updateNhanVien($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong)
    {
        $query = "UPDATE nhanvien 
                SET Ten_NV = :ten_nv, 
                    Phai = :phai, 
                    Noi_Sinh = :noi_sinh, 
                    Ma_Phong = :ma_phong, 
                    Luong = :luong 
                WHERE Ma_NV = :ma_nv";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ma_nv', $ma_nv);
        $stmt->bindParam(':ten_nv', $ten_nv);
        $stmt->bindParam(':phai', $phai);
        $stmt->bindParam(':noi_sinh', $noi_sinh);
        $stmt->bindParam(':ma_phong', $ma_phong);
        $stmt->bindParam(':luong', $luong);

        return $stmt->execute();
    }

    public function deleteNhanVien($ma_nv)
    {
        $query = "DELETE FROM nhanvien WHERE Ma_NV = :ma_nv";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ma_nv', $ma_nv);
        return $stmt->execute();
    }

}
?>
