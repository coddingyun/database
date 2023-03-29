<?php
//connect db
$conn = mysqli_connect(
    'localhost', // 주소
    'group34', // 사용자 이름
    'yunnie', // 비밀번호
    'group34'); // 데이터베이스 이름
$q=$_GET['term']; 
$sql="SELECT capacity FROM Room WHERE capacity LIKE '%".$q."%'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)) {
$json[]=array(
'value'=> $row['capacity'],
'label'=> $row['capacity']
);
}
echo json_encode($json);
?>