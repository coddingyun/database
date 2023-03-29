<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = mysqli_connect(
  'localhost', // 주소
  'group34', // 사용자 이름
  'yunnie', // 비밀번호
  'group34'); // 데이터베이스 이름
$sql = "SELECT * FROM Room";
$result = mysqli_query($conn, $sql);

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
  </head>
  <body>
    <h1> Room Finder </h1>
    <h3> Enter the room information. </h3>
    <form action="room_create.php" method="POST">
      <p><input type="text" name="roomNum" placeholder="Room number"></p>
      <p><input type="text" name="building" placeholder="Building"></p>
      <p><input type="text" name="capacity" placeholder="Capacity"></p>
      <p><input type="text" name="available" placeholder="Available (true: 1, false: 0)"></p>
      <p><input type="submit"></p>
    </form>
  </body>
</html>