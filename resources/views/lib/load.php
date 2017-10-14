<?php
    $result = array();
    $callback = $_GET['callback'];
    $resultData = 'failed';

    // DB에 연결
    $connection = mysqli_connect("localhost", "root", "", "phptest");
    mysqli_query("set names utf8"); // 한글이 깨지지 않도록 유니코드로 설정

    $query = mysqli_query($connection, "SELECT * FROM MYGALLERY ORDER BY id DESC");
    
    // 쿼리문이 성공했는갈?
    if($query) {
        $resultData = "success";
        $data = array();

        $num = mysqli_num_rows($query);

        for($i = 0; $i < $num; $i++) {
            mysqli_data_seek($i);
            $row = mysqli_fetch_array($query);

            $id = $row['id'];
            $imageName = $row['imageName'];

            $data[$i] = array();
            $data[$i]['id'] = $id;
            $data[$i]['imageName'] = $imageName;
        }
    }

    $result = array('result' => $resultData, 'data' => $data);

    mysqli_close($connection);

    echo $callback . "(" . json_encode($result) . ")";
?>