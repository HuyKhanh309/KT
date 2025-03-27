<?php include 'app/views/shares/header.php'; ?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 10px;
    }

    th {
        background-color: #fefefe;
        color: red;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .gender-icon {
        width: 30px;
        height: 30px;
    }

    .btn-add {
        display: inline-block;
        background-color: green;
        color: white;
        padding: 8px 12px;
        text-decoration: none;
        margin-bottom: 10px;
        float: right;
        font-weight: bold;
    }

    .table-title {
        text-align: center;
        color: #0033cc;
        font-size: 22px;
        margin-bottom: 15px;
    }

    .action-icons img {
        width: 20px;
        margin: 0 5px;
        cursor: pointer;
    }
</style>

<div class="table-title">THÔNG TIN NHÂN VIÊN</div>
<a href="/BT6/User/add" class="btn-add">THÊM NHÂN VIÊN</a>

<table>
    <thead>
        <tr>
            <th>Mã Nhân Viên</th>
            <th>Tên Nhân Viên</th>
            <th>Giới tính</th>
            <th>Nơi Sinh</th>
            <th>Tên Phòng</th>
            <th>Lương</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user->Id); ?></td>
                <td><?php echo htmlspecialchars($user->fullname); ?></td>
                <td>
                    <?php
                        $genderIcon = ($user->role === 'admin') 
                                      ? 'https://cdn-icons-png.flaticon.com/512/1998/1998671.png' // Male icon
                                      : 'https://cdn-icons-png.flaticon.com/512/1998/1998611.png'; // Female icon
                    ?>
                    <img src="<?php echo $genderIcon; ?>" alt="gender" class="gender-icon">
                </td>
                <td><?php echo htmlspecialchars($user->email); ?></td>
                <td><?php echo htmlspecialchars($user->username); ?></td>
                <td><?php echo number_format($user->Luong ?? 0); ?></td>
                <td class="action-icons">
                    <a href="/BT6/User/edit/<?php echo $user->Id; ?>">
                        <img src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png" alt="edit">
                    </a>
                    <a href="/BT6/User/delete/<?php echo $user->Id; ?>" onclick="return confirm('Bạn có chắc muốn xóa?');">
                        <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="delete">
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'app/views/shares/footer.php'; ?>
