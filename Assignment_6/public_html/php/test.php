<?php
    //report errors 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $conn = mysqli_connect(
        'localhost', // 주소
        'group34', // 사용자 이름
        'coastroad', // 비밀번호
        'group34'); // 데이터베이스 이름
    if(isset($_POST['table1']) && isset($_POST['table2']))
    {   
        //create relationship between Users and Room
        $query = "INSERT INTO Book (user_id, room_id, start_date) VALUES ('".$_POST['table1']."', '".$_POST['table2']."', '".$_POST['date']."')";
        //report the sucess of the query and back to the pervious page
        if(mysqli_query($conn, $query))
        {
            echo 'Success <br> <a href="../maintain.html">Back</a>';
        }
        else
        {
            echo("Errormessage:". $conn -> error);
            echo "<br>";
            echo 'There was an error. Please try again later.<br><a href="../maintain.html">Back</a>';
        }
    }
?>