<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .card {
      border: 3px solid #BF6159; /* กำหนดสีกรอบเป็นสีส้ม */
      border-radius: 0.375rem; /* กำหนดความโค้งของมุมกรอบ */
    }
  </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
  <div class="card" style="width: 100%; max-width: 700px;">
    <div class="card-body">
      <h2 class="text-center my-4">Register</h2>
      <form method="post" action = "insert_register.php">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name ="username" placeholder="Enter your username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name ="password" placeholder="Enter your password" required>
        </div>
        <div class="mb-3">
          <label for="age" class="form-label">Age</label>
          <input type="age" class="form-control" id="age" name ="age" placeholder="Enter your age" required>
        </div>
        <div class="mb-3">
          <label for="number" class="form-label">Number</label>
          <input type="number" class="form-control" id="number" name ="number"  placeholder="Enter your number" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name ="email" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
          <label for="Profilepicture" class="form-label">Profile picture</label>
          <input type="file" class="form-control" id="Profilpictureil" name ="Profilepicture" placeholder="Enter your Profilepicture" required>
        </div>
        <div class="d-grid mb-3">
          <button type="submit"  class="btn btn-primary">Register</button>
        </div>
        <div class="text-center mb-3">
          <span>or</span>
        </div>
        <div class="d-grid mb-3">
          <button type="button" class="btn btn-danger" onclick="googleLogin()">Register with Google</button>
        </div>
        <div class="d-grid">
          <button type="button" class="btn btn-success" onclick="lineLogin()">Register with LINE</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
  <script>
    function googleLogin() {
      // Implement Google login logic here
      alert('Google login is not implemented yet.');
    }

    function lineLogin() {
      // Implement LINE login logic here
      alert('LINE login is not implemented yet.');
    }
  </script>
</body>
</html>
