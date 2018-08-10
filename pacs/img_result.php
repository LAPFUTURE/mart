<?php //请求图片及结果，医生提交阅片病历
require('conn.php');
if(isset($_POST["ImageNames"])){//fundus信息，返回眼底图片及结果
	$ImageNames = $_POST["ImageNames"];
	$sql = "SELECT * from result where ImageName = '$ImageNames'";
	$res = $conn->query($sql);
	if($res->num_rows > 0){//判断条数是否为0
        for($i=0;$i<$res->num_rows;$i++){
    		while($arr = $res->fetch_assoc()){
    			$data[] = $arr;
    		}
            $data[$i]["Date"] = substr($data[$i]["Date"],0,4)."-".
                               substr($data[$i]["Date"],4,2)."-".
                               substr($data[$i]["Date"],6,2);
            $arr1[] = $data[$i];
        }
    }else{
        $arr1 = ["message"=>"数据库无此图片"];
    }
    echo json_encode((object)$arr1);
}

if(isset($_POST["readRecords"]) && isset($_POST["patientId"]) && isset($_POST["fullDate"]) && isset($_POST["DoctorName"])  && isset($_POST["ImgName"])){//将阅片病历写入数据库
    $sql = "INSERT INTO result (Patient_id,`Date`,doctorName,Result,ImageName) VALUES ('{$_POST["patientId"]}','{$_POST["fullDate"]}','{$_POST["DoctorName"]}','{$_POST["readRecords"]}','{$_POST["ImgName"]}')";
    $conn->query($sql);
    $arr2 = [
    "rse" => $_POST,
    "message" => "success"
    ];
   echo json_encode((object)$arr2);
}

if(isset($_POST["doctorNames"]) && isset($_POST["ImgNamess"])){
    $doctorNames = $_POST["doctorNames"];
    $ImgNamess   = $_POST["ImgNamess"];
    $sql = "SELECT Result from result where DoctorName = '$doctorNames' and ImageName = '$ImgNamess'";
    $res = $conn->query($sql);
    if($res->num_rows > 0){//判断条数是否为0
        while($arr = $res->fetch_assoc()){
            $data[] = $arr;
        }        
    }
    $arr3 = [
    "res" => $data[0]["Result"],
    "message" => "success"
    ];
   echo json_encode((object)$arr3);
}

?>