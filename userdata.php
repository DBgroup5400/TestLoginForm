<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Contents-Type" conten="text/html;charset=UTF-8">
    <title> User Data </title>
  </head>

  <body>
    <center>
      <font size='10'> Your &nbsp Data<br><br> </font>
      <?php
        session_start();
        $dbname = "User";
        $link = mysql_connect( "localhost", "team2", "testpassjhkkrokw" );
        if( !$link )
          die( "Connection Failed.".mysql_error() );

        $dbselect = mysql_select_db( $dbname, $link );
        if( !$dbselect )
          die( "DB Select Failed.".mysql_error() );

        $chartype = mysql_query( "SET NAMES utf8", $link );
        if( !$chartype )
          die( "Query Failed.".mysql_error() );

        $query = "SELECT * from ".$dbname.".Data where id = ".$_SESSION["id"].";";
        $result = mysql_query( $query );
        if( !$result )
          die( "Query Failed.".mysql_error() );
        $data = mysql_fetch_assoc( $result );
        echo "<table><tbody><tr>";
        echo "<th>Your Name</th>";
        echo "<th>".$data["name"]."</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Your Location</th>";
        echo "<th>".$data["location"]."</th>";
        echo "</tr></tbody></table><br><br>";
      ?>
	  <font size='5'> <a href="logout.php"> logout<br> </a> </font>
    </center>
  </body>
</html>