<?php
    session_start();
    $username = $_SESSION['username'];
    $amount = $_POST['Amount'];
    $receiver = $_POST['Receiver'];
    $servername = "johnny.heliohost.org";
    $dbusername = "maciejko_admin";
    $dbpassword = "Maciusmi1";
    $dbname = "maciejko_bank";
    $title = 'test';
    $mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    $sql = "UPDATE users SET balance = balance-'$amount' where username='$username';";
    $sql .= "UPDATE users SET balance = balance+'$amount' where username='$receiver';";
    $sql .= "INSERT INTO transfers(username, amount, receiver, title) VALUES('$username','$amount','$receiver','$title')";
    if ($mysqli -> multi_query($sql)) {
        do {
          // Store first result set
          if ($result = $mysqli -> store_result()) {
            while ($row = $result -> fetch_row()) {
              printf("%s\n", $row[0]);
            }
           $result -> free_result();
          }
          // if there are more result-sets, the print a divider
          if ($mysqli -> more_results()) {
            printf("-------------\n");
          }
           //Prepare next result set
        } while ($mysqli -> next_result());
      }
      $mysqli -> close();
      header('Location:'.'main.php');
?>