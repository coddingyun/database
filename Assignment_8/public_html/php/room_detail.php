<?php
//connect db
$conn = mysqli_connect(
    'localhost', // 주소
    'group34', // 사용자 이름
    'yunnie', // 비밀번호
    'group34'); // 데이터베이스 이름
// 쿼리스트링 받아오기
$filtered = array(
    'room_id'=>mysqli_real_escape_string($conn, $_GET['room_id'])
  );
// room_id로 room 정보 가져오기
$sql = "select * from Room where room_id = {$filtered['room_id']}";
$result = mysqli_query($conn, $sql);
// room 정보 테이블로 출력
$row = mysqli_fetch_array($result);
echo '<table border="1">';
echo '<tr>';
echo '<th>room_number</th><th>capacity</th><th>building</th>';
echo '</tr>';
$escaped = array(
    'room_number'=>htmlspecialchars($row['room_number']),
    'capacity'=>htmlspecialchars($row['capacity']),
    'building'=>htmlspecialchars($row['building'])
);
echo '<tr>';
echo "<td>{$escaped['room_number']}</td>";
echo "<td>{$escaped['capacity']}</td>";
echo "<td>{$escaped['building']}</td>";
echo '</tr>';
echo '</table>';

?>