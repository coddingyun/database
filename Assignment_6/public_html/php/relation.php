<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = mysqli_connect(
  'localhost', // 주소
  'group34', // 사용자 이름
  'coastroad', // 비밀번호
  'group34'); // 데이터베이스 이름
?>

<!doctype html>
<html>
  <head>
    <title>WEB</title>
  </head>
  <body>
    <h1> Room Finder </h1>
    <h3> Choose the Use and Room</h3>
    <h3> Then enter the start date </h3>
  <form action="test.php" method="post">
        <select name="table1">
            <?php
                echo "<option value='User'>User</option>";
                $conn = mysqli_connect(
                    'localhost', // 주소
                    'group34', // 사용자 이름
                    'coastroad', // 비밀번호
                    'group34'); // 데이터베이스 이름
                //query to get all the data from the table
                //select all of the data in Users table
                $sql = "SELECT * FROM Users";
                $result = mysqli_query($conn, $sql);
                //loop through the data
                while($row = mysqli_fetch_array($result)){
                    //display the data
                    echo "<option value='".$row['user_id']."'>".$row['name']."</option>";
                }
            ?>
        </select>
        <select name="table2">
            <?php
                //query to get all the data from the table
                echo "<option value='User'>Room</option>";
                // select all of the data from the table Room
                $sql = "SELECT * FROM Room";
                $result = mysqli_query($conn, $sql);
                //loop through the data
                while($row = mysqli_fetch_array($result)){
                    //display the data
                    echo "<option value='".$row['room_id']."'>".$row['room_number']."</option>";
                }
            ?>
        </select>
        <input type="date" name="date" placeholder="Start date">
        <input type="submit" value="Submit" />
    </form>
  </body>
</html>