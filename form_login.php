<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      background-image: url('img/11.png');
      background-size: cover;
      /* ทำให้ภาพพื้นหลังครอบคลุมทั้งหน้าจอ */
      background-position: center;
      /* จัดให้อยู่ตรงกลาง */
      background-repeat: no-repeat;
      /* ป้องกันการทำซ้ำของภาพพื้นหลัง */
    }

    .card {
      border: 3px solid #BF6159;
      /* กำหนดสีกรอบ */
      border-radius: 1rem;
      /* ทำให้มุมโค้งมน */
      background-color: rgba(255, 255, 255, 0.9);
      /* เพิ่มพื้นหลังสีขาวพร้อมความโปร่งแสงเล็กน้อย */
    }

    .container {
      display: flex;
      justify-content: center;
      /* จัดวางกล่องให้อยู่ตรงกลาง */
      align-items: center;
      height: 100vh;
      /* ใช้ความสูงเต็มหน้าจอ */
    }
  </style>
</head>

<body>

  <header class="px-5 d-flex align-items-center">
    <nav class="navbar navbar-expand-lg" style="width: 100%;">
      <div class="container-fluid">
        <a class="navbar-brand" href="/center">
          <img src="img/logo.png" width="100" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar content -->
        </div>
      </div>
    </nav>
  </header>

  <div class="container">
    <div class="card" style="width: 100%; max-width: 500px;">
      <div class="card-body">
        <h2 class="text-center my-4">Login</h2>
        <form method="post" action="login_user.php">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required autocomplete="username">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-outline-primary">Login</button>
          </div>
          <div class="text-center mb-3">
            <span>or</span>
          </div>
          <div class="d-grid">
            <button type="button" class="btn btn-outline-success" onclick="lineLogin()">Login with LINE</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script>


    function lineLogin() {
      // Implement LINE login logic here
      alert('LINE login is not implemented yet.');
    }
  </script>
</body>

</html>
