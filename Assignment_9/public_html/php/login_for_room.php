<?php
//connect db
$conn = mysqli_connect(
    'localhost', // 주소
    'group34', // 사용자 이름
    'yunnie', // 비밀번호
    'group34'); // 데이터베이스 이름
// input user name and password
$filtered = array(
    'name'=>mysqli_real_escape_string($conn, $_POST['username']),
    'password'=>mysqli_real_escape_string($conn, $_POST['password'])
  );
// if user name and password is in table users_manage, then go to manage page
$sql = "select * from user_manage where user_name = '{$filtered['name']}' and user_password = '{$filtered['password']}'";
$result = mysqli_query($conn, $sql);
if($result->num_rows == 1){
    echo 'login success<br>';
    echo '<a href="../php/room.php">Go to room maintenance page</a>';
    //header('Location: ../maintain.html');
} else {
    echo 'login failed.<br>';
    echo 'You are not authorized to access this page.<br>';
    echo '<a href="../page/login_for_room.html">Back</a>';
    error_log(mysqli_error($conn));
}
?>