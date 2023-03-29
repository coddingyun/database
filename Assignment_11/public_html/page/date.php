<?php
//connect db
$conn = mysqli_connect(
    'localhost', // 주소
    'group34', // 사용자 이름
    'yunnie', // 비밀번호
    'group34'); // 데이터베이스 이름
$q=$_GET['term']; 
$sql="SELECT start_date FROM Book WHERE start_date LIKE '%".$q."%'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)) {
    //echo $row['start_date'];
$json[]=array(
'value'=> explode(" ",$row['start_date'])[0],
'label'=> explode(" ",$row['start_date'])[0]
);
}
echo json_encode($json);
?>