<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h3 class="text-primary mb-4">Thêm Nhân Viên</h3>

    <form action="/KT/NhanVien/save" method="POST" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Mã Nhân Viên</label>
            <input type="text" name="Ma_NV" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Tên Nhân Viên</label>
            <input type="text" name="Ten_NV" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Giới tính</label>
            <select name="Phai" class="form-select" required>
                <option value="NAM">Nam</option>
                <option value="NU">Nữ</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Nơi Sinh</label>
            <input type="text" name="Noi_Sinh" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Phòng Ban</label>
            <select name="Ma_Phong" class="form-select" required>
                <?php foreach ($phongbans as $pb): ?>
                    <option value="<?php echo $pb->Ma_Phong; ?>"><?php echo $pb->Ten_Phong; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Lương</label>
            <input type="number" name="Luong" class="form-control" required>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="/KT/NhanVien" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>
