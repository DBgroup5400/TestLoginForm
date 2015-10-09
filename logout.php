<?php
  session_start();
  echo "<center><font size=\'10\'>";
  if( !isset( $_SESSION["id"] ) ){
    echo "You were logout.<br><br>";
  } else{
  	echo "Seeeion timed out.<br><br>";
  }
  echo "</font></center>";
  session_destroy();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Contents-Type" conten="text/html;charset=UTF-8">
    <title> Logout </title>
  </head>

  <body>
    <center>
      <font size='5'> <a href="login.php"> login<br> </a> </font>
      <font size='5'> <a href="home.html"> home<br> </a> </font>
    </center>
  </body>
</html>