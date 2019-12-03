  <?php
  session_start();
  $_SESSION['loggedin'] = false;
  ?>
  <html>
      <head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="index.css">
        <title>NordBANK</title>
      </head>
      <body class="bg-light">
        <header>
          <img src="logobiale.png" alt="logo"></img>
        </header>
        <h1>Sign in to your bank account</h1>
        <form action="login.php" method="POST">
          <div class="form-group">
            <label for="Username">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username"></input>
          </div>
          <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password"></input>
          </div>
          <button type="submit" class="btn btn-success">Log in</button>
        </form>
        <button type="button" onclick="window.location.replace('register.php')" class="register btn btn-primary btn-success" >Don't have an account yet?</button>
      </body>	
    </html>