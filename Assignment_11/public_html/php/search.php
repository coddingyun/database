<?php
// connect db
$conn = mysqli_connect(
    'localhost', // 주소
    'group34', // 사용자 이름
    'yunnie', // 비밀번호
    'group34'); // 데이터베이스 이름
// implement grant command to give permission to user and check it is successful and print why it is failed

// search room by capacity and date
$sql = "SELECT * FROM Room WHERE capacity >= {$_POST['capacity']} AND room_id NOT IN (SELECT room_id FROM Book WHERE start_date = '{$_POST['date']}')";
// $filtered = array(
//     'capacity'=>mysqli_real_escape_string($conn, $_POST['capacity'])
//   );
// $sql = "select * from Room where capacity >= {$filtered['capacity']} and available = 1";
$result = mysqli_query($conn, $sql);
if($result === false){
    //inform the user that the query failed
    echo("Errormessage:". $conn -> error);
    echo 'There was an error. Please try again later.<br><a href="../index.html">Back</a>';
    error_log(mysqli_error($conn));
} else {
    //inform the user that the query was successful
    //echo 'Success <br> <a href="../maintain.html">Back</a>';
    //show the result of available rooms and link to details
    echo '<h2>Available Rooms</h2>';
    //$row = mysqli_fetch_array($result);
    // if there is no available room, show the message
    if(mysqli_num_rows($result) == 0){
        echo 'There is no available room. Please try again later.<br><a href="../index.html">Back</a>';
    } else {
        while($row = mysqli_fetch_array($result)){
            echo '<a href="room_detail.php?room_id='.$row['room_id'].'">'.$row['room_number'].'</a><br>';
        }
    }
}

?>