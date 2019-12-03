<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "<p style='position: absolute; bottom: 0;'>Welcome back to your account, " . $_SESSION['username'] . "!</p>";
} else {
    header('Location: '.'index.php');
}
$servername = "johnny.heliohost.org";
$dbusername = "maciejko_admin";
$dbpassword = "Maciusmi1";
$dbname = "maciejko_bank";
$username = $_SESSION['username'];
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
$sql = "SELECT * from users where username='$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <form action="logout.php" method="POST">
            <button id="logout" class="btn btn-primary" type="submit">Logout</button>
        </form>
        <header>
            <img src="logobiale.png" alt="logo"></img>
        </header>
        <div class="options">
            <h2 style="text-align: center">Balance</h2>
            <?php
                echo "<h3 style='text-align: center'>" . $row['balance'] . "$</h3>";
                echo "<h5 style='text-align: center; margin-top: 30px;'> Your bank account number</h5>";
                echo "<h6 style='text-align: center' id='banknumber'>" . $row['bank_account_number'] . "</h6>";
            ?>
            <button id="copyButton">Copy</button>
        </div>
    </body>
</html>
<script>
var button = document.getElementById("copyButton");
var content = document.getElementById("banknumber");

button.addEventListener("click", function() {
    var range = document.createRange();
    var selection = window.getSelection();

    selection.removeAllRanges();

    range.selectNodeContents(content);
    selection.addRange(range);

    document.execCommand('copy');
}, false);
</script>