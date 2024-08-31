<!DOCTYPE html>
<html lang="en">


    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Hugo 0.104.2">
      <title>ศูนย์กลางเครื่องสำอาง</title>
      <link href="style.css" rel="stylesheet" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body>
      

      <header class="w-100 bg-D9D9D9 px-5" style="height: 70px;">
          <nav class="navbar navbar-expand-lg container">
              <div class="d-flex flex-wrap w-100 justify-content-between align-items-center center">
                  <a href="#">
                      <img src="img/logo.png" width="130px" alt="">
                  </a>
              </div>
          </nav>
      </header>


      
      
        <style>
          .card {
            border: 4px solid #BF6159; /* กำหนดสีกรอบเป็นสีส้ม */
            border-radius: 0.375rem; /* กำหนดความโค้งของมุมกรอบ */
          }
        </style>
    </head>


    <br>
    <br>
    <br>
      <div class="d-flex justify-content-center align-items-center ">
        <div class="card" style="width:100%; max-width: 500px;">
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
                <label for="text" class="form-label">Phone</label>
                <input type="text" class="form-control" id="number" name ="number" maxlength="10"  placeholder="Enter your number" required>
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
                <center><button type="submit" class="btn btn-primary">Register</button></center>
              </div>
              <div class="text-center mb-3">
              </div>
            </form>
          </div>
        </div>

      

    </div>
   </body>

 </html>