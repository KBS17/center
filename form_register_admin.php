<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Register for admin account">
  <meta name="author" content="Your Name">
  <meta name="generator" content="HTML5">
  <title>ศูนย์กลางเครื่องสำอาง</title>
  <link href="style.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      background-image: url('img/11.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .card {
      border: 3px solid #BF6159;
      border-radius: 1rem;
      background-color: rgba(255, 255, 255, 0.9);
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      padding-left: 0;
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
        <h2 class="text-center my-4">Register</h2>
        <form method="post" action="insert_register_admin.php">
          <div class="mb-3">
            <label for="username" class="form-label">Username(ชื่อ)</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required autocomplete="username">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password(รหัสผ่าน)</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required autocomplete="new-password">
          </div>
          <div class="mb-3">
            <label for="number" class="form-label">Phone(เบอร์โทร)</label>
            <input type="text" class="form-control" id="number" name="number" maxlength="10" placeholder="Enter your phone number" required autocomplete="tel">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email(อีเมล)</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required autocomplete="email">
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>