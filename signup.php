<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Contents-Type" conten="text/html;charset=UTF-8">
    <title> Sign up </title>
  </head>

  <body>
    <center>
      <font size='10'> Sign &nbsp up<br><br> </font>
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
            <th> Your &nbsp Location </th>
            <th> <input type="text" name="location"> </th>
          </tr>
          <tr>
            <th colspan=2> <input type="submit" name="send" value="send"> </th>
          </tr>
        </tbody>
      </table>
      </form>
    </center>
  </body>
</html>

<?php
  $dbname = "User";
  $index_POST = array( 0 => "username",
    1 => "password",
    2 => "location", );
  $index_AUTH = array( 0 => "id",
    1 => "name",
    2 => "password", );
  $index_DATA = array( 0 => "id",
    1 => "name",
    2 => "location", );

  echo "<center>";

  if( $_POST["send"] != "send" )
    die( "" );

  for( $i = 0; $i < 3; $i++ ){
    if( !$_POST[$index_POST[$i]] )
      die( "<br>require ".$index_POST[$i] );
  }

  $link = mysql_connect( "localhost", "team2", "testpassjhkkrokw" );
  if( !$link )
    die( "Connection Failed.".mysql_error() );

  $dbselect = mysql_select_db( $dbname, $link );
  if( !$dbselect )
    die( "DB Select Failed.".mysql_error() );

  $chartype = mysql_query( "SET NAMES utf8", $link );
  if( !$chartype )
    die( "Query Failed.".mysql_error() );

  $query = "SELECT max(id) from ".$dbname.".Auth;";
  $result = mysql_query( $query );
  if( !$result )
    die( "Query Failed.".mysql_error() );
  $data = mysql_fetch_assoc( $result );
  $user_id = $data["max(id)"] + 1;

  $HashedPass = password_hash( $_POST["password"], PASSWORD_DEFAULT );

  $query = "INSERT INTO ".$dbname.".Auth (id, name, password) VALUES (".$user_id.",'".$_POST["username"]."','".$HashedPass."');";
  $result = mysql_query( $query );
  if( !$result )
    die( "Query Failed.".mysql_error() );

  $query = "INSERT INTO ".$dbname.".Data (id, name, location) VALUES (".$user_id.",'".$_POST["username"]."','".$_POST["location"]."');";
  $result = mysql_query( $query );
  if( !$result )
    die( "Query Failed.".mysql_error() );

  $flag = mysql_close( $link );
  if( !$flag )
    die( "Close Failed.".mysql_error() );

  echo "<br>Complete<br><br>";
  echo "<font size=\'5\'> <a href=\"home.html\"> home<br> </a> </font>";
  echo "<font size=\'5\'> <a href=\"login.php\"> login<br> </a> </font>";
  echo "</center>";
?>
