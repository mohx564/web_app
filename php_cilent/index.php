<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إدارة المستخدمين</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">إدارة المستخدمين</h2>

        <!-- Form لإضافة مستخدم جديد -->
        <div class="card mb-4">
            <div class="card-header">إضافة مستخدم جديد</div>
            <div class="card-body">
                <form action="insert.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">الاسم</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">إضافة</button>
                </form>
            </div>
        </div>

        <!-- جدول لعرض المستخدمين -->
        <div class="card">
            <div class="card-header">قائمة المستخدمين</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>المعرف</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $api_url = "http://localhost:3000/users"; // رابط API
                        $response = file_get_contents($api_url);
                        $users = json_decode($response, true);

                        if (!empty($users)) {
                            foreach ($users as $user) {
                                echo "<tr>
                                    <td>{$user['id']}</td>
                                    <td>{$user['name']}</td>
                                    <td>{$user['email']}</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' class='text-center'>لا توجد بيانات</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
