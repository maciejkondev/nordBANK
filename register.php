<html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="register.css">
    </head>
    <body class="bg-light">
        <header>
            <a href="index.php"><img src="logobiale.png" alt="Logo"></a>
        </header>
        <form action="" method="POST">
          <div class="form-group">
            <label for="Username">Username</label>
            <input type="text" class="form-control" name="username" id="username" required placeholder="Enter username">
          </div>
          <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" name="password" id="password" required placeholder="Enter password">
          </div>
          <div class="form-group">
            <label for="bankNumber">Generate your bank account number</label>
            <input type="number" required readonly="readonly" maxlength="26" onclick="generate()" class="form-control" name="bankNumber" id="bankNumber" placeholder="Click on me to generate your bank number">
          <button id="registerButton" type="submit" class="btn btn-success btn-primary">Register</button>
        </form>
    </body>
    <script>
        function generate(){
            let banknumber = "00";
            for(i=0;i<24;i++){
                banknumber = banknumber + Math.floor((Math.random() * 9) + 1).toString();
            }
            console.log(banknumber);
            document.getElementById('bankNumber').value = banknumber;
        }
    </script>
</head>
<html>
<?php
    @$username = $_POST['username'];
    @$password = $_POST['password'];
    @$bankNumber = $_POST['bankNumber'];
    $servername = "johnny.heliohost.org";
    $dbusername = "maciejko_admin";
    $dbpassword = "Maciusmi1";
    $dbname = "maciejko_bank";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    $sql = "INSERT INTO users(username, password, bank_account_number,balance) VALUES('$username','$password','$bankNumber','100')";
    if(!empty($username) && !empty($password) && !empty($bankNumber)){
    $conn->query($sql);
    header('Location: https://nordbank.herokuapp.com');
    }
    
?>