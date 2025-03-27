<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h2 class="text-center text-primary mb-4">THÔNG TIN NHÂN VIÊN</h2>
    
    <div class="text-end mb-3">
        <a href="/KT/NhanVien/add" class="btn btn-success">THÊM NHÂN VIÊN</a>
    </div>

    <table class="table table-bordered table-striped align-middle text-center">
        <thead class="table-danger">
            <tr>
                <th>Mã Nhân Viên</th>
                <th>Tên Nhân Viên</th>
                <th>Giới tính</th>
                <th>Nơi Sinh</th>
                <th>Tên Phòng</th>
                <th>Lương</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nhanviens as $nv): ?>
                <tr>
                    <td><?php echo htmlspecialchars($nv->Ma_NV); ?></td>
                    <td><?php echo htmlspecialchars($nv->Ten_NV); ?></td>
                    <td>
                        <?php
                            $genderIcon = ($nv->Phai === 'NAM')
                                ? '/KT/app/public/images/Man.jpg'
                                : '/KT/app/public/images/Woman.jpg';
                        ?>
                        <img src="<?php echo $genderIcon; ?>" alt="gender" class="rounded-circle" width="32" height="32">
                    </td>
                    <td><?php echo htmlspecialchars($nv->Noi_Sinh); ?></td>
                    <td><?php echo htmlspecialchars($nv->Ten_Phong); ?></td>
                    <td><?php echo number_format($nv->Luong); ?></td>
                    <td>
                        <a href="/KT/NhanVien/edit/<?php echo $nv->Ma_NV; ?>" class="btn btn-sm btn-warning me-1">
                            <i class="bi bi-pencil-fill"></i> Sửa
                        </a>
                        <a href="/KT/NhanVien/delete/<?php echo $nv->Ma_NV; ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc muốn xóa nhân viên này?');">
                            <i class="bi bi-trash-fill"></i> Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php include 'app/views/shares/footer.php'; ?>
