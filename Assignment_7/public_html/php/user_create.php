<?php
//report errors
error_reporting(E_ALL);
ini_set('display_errors', 1);
// connect to mysql
$conn = mysqli_connect(
    'localhost', // 주소
    'group34', // 사용자 이름
    'coastroad', // 비밀번호
    'group34'); // 데이터베이스 이름
// $sql = "SELECT * FROM Users";
// $result = mysqli_query($conn, $sql);

$filtered = array(
    'stID'=>mysqli_real_escape_string($conn, $_POST['stID']),
    'name'=>mysqli_real_escape_string($conn, $_POST['name']),
    'password'=>mysqli_real_escape_string($conn, $_POST['password'])
  );

// find max id + 1 and insert it into users
// $sql = "
//   INSERT INTO Users
//     (id, name, password)
//     VALUES(
//         (SELECT MAX(id) + 1 FROM Users),
//         '{$filtered['name']}',
//         '{$filtered['password']}'
//     )
$max_sql = "SELECT (ifnull(MAX(user_id),0))+1 FROM Users";
$max_result = mysqli_query($conn, $max_sql);
$max_row = mysqli_fetch_array($max_result);
$max_id = $max_row[0];
$sql = "
  INSERT INTO Users
    (user_id, ID, name, password)
    VALUES(
        {$max_id},
        '{$filtered['stID']}',
        '{$filtered['name']}',
        '{$filtered['password']}'
    )
";

// $sql = "
//   INSERT INTO Users
//     (user_id, ID, name, password)
//     VALUES(
//         (SELECT (ifnull(MAX(user_id),0))+1 FROM Users),
//       '{$filtered['stID']}',
//       '{$filtered['name']}',
//       '{$filtered['password']}'
//     )
// ";
$result = mysqli_query($conn, $sql);
if($result === false){
    //inform the user that the query failed
    echo("Errormessage:". $conn -> error);
    echo 'There was an error. Please try again later.<br><a href="../maintain.html">Back</a>';
    error_log(mysqli_error($conn));
} else {
    //inform the user of success in english
    echo 'Success! <br><a href="../maintain.html">Back</a>';
}
?>