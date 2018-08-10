<?php
    header("Access-Control-Allow-Origin: *"); 
    require('conn.php');
    if(isset($_POST["dates"])){ 
    	$dates = (string)$_POST["dates"];
    	// echo $dates;
    	$StudyDate_Ymd = str_replace("-","",$dates);
    	$sql = "SELECT * from patient where StudyDate_Ymd='$StudyDate_Ymd'";
    	$res = $conn->query($sql);
        if($res->num_rows > 0){
			while($arr = $res->fetch_assoc()){
				$data[] = $arr["PatientName"];}
        }else{
        	$data =  ["message" => "没有在这个日期的病人!"];
        }
        $arr = $data;
        echo json_encode((object)$arr);
    }
?>