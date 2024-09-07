<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      background-image: url('img/11.png');
      background-size: cover; /* ทำให้ภาพพื้นหลังครอบคลุมทั้งหน้าจอ */
      background-position: center; /* จัดให้อยู่ตรงกลาง */
      background-repeat: no-repeat; /* ป้องกันการทำซ้ำของภาพพื้นหลัง */
    }
    .card {
      border: 3px solid #BF6159; /* กำหนดสีกรอบ */
      border-radius: 1rem; /* ทำให้มุมโค้งมน */
      background-color: rgba(255, 255, 255, 0.9); /* เพิ่มพื้นหลังสีขาวพร้อมความโปร่งแสงเล็กน้อย */
    }
    .container {
      display: flex;
      justify-content: center; /* จัดวางกล่องให้อยู่ตรงกลาง */
      align-items: center;
      height: 100vh;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card" style="width: 100%; max-width: 500px;">
      <div class="card-body">
        <h2 class="text-center my-4">Login Admin</h2>
        <form method="post" action="login_admin.php">
          <div class="mb-3">
            <label for="admin_id" class="form-label">Username</label>
            <input type="text" class="form-control" id="admin_id" name="admin_id" placeholder="Enter your username" required autocomplete="username">
          </div>
          <div class="mb-3">
            <label for="admin_password" class="form-label">Password</label>
            <input type="password" class="form-control" id="admin_password" name="admin_password" placeholder="Enter your password" required autocomplete="current-password">
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-outline-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
