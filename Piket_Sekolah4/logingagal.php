
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Halaman Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <style type="text/css">
      body{
        
      }
    </style>
  </head>

  <body class="text-center  bg-dark">
    <br><br><br>
    <div class="container w-50 border border-primary shadow-lg p-3 mb-5 bg-white rounded"> 
    <form class="form-signin" method="post" action="loginproc.php">      
      <h1 class="display-4">Halaman Login</h1><br>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="name" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" name="password" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div style="color : red" width="15px" height="15px">Password atau username anda salah.</div>      
      <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Masuk</button>      
    </form>
  </div>
  </body>
</html>
