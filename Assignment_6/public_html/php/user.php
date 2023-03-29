<?php
$conn = mysqli_connect(
  'localhost', // 주소
  'group34', // 사용자 이름
  'coastroad', // 비밀번호
  'group34'); // 데이터베이스 이름

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>WEB</title>
  </head>
  <body>
    <h1> Room Finder </h1>
    <h3> Enter your information. </h3>
    <form action="user_create.php" method="POST">
      <p><input type="text" name="stID" placeholder="Student id"></p>
      <p><input type="text" name="name" placeholder="Name"></p>
      <p><input type="text" name="password" placeholder="Password"></p>
      <p><input type="submit"></p>
    </form>
  </body>
</html>