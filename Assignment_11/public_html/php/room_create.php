<?php
//report errors 
error_reporting(E_ALL);
ini_set('display_errors', 1);
// connect to mysql
$conn = mysqli_connect(
    'localhost', // 주소
    'group34', // 사용자 이름
    'yunnie', // 비밀번호
    'group34'); // 데이터베이스 이름
$conn2 = mysqli_connect(
    'localhost', // 주소
    'group34admin', // 사용자 이름
    'FourHour', // 비밀번호
    'group34'); // 데이터베이스 이름
$sql = "SELECT * FROM Room";
$result = mysqli_query($conn, $sql);

$filtered = array(
    'roomNum'=>mysqli_real_escape_string($conn, $_POST['roomNum']),
    'building'=>mysqli_real_escape_string($conn, $_POST['building']),
    'capacity'=>mysqli_real_escape_string($conn, $_POST['capacity']),
    'available'=>mysqli_real_escape_string($conn, $_POST['available'])
  );

$max_sql = "SELECT (ifnull(MAX(room_id),0))+1 FROM Room";
$max_result = mysqli_query($conn, $max_sql);
$max_row = mysqli_fetch_array($max_result);
$max_id = $max_row[0];
$sql = "
  INSERT INTO Room
    (room_id, building, room_number, capacity, available)
    VALUES(
        {$max_id},
        '{$filtered['building']}',
        '{$filtered['roomNum']}',
        '{$filtered['capacity']}',
        '{$filtered['available']}'
    )
";
$result = mysqli_query($conn2, $sql);
if($result === false){
    //inform the user that the query failed
    echo ("Errormessage:". $conn -> error);
    echo "<br>";
    echo 'There was an error. Please try again later.<br><a href="../maintain.html">Back</a>';
    //report the error to the server
    error_log(mysqli_error($conn));
} else {
    //inform the user of success in english
    echo 'Success! <a href="../maintain.html">Back</a>';
}
?>