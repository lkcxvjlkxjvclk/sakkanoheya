<?php
    $result = array();
    $resultData = "failed";

    $connection = mysqli_connect("localhost", "root", "", "phptest");
    mysqli_query("set names utf8");

    $today = date("Y-m-d (H:i:s)");
    $fileName = $today . ".jpg";

    if(move_uploaded_file($_FILES['file']['tmp_name'], "./image/" . $fileName)){
        chmod("../image/" . $fileName, 0777);
        // chmod("./image/" . $fileName, 0777); 원래 이건데 바꿈
        
        $query = mysqli_query($connection, "INSERT INTO MYGALLERY(imageName) VALUES('" . $fileName . "')");

        if($query)
            $resultData = "success";
        else
            unlink("../image/" . $fileName);
            // unlink("./image/" . $fileName); 원래 이건데 바꿈
    }

    $result = array('result' => $resultData, 'imageName' => $fileName);

    mysqli_close($connection);

    echo json_encode($result);
?>