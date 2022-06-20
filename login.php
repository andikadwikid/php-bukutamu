<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <title>Login</title>
</head>
<body>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Login </h2>
    

    <!-- Icon -->
    <div class="fadeIn first">
<h2>Buku Tamu</h2>
</div>
    <div class="fadeIn first">

      <img src="img/abc.jpg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action="login-proses.php" method="post">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="username">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <button type="submit">Login</button>
    </form>

    
    

  </div>
</div>
</body>
</html>