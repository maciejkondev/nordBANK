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
    function sendMessage(){
        $conn = new mysqli("johnny.heliohost.org","maciejko_admin","Maciusmi1","maciejko_bank");
        $username = $_SESSION['username'];
        $hourMin = date('H:i');
        $message = $_POST['message'];
        $messagesql = "INSERT INTO livechat(username, message, time) VALUES ('$username', '$message','$hourMin')";
        $conn->query($messagesql);
        header('Location: https://nordbank.herokuapp.com/main.php');
    }
    if (isset($_GET['sendMessage'])) {
        sendMessage();
    }

?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="main2.css">
    </head>
    <body class="bg-light">
        <div>
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
            <div class="chatContainer">
                <h4 style="text-align: center">Live chat</h4>
                <div id="chat" class="chat bg-info">
                    <?php
                        refresh();

                        if (isset($_GET['refreshChat'])) {
                            refresh();
                            header('Location: https://nordbank.herokuapp.com/main.php');
                        }
                        
                        function refresh(){
                            $conn = new mysqli("johnny.heliohost.org","maciejko_admin","Maciusmi1","maciejko_bank");
                            $chatsql = "SELECT * from livechat";
                            $resultchat = $conn->query($chatsql);
                            if ($resultchat->num_rows > 0) {
                                while($row = $resultchat->fetch_assoc()) {
                                    echo $row["time"]. " | " . $row["username"]. ": " . $row["message"]. "<br>";
                                }
                            } else {
                                echo "No news, write something :)";
                            }

                        }
                    ?>
                    
                </div>
                <div class="button-container">
                    <form method="POST" action="main.php?sendMessage=true">
                        <input type="text" id="message" name="message" placeholder="Type your message">
                        <div>
                        <button id="submitChat" type="submit" class="btn btn-success">Send</button>
                        </div>
                    </form>
                    <form method="POST" action="main.php?refreshChat=true">
                        <div>
                        <button id="refreshChat" type="submit" class="btn btn-success">Refresh</button>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </body>
</html>
<script>
    var messageBody = document.querySelector('#chat');
    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
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