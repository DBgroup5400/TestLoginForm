<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Contents-Type" conten="text/html;charset=UTF-8">
    <title> Login </title>
  </head>

  <body>
    <center>
      <font size='10'> login<br><br> </font>
      <form method="post" action="">
      <table>
        <tbody>
          <tr>
            <th> User &nbsp Name</th>
            <th> <input type="text" name="username"> </th>
          </tr>
          <tr>
            <th> Password</th>
            <th> <input type="password" name="password"> </th>
          </tr>
          <tr>
            <th colspan=2> <input type="submit" name="login" value="login"> </th>
          </tr>
        </tbody>
      </table>
    </center>
  </body>
</html>

<?php
  $dbname = "User";
  $index_POST = array( 0 => "username", 1 => "password", );
  $index_AUTH = array( 0 => "id",
    1 => "name",
    2 => "password", );

  echo "<center>";

  if( $_POST["login"] != "login" )
    die( "" );

  for( $i = 0; $i < 2; $i++ ){
    if( !$_POST[$index_POST[$i]] )
      die( "<br>require ".$index_POST[$i] );
  }

  session_start();

  $link = mysql_connect( "localhost", "team2", "testpassjhkkrokw" );
  if( !$link )
    die( "Connection Failed.".mysql_error() );

  $dbselect = mysql_select_db( $dbname, $link );
  if( !$dbselect )
    die( "DB Select Failed.".mysql_error() );

  $chartype = mysql_query( "SET NAMES utf8", $link );
  if( !$chartype )
    die( "Query Failed.".mysql_error() );

  $query = "SELECT * from ".$dbname.".Auth where name = '".$_POST["username"]."';";
  $result = mysql_query( $query );
  if( !$result )
    die( "Query Failed.".mysql_error() );
  if( !( $data = mysql_fetch_assoc( $result ) ) ){
    mysql_close( $link );
    die( "You don't sign up." );
  } else{
    $flag = mysql_close( $link );
    if( !$flag )
      die( "Close Failed.".mysql_error() );
    if( password_verify( $_POST["password"], $data["password"] ) ){
      session_regenerate_id( true );
      $_SESSION["id"] = $data["id"];
      header( "Location: userdata.php");
      exit;
    } else{
      die( "Authentication Failed." );
    }
  }
  echo "</center>";

?>
